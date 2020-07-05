
var util = require('util');
var mysql = require('mysql');
//I need aws-sdk access
var AWS = require('aws-sdk');


var S = new AWS.S3({
    maxRetries: 0,
    region: 'us-west-2',
});


var connection = mysql.createConnection({
    host: "ls-77e1472d76ad627554447c61511cf31b8998c2ce.c1ca77nowf79.us-west-2.rds.amazonaws.com",
    user: "dbmasteruser",
    password: "comp4900",
    database: "database1",
});

//we have s3 bucket info in event.
exports.handler = function(event, context, callback) {
    // Read options from the event.
    console.log("Reading options from event:\n", util.inspect(event, {depth: 5}));
    
    var srcBucket = event.Records[0].s3.bucket.name;
    //s3.object.key would be test_list.csv
    var srcKey    = event.Records[0].s3.object.key;

    console.log("scrBucket: ", srcBucket);
    console.log("srcKey:    ", srcKey);

    // don't run on anything that isn't a CSV
    if (srcKey.match(/\.csv$/) === null) {
        var msg = "Key " + srcKey + " is not a csv file, bailing out";
        console.log(msg);
        return callback(null, {message: msg});
    }


    S.getObject({
        Bucket: srcBucket,
        Key: srcKey,
    }, function (err, data) {
        if (err !== null) { return callback(err, null); }
        console.log("Raw CSV data: " + data.Body.toString('utf-8'));
        //for i = first row to last row
        //process the row -> find (parse) each piece of data map it to a row in the DB
        //insert into db
        console.log(line);
        console.log(line[1]);

        var data = {User_First_Name: line[0], User_Last_Name: line[1], User_Email: 'bill@gmail.com', Active: 1, User_Type_User_Type_ID: 1};

        connection.query('INSERT INTO User SET ?', line, function (error, results, fields) {
        if (error) {
            connection.destroy();
            throw error;
        } else {
            // connected!
            console.log(results);
            callback(error, results);
            connection.end(function (err) { callback(err, results);});
        }
        });
        var lines = data.Body.toString('utf-8').split('\n');
        
        lines.slice(1).forEach(function (raw_line) {
            var line = raw_line.split(',');
            console.log(line);
        });
        return callback(null, data);
    });
};

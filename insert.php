

<?php

        $con = mysqli_connect('ls-77e1472d76ad627554447c61511cf31b8998c2ce.c1ca77nowf79.us-west-2.rds.amazonaws.com', 'dbmasteruser', 'comp4900', 'database1');

        if (!$con){
                echo 'not connected to server';
        }

        if (!mysqli_select_db($con, 'database1')){
                echo 'database not selected' . mysqli_connect_error();
        }

        $type = $_POST['type'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];

        $sql = "INSERT INTO User (User_Type_User_Type_ID, User_First_Name, User_Last_Name, User_Email) VALUES ('$type', '$fname', '$lname', '$email')";

        if (!mysqli_query($con, $sql)){
                echo 'not inserted';
        }else{
                echo 'inserted';
        }

        header("refresh:5; url = index.html");

?>
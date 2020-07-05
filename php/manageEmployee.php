<?php
ini_set ('display_errors', '1');
error_reporting(E_ALL);
	$con = mysqli_connect('ls-77e1472d76ad627554447c61511cf31b8998c2ce.c1ca77nowf79.us-west-2.rds.amazonaws.com', 'dbmasteruser', 'comp4900', 'database1');

        if (!$con){
                echo 'not connected to server';
        }

        if (!mysqli_select_db($con, 'database1')){
                echo 'database not selected' . mysqli_connect_error();
        }
		
	$sql = "SELECT * FROM User";
	
	$records = mysqli_query($con, $sql);
	
?>

<html>

<head>

<title> Manage Employee </title>

</head>

<body>

<table width = "600" border ="1" cellpadding = "1" cellspacing = "1">

<tr>
<th> First name</th>
<th> Last name</th>
<th> Email </th>
<th> User Type</th>
</tr>

<?php
ini_set ('display_errors', '1');
error_reporting(E_ALL);

	while($user = mysqli_fetch_assoc($records)){
		echo "<tr>";
		
		echo "<td>".$user['User_First_Name']."</td>";
		echo "<td>".$user['User_Last_Name']."</td>";
		echo "<td>".$user['User_Email']."</td>";
		echo "<td>".$user['User_Type_User_Type_ID']."</td>";
		echo "</tr>";
	}
?>

</table>

Deleting links

<table width = "600" border ="1" cellpadding = "1" cellspacing = "1">

<tr>
<th> First name</th>
<th> Last name</th>
<th> Email </th>
<th> User Type</th>
</tr>

<?php
ini_set ('display_errors', '1');
error_reporting(E_ALL);

	while($user = mysqli_fetch_assoc($records)){
		echo "<tr>";
		
		echo "<td>".$user['User_First_Name']."</td>";
		echo "<td>".$user['User_Last_Name']."</td>";
		echo "<td>".$user['User_Email']."</td>";
		echo "<td>".$user['User_Type_User_Type_ID']."</td>";
		echo "</tr>";
	}
?>

</table>
</body>
</html>

 
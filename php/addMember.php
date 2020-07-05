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
		
	$sql = "SELECT * FROM User WHERE Active = 1";
	$archivedUser = "SELECT * FROM User WHERE Active = 0";
	$records = mysqli_query($con, $sql);
	$records1 = mysqli_query($con, $sql);
	$records2 = mysqli_query($con, $archivedUser);
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Add Member
	</title>
</head>
<body>

	<table width = "600" border ="1" cellpadding = "1" cellspacing = "1">

<tr>
<td><form name="form1" method="post" action="">
<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<td bgcolor="#FFFFFF">&nbsp;</td>
<td colspan="3" bgcolor="#FFFFFF"><strong>Active</strong> </td>
<table width = "600" border ="1" cellpadding = "1" cellspacing = "1">

<tr>
<th> # </th>
<th> User ID</th>
<th> First name</th>
<th> Last name</th>
<th> Email </th>
<th> User Type</th>
</tr>

<?php
ini_set ('display_errors', '1');
error_reporting(E_ALL);

	while($user = mysqli_fetch_assoc($records1)){
?>

<tr>
<td align="center" ><input name="checkbox[]" type="checkbox" value="<?php echo $user['User_ID']; ?>"></td>
<td><?php echo $user['User_ID']; ?></td>
<td><?php echo $user['User_First_Name']; ?></td>
<td><?php echo $user['User_Last_Name']; ?></td>
<td><?php echo $user['User_Email']; ?></td>
<td><?php echo $user['User_Type_User_Type_ID']; ?></td>
</tr>

<?php
	}
?>
<tr>
<td colspan="4" align="center"><input name="add" type="submit" value="Add Member"></td>
</tr>

<?php

// Check if add button active, start this 

if (isset($_POST['add']) && isset($_POST['checkbox'])) {
        $add_id = (int)$add_id;
        //$q = "SELECT COUNT(1) FROM Project WHERE User_User_ID = "
        //if()
        $add = "UPDATE Project SET Project_Name = 'daniel' FROM Project
        	INNER JOIN User ON Project.User_User_ID = User.User_ID WHERE User_User_ID = $add_id"; 
        $add_now = mysqli_query($con, $add);
        if ($add_now){
        	echo "<meta http-equiv=\"refresh\" content = \"0; URL = addMember.php\">";
		}else{
			echo "cant add, the user still have a project active";
		}
}


//if ($add_now){
//        echo "<meta http-equiv=\"refresh\" content = \"0; URL = addMember.php\">";
//}else{
//	echo "cant add, the user still have a project active";
//}

?>

</table>

</form>
</td>
</tr>

</body>
</html>
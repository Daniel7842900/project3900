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

/*    $sql = "SELECT Project.Project_Name, Project.Project_Desc,
    	User.User_First_Name, User.User_Last_Name
    	FROM Project
    	INNER JOIN User
    	ON Project.User_User_ID = User.User_ID";*/

    $sql = "SELECT User.User_First_Name, User.User_Last_Name
    FROM User
    INNER JOIN Project
    ON User.User_ID = Project.User_User_ID
    WHERE Project.Project_Name = 'daniel'";
    $records = mysqli_query($con, $sql);
    $records2 = mysqli_query($con, $sql);

/*    $sql = "INSERT INTO User (User_Type_User_Type_ID, User_First_Name, User_Last_Name, User_Email) VALUES ('$type', '$fname', '$lname', '$email')";*/
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Edit Project
	</title>
</head>
<body>

 	<?php
//		ini_set ('display_errors', '1');
//		error_reporting(E_ALL);
//		
//		$i = 0;
//		while($wt = mysqli_fetch_assoc($records)){
	?>

	<form action= "editProject.php" method ="post">

		Project Name:* <input type = "text" name = "pname"> <br/>
		
		<?php

			if (isset($_POST['pname'])){

				$pname = $_POST['pname'];
				$sql2 = "UPDATE Project SET Project_Name = '$pname' WHERE Project_ID = 1"; 

				if(mysqli_query($con, $sql2)){ 
	    			echo "Record was updated successfully."; 
				} else { 
	    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
				}
			}
		?>
		Description:* <input type = "text" name = "desc"> <br/>
		<?php

			if (isset($_POST['desc'])){

			    $desc = $_POST['desc'];
				$sql3 = "UPDATE Project SET Project_Desc = '$desc' WHERE Project_ID = 1"; 

				if(mysqli_query($con, $sql3)){ 
	    			echo "Record was updated successfully."; 
				} else { 
	    			echo "ERROR: Could not able to execute $sql2. " . mysqli_error($con); 
				}
			}
		?>
		Members: </br>
		<?php
			$i = 0;
			while($wt = mysqli_fetch_assoc($records)){
		?>
			<option value = "1"><?php echo $wt['User_First_Name']." ".$wt['User_Last_Name'] ?></option>
		<?php
				}
		?>

		<input type = "submit" name = "addmember" value = "Add member"> <br/>
		
		<label>
			Project Manager:
		</label>
		<select name = "managers">
			<?php
				$i = 0;
				while($wt = mysqli_fetch_assoc($records2)){
			?>
			<option value = "1"><?php echo $wt['User_First_Name']." ".$wt['User_Last_Name'] ?></option>
			<?php
				}
			?>
		</select> <br/>
		<input type = "submit" name = "saveform" value = "Save">
	</form>
	<?php
    $managers = $_POST['managers'];
    $btnMember = $_POST['addmember'];
    $btnSave = $_POST['saveform'];
	?>
</body>
</html>
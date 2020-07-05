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

	$sql = "SELECT Category.Category_Code, Category.Category_Name	
        FROM Category";
    $sql2 = "SELECT Category.Category_ID
    	FROM Category";
	$records = mysqli_query($con, $sql);
	$records2 = mysqli_query($con, $sql2);
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Work Breakdown Structure
	</title>
</head>
<body>

<form action="workBreakDown.php" method="post">
	<input type="button" name="add_cat" value="Add Category">
	<table>
		<tr>
			<th>
				
			</th>
			<th>
				Assignee
			</th>
			<th>
				Start Date
			</th>
			<th>
				End Date
			</th>
			<th>
				Budget
			</th>
		</tr>
		<?php
			ini_set ('display_errors', '1');
			error_reporting(E_ALL);

		    $j = 0;
			while($wt = mysqli_fetch_assoc($records)){
		?>

		<tr>
			<td> <?php echo $wt['Category_Code']. " " . $wt['Category_Name']; ?>
				<input type = "button" name = "del" value="del"><input type="button" name="add" value="+">
				<input type="button" name="showTask" value="expand"><input type="button" name="edit" value="edit">
			</td>
		    <td> <input type = "text" name = "assignee[]"> </td>
		    <td> <input type = "text" name = "startDate[]"></td>
		    <?php

		    	//while($wt2 = mysqli_fetch_assoc($records2)) {

				if (isset($_POST['startDate'])){

					$start = $_POST['startDate'][0];
					$sql3 = "UPDATE Category SET Category_Start_Date = '$start' WHERE Category_Code = '1000'"; 

					if(mysqli_query($con, $sql3)){ 
		    			echo "Record was updated successfully."; 
					} else { 
		    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
					}
				}

				//}
			?>
		    <td> <input type = "date" name = "endDate[]"></td>
		    <td> <input type = "number" name="budget[]"></td>
		</tr>
		<?php
			}
		?>  
	</table>
	<input type="submit" name="SAVE">

</form>
</body>
</html>
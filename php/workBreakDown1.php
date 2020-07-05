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

	$sql = "SELECT Category.Category_Code, Category.Category_Name, Category.Category_ID	
        FROM Category";
    $sql2 = "SELECT Category.Category_ID
    	FROM Category";

    $sql3 = "SELECT User.User_First_Name, User.User_Last_Name
    FROM User
    INNER JOIN Project
    ON User.Project_Project_ID = Project.Project_ID
    WHERE Project.Project_Name = 'daniel'";


    $sql5 = "SELECT Task.Task_Code, Task.Task_Name, Category.Category_ID
    	FROM Task
    	INNER JOIN Category
    	ON Task.Category_Category_ID = Category.Category_ID";

	$records = mysqli_query($con, $sql);
	$records2 = mysqli_query($con, $sql2);
	$records3 = mysqli_query($con, $sql3);
	$records5 = mysqli_query($con, $sql5);
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Work Breakdown Structure
	</title>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>   
    <script type = "text/javascript">
      
      $(document).ready(function () {
        var counter = 1;
        $("#add_row_category").click(function () {
            new_elem = $("#template").clone().appendTo("#myTable tbody").show().attr("id", "addr" + counter);
            counter += 1;
        });
        });
        
  </script>
  <script>
    $(function() {
    // HTML template of a row
    var html = "<tr><td><input type = 'text' placeholder='Task Code' name = 'taskCode[]'><input type = 'text' placeholder='Task Name' name = 'taskName[]'></td><td><input type = 'text' style = 'display:none'></input></td><td><input type = 'text' name = 'taskStart[]'></td><td> <input type ='text' name = 'taskEnd[]'></td><td> <input type ='text' name = 'taskBudget[]'></td></tr>";

    $('#myTable').delegate('button.add_row_task', 'click', function() {
        var row = $(this).closest('tr'); // get the parent row of the clicked button
        $(html).insertAfter(row); // insert content
    });
});
  </script>  
        
    
</head>
<body>

<form action="workBreakDown1.php" method="post">
	<input type="button" name="add_cat" value="Add Category" id = "add_row_category">
	<table id = "myTable">
        <tr id = "template" style = "display:none">
          <td><input type = "text" placeholder="Category Code" name = "catCode[]">
          <input type = "text" placeholder="Category Name" name = "catName[]"> </td>
          <td><input type = "text" style = "display:none" ></td>
          <td><input type = "text" style = "display:none"></td>
          <td> <input type ="text" style = "display:none"></td>
        </tr>

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
		//	ini_set ('display_errors', '1');
		//	error_reporting(E_ALL);

		    $j = 0;
			while($wt = mysqli_fetch_assoc($records)){

		?>

		<tr id = "taskRow">
			<td> <?php echo $wt['Category_Code']. " " . $wt['Category_Name']; ?>
			<form method="post" action="">
				<input type="hidden" name="add_task" value="<?php echo $wt['Category_ID']; ?>">
				<?php
				echo $wt['Category_ID'];
				?>
 				<button type="button" name="add" class = "add_row_task">+</button>
 			</form>
              <input type = "button" name = "del" value="del">
                <input type="button" name="edit" value="edit">
			</td>
		    <td> <input type = "text" name = "assignee[]"> </td>
		    <td> <input type = "text" name = "startDate[]"> </td>
		    <?php

		    	//$j = 0;
				//while($wt = mysqli_fetch_assoc($records)){
		    	//while($wt2 = mysqli_fetch_assoc($records2)) {
				//if (isset($_POST['startDate']){
				if (isset($_POST['startDate']) && isset($_POST['SAVE'])){
					//$start = "2019-05-30";
					$start = $_POST['startDate'][$j];
					$sql6 = "UPDATE Category SET Category_Start_Date = '$start' WHERE Category_Code = 1000"; 

					if(mysqli_query($con, $sql6)){ 
		    			echo "Record was updated successfully."; 
					} else { 
		    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
					}
				}

				
			?>
		    <td> <input type = "text" name = "endDate[]"></td>
		    <?php
				if (isset($_POST['endDate']) && isset($_POST['SAVE'])){
					//$start = "2019-05-30";
					$end = $_POST['endDate'][$j];
					$sql7 = "UPDATE Category SET Category_Start_Date = '$end' WHERE Category_Code = 1000"; 

					if(mysqli_query($con, $sql7)){ 
		    			echo "Record was updated successfully."; 
					} else { 
		    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
					}
				}
		    ?>
		    <td> <input type = "number" name="budget[]"></td>
		    <?php
			//	if (isset($_POST['budget']) && isset($_POST['SAVE'])){
					//$start = "2019-05-30";
			//		$budget = $_POST['budget'][$j];
			//		$sql5 = "UPDATE Category SET Category_Start_Date = '$end' WHERE Category_Code = 1000"; 

			//		if(mysqli_query($con, $sql4)){ 
		    //			echo "Record was updated successfully."; 
			//		} else { 
		    //			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
			//		}
			//	}
		    ?>
		</tr>
		<?php
              $k = 0;
			while($wt2 = mysqli_fetch_assoc($records5)){
				if($wt['Category_ID'] == $wt2['Category_ID']) {
		?>
  
            <tr>
			<td> <?php echo $wt2['Task_Code']. " " . $wt2['Task_Name']; ?>
				<input type = "button" name = "del" value="del"><input type="submit" name="add" value="+">
                <input type="button" name="edit" value="edit">
			</td>
		    <td>
		    <label>	
		    </label>
		    <select name = "assignee">
		    	<?php
					$i = 0;
					while($wt3 = mysqli_fetch_assoc($records3)){
				?>
				<option value = "1"><?php echo $wt3['User_First_Name']." ".$wt3['User_Last_Name'] ?></option>
				<?php
					}
                    mysqli_data_seek($records3, 0);
				?>
		    </select>
			<td> <input type = "text" name = "startDate[]"> </td>
		    <?php

		    	//$j = 0;
				//while($wt = mysqli_fetch_assoc($records)){
		    	//while($wt2 = mysqli_fetch_assoc($records2)) {
				//if (isset($_POST['startDate']){
				if (isset($_POST['startDate']) && isset($_POST['SAVE'])){
					//$start = "2019-05-30";
					$start = $_POST['startDate'][$k];
					$sql8 = "UPDATE Category SET Category_Start_Date = '$start' WHERE Category_Code = 1000"; 

					if(mysqli_query($con, $sql8)){ 
		    			echo "Record was updated successfully."; 
					} else { 
		    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
					}
				}

				
			?>
		    <td> <input type = "text" name = "endDate[]"></td>
		    <?php
				if (isset($_POST['endDate']) && isset($_POST['SAVE'])){
					//$start = "2019-05-30";
					$end = $_POST['endDate'][$k];
					$sql9 = "UPDATE Category SET Category_Start_Date = '$end' WHERE Category_Code = 1000"; 

					if(mysqli_query($con, $sql9)){ 
		    			echo "Record was updated successfully."; 
					} else { 
		    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
					}
				}
		    ?>
		    <td> <input type = "number" name="budget[]"></td>
		    <?php
				//if (isset($_POST['budget']) && isset($_POST['SAVE'])){
				//	$budget = $_POST['budget'][$k];
				//	$sql6 = "UPDATE Task SET Task_Budget = '$budget' WHERE Category_Code = 1000"; 

				//	if(mysqli_query($con, $sql6)){ 
		    	//		echo "Record was updated successfully."; 
				//	} else { 
		    	//		echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
				//	}
				//}
		    ?>
		</tr></br>
		<?php
				}
			}
			mysqli_data_seek($records5,0);
		?>
		<?php 
		}
		if (isset($_POST['taskCode']) && isset($_POST['taskName']) && isset($_POST['taskBudget'])
			&& isset($_POST['taskStart']) && isset($_POST['taskEnd']) && isset($_POST['SAVE'])){
  				
  				for($u = 0, $count = count($_POST('add_task'); $u < $count; $u++) {
					$add_id = strip_tags($_POST['add_task']);
  				}
  				echo $add_id;
  				
  			//$add_id = strip_tags($_POST['add_task']);
            $taskCode = $_POST['taskCode'];
            $taskName = $_POST['taskName'];
            $taskStart = $_POST['taskStart'];
            $taskEnd = $_POST['taskEnd'];
            $taskBudget = $_POST['taskBudget'];
            	
           		
            for ($q = 0, $count = count($_POST['taskCode']); $q < $count; $q++){  
				echo $q;
				echo $count;            
            	$sqlAddTask = "INSERT INTO Task (Task_Name, Task_Start_Date, Task_End_Date, Task_Budget, Task_code, Category_Category_ID, User_User_ID) VALUES ('$taskName[$q]', '$taskStart[$q]', '$taskEnd[$q]', '$taskBudget[$q]', '$taskCode[$q]', '$add_id', '1')";
            	$addTask = mysqli_query($con, $sqlAddTask);
            }
            
            if ($addTask){
                //echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
            }else{
                echo 'not inserted';
            }
        }
            
            	
/*
            for ($q = 0, $count = count($_POST['taskCode']); $q < $count; $q++){  
				echo $q;
				echo $count;            
            	$sqlAddTask = "INSERT INTO Task (Task_Name, Task_Start_Date, Task_End_Date, Task_Budget, Task_code, Category_Category_ID, User_User_ID) VALUES ('$taskName[$q]', '$taskStart[$q]', '$taskEnd[$q]', '$taskBudget[$q]', '$taskCode[$q]', '$add_id', '1')";
            	$addTask = mysqli_query($con, $sqlAddTask);
            }
            if ($addTask){
                //echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
            }else{
                echo 'not inserted';
            }
            }*/
      
/*            if (isset($_POST['catCode']) && isset($_POST['catName'])){
              $catCode = $_POST['catCode'];
              $catName = $_POST['catName'];
              
              for ($i = 1, $count = count($_POST['catCode']); $i < $count; $i++){
                
              
              $sqlAddCat = "INSERT INTO Category (Category_Name, Category_Start_Date, Category_End_Date, Category_Code) VALUES ('$catName[$i]', '2019-05-11', '2019-06-01', '$catCode[$i]')";
                
              $addCat = mysqli_query($con, $sqlAddCat);
              }
              if ($addCat){
                echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
              }else{
                echo 'not inserted';
              }
            }*/

/*			if (isset($_POST['taskCode']) && isset($_POST['taskName']) && isset($_POST['taskBudget'])
				&&isset($_POST['taskStart']) && isset($_POST['taskEnd'])){
            	$taskCode = $_POST['taskCode'];
                $taskName = $_POST['taskName'];
                $taskStart = $_POST['taskStart'];
                $taskEnd = $_POST['taskEnd'];
                $taskBudget = $_POST['taskBudget'];

                for ($q = 0, $count = count($_POST['taskCode']); $q < $count; $q++){  
					echo $q;
					echo $count;              
                	$sqlAddTask = "INSERT INTO Task (Task_Name, Task_Start_Date, Task_End_Date, Task_Budget, Task_code, Category_Category_ID, User_User_ID) VALUES ('$taskName[$q]', '$taskStart[$q]', '$taskEnd[$q]', '$taskBudget[$q]', '$taskCode[$q]', '1', '1')";
                	$addTask = mysqli_query($con, $sqlAddTask);
                }
                if ($addTask){
                  echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
                }else{
                  echo 'not inserted';
                }
            }*/
            mysqli_close($con);
		?>  
	</table>
	<input type="submit" name="SAVE">

</form>
</body>
</html>
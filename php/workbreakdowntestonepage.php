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

    $sql0 = "SELECT Task.Task_Code, Task.Task_Name, Category.Category_ID, Task.Task_ID
    	FROM Task
    	INNER JOIN Category
    	ON Task.Category_Category_ID = Category.Category_ID";

	$records = mysqli_query($con, $sql);
	$records2 = mysqli_query($con, $sql2);
	$records3 = mysqli_query($con, $sql3);
	$records0 = mysqli_query($con, $sql0);
	
?>

<!DOCTYPE html>
<html>
<head>
  
  <style>
    #category_row{
      background-color: gray;
    }
  </style>
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
    var html = '<tr><td><input type = "text" placeholder="Task Code" name = "taskCode[]"></td><td><input type = "text" placeholder="Task Name" name = "taskName[]"></td><td><input type = "text" style = "display:none" ></td><td><input type = "text" style = "display:none" ></td><td><input type = "text"></td><td> <input type ="text"></td><td> <input type ="text"></td></tr>';

    $('#myTable').delegate('button.add_row_task', 'click', function() {
        var row = $(this).closest('tr'); // get the parent row of the clicked button
        $(html).insertAfter(row); // insert content
    });
});
  </script>  
        
  <script>
    //template for Editing category
    $(function() {
    // HTML template of a row
    var html = '<tr><td><input type = "text" placeholder="New Category Code" name = "newCategoryCode"></td><td><input type = "text" placeholder="New Category Name" name = "newCategoryName"></td></tr>';

    $('#myTable').delegate('button.edit_category', 'click', function() {
        var row = $(this).closest('tr'); // get the parent row of the clicked button
        $(html).insertAfter(row); // insert content
    });
});
  </script>  
  
  <script>
    $(function() {
    // HTML template of a row
    var html = '<tr><td><input type = "text" placeholder="New Task Code" name = "newCategoryCode"></td><td><input type = "text" placeholder="New Task Name" name = "newCategoryName"></td></tr>';

    $('#myTable').delegate('button.edit_task', 'click', function() {
        var row = $(this).closest('tr'); // get the parent row of the clicked button
        $(html).insertAfter(row); // insert content
    });
});
  </script>  
  
  <script>
    $(function() {

    $('#myTable').delegate('button.delete_task', 'click', function() {
        var row = $(this).closest('tr'); // get the parent row of the clicked button
        row.remove(); // delete whole row
    });
});
  </script>  
    
</head>
<body>

<form action="workBreakDown1.php" method="post">
	<input type="button" name="add_cat" value="Add Category" id = "add_row_category">
	<table id = "myTable">
        <tr id = "template" style = "display:none">
          <td><input type = "text" placeholder="Category Code" name = "catCode[]"></td>
          <td><input type = "text" placeholder="Category Name" name = "catName[]"> </td>
          <td><input type = "text" style = "display:none" ></td>
          <td><input type = "text" style = "display:none"></td>
          <td> <input type ="text" style = "display:none"></td>
        </tr>
      
		<tr>

            <th>
				Code
			</th>
            <th>
                Name
            </th>
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

		<tr id = "category_row">
          <td> <?php echo $wt['Category_Code'] ?></td>
          <td> <?php echo $wt['Category_Name'] ?> </td>
          <td> 
            <form method = "post" action = "">
             <input type="hidden" name="delete_category" value="<?php echo $wt['Category_ID']; ?>">
             <input type = "submit" name = "delCategory" value = "del">
              
              <a href="editCategory.php?idCat= <?php echo $wt['Category_ID'] ?> ">Edit</a>
             <button type="button" name="add" class = "add_row_task"> + </button>           
		  </td>
            </form>
		    <td> <input type = "text" name = "assignee[]" style= "display: none"> </td>
		    <td> <input type = "text" name = "startDate[]" style= "display: none"> </td>
		    <?php

		    	//$j = 0;
				//while($wt = mysqli_fetch_assoc($records)){
		    	//while($wt2 = mysqli_fetch_assoc($records2)) {
				//if (isset($_POST['startDate']){
				if (isset($_POST['startDate']) && isset($_POST['SAVE'])){
					//$start = "2019-05-30";
					$start = $_POST['startDate'][$j];
					$sql3 = "UPDATE Category SET Category_Start_Date = '$start' WHERE Category_Code = 1000"; 

					if(mysqli_query($con, $sql3)){ 
		    			echo "Record was updated successfully."; 
					} else { 
		    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
					}
				}

				
			?>
		    <td> <input type = "text" name = "endDate[]"style= "display: none"></td>
		    <?php
				if (isset($_POST['endDate']) && isset($_POST['SAVE'])){
					//$start = "2019-05-30";
					$end = $_POST['endDate'][$j];
					$sql4 = "UPDATE Category SET Category_Start_Date = '$end' WHERE Category_Code = 1000"; 

					if(mysqli_query($con, $sql4)){ 
		    			echo "Record was updated successfully."; 
					} else { 
		    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con); 
					}
				}
		    ?>
		    <td> <input type = "number" name="budget[]"style = "display: none"></td>
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
			while($wt2 = mysqli_fetch_assoc($records0)){
				if($wt['Category_ID'] == $wt2['Category_ID']) {
		?>
  
            <tr>
              <td> <?php echo $wt2['Task_Code'] ?></td>
              <td> <?php echo $wt2['Task_Name'] ?> </td> 
              <td>  <form method = "post" action = ""><input type="hidden" name="delete_task" value="<?php echo $wt2['Task_ID']; ?>"><?php echo $wt2['Task_ID'];?><input type = "submit" name = "delTask" class = "delete_task" value = "del">
              <button type="button" name="edit" class = "edit_task" > edit </button></td></form> 
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
					$sql4 = "UPDATE Category SET Category_Start_Date = '$start' WHERE Category_Code = 1000"; 

					if(mysqli_query($con, $sql4)){ 
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
					$sql5 = "UPDATE Category SET Category_Start_Date = '$end' WHERE Category_Code = 1000"; 

					if(mysqli_query($con, $sql5)){ 
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
		</tr>
		<?php
				}
			}
			mysqli_data_seek($records0,0);
		?>
		<?php
  
              
			}
      
            //inserting new category
            if (isset($_POST['catCode']) && isset($_POST['catName'])){
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
            }
      
      
            //deleting task
            if (isset($_POST['delTask'])){
              $del_id = strip_tags($_POST['delete_task']);
              $deleteTimesheet = mysqli_query($con, "DELETE FROM Weekly_Timesheet WHERE Task_Task_ID = $del_id");
              $deleteTask1 = mysqli_query($con, "DELETE FROM Task WHERE Task_ID = $del_id");
              
              echo $del_id;
              
              if ($deleteTask1){
                //echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
              }
              else{
                echo "not deleted";
              }
            }
      
            //deleting category
            if (isset($_POST['delCategory'])){
              $del_id = strip_tags($_POST['delete_category']);
              $selectTask = "SELECT Task_ID FROM Task WHERE Category_Category_ID = $del_id";
              $recordTask = mysqli_query($con, $selectTask);
              
              while ($result = mysqli_fetch_assoc($recordTask)){
                $taskid = $result['Task_ID'];
               mysqli_query($con, "DELETE FROM Weekly_Timesheet WHERE Task_Task_ID = $taskid");
              }
              $deleteTask = mysqli_query($con, "DELETE FROM Task WHERE Category_Category_ID = $del_id");
              $deleteCategory1 = mysqli_query($con, "DELETE FROM Category WHERE Category_ID = $del_id");
              
              
              if ($deleteCategory1){
                echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
              }
              else{
                echo "not deleted";
              }
            }
      
                
            if (isset($_POST['newCategoryCode']) && isset($_POST['newCategoryName'])){
               $del_id = strip_tags($_POST['delete_category']);
              $newCategoryName = $_POST['newCategoryName'];
              $newCategoryCode = $_POST['newCategoryCode'];
                
              $changeCategory = mysqli_query($con, "UPDATE Category SET Category_Name = '$newCategoryName', Category_Code = '$newCategoryCode' WHERE Category_ID = $del_id");
              
              if ($changeCategory){
                echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
              }
              else{
                echo "not edited";
              }
            }

      mysqli_close($con);
		?>  
	</table>
	<input type="submit" name="SAVE">

</form>
</body>
</html>
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

    $sql1 = "SELECT User.User_First_Name, User.User_Last_Name
        FROM User
        INNER JOIN Project
        ON User.Project_Project_ID = Project.Project_ID
        WHERE Project.Project_Name = 'daniel'";

    $records1 = mysqli_query($con, $sql1);

?>
<?php

/*if (isset($_GET['id']) && isset($_POST['newCatName']) && isset($_POST['newCatCode'])){
  
  $catID = $_GET['id'];
  $catName = $_POST['newCatName'];
  $catCode = $_POST['newCatCode'];
  
  $changeCategory = mysqli_query($con, "UPDATE Category SET Category_Name = '$catName', Category_Code = '$catCode' WHERE Category_ID = '$catID'");
              
  if ($changeCategory){
    echo "edited";
  }
  else{
    echo "not edited";
  }
  
  
}*/
    
    if (isset($_GET['idCat'])){
      $catID = $_GET['idCat'];
      
      $sql = "SELECT * FROM Category WHERE Category_ID = '$catID'";
      
      $record = mysqli_query ($con, $sql);
    }
    
    while ($a = mysqli_fetch_assoc($record)){
      
    
?>

<html>
  <body>
  <form action="addTask.php" method="post">
    <input type = "text" name = "newTaskName" placeholder = "Input new task name" >
    <input type = "text" name = "newTaskCode" placeholder = "Input new task code" >
    <select name = "assignee">
    <?php
        $i = 0;
        while($wt1 = mysqli_fetch_assoc($records1)){
    ?>
        <option value = "1"><?php echo $wt1['User_First_Name']." ".$wt1['User_Last_Name'] ?></option>
    <?php
        }
        mysqli_data_seek($records1, 0);
    ?>
    </select>
    <input type = "date" name="newTaskStart">
    <input type = "date" name="newTaskEnd">
    <input type = "number" name = "budget">
    <input type = "hidden" name = "catID" value = "<?php echo $a['Category_ID']; ?>">
    <input type = "submit" name = "addNow" value = add>
  

  </form>
    
    <?php
    }

    if (isset($_POST['newTaskName']) && isset($_POST['newTaskCode']) && isset($_POST['newTaskStart'])
        && isset($_POST['newTaskEnd']) && isset($_POST['budget'])) {
      
        $catID = $_POST['catID'];
        $taskName = $_POST['newTaskName'];
        $taskCode = $_POST['newTaskCode'];
        $taskStart = $_POST['newTaskStart'];
        $taskEnd = $_POST['newTaskEnd'];
        $taskBudget = $_POST['budget'];
  
        $addNewTask = mysqli_query($con, "INSERT INTO Task (Task_Name, Task_Start_Date, Task_End_Date, Task_Budget, Task_code, Category_Category_ID, User_User_ID) VALUES ('$taskName', '$taskStart', '$taskEnd', '$taskBudget', '$taskCode', '$catID', '1')");
              
        if ($addNewTask){
            echo "added";
            //echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
        } else{
            echo "not added";
        }
    }

    ?>
    </body>
</html>

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
		
	$sql = "SELECT Category.Category_Code, Task.Task_Code, Task.Task_ID	
        FROM Task
		INNER JOIN Category 
        ON Task.Category_Category_ID = Category.Category_ID";
	$records = mysqli_query($con, $sql);
	
?>

<html>

<head>

<title> Timesheet </title>

</head>

<body>
<form action= "timesheet.php" method ="post">
  <div class="dropdown">
    <button class="dropbtn1">Dropdown</button>
      <div class="dropdown-content">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
      </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn2">Dropdown</button>
      <div class="dropdown-content">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
      </div>
  </div>
<table width = "600" border ="1" cellpadding = "1" cellspacing = "1">

<tr>
<th> Category Code</th>
<th> Task Code</th>
<th> Actuals</th>
<th> ETC </th>

</tr>

<?php
ini_set ('display_errors', '1');
error_reporting(E_ALL);

	while($wt = mysqli_fetch_assoc($records)){
    $i = 0;
?>

  <tr>
    <td> <?php echo $wt['Category_Code']; ?></td>
    <td> <?php echo $wt['Task_Code']; ?></td>
    <td> <input type = "number" name = "Actuals[]"> </td>
    <td> <input type = "number" name = "ETC[]"></td>
  </tr>
  
  <?php
    
       
  
  $taskID = $wt['Task_ID'];
                                          
  if (isset($_POST['Actuals']) && isset($_POST['ETC'])){
    
    $charged = $_POST['Actuals'][$i];
        $ETC = $_POST['ETC'][$i];
  $sql2 = "INSERT INTO Weekly_Timesheet (Actuals, ETC, Task_Task_ID) VALUES ('$charged', '$ETC', '$taskID')";
    
    if (!mysqli_query($con, $sql2)){
                echo 'not inserted';
        }else{
                echo 'inserted';
        }                                 
    }
     
  $i++;
  }


  ?>
</table>
    <input type="submit" name="SAVE">
  </form>
</body>
</html>

 
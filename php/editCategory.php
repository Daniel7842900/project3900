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
    
    if (isset($_GET['id'])){
      $catID = $_GET['id'];
      
      $sql = "SELECT * FROM Category WHERE Category_ID = '$catID'";
      
      $record = mysqli_query ($con, $sql);
    }
    
    while ($a = mysqli_fetch_assoc($record)){
      
    
?>

<html>
  <body>
  <form action="editCategory.php" method="POST">
    <input type = "text" name = "newCatName" placeholder="Input new category name" value = "<?php echo $a['Category_Name']; ?>" >
    <input type = "text" name = "newCatCode" placeholder = "Input new category code" value = "<?php echo $a['Category_Code']; ?>">
    <input type = "hidden" name = "catID" value = "<?php echo $a['Category_ID']; ?>">
    <input type = "submit" name = "editNow" value = Edit>
  

  </form>
    
    <?php
    }

    if (isset($_POST['newCatName']) && isset($_POST['newCatCode'])){
      
       $catID = $_POST['catID'];
  $catName = $_POST['newCatName'];
  $catCode = $_POST['newCatCode'];
  
  $changeCategory = mysqli_query($con, "UPDATE Category SET Category_Name = '$catName', Category_Code = '$catCode' WHERE Category_ID = '$catID'");
              
  if ($changeCategory){
    echo "<meta http-equiv=\"refresh\" content = \"0; URL = workBreakDown1.php\">";
  }
  else{
    echo "not edited";
  }
  
      
    }
    ?>
    </body>
</html>

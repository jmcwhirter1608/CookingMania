<!DOCTYPE html>

<html>
    <body>
        <?php include 'navbar.php';
            session_unset();
            session_destroy();
            header("Location: index.php");
        ?>
    </body>
</html>


<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit-comment'])) {
          
        switch(0){
          case 0: 
            if(empty($_POST['fname'])){
              $Err = "First Name is Required";
              break;
            } else{
              $fname = test_input($_POST['fname']);
            }
          case 1:
            if(empty($_POST['lname'])){
              $Err = "Last Name is Required";
              break;
            } else{
              $lname = test_input($_POST['lname']);
            }
        }
    }
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Comment</label>
    <input type='text' name='comment'>

    <input type='submit' name='submit-comment'>

</form>
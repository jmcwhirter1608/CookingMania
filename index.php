<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css\styles.css">
    <title>Cooking Mania</title>
</head>
<body>
    <?php    
    include 'dbconnection.php'; 
    session_start();
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
      } 

    echo '<h1>Welcome to Cooking Mania</h1>';

    if(isset($_SESSION['User_ID'])){
      header('Location: ProfilePage.php');
    } else{
      include "SignIn.php";
      include "Register.php";
    }
    ?>

    
</body>
</html>

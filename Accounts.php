<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css\styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <?php include 'dbconnection.php'?>
    <?php
    if(!isset($_COOKIE['AccType'])){
        header("Location: SignIn.php");
    } else{
        if($_COOKIE['AccType'] != 0){
            header("Location: index.php");
        }
    }
    ?>
    <h1>Create, Edit, or Deleted Accounts Here</h1>


    
</body>
</html>
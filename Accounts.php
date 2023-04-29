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
        if($_COOKIE['AccType'] != 1){
            header("Location: index.php");
        }
    }
    ?>
    <h1>Create</h1>
    <?php include 'Register/CreateAccount.php'?>
    <h1>Edit</h1>
    <div id='EditAccount-RowForm'>
        <div id='EditAccount-RowForm-Row'>User ID</div>
        <div id='EditAccount-RowForm-Row'>User Type</div>
        <div id='EditAccount-RowForm-Row'>First Name</div>
        <div id='EditAccount-RowForm-Row'>Last Name</div>
        <div id='EditAccount-RowForm-Row'>Email</div>
        <div id='EditAccount-RowForm-Row'>Phone Number</div>
        <div id='EditAccount-RowForm-Row'>Password</div>
        <div id='EditAccount-RowForm-Row'>Update</div>
    </div>
    <?php include 'Register/EditAccount.php'?>
    <h1>Delete</h1>


    
</body>
</html>
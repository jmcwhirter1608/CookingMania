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
    <?php
    if(!isset($_COOKIE['AccType'])){
        header("Location: SignIn.php");
    } else{
        if($_COOKIE['AccType'] != 1){
            header("Location: index.php");
        }
    }
    ?>
    <h3>Create</h3>
    <?php include 'Register/CreateAccount.php'?>
    <h3>Edit</h3>
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
    <h3>Delete</h3>
    <div id='DeleteAccount-RowForm'>
        <div id='DeleteAccount-RowForm-Row-header'>User ID</div>
        <div id='DeleteAccount-RowForm-Row-header'>User Type</div>
        <div id='DeleteAccount-RowForm-Row-header'>First Name</div>
        <div id='DeleteAccount-RowForm-Row-header'>Last Name</div>
        <div id='DeleteAccount-RowForm-Row-header'>Email</div>
        <div id='DeleteAccount-RowForm-Row-header'>Phone Number</div>
        <div id='DeleteAccount-RowForm-Row-header'>Password</div>
        <div id='DeleteAccount-RowForm-Row-Delete-header'>To Delete</div>
    </div>
    <?php include 'Register/DeleteAccount.php'?>



    
</body>
</html>
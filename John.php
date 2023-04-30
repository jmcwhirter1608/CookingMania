<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John</title>
</head>
<body>
    <?php include "navbar.php"?>
    <h1>John</h1>
    <?php
    if(!isset($_COOKIE['UserID'])){
        header("Location: SignIn.php");
    } 
    else{
        echo "Cookie \'UserID\' is ". $_COOKIE['UserID'] . "<br>";
    }

    ?>
</body>
</html>
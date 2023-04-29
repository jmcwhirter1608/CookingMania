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
    if(!isset($_COOKIE['email'])){
        header("Location: SignIn.php");
    } 
    else{
        echo "Cookie \'email\' is ". $_COOKIE['email'] . "<br>";
    }

    if(!isset($_COOKIE['psw'])){
        header("Location: SignIn.php");
    } 
    else{
        echo "Cookie \'psw\' is ". $_COOKIE['psw'] . "<br>";
    }
    ?>
</body>
</html>
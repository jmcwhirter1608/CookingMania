<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
</head>
<body>
    <?php include "navbar.php"?>
    <hr />
    <h1 align="center">Add Recipe as a Chef</h1>
    <?php include "dbconnection.php"?>
    <?php


    Print '<hr />';

    
    //close the connection
    mysqli_close($connection);
    ?>


</body>
</html>

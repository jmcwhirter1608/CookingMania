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
    <h1>Recipes List</h1>


    <?php

    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $database_name = "CookingMania";
    $connection = mysqli_connect($server_name, $user_name, $password, $database_name);


    $result = mysqli_query($connection, "SELECT * FROM Recipes");


    while ( $row = mysqli_fetch_array($result) ) {
        Print '<a align="center">'. $row['Recipe_name'] . "</a>";
        <div>
          <li><a href="Ariana.php">Ariana</a></li>
        </div>

     }
    //close the connection
    mysqli_close($connection);
    ?>

</body>
</html>

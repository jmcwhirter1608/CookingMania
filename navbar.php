<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav>
        <div class="container">
            <div class="navbar-header">
                <a class="Logo" href="index.php">Home</a>
            </div>
            <ul class="navbar body">
                <li><a href="Ariana.php">Ariana</a></li>
                <li><a href="John.php">John</a></li>
                <li><a href="Preksha.php">Recipes</a></li>


                <?php
                include "dbconnection.php";

                $result = mysqli_query($connection, "SELECT * FROM Users WHERE User_type = 2 ");

                Print '<li> <a href="create_recipe.php">'. 'Add Recipe'.'</a></li>';
                ?>

                <li><a href="Shri.php">Shri</a></li>
            </ul>
        </div>
    </nav>
</body>
</html>

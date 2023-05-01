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
<<<<<<< Updated upstream
                <li><a href="Preksha.php">Preksha</a></li>
                <li><a href="Recipe_list.php">Recipes Available</a></li>
=======
                <li><a href="view_recipe.php">Recipes</a></li>

                <?php
                include "dbconnection.php";

                $User_ID = 1; //get from cookie.

                $result = mysqli_query($connection, "SELECT User_type FROM Users WHERE User_ID = $User_ID");
                $user_type = array();

                while( $val = mysqli_fetch_array($result)){
                  $user_type[] = $val['User_type'];
                }

                if( $user_type[0] != 1){
                  Print '<li> <a href="create_recipe.php">'. 'Add Recipe'.'</a></li>';
                  Print '<li> <a href="edit_delete_recipe.php">'. 'Edit/Delete Recipe'. '</a></li>';
                }

                ?>


                <!-- <li> <a href="create_recipe.php"> Add Recipe </a></li> -->

>>>>>>> Stashed changes
                <li><a href="Shri.php">Shri</a></li>
            </ul>
        </div>
    </nav>
</body>
</html>

<!-- <?php
include "dbconnection.php";

$result = mysqli_query($connection, "SELECT * FROM Users WHERE User_type = 2 OR U ");

Print '';
?> -->

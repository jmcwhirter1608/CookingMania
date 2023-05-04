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
                <?php
                     session_start();
                    if(isset($_SESSION['User_ID'])){
                        echo "<li><a href=\"ProfilePage.php\">Profile</a></li>";
                        echo "<li><a href=\"SignOut.php\">Sign Out</a></li>";
                    } 
                ?>
                <li><a href="Ariana.php">Comments</a></li>
                <li><a href="view_recipe.php">Recipes</a></li>



                <?php

                if(isset($_SESSION['User_type'])){
                    switch($_SESSION['User_type']){
                        case 1:
                            break;
                        default:
                            echo '<li> <a href="create_recipe.php">Add Recipe</a></li>';
                          
                    }
                }


                ?>
                <li><a href="Shri.php">Shri</a></li>
            </ul>
        </div>
    </nav>
</body>
</html>

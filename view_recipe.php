<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
</head>
<body>
    <?php include "navbar.php"?>
    <hr />
    <h1 align="center">Recipes List</h1>
    <?php include "dbconnection.php"?>
    <?php

    $User_ID = $_SESSION['User_ID'];
    $user_type = $_SESSION['User_type'];

    //go through all the recipes and get all recipe data
    $result = mysqli_query($connection, "SELECT * FROM Recipes");
    
    while ( $recipe = mysqli_fetch_array($result) ) {
      //for each recipe get the name and the time of ingredients
      $recipe_id = $recipe['Recipe_ID'];
      Print '<hr />';
      Print '<h2 align="center">'. $recipe['Recipe_name'] . "</h2>";

      Print '<h4 align="center">'. "This recipe will take " . $recipe["Recipe_time"]. " hours. ". "</h4>";

      //print out the ingredients
      Print '<p align="center"> <b>'. " Recipe Ingredients and Quantities". " </b> </p>";
      Print '<p align="center" style="width: 100%">'. $recipe["Recipe_Ingredients"]. "</p>";
      Print "<br />";

      //print out the instructions
      Print '<p align="center"  > <b>'. " Recipe Instructions: ". "</b></p>";
      Print '<p align="center" style="width: 100%">'. $recipe["Recipe_instructions"]. "</p>";
      Print "<br />";

      //print the recipe level
      Print '<p align="center">'. "Recipe Difficulty: ". $recipe["Recipe_level"].'</p>';

      //get the recipe creator
      $name = mysqli_query($connection, "SELECT * FROM Users WHERE User_ID = ".$recipe["User_ID"]." ");
      $name_res = mysqli_fetch_array($name);
      Print '<p align="center">'. "Recipe Creator: ". $name_res["User_fname"]. " ".$name_res["User_lname"] .'</p>';

      //get the number of classes
      $class = mysqli_query($connection, "SELECT * FROM Classes WHERE Recipe_ID = ".$recipe["Recipe_ID"]." ");
      $class_num = mysqli_num_rows($class);


      Print '<p align="center">'. "Classes available: ". $class_num .'</p>';
      ?>


      <!-- make a edit button and post all of it to create recipe with the data.  -->
      <!-- if creator or admin -->
      <?php if( $User_ID == $recipe["User_ID"] || $user_type == 1 ) { ?>

        <div align='center'>


      <?php
        //admin or creator can also see the last date of update for this recipe.
        Print '<p align="center">'. "Recipe Last Updated: ". $recipe["last_update_date"].'</p>';
        Print '<p align="center">'. "Recipe ID: ". $recipe["Recipe_ID"].'</p>';
        //send all needed data to edit/delete
        echo "<form method='post' action='edit_delete_recipe.php'>
          <input type='hidden' name='recipe_id' value=". $recipe_id. ">
          <input type='submit' name='edit' value='Edit Recipe'>

        </form>";
      ?>
        </div>

      <?php }
        Print '<hr />';
        Print "<br />";

      }

      //close the connection
      mysqli_close($connection);
      ?>


</body>
</html>

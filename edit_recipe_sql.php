<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Created</title>
</head>
<body>
    <?php include "navbar.php"?>
    <hr />
    <h1> Recipe Status: </h1>
    <?php

      $server_name = "localhost";
      $user_name = "root";
      $password = "";
      $database_name = "CookingMania";



      $connection = new mysqli($server_name, $user_name, $password, $database_name);

      if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
      }

      // define variables
      $Recipe_ID = ($_REQUEST['recipe_id']);
      $Recipe_name = ($_REQUEST["recipename"]);
      $Recipe_time = ($_REQUEST["time"]);
      $Recipe_level = ($_REQUEST["level"]);
      $Recipe_instructions = ($_REQUEST["instructions"]);
      $Recipe_Ingredients = ($_REQUEST["ingredients"]);
      $User_ID = $_SESSION['User_ID'];
      $user_type = $_SESSION['User_type'];
      $last_update_date = date ('Y-m-d');


      //make sure is teacher or admin
      if( $user_type != 1){

        $result_id = $connection->prepare( "UPDATE Recipes SET Recipe_name = ?, last_update_date=?, Recipe_time = ? ,Recipe_instructions=?, Recipe_Ingredients=?, Recipe_level=? WHERE Recipe_ID=? ");
        $result_id->bind_param("sssssii", $Recipe_name, $last_update_date, $Recipe_time,$Recipe_instructions, $Recipe_Ingredients,  $Recipe_level, $Recipe_ID);

        $result_id->execute();

        Print '<h1>'.' You have updated the recipe with ID:'. $Recipe_ID. ' </h1>';

        //show updated information to user
        $result = mysqli_query($connection, "SELECT * FROM Recipes WHERE Recipe_ID=$Recipe_ID");

        $recipe = mysqli_fetch_array($result);
        Print '<hr />';
        Print '<h2 align="center">'. $recipe['Recipe_name'] . "</h2>";

        Print '<h4 align="center">'. "This recipe will take " . $recipe["Recipe_time"]. " hours. ". "</h4>";

        //print out the instructions
        Print '<p align="center"  > <b>'. " Recipe Instructions: ". "</b></p>";
        Print '<p align="center" style="width: 100%">'. $recipe["Recipe_instructions"]. "</p>";
        Print "<br />";

        //print ingredients
        Print '<p align="center"  > <b>'. " Recipe Ingredients: ". "</b></p>";
        Print '<p align="center" style="width: 100%">'. $recipe["Recipe_Ingredients"]. "</p>";
        Print "<br />";

        //print the recipe level
        Print '<p align="center">'. "Recipe Difficulty: ". $recipe["Recipe_level"].'</p>';

        Print '<p align="center">'. "Last Updated on: ". $recipe["last_update_date"].'</p>';

        //get the recipe creator
        $name = mysqli_query($connection, "SELECT * FROM Users WHERE User_ID = ".$recipe["User_ID"]." ");
        $name_res = mysqli_fetch_array($name);
        Print '<p align="center">'. "Recipe Creator: ". $name_res["User_fname"]. " ".$name_res["User_lname"] .'</p>';

        //get the number of classes
        $class = mysqli_query($connection, "SELECT * FROM Classes WHERE Recipe_ID = ".$recipe["Recipe_ID"]." ");
        $class_num = mysqli_num_rows($class);
        Print '<p align="center">'. "Classes available: ". $class_num .'</p>';

      }
      else{
        Print '<h1>'.' You do not have permissions to make recipes.'. ' </h1>';
      }

      //close the connection
      $connection -> close();
      ?>
  </body>

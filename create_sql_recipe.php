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

      //echo $_REQUEST["ingredient"];

      $connection = new mysqli($server_name, $user_name, $password, $database_name);

      if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
      }
      //will serve the form and insert into DB.

      // define variables
      $Recipe_name = ($_REQUEST["recipename"]);
      $Recipe_time = ($_REQUEST["time"]);
      $Recipe_level = ($_REQUEST["level"]);
      $Recipe_instructions = ($_REQUEST["instructions"]);
      $Recipe_ingredients = ($_REQUEST["ingredients"]);
      $recipe_creator = ($_REQUEST["User"]);

      $User_ID = $_SESSION['User_ID'];
      $last_update_date = date ('Y-m-d');
      $user_type = $_SESSION['User_type'];


      if( $user_type != 1){

        if ($user_type == 3){
          if( $recipe_creator != "" && $recipe_creator != $User_ID){
              $User_ID= $recipe_creator;
          }
        }

        //make sure not already inserted.
        $result_id = $connection->prepare( "SELECT Recipe_ID FROM Recipes WHERE Recipe_name = ? AND User_ID = ? AND last_update_date=? AND Recipe_time = ? AND Recipe_level=?");
        $result_id->bind_param("ssssi", $Recipe_name, $User_ID, $last_update_date, $Recipe_time, $Recipe_level);

        $result_id->execute();
        $result_id->bind_result($Recipe_ID);

        $Recipe_ids = array();
        while ($result_id->fetch()) {
          $Recipe_ids[] = $Recipe_ID;
        }

        //If new entry
        if ( $Recipe_ids == array() ){

          $insert_sql = $connection->prepare("INSERT INTO Recipes(Recipe_name, Recipe_time, Recipe_level, Recipe_instructions,Recipe_Ingredients, last_update_date, User_ID) Values (?, ?,?,?,?, ?, ?)");
          $insert_sql->bind_param("ssisssi", $Recipe_name, $Recipe_time, $Recipe_level, $Recipe_instructions, $Recipe_ingredients, $last_update_date, $User_ID );

          if ($insert_sql->execute() === TRUE) {
            Print  '<p>'. "New recipe created successfully". '</p>';
          } else {
            Print  '<p>'. "Error Recipe not created.". '</p>';
          }

          //return the recipe id of this newly inserted recipe.
          $result_id = $connection->prepare( "SELECT Recipe_ID FROM Recipes WHERE Recipe_name = ? AND User_ID = ? AND last_update_date=? AND Recipe_time = ? AND Recipe_level=?");
          $result_id->bind_param("ssssi", $Recipe_name, $User_ID, $last_update_date, $Recipe_time, $Recipe_level);

          $result_id->execute();
          $result_id->bind_result($Recipe_ID);

          while ($result_id->fetch()) {
            $Recipe_ids[] = $Recipe_ID;
          }

          Print '<p>'. "Recipe ID: ". $Recipe_ids[0].'</p>';

         }
        else{
          Print '<h1>'."Recipe already exists with ID ". $Recipe_ids[0].'</h1>';
        }

      }
      else{
        Print '<h1>'.' You do not have permissions to make recipes.'. ' </h1>';
      }

      //close the connection
      $connection -> close();
      ?>
  </body>

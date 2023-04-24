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
    <h1> Recipe Submitted. </h1>
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

      // define variables
      $Recipe_name = ($_REQUEST["recipename"]);
      $Recipe_time = ($_REQUEST["time"]);
      $Recipe_level = ($_REQUEST["level"]);
      $Recipe_instructions = ($_REQUEST["instructions"]);
      $User_ID = 1; //FIX ME
      $last_update_date = date ('Y-m-d');

      $result_id = $connection->prepare( "SELECT Recipe_ID FROM Recipes WHERE Recipe_name = ? AND User_ID = ? AND last_update_date=? AND Recipe_time = ? AND Recipe_level=?");
      $result_id->bind_param("ssssi", $Recipe_name, $User_ID, $last_update_date, $Recipe_time, $Recipe_level);

      $result_id->execute();
      $result_id->bind_result($Recipe_ID);

      $Recipe_ids = array();
      while ($result_id->fetch()) {
        $Recipe_ids[] = $Recipe_ID;
      }


      if ( $Recipe_ids == array() ){
        $insert_sql = $connection->prepare("INSERT INTO Recipes(Recipe_name, Recipe_time, Recipe_level, Recipe_instructions, last_update_date, User_ID) Values (?, ?,?,?, ?, ?)");
        $insert_sql->bind_param("ssissi", $Recipe_name, $Recipe_time, $Recipe_level, $Recipe_instructions, $last_update_date, $User_ID );

        if ($insert_sql->execute() === TRUE) {
          Print  '<p>'. "New recipe created successfully". '</p>';
        } else {
          Print  '<p>'. "Error Recipe not created.". '</p>';
        }


        $result_id = $connection->prepare( "SELECT Recipe_ID FROM Recipes WHERE Recipe_name = ? AND User_ID = ? AND last_update_date=? AND Recipe_time = ? AND Recipe_level=?");
        $result_id->bind_param("ssssi", $Recipe_name, $User_ID, $last_update_date, $Recipe_time, $Recipe_level);

        $result_id->execute();
        $result_id->bind_result($Recipe_ID);

        while ($result_id->fetch()) {
          $Recipe_ids[] = $Recipe_ID;
        }

        Print '<p>'. "Recipe ID: ". $Recipe_ids[0].'</p>';


        $ingredient_quanitity = $_REQUEST["ingredient_quantity"];
        $ingredient_id = 0;
        foreach ($ingredient_quanitity as $ingr_quantity){

          $insert_ingr = $connection->prepare("INSERT INTO Ingredient_List(Recipe_ID, Ingredient_ID, Ingredient_Quantity) Values (?, ?,?)");
          $insert_ingr->bind_param("iii", $Recipe_ids[0], $ingredient_id, $ingr_quantity);
          $ingredient_id++;


          if ($insert_ingr->execute() === TRUE) {
              Print  '<p>'. "ingredient linked successfully". "</p> ";
              Print '<br />';
          } else {
              Print  '<p>'. "ingredient not linked". "</p> ";
          }
        }

      }
      else{
        Print '<h1>'."Recipe already exists with ID ". $Recipe_ids[0].'</h1>';
      }



      //close the connection
      $connection -> close();
      ?>
  </body>

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
      $last_update_date = date ('Y-m-d H:i:s');


      $insert_sql = $connection->prepare("INSERT INTO Recipes(Recipe_name, Recipe_time, Recipe_level, Recipe_instructions, last_update_date, User_ID) Values (?, ?,?,?, ?, ?)");
      $insert_sql->bind_param("ssissi", $Recipe_name, $Recipe_time, $Recipe_level, $Recipe_instructions, $last_update_date, $User_ID );

      if ($insert_sql->execute() === TRUE) {
        echo "New recipe created successfully". "\n";
      } else {
        echo "Error Recipe not created.";
      }

      $result_id = $connection->prepare( "SELECT Recipe_ID FROM Recipes WHERE Recipe_name = ? AND Recipe_time = ? AND Recipe_level=? AND last_update_date=? AND User_ID=?");
      $result_id->bind_param("ssssss", $Recipe_name, $Recipe_time, $Recipe_level,  $last_update_date, $User_ID );

      $result_id->execute();
      $result_id->bind_result($Recipe_ID);

      while ($result_id->fetch()) {
        echo $Recipe_ID;
      }
      // /* fetch values */
      // while ($result_id->fetch()) {
      //     echo $Recipe_ID;
      // }
      // $id_val = $result_id->get_result();
      // $Recipe_ID = $id_val->fetch_assoc();

      // Print "<br />";
      //
      // echo "hello";
      // } else {
      //   echo "Error recipe id not got.";
      // }

      $Recipe_ID = 44;

      $ingredient_quanitity = $_REQUEST["ingredient_quantity"];
      $ingredient_id = 0;
      foreach ($ingredient_quanitity as $ingr_quantity){
        $insert_ingr = $connection->prepare("INSERT INTO Ingredient_List(Recipe_ID, Ingredient_ID, Ingredient_Quantity) Values (?, ?,?)");
        $insert_ingr->bind_param("iii", $Recipe_ID, $ingredient_id, $ingr_quantity);
        $ingredient_id++;


        if ($insert_ingr->execute() === TRUE) {
          echo "ingredient linked successfully \n" ;
          //echo $ingredient_id;
        } else {
          echo "ingredient not linked \n";
        }
      }

      //close the connection
      $connection -> close();
      ?>
  </body>

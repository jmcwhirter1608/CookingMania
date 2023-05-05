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

      // define variables
      $User_ID= $_SESSION['User_ID'];
      $Recipe_ID = ($_REQUEST['recipe_id']);
      $Recipe_Name = ($_REQUEST['recipe_name']);
      $user_type = $_SESSION['User_type'];

      //if can delete then remove.
      //if not a user
      if( $user_type != 3){

        $result_id = $connection->prepare( "DELETE FROM Recipes WHERE Recipe_ID=? ");
        $result_id->bind_param("i", $Recipe_ID);

        if($result_id->execute()){
          echo "<h1> You have deleted: $Recipe_Name Recipe with ID ". $Recipe_ID.'</h1>';

        }
        else{
          echo "<h1> Deletion failed </h1>";
        }

      }
      else{
        echo '<h1>'.' You do not have permissions to make recipes.'. ' </h1>';
      }

      //close the connection
      $connection -> close();
      ?>
  </body>

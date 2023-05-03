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
      $Recipe_ID = ($_REQUEST['recipe_id']);
      $Recipe_Name = ($_REQUEST['recipe_name']);


      $result = mysqli_query($connection, "SELECT User_type FROM Users WHERE User_ID = $User_ID");
      $user_type = array();
      while( $val = mysqli_fetch_array($result)){
        $user_type[] = $val['User_type'];
      }

      if( $user_type[0] != 1){

        
        $result_id = $connection->prepare( "DELETE FROM Recipes WHERE Recipe_ID=? ");
        $result_id->bind_param("i", $Recipe_ID);

        $result_id->execute();

        Print '<h1>'.' You have deleted: '.$Recipe_Name . ' Recipe </h1>';

      }
      else{
        Print '<h1>'.' You do not have permissions to make recipes.'. ' </h1>';
      }

      //close the connection
      $connection -> close();
      ?>
  </body>

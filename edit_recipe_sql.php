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
      $Recipe_name = ($_REQUEST["recipename"]);
      $Recipe_time = ($_REQUEST["time"]);
      $Recipe_level = ($_REQUEST["level"]);
      $Recipe_instructions = ($_REQUEST["instructions"]);
      $Recipe_Ingredients = ($_REQUEST["ingredients"]);
      $User_ID = 1; //FIX ME. get this from cookies.
      $last_update_date = date ('Y-m-d');

      $result = mysqli_query($connection, "SELECT User_type FROM Users WHERE User_ID = $User_ID");
      $user_type = array();
      while( $val = mysqli_fetch_array($result)){
        $user_type[] = $val['User_type'];
      }

      if( $user_type[0] != 1){

        $result_id = $connection->prepare( "UPDATE Recipes SET Recipe_name = ?, last_update_date=?, Recipe_time = ? ,Recipe_instructions=?, Recipe_Ingredients=?, Recipe_level=? WHERE Recipe_ID=? ");
        $result_id->bind_param("sssssii", $Recipe_name, $last_update_date, $Recipe_time,$Recipe_instructions, $Recipe_Ingredients,  $Recipe_level, $Recipe_ID);

        $result_id->execute();

        //INGREDIENTS UPDATE:
        // $ingredient_quanitity = $_REQUEST["ingredient_quantity"];
        // $ingredient_id = 1;
        //
        // foreach ($ingredient_quanitity as $ingr_quantity){
        //
        //
        //   $ingredient_list_res = mysqli_query($connection, "SELECT Ingredient_Quantity FROM Ingredient_List WHERE Recipe_ID = $Recipe_ID AND Ingredient_ID=$ingredient_id");
        //   $item_quantity_curr = mysqli_fetch_array($ingredient_list_res);
        //   //echo
        //   $exists = mysqli_num_rows($ingredient_list_res);

          //echo $exists;
        //  if($exists > 0 ){
        //     if($ingr_quantity > 0 ){
        //       $insert_ingr = $connection->prepare("UPDATE Ingredient_List SET Ingredient_Quantity=? WHERE Recipe_ID= ? AND Ingredient_ID=?,");
        //       $insert_ingr->bind_param("iii",  $ingr_quantity, $Recipe_ID, $ingredient_id,);
        //       $insert_ingr->execute();
        //       echo "update";
        //     }
        //     elseif( $ingr_quantity == 0){
        //       $insert_ingr = $connection->prepare("DELETE FROM Ingredient_List WHERE Recipe_ID=? AND Ingredient_ID=? ");
        //       $insert_ingr->bind_param("ii", $Recipe_ID, $ingredient_id);
        //       $insert_ingr->execute();
        //       echo "deleted";
        //     }
        //   }
        //   else{
        //     if($ingr_quantity > 0 ){
        //       $insert_ingr = $connection->prepare("INSERT INTO Ingredient_List(Recipe_ID, Ingredient_ID, Ingredient_Quantity) Values (?, ?,?)");
        //       $insert_ingr->bind_param("iii", $Recipe_ID, $ingredient_id, $ingr_quantity);
        //
        //       if ($insert_ingr->execute() === TRUE) {
        //           Print  '<p>'. "ingredient linked successfully".$ingredient_id . $ingr_quantity . "</p> ";
        //           Print '<br />';
        //       } else {
        //           Print  '<p>'. "ingredient not linked". "</p> ";
        //       }
        //     }
        //   }
        //   $ingredient_id++;
        // }

        Print '<h1>'.' You have updated the recipe with ID:'. $Recipe_ID. ' </h1>';

        $result = mysqli_query($connection, "SELECT * FROM Recipes WHERE Recipe_ID=$Recipe_ID");

        $recipe = mysqli_fetch_array($result);
        Print '<hr />';
        Print '<h2 align="center">'. $recipe['Recipe_name'] . "</h2>";

        Print '<h4 align="center">'. "This recipe will take " . $recipe["Recipe_time"]. " hours. ". "</h4>";

        //print out the instructions
        Print '<p align="center"  > <b>'. " Recipe Instructions: ". "</b></p>";
        Print '<p align="center" style="width: 100%">'. $recipe["Recipe_instructions"]. "</p>";
        Print "<br />";

        Print '<p align="center"  > <b>'. " Recipe Ingredients: ". "</b></p>";
        // $ingredient_list_res = mysqli_query($connection, "SELECT * FROM Ingredient_List WHERE Recipe_ID = $Recipe_ID ");
        //
        // while( $ingredient = mysqli_fetch_array($ingredient_list_res) ){
        //
        //   $ingredients_res = mysqli_query($connection, 'SELECT * FROM Ingredients WHERE Ingredient_ID = $ingredient["Ingredient_ID"] ');
        //
        //   while( $item = mysqli_fetch_array($ingredients_res) ){
        //       Print '<p align="center">'. $ingredient["Ingredient_Quantity"]. " " .$item["Ingredient_Name"] ."</p>";
        //   }
        // }
        // Print '<p align="center"> <b>'. " Recipe Special Instructions". " </b> </p>";
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

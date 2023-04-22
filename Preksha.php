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

    //go through all the recipes and get all recipe data
    $result = mysqli_query($connection, "SELECT * FROM Recipes");

    while ( $row = mysqli_fetch_array($result) ) {
      //for each recipe get the name and the time of ingredients
      Print '<hr />';
      Print '<h2 align="center">'. $row['Recipe_name'] . "</h2>";

      Print '<h4 align="center">'. "This recipe will take " . $row["Recipe_time"]. " hours. ". "</h4>";

      Print '<p align="center"> <b>'. " Recipe Ingredients and Quantities". " </b> </p>";

      $ingredient_list_res = mysqli_query($connection, "SELECT * FROM Ingredient_List WHERE Recipe_ID = ".$row['Recipe_ID']." ");

      //for all ingredients for this recipe print the item and the quantity
      while( $ingredient = mysqli_fetch_array($ingredient_list_res) ){

        $ingredients_res = mysqli_query($connection, "SELECT * FROM Ingredients WHERE Ingredient_ID = ".$ingredient['Ingredient_ID']." ");

        while( $item = mysqli_fetch_array($ingredients_res) ){
            Print '<p align="center">'. $ingredient["Ingredient_Quantity"]. " " .$item["Ingredient_Name"] ."</p>";
        }
      }

      //print out the instructions
      Print '<p align="center"  > <b>'. " Recipe Instructions: ". "</b></p>";
      Print '<p align="center" style="width: 100%">'. $row["Recipe_instructions"]. "</p>";
      Print "<br />";
      //print the recipe level
      Print '<p align="center">'. "Recipe Difficulty: ". $row["Recipe_level"].'</p>';

      //get the recipe creator
      $name = mysqli_query($connection, "SELECT * FROM Users WHERE User_ID = ".$row["User_ID"]." ");
      $name_res = mysqli_fetch_array($name);
      Print '<p align="center">'. "Recipe Creator: ". $name_res["User_fname"]. " ".$name_res["User_lname"] .'</p>';

      //get the number of classes
      $class = mysqli_query($connection, "SELECT * FROM Classes WHERE Recipe_ID = ".$row["Recipe_ID"]." ");
      $class_num = mysqli_num_rows($class);
      Print '<p align="center">'. "Classes available: ". $class_num .'</p>';

      Print '<hr />';
      Print "<br />";

     }

    //close the connection
    mysqli_close($connection);
    ?>


</body>
</html>

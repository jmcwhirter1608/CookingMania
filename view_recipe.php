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
    $User_ID = 1;


    $user_result = mysqli_query($connection, "SELECT User_type FROM Users WHERE User_ID = $User_ID");
    $user_type = array();

    while( $val = mysqli_fetch_array($user_result)){
      $user_type[] = $val['User_type'];
    }


    //$user_type = 3; //got from cookies and login.


    //go through all the recipes and get all recipe data
    $result = mysqli_query($connection, "SELECT * FROM Recipes");

    while ( $recipe = mysqli_fetch_array($result) ) {
      //for each recipe get the name and the time of ingredients
      $recipe_id = $recipe['Recipe_ID'];
      Print '<hr />';
      Print '<h2 align="center">'. $recipe['Recipe_name'] . "</h2>";

      Print '<h4 align="center">'. "This recipe will take " . $recipe["Recipe_time"]. " hours. ". "</h4>";

      Print '<p align="center"> <b>'. " Recipe Ingredients and Quantities". " </b> </p>";

      $ingredient_list_res = mysqli_query($connection, "SELECT * FROM Ingredient_List WHERE Recipe_ID = ".$recipe['Recipe_ID']." ");

      //for all ingredients for this recipe print the item and the quantity
      while( $ingredient = mysqli_fetch_array($ingredient_list_res) ){

        $ingredients_res = mysqli_query($connection, "SELECT * FROM Ingredients WHERE Ingredient_ID = ".$ingredient['Ingredient_ID']." ");

        while( $item = mysqli_fetch_array($ingredients_res) ){
            Print '<p align="center">'. $ingredient["Ingredient_Quantity"]. " " .$item["Ingredient_Name"] ."</p>";
        }
      }

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

      <!-- //make a delete button if the user is the same as creator.

      //make a edit button and post all of it to create recipe with the data. -->

      <?php if( $User_ID == $recipe["User_ID"] || $user_type[0] == 3 ) { ?>

        <div align='center'>

      <?php
        //echo $recipe["User_ID"];
        echo "<form method='post' action='edit_delete_recipe.php'>.
          <input type='hidden' name='recipe_id' value=". $recipe_id. ">
          <input type='submit' name='edit' value='Edit Recipe'>

        </form>"
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

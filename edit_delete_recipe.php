<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit or Delete Recipe</title>
  </head>
  <body>
    <?php include "navbar.php"?>
    <hr />
    <h1 align="center">Edit Recipe </h1>
    <?php include "dbconnection.php"?>

    <?php
      $Recipe_ID = ($_REQUEST['recipe_id']);
      $result = mysqli_query($connection, "SELECT * FROM Recipes WHERE Recipe_ID=$Recipe_ID");

      //echo "Editing recipe id: ". $Recipe_ID;
      $recipe = mysqli_fetch_array($result);
        //for each recipe get the name
      $recipe_name = $recipe['Recipe_name'];
      //echo $recipe_name;

      $result_ingredients = mysqli_query($connection, "SELECT * FROM Ingredients ORDER BY Ingredient_ID ASC");
      $ingredient_name = array();
      $ingredient_id = array();
      $ingredient_quanitity = array();
      while( $ingredient = mysqli_fetch_array($result_ingredients) ){
            $ingredient_name[] = $ingredient['Ingredient_Name'];
            $ingredient_id[] = $ingredient['Ingredient_ID'];
      }

      // echo "<h1> ". foreach ($ingredient_name as $ingr){ ."<br />" .}."</h1>";

      echo "<form method='post' action='edit_recipe_sql.php'>

      <div class='create_recipe' align='center'>

      <h1>Edit Recipe ". $recipe_name." with ID: ".$Recipe_ID. "</h1>
      <label for='recipename'><b>Recipe Name</b></label>
      <input type='text' required name='recipename' value=\"". $recipe_name ."\"  >
      <br /><br />

      <label for='time'><b>Enter Time this Recipe will take in hours</b></label>
      <input type='number' name='time' min='0' max='10' step='0.1' required value = ".$recipe['Recipe_time'].">
      <br/>  <br />
      <label for='level'><b>Level from 1 (easy) to 5 (hard): </b></label>
      <input required type='number' id='value' name='level'  min='1' max='5' value = ". $recipe['Recipe_level'].">
      <br/> <br />

      <label for='instructions'><b>Instructions</b></label><br />
      <textarea name='instructions' rows='10' cols='30' required>". $recipe['Recipe_instructions'] .
      "</textarea>
      <br /><br />
      <label for='Ingredients'><b>Ingredients</b></label><br />
      <br />
      <input type='hidden' name='recipe_id' value=". $Recipe_ID. ">

       <textarea name='ingredients' rows='10' cols='30' required>". $recipe['Recipe_Ingredients'] .
       "</textarea>
       <br /><br />
       <input type='submit' name='submit' value='Update Recipe'>
       </div>
       </form> ";

      // <p>Ingredient options and Quantities: </p>;

      // foreach ($ingredient_name as $ingr) {
      //     echo "<label for='ingredient'>".$ingr. "</label>
      //    <input type='number' name='ingredient_quantity[]' placeholder='0' min='0' max='30 value=".$ingr.">
      //     <br />";
      // }
      //
      //// <p>Ingredient special instructions: </p>
     


      echo "

      <br /><br />
      <br /><br />
      <br /><br /><form method='post' action='delete_recipe_sql.php' align='center'>

      <input type='hidden' name='recipe_id' value=". $Recipe_ID. ">
      <input type='hidden' name='recipe_name' value=". $recipe_name. ">

      <input type='submit' name='submit' value='DELETE RECIPE.'>
      </form>

      <br /><br />
      <br /><br />
      <br /><br />";

      //close the connection
      mysqli_close($connection);
      ?>

  </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
</head>
<body>
    <?php include "navbar.php"?>
    <hr />
    <h1 align="center">Add Recipe as a Chef</h1>
    <?php include "dbconnection.php"?>

    <!-- IF USER IS AN ADMIN OR A TEACHER ONLY SHOULD BE ABLE TO ACCESS. -->

    <hr />


  <form method="post" action="create_sql_recipe.php">

    <div class="create_recipe" align="center">
    <h1>Create Recipe</h1>
    <label for="recipename"><b>Recipe Name</b></label>
    <input type="text" placeholder="Recipe Name" name="recipename" required>
    <br /><br />

    <label for="time"><b>Enter Time this Recipe will take in hours</b></label>
    <input type="number" placeholder="Time" name="time" min="0" max="10" step="0.1" required>
    <br/>  <br />
    <label for="level"><b>Level from 1 (easy) to 5 (hard): </b></label>
    <input type="number" id="value" name="level" placeholder="1" min="1" max="5" required>
    <br/> <br />

    <label for="instructions"><b>Instructions</b></label><br />
    <textarea required name="instructions" rows="10" cols="30" > <?php echo $instructions; ?>
    </textarea>
    <br /><br />

    <label for="Ingredients"><b>Ingredients</b></label><br />

    <?php
      $result_ingredients = mysqli_query($connection, "SELECT * FROM Ingredients ORDER BY Ingredient_ID ASC");
      $ingredient_name = array();
      $ingredient_id = array();
      $ingredient_quanitity = array();
      while( $ingredient = mysqli_fetch_array($result_ingredients) ){
            $ingredient_name[] = $ingredient['Ingredient_Name'];
            $ingredient_id[] = $ingredient['Ingredient_ID'];
      }
    ?>

    <?php foreach ($ingredient_name as $ingr) { ?>
      <label for="ingredient"> <?php echo $ingr ?> </label>
      <input type="number" name="ingredient_quantity[]" placeholder="0" min="0" max="30">
       <br />
    <?php } ?>

    <?php
    foreach ($ingredient_quanitity as $ingr) {
     echo $ingr;
   }
    ?>
    <br/><br />





    <input type='submit' name='submit' value='Post Recipe'>
  </div>
</form>


    <?php
    //close the connection
    mysqli_close($connection);
    ?>


</body>
</html>

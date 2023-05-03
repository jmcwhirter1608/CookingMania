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
    <?php
      $User_ID = $_SESSION['User_ID'];
      $user_type = $_SESSION['User_type'];
    ?>

    <hr />

    <!-- form to create a new recipe. all fields are required. -->
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
    <textarea required name="instructions" rows="10" cols="30" required> <?php echo $instructions; ?>
    </textarea>
    <br /><br />

    <label for="Ingredients"><b>Ingredients</b></label><br />
    <textarea required name="ingredients" rows="10" cols="30" required > <?php echo $ingredients; ?>
    </textarea>
    <br /><br />

    <br/><br />

    <?php
    if($user_type == 3 ){
    ?>
    <label for="User_name">Recipe Creator:</label>
    <select name="User">
    <?php
        // use a while loop to fetch data
        // from the $all_categories variable
        // and individually display as an option
        $users_recipe = mysqli_query($connection,"SELECT User_ID, User_fname, User_lname FROM Users WHERE User_Type != 1" );
        while ($users = mysqli_fetch_array(  $users_recipe) ){
          //echo $users["User_fname"]." ". $users["User_lname"];
    ?>
    <option value="<?php echo $users["User_ID"]?>">
    <?php echo $users["User_fname"]." ". $users["User_lname"];?>
    <?php } ?>


    </select><br/>
    <br/>
      <?php } ?>

    <input type='submit' name='submit' value='Post Recipe'>

    </div>
  </form>
    <br/><br />


    <?php
    //close the connection
    mysqli_close($connection);
    ?>


</body>
</html>

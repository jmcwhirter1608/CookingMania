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
      $User_ID = $_SESSION['User_ID'];
      $user_type = $_SESSION['User_type'];
      $result = mysqli_query($connection, "SELECT * FROM Recipes WHERE Recipe_ID=$Recipe_ID");
      $recipe = mysqli_fetch_array($result);

      //for recipe get the name
      $recipe_name = $recipe['Recipe_name'];

      //form to edit with the old value prepopulated.
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
       <br /><br />";


       if($user_type == 3 ){
            //get the user name
           $recipe_creator_id =  $recipe['User_ID'];
           // $current_creator = mysqli_query($connection,"SELECT User_fname, User_lname FROM Users WHERE User_ID= $recipe_creator_id" );
           // $creator = mysqli_fetch_array(  $current_creator);
           //echo $creator['User_fname']." ". $creator['User_lname'];
           echo "<label for='User_name'>Recipe Creator:</label>
           <select name='User'>";
           // use a while loop to fetch data
           // from the $all_categories variable
           // and individually display as an option
           $users_recipe = mysqli_query($connection,"SELECT User_ID, User_fname, User_lname FROM Users WHERE User_Type != 1" );
           while ($users = mysqli_fetch_array(  $users_recipe) ){
             if( $recipe_creator_id == $users['User_ID']){
               echo "<option value=". $users['User_ID']. " selected>";
               echo $users["User_fname"]." ". $users["User_lname"];
             }
             else{
               echo "<option value=". $users['User_ID']. ">";
               echo $users["User_fname"]." ". $users["User_lname"];
              }
           }


       echo "</select><br/>
       <br/>";
      }

       echo "<input type='submit' name='submit' value='Update Recipe'>
       </div>
       </form> ";

       //delete button and send the recipe ID and name.
      echo "

      <br /><br />
      <br /><br />
      <br /><br /><form method='post' action='delete_recipe_sql.php' align='center'>

      <input type='hidden' name='recipe_id' value=". $Recipe_ID. ">
      <input type='hidden' name='recipe_name' value=\"". $recipe_name ."\" >

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

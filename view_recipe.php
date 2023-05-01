

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
    <h1 align="center">Recipes List</h1>

    <?php
<<<<<<< Updated upstream:Preksha.php
=======
    $User_ID = 1;


    $user_result = mysqli_query($connection, "SELECT User_type FROM Users WHERE User_ID = $User_ID");
    $user_type = array();

    while( $val = mysqli_fetch_array($user_result)){
      $user_type[] = $val['User_type'];
    }


    //$user_type = 3; //got from cookies and login.

>>>>>>> Stashed changes:view_recipe.php

    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $database_name = "CookingMania";
    $connection = mysqli_connect($server_name, $user_name, $password, $database_name);


    $result = mysqli_query($connection, "SELECT * FROM Recipes");


    while ( $row = mysqli_fetch_array($result) ) {


      Print '<hr />';
      Print '<h2 align="center">'. $row['Recipe_name'] . "</h2>";

      Print '<h4 align="center">'. "This recipe will take " . $row["Recipe_time"]. " hours. ". "</h4>";
      //Print '<table border ="1" align="center" cellpadding="20%">'
      Print '<p align="center"> <b>'. " Recipe Ingredients and Quantities". " </b> </p>";

      $ingredient_list_res = mysqli_query($connection, "SELECT * FROM Ingredient_List WHERE Recipe_ID = ".$row['Recipe_ID']." ");

      while( $ingredient = mysqli_fetch_array($ingredient_list_res) ){
        //Print '<h6 align="center">'. $ingredient["Ingredient_Quantity"] ."</h6>";

        $ingredients_res = mysqli_query($connection, "SELECT * FROM Ingredients WHERE Ingredient_ID = ".$ingredient['Ingredient_ID']." ");

        while( $item = mysqli_fetch_array($ingredients_res) ){
            Print '<p align="center">'. $ingredient["Ingredient_Quantity"]. " " .$item["Ingredient_Name"] ."</p>";
        }
      }

      Print '<p align="center"  > <b>'. " Recipe Instructions: ". "</b></p>";
      Print '<p align="center" style="width: 100%">'. $row["Recipe_instructions"]. "</p>";

      Print '<p align="center">'. "Recipe Difficulty: ". $row["Recipe_level"].'</p>';

      $name = mysqli_query($connection, "SELECT * FROM Users WHERE User_ID = ".$row["User_ID"]." ");
      $name_res = mysqli_fetch_array($name);
      Print '<p align="center">'. "Recipe Creator: ". $name_res["User_fname"]. " ".$name_res["User_lname"] .'</p>';

<<<<<<< Updated upstream:Preksha.php
      $class = mysqli_query($connection, "SELECT COUNT(*) FROM Classes WHERE Recipe_ID = ".$row["Recipe_ID"]." ");
      //$class_res = mysqli_fetch_array($class);
      //Print '<p>'. "Classes available: ". $class_res. '</p>'
      echo $class; 
      Print '<hr />';
      Print "<br />";

        // <tr> '</table>'
        //     $result = mysqli_query($connection, "SELECT * FROM Recipes");
        // </tr>





     }


    //close the connection
    mysqli_close($connection);
    ?>
=======
      //get the number of classes
      $class = mysqli_query($connection, "SELECT * FROM Classes WHERE Recipe_ID = ".$recipe["Recipe_ID"]." ");
      $class_num = mysqli_num_rows($class);
      Print '<p align="center">'. "Classes available: ". $class_num .'</p>';
      ?>

      <!-- //make a delete button if the user is the same as creator.

      //make a edit button and post all of it to create recipe with the data. -->

      <?php if( $User_ID == $recipe["User_ID"] || $user_type[0] == 3 ) { ?>

        <div align='center'>


        <form method="post" action="edit_delete_recipe.php">
          <input type='submit' name='edit' value='Edit Recipe'>
        </form>
        </div>

      <?php }
      Print '<hr />';
      Print "<br />";

       }

      //close the connection
      mysqli_close($connection);
      ?>
>>>>>>> Stashed changes:view_recipe.php


    <h2> </h2>
</body>
</html>

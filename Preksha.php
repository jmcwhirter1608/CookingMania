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

      //$class = mysqli_query($connection, "SELECT COUNT(*) FROM Classes WHERE Recipe_ID = ".$row["Recipe_ID"]." ");
      //$class_res = mysqli_fetch_array($class);
      //Print '<p>'. "Classes available: ". $class_res. '</p>'
      //echo $class;
      Print '<hr />';
      Print "<br />";

        // <tr> '</table>'
        //     $result = mysqli_query($connection, "SELECT * FROM Recipes");
        // </tr>





     }


    //close the connection
    mysqli_close($connection);
    ?>


    <h2> </h2>
</body>
</html>

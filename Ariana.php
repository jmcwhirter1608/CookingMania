<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ariana</title>
</head>


<!-- ADD,VIEW,UPDATE,DELETE comments -->
<body>
    
<?php include "navbar.php"?>
    <hr />
    <h1 align="center">Recipes Comment</h1>
    <?php include "dbconnection.php"?>

   <?php 
   // get the recipes name from the recipe table
   $sql = sprintf("SELECT Recipe_name FROM recipes");
   $result = $connection->query($sql);

   while ( $recipe = $result->fetch_assoc()) {
      Print '<hr />';
      Print '<h2 align="center">'. $recipe['Recipe_name'] . "</h2>"; 
   }



    ?>
  
    
</body>
</html>
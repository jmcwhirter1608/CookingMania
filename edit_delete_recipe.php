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
    echo ($_REQUEST["recipename"]); 
    ?>

    <?php
    //close the connection
    mysqli_close($connection);
    ?>

  </body>
</html>

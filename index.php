<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "CookingMania";


$connection = mysqli_connect($server_name, $user_name, $password, $database_name);


$result = mysqli_query($connection, "SELECT * FROM Ingredients");

while ( $row = mysqli_fetch_array($result) ) {
  echo $row["Ingredient_ID"]. " . " . $row["Ingredient_Name"];
//   echo $row{'Ingredient_ID'}." . ". $row{'Ingredient_Name'}. "." ."<br>" ;
 }


//close the connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css\styles.css">
    <title>Cooking Mania</title>
</head>
<body>
    <?php include "navbar.php"?> <!-- Include This for navbar /!-->
    <h1>Welcome to Cooking Mania</h1>

    <!-- <form method='post' action='SignInForm.php'>
      <input type='submit' name='signin' value='Sign In'></input>
      <input type='submit' name='register' value='Register'></input>
    </form> -->

    
</body>
</html>

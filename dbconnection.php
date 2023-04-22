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

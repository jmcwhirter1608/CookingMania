<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\styles.css">
    <title>Comment</title>
</head>


<!-- ADD,VIEW,UPDATE,DELETE comments -->
<body>

<?php include "navbar.php"?>
    <hr />
    <h1 align="center">Recipes Comment</h1>
    <?php include "dbconnection.php"?>

   <?php 
   // sql statement to get the recipes from the recipe table
   $sql = sprintf("SELECT * FROM recipes"); 
   $result = $connection->query($sql);

   //print out recipes name 
   while ( $row = $result->fetch_assoc()) {

    // get the comment from database
     $sql1 = sprintf("SELECT * 
     FROM comments
     INNER JOIN users
     ON users.User_ID = comments.User_ID
     WHERE Recipe_ID = %d", $row['Recipe_ID']);

     $result1 = $connection->query($sql1);

      Print '<hr />';
      Print '<h2 align="center">'. $row['Recipe_name'] . "</h2>"; 
      Print '<h2 align="center"> Comments </h2> '; 

      while ( $row1 = $result1->fetch_assoc()){
        Print '<h2 align="center">'. $row1['User_fname'] . ": " . $row1['CommentText'] . "</h2>"; 
    }; 

      //create comment form, INSERT INTO Comments(Comment_ID, Recipe_ID,User_ID, CommentText)
      Print '<form method = "post" action = "CreateSQLComment.php?Recipe_ID='.$row['Recipe_ID'].'">
          <label> Comment: </label> <input type = "text" name = "comment"> <br>
         <input type="submit" name="Create-comment" value="Submit">
      </form>';
   }
   ?>

    <!-- edit/delete -->
    <?php    

        echo "<form id='DeleteAccount-RowForm' method='post' action=". htmlspecialchars($_SERVER["PHP_SELF"]) . ">";

        while($row1 = $result1->fetch_assoc()){
            if($row1['User_ID']==$_SESSION['User_ID']){ //if user id is same as session they can delete
            echo   "<div id='DeleteAccount-RowForm-Row' >" . $row1['User_ID'] . "</div>"

            Print "<input id='DeleteAccount-RowForm-Row-Delete' type='checkbox' name='check[" . $row['User_ID'] . "] >";
    
 
             echo "<input type='submit' name='Delete-comment' value='Delete'></form>";
            }

        };
    ?>
  




</body>
</html>
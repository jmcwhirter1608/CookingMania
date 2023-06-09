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
    <h1 class=Profileheader>Recipe Comments</h1>
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
      Print '<div class=Comment>';
      Print '<h2 class=Comment-Recipe>'. $row['Recipe_name'] . "</h2>"; //print recipe name

      while ( $row1 = $result1->fetch_assoc()){
       
        //print out comment with user name
      //  Print '<h2 align="center">'. $row1['User_fname'] . ": " . $row1['CommentText'] . "</h2>"; 

        //edit and delete comment 
        //admin can delete and edit all comments! 
          if($row1['User_ID']==$_SESSION['User_ID'] ||  $_SESSION['User_type']==1 ) { //if user = logged in user (you can edit/delete )
            
            //form to edit/delete 
            Print '
              <form method = "post" action = "Comments/Edit_Delete_CommentSQL.php?Comment_ID='.$row1['Comment_ID'].'">
                <label><b>'. $row1['User_fname'] . " " . $row1['User_lname'] .  ':</b></label> <br>
                <input type = "text" name = "CommentText" value ="' .$row1['CommentText'].'">
                <input type="submit" name="Edit-comment" value="Edit"> 
                <input type="submit" name="Delete-comment" value="Delete">
            </form>';
            
        }else{
            Print '<h3>'. $row1['User_fname'] . ":</h3><p>" . $row1['CommentText'] . "</p>"; 
        }

       
    }; 

      //create comment form, INSERT INTO Comments(Comment_ID, Recipe_ID,User_ID, CommentText)
      Print '<form method = "post" action = "Comments/CreateSQLComment.php?Recipe_ID='.$row['Recipe_ID'].'">
          <label><b> Post Comment: </b></label> <input type = "text" name = "comment"> <br>
         <input type="submit" name="Create-comment" value="Submit">
      </form>';
    Print '</div>';
    }
   ?>


</body>
</html>
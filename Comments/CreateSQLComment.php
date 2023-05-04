<?php 
include "dbconnection.php";
session_start();
    //taking values from the form data input
    $CommentText = ($_POST["comment"]);
    $Recipe_ID = ($_REQUEST["Recipe_ID"]);
    // Performing insert query execution
        echo $Recipe_ID;
        $sql = sprintf(
            "INSERT INTO comments  
            VALUES (NULL,%d,%d,'%s');",
            $Recipe_ID,$_SESSION['User_ID'],
            $CommentText);
         
        if(mysqli_query($connection, $sql)){
            echo "<h3> data stored in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>";
         
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($connection);
        }
        header('location: Ariana.php');
?>


<?php 
//author: ariana p 
//file that has the sql statements for edit and delete 
include "../dbconnection.php";

//sql to delete from comments table 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Delete-comment'])) {
    $sql = sprintf("DELETE FROM comments 
    WHERE
    Comment_ID=%d",
    $_REQUEST['Comment_ID']); 
    $result = $connection->query($sql);
};

//sql to edit from comments table 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Edit-comment'])){
    $sql = sprintf("UPDATE comments 
    SET CommentText ='%s'
    WHERE
    Comment_ID=%d",
    $_POST['CommentText'],
    $_REQUEST['Comment_ID']
    ); 
    
    $result = $connection->query($sql);
};

header('location: ../Ariana.php');
?>


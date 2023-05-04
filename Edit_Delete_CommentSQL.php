<?php 
include "dbconnection.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Delete-comment'])) {
    $sql = sprintf("DELETE FROM comments 
    WHERE
    Comment_ID=%d",
    $_REQUEST['Comment_ID']); 
    $result = $connection->query($sql);
};


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

header('location: Ariana.php');
?>


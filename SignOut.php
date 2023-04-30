<!DOCTYPE html>
<?php

    setcookie("UserID", FALSE, 1, '/'); // Deletes cookies
    setcookie("AccType", FALSE, 1, '/');

?>
<html>
    <body>
        <?php include 'navbar.php'?>
        <?php
        header("Location: index.php")
        ?>
    </body>
</html>

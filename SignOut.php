<!DOCTYPE html>
<?php

    setcookie("UserID", FALSE, 1, '/');
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

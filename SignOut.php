<!DOCTYPE html>

<html>
    <body>
        <?php include 'navbar.php';
            session_unset();
            session_destroy();
            header("Location: index.php");
        ?>
    </body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['DeleteUser-submit'])) {
        $sql = sprintf("DELETE FROM users
        WHERE User_ID = %s; ",
        $_SESSION['User_ID']
        );

        try{
            $result = $connection->query($sql);
            if($result === TRUE){
                header("Location: Profile/SignOut.php");
            } else{
                echo "Cannot delete account contact Administrator";
            }
        } catch(Exception $e){
            echo "Error: ". $e->getMessage();
        }
    }

?>
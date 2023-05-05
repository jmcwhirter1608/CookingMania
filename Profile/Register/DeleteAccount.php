<?php

    $acc_type = $uid = $fname = $lname = $email = $phone = $psw = NULL;

    $sql = sprintf("SELECT * FROM users");

    try{
        echo "<form id='DeleteAccount-RowForm' method='post' action=". htmlspecialchars($_SERVER["PHP_SELF"]) . ">";
        $result = $connection->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo   "<div id='DeleteAccount-RowForm-Row' >" . $row['User_ID'] . "</div>
                        <div id='DeleteAccount-RowForm-Row' >". $row['User_type'] . "</div>
                        <div id='DeleteAccount-RowForm-Row' >" . $row['User_fname'] . "</div>
                        <div id='DeleteAccount-RowForm-Row' >" . $row['User_lname'] ."</div>
                        <div id='DeleteAccount-RowForm-Row' >" . $row['User_email'] . "</div>
                        <div id='DeleteAccount-RowForm-Row' >" . $row['User_phonenumber'] . "</div>
                        <div id='DeleteAccount-RowForm-Row' >" . $row['User_password'] . "</div>
                        <input id='DeleteAccount-RowForm-Row-Delete' type='checkbox' name='check[" . $row['User_ID'] . "]' >
                        ";
                
            }
            echo "
            <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            <input type='submit' name='Delete-submit' value='Delete'></form>";
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Delete-submit'])) {

        
        $postKeys = array_keys($_POST['check']);

        $sql_ids = '(';
        $last = end($postKeys);
        foreach($_POST['check'] as $id => $value){
            if($id == $last){
                $sql_ids .= $id .')';
            } else{
                $sql_ids .= $id . ',';
            }
        }

        $sql = sprintf("DELETE FROM class_enrollment
        WHERE User_ID IN %s;
        ",
        $sql_ids
        );
        
        try{
            $result = $connection->query($sql);
            if($result === TRUE){
                echo "Successfully deleted Class Enrollments<br>";
            }
        } catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }

        $sql = sprintf("DELETE FROM comments
        WHERE User_ID IN %s;
        ",
        $sql_ids);

        try{
            $result = $connection->query($sql);
            if($result === TRUE){
                echo "Successfully deleted comments<br>";
            }
        } catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }

        $sql = sprintf("DELETE FROM recipes
        WHERE User_ID IN %s;
        ",
        $sql_ids);

        try{
            $result = $connection->query($sql);
            if($result === TRUE){
                echo "Successfully deleted recipes<br>";
            }
        } catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }

        $sql = sprintf("DELETE FROM classes
        WHERE User_ID IN %s;
        ",
        $sql_ids);

        try{
            $result = $connection->query($sql);
            if($result === TRUE){
                echo "Successfully deleted classes<br>";
            }
        } catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }

        $sql = sprintf("DELETE FROM users
        WHERE User_ID IN %s;
        ",
        $sql_ids);

        try{
            $result = $connection->query($sql);
            if($result === TRUE){
                echo "Successfully deleted user<br>";
            }
        } catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        
    }
?>
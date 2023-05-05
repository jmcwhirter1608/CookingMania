<?php

    $acc_type = $uid = $fname = $lname = $email = $phone = $psw = $Err = NULL;

    $sql = sprintf("SELECT * FROM users");

    try{
        $result = $connection->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                 echo   "<form id='EditAccount-RowForm' method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                            <input id='EditAccount-RowForm-Row' type=\"text\" placeholder=\"Enter User ID\" name=\"uid\" value=" . $row['User_ID'] . ">
                            <input id='EditAccount-RowForm-Row' type=\"text\" placeholder=\"Enter 0-3\" name=\"acc-type\" value=". $row['User_type'] . ">
                            <input id='EditAccount-RowForm-Row' type=\"text\" placeholder=\"Enter First Name\" name=\"fname\" value=" . $row['User_fname'] . ">
                            <input id='EditAccount-RowForm-Row' type=\"text\" placeholder=\"Enter Last Name\" name=\"lname\" value=" . $row['User_lname'] .">
                            <input id='EditAccount-RowForm-Row' type=\"text\" placeholder=\"Enter Email\" name=\"email\" value=" . $row['User_email'] . ">
                            <input id='EditAccount-RowForm-Row' type=\"text\" name=\"phone\" placeholder=\"xxxxxxxxxx\" value=" . $row['User_phonenumber'] . ">
                            <input id='EditAccount-RowForm-Row' type=\"password\" placeholder=\"Enter Password\" name=\"psw\" value=" . $row['User_password'] . ">
                            <input id='EditAccount-RowForm-Row' type=\"submit\" name=\"Edit-submit\" value=\"Update\">
             
                        </form>";
                
            }
        }
    } catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Edit-submit'])) {
        // echo $_POST['uid'] . " " .  $_POST['acc-type'] . " " . $_POST['fname'] . " " . $_POST['lname'] . " " . $_POST['email'] . " " . $_POST['phone'] . " " . $_POST['psw'] . "<br>";
        switch(0){
            case 0:
                if(empty($_POST['uid'])){
                    $Err = "User ID is Required";
                    break;
                } else {
                    $uid = test_input($_POST['uid']);
                }
            case 1:
                if(empty($_POST['acc-type'])){
                    $Err = "User Type is Required";
                    break;
                } else{
                    $acc_type = test_input($_POST['acc-type']);
                }
            case 2: 
                if(empty($_POST['fname'])){
                    $Err = "First Name is Required";
                    break;
                } else{
                    $fname = test_input($_POST['fname']);
                }
            case 3:
                if(empty($_POST['lname'])){
                    $Err = "Last Name is Required";
                    break;
                } else{
                    $lname = test_input($_POST['lname']);
                }
            case 4:
                if(empty($_POST['email'])){
                    $Err = "Email is Required";
                    break;
                } else{
                    $email = test_input($_POST['email']);
                }
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $Err = "Invalid Email";
                    break;
                }
                $query = sprintf("SELECT * FROM users 
                WHERE User_email='%s' AND NOT User_ID=$uid",
                $connection->real_escape_string($email));
                $result = $connection->query($query);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $Err = 'Email already in use: ' . $row['User_email'] . ' for User ID ' . $row['User_ID'];
                    }
                    break;
                }
            case 5:
                if(empty($_POST['phone'])){
                    $Err = "Phone is Required";
                    break;
                } else{
                    $phone = test_input($_POST['phone']);
                }
                if(preg_match('/^[0-9]{10}+$/', $phone) == FALSE){
                    $Err = "Invalid Phone Number (Format: 1234567890)";
                    break;
                }
            case 6:
                if(empty($_POST['psw'])){
                    $Err = "Password is Required";
                    break;
                } else{
                    $psw = test_input($_POST['psw']);
                }
            
            case 7:
                $sql = sprintf("UPDATE `users` 
                SET `User_type`=%d,`User_fname`='%s',`User_lname`='%s',`User_email`='%s',`User_phonenumber`=%d,`User_password`='%s' 
                WHERE `User_ID` = %d",
                $acc_type,
                $connection->real_escape_string($fname),
                $connection->real_escape_string($lname),
                $connection->real_escape_string($email),
                $connection->real_escape_string($phone),
                $connection->real_escape_string($psw),
                $uid
                );

                try{
                    $result = $connection->query($sql);
                } catch(Exception $e){
                    echo "Error: ". $e->getMessage();
                }
        }

        if(!empty($Err)){
            echo $Err;
        }


    }
?>
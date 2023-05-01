<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['UpdateUser-submit'])) {
        // echo $_POST['uid'] . " " .  $_POST['acc-type'] . " " . $_POST['fname'] . " " . $_POST['lname'] . " " . $_POST['email'] . " " . $_POST['phone'] . " " . $_POST['psw'] . "<br>";
        switch(0){
            case 0: 
                if(empty($_POST['fname'])){
                    $Err = "First Name is Required";
                    break;
                } else{
                    $fname = test_input($_POST['fname']);
                }
            case 1:
                if(empty($_POST['lname'])){
                    $Err = "Last Name is Required";
                    break;
                } else{
                    $lname = test_input($_POST['lname']);
                }
            case 2:
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
            case 3:
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
            case 4:
                if(empty($_POST['psw'])){
                    $Err = "Password is Required";
                    break;
                } else{
                    $psw = test_input($_POST['psw']);
                }
            case 5:
                if(empty($_POST['psw-repeat'])){
                    $Err = "Repeat Password is Required";
                    break;
                } else{
                    $psw_repeat = test_input($_POST['psw-repeat']);
                    if($psw != $psw_repeat){
                        $Err = "Passwords Do not Match";
                        break;
                    }
                }
            case 6:
                $sql = sprintf("UPDATE `users` 
                SET `User_fname`='%s',`User_lname`='%s',`User_email`='%s',`User_phonenumber`=%d,`User_password`='%s' 
                WHERE `User_ID` = %d",
                $connection->real_escape_string($fname),
                $connection->real_escape_string($lname),
                $connection->real_escape_string($email),
                $connection->real_escape_string($phone),
                $connection->real_escape_string($psw),
                $uid
                );

                try{
                    $result = $connection->query($sql);
                    if($result === TRUE){
                        echo "Account successfully Update!";
                    } else{
                        
                    }
                } catch(Exception $e){
                    echo "Error: ". $e->getMessage();
                }
        }

        if($Err != NULL){
            echo "Error: " . $Err . "<br>";
        }
    }

?>
<?php

$fname = $lname = $email = $phone = $psw = $psw_repeat = NULL;
$Err = NULL;



$sql = sprintf("SELECT User_email, User_phonenumber, User_password FROM users 
WHERE User_ID = %d",
$_SESSION['User_ID']);

try{
    $result = $connection->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $fname = $_SESSION['User_fname'];
            $lname = $_SESSION['User_lname'];
            $email = $row['User_email'];
            $phone = $row['User_phonenumber'];
            $psw = $row['User_password'];
        }
    }
    $psw_repeat = $psw;
}catch(Exception $e){
    echo "Error: " . $e->getMessage();
}

?>

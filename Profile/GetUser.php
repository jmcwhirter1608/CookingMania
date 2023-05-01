<?php

$fname = $lname = $email = $phone = $psw = $psw_repeat = NULL;
$Err = NULL;

if(isset($_COOKIE['UserID'])){
    $uid = $_COOKIE['UserID'];
} else {
    header("Location: SignIn.php");
}


$sql = sprintf("SELECT * FROM users 
WHERE User_ID = %d",
$uid);

try{
    $result = $connection->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $fname = $row['User_fname'];
            $lname = $row['User_lname'];
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

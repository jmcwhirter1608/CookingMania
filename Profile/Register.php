<?php 
include '../dbconnection.php';
session_start();
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} 

        // define variables and set to empty values
        $acc_type = NULL;
        $fname = $lname = $email = $phone = $psw = $psw_repeat = NULL;
        $Err = NULL;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Create-submit'])) {
          
          switch(0){
            case 0: 
              if(empty($_POST['fname'])){
                $Err = 200;
                break;
              } else{
                $fname = test_input($_POST['fname']);
              }
            case 1:
              if(empty($_POST['lname'])){
                $Err = 201;
                break;
              } else{
                $lname = test_input($_POST['lname']);
              }
            case 2:
              if(empty($_POST['email'])){
                $Err = 101;
                break;
              } else{
                $email = test_input($_POST['email']);
              }
              if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $Err = 105;
                break;
              }
              $query = sprintf("SELECT * FROM users 
              WHERE User_email='%s'",
              $connection->real_escape_string($email));

              if($connection->query($query)->num_rows > 0){
                $Err = 204;
                break;
              }
            case 3:
              if(empty($_POST['phone'])){
                $Err = 205;
                break;
              } else{
                $phone = test_input($_POST['phone']);
              }
              if(preg_match('/^[0-9]{10}+$/', $phone) == FALSE){
                $Err = 206;
                break;
              }
            case 4:
              if(empty($_POST['psw'])){
                $Err = 102;
                break;
              } else{
                $psw = test_input($_POST['psw']);
              }
            case 5:
              if(empty($_POST['psw-repeat'])){
                $Err = 103;
                break;
              } else{
                $psw_repeat = test_input($_POST['psw']);
              }
              if($psw != $psw_repeat){
                $Err = 104;
                break;
              }
            case 6:
              if(empty($_POST['acc-type'])){
                $Err = 207;
                break;
              } else{
                $acc_type = test_input($_POST['acc-type']);
              }
            case 7:
              $sql = sprintf("INSERT INTO `users` (`User_ID`, `User_type`, `User_fname`, `User_lname`, `User_email`, `User_phonenumber`, `User_password`)
              VALUES (NULL, %d , '%s', '%s', '%s', %d, '%s')", 
              $acc_type,
              $connection->real_escape_string($fname),
              $connection->real_escape_string($lname),
              $connection->real_escape_string($email),
              $connection->real_escape_string($phone),
              $connection->real_escape_string($psw));
              try {
                $result = $connection->query($sql);
                
                if($result == TRUE){
                  $_SESSION['User_fname'] = $fname;
                  $_SESSION['User_lname'] = $lname;
                  $_SESSION['User_ID'] = $connection->insert_id;
                  $_SESSION['User_type'] = $acc_type;
                  header("Location: ../ProfilePage.php");
                } else{
                  echo 208;
                }
              } catch(Exception $e) {
                switch($e->getCode()){
                  case 1062:
                    echo "Error: Email or Phone Number in use <br>";
                  default:
                    echo "Error: " . $e->getMessage();
                }
              }
              
        }
        if($Err != NULL)
          header("Location: ../index.php?Err=$Err");
          echo "Error: ". $Err . "<br>";
      }


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\styles.css">

    <title>Register</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <?php include 'dbconnection.php'?>
    <?php
        // define variables and set to empty values
        $fname = $lname = $email = $phone = $psw = $psw_repeat = $acc_type = "";
        $unameErr = $emailErr = $pswErr = $psw_repeatErr ='';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

          $fname = test_input($_POST["fname"]);

          $lname = test_input($_POST['lname']);

          $email = test_input($_POST["email"]);
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
              $emailErr = "Invalid Email";
          }

          $phone = test_input($_POST['phone']);
          if(preg_match('/^[0-9]{10}+$/', $phone) == FALSE){
            $phoneErr = "Invalid Phone Number (Format: 1234567890)";
          }

          $psw = test_input($_POST["psw"]);
          $psw_repeat = test_input($_POST["psw-repeat"]);
          if($psw != $psw_repeat)
              $pswErr = "Passwords are not equal";
          else
              $pswErr = '';


          

        }

        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
    ?>
    <form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="register">
        <h1>Register</h1>


        <label for="fname"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="fname" value="<?php echo $fname;?>" required><br/>

        <label for="lname"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="lname" value="<?php echo $lname;?>" required><br/>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>" required><br/>

        <label for="phone"><b>Phone Number</b></label>
        <input type="tel" name="phone" value="<?php echo $phone;?>" placeholder="xxxxxxxxxx" required><br/>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw"  required><br/>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required><br/>

        <label for="acc-type"><b>Teacher</b></label>
        <input type="radio" name="acc-type" value=2 required>
        <label for="acc-type"><b>Student</b></label>
        <input type="radio" name="acc-type" value=1 required>
        <br>
        <input type='submit' name='submit' value='Register'>

      </div>
    </form> 
    <?php

        if(empty($email))
            echo "Error: $emailErr <br>";
        else
            if(empty($pswErr)){
              if(empty($phoneErr)){

                $sql = "INSERT INTO `users` (`User_ID`, `User_type`, `User_fname`, `User_lname`, `User_email`, `User_phonenumber`, `User_password`) VALUES (NULL, '$acc_type', '$fname', '$lname', '$email', '$phone', '$psw') ";
                try {
                  $result = $connection->query($sql);
                  echo "Account Created, Welcome $fname $lname!";
                  setcookie("email", $email, time() + (86400 * 30), '/');
                  setcookie("psw", $psw, time() + (86400 * 30), '/');
                } catch(Exception $e) {
                  switch($e->getCode()){
                    case 1062:
                      echo "Error: Email or Phone Number in use <br>";
                    default:
                      echo "Error: " . $e->getMessage();
                  }
                }
              } else{
                echo "Error: $phoneErr <br>";
              }
                
              }
            else
                echo "Error: $pswErr <br>";


        if ($connection->connect_error){
            die("Connection failed: " . $connection->connect_error);
        }


        
        ?>
</body>
</html>
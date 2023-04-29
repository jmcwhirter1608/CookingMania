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
        $acc_type = 1;
        $fname = $lname = $email = $phone = $psw = $psw_repeat = "";
        $unameErr = $emailErr = $pswErr = $psw_repeatErr ='';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
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
              WHERE User_email='%s'",
              $connection->real_escape_string($email));

              if($connection->query($query)->num_rows > 0){
                $Err = 'Email already in use';
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
                $psw_repeat = test_input($_POST['psw']);
              }
              if($psw != $psw_repeat){
                $Err = "Passwords are not Equal";
                break;
              }
            case 6:
              if(empty($_POST['acc-type'])){
                $Err = "Please select Teacher or Student";
                break;
              } else{
                $acc_type = test_input($_POST['acc-type']);
              }

            default:
              break;
            }
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
        <input type="text" placeholder="Enter First Name" name="fname" value="<?php echo $fname;?>"><br/>

        <label for="lname"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="lname" value="<?php echo $lname;?>"><br/>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>"><br/>

        <label for="phone"><b>Phone Number</b></label>
        <input type="tel" name="phone" value="<?php echo $phone;?>" placeholder="xxxxxxxxxx"><br/>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" ><br/>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat"><br/>

        <label for="acc-type"><b>Teacher</b></label>
        <input type="radio" name="acc-type" value=2>
        <label for="acc-type"><b>Student</b></label>
        <input type="radio" name="acc-type" value=1>
        <br>
        <input type='submit' name='submit' value='Register'>

      </div>
    </form> 
    <?php

        if(empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($psw) || empty($psw_repeat) || empty($acc_type))
          echo "Error: ". $Err . "<br>";
        else{
          
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
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                echo $row['User_ID'];
                setcookie("User_ID", $row['User_ID'], time() + (86400 * 30), '/');
              }
            }
            echo "Account Created, Welcome $fname $lname!";
            setcookie("AccType", $acc_type, time() + (86400 * 30), '/');
          } catch(Exception $e) {
            switch($e->getCode()){
              case 1062:
                echo "Error: Email or Phone Number in use <br>";
              default:
                echo "Error: " . $e->getMessage();
            }
          }
        }

        if ($connection->connect_error){
            die("Connection failed: " . $connection->connect_error);
        }


        
        ?>
</body>
</html>
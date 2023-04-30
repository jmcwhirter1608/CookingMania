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
    <?php include 'Register/RegisterInputConfirm.php'?>
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
        <input type="radio" name="acc-type" value=3>
        <br>
        <input type='submit' name='Create-submit' value='Register'>

      </div>
    </form> 
    <?php
        if(empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($psw) || empty($psw_repeat) || empty($acc_type)){
          if($Err != NULL)
            echo "Error: ". $Err . "<br>";
        }
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
            
            if($result === TRUE){
              echo "Account Created, Welcome $fname $lname!";
              setcookie("AccType", $acc_type, time() + (86400 * 30), '/');
              setcookie("UserID", $connection->insert_id, time() + (86400 * 30), '/');
              header("Location: Register.php");
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

        if ($connection->connect_error){
            die("Connection failed: " . $connection->connect_error);
        }
        ?>
</body>
</html>
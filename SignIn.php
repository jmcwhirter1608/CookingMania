<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\styles.css">

    <title>Sign In</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <?php include 'dbconnection.php'?>

    <?php
        // define variables and set to empty values
        $email = $psw = $psw_repeat = "";
        $unameErr = $emailErr = $pswErr = $psw_repeatErr ='';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = test_input($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailErr = "Invalid Email";

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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="register">
    <h1>Sign In</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>" required><br/>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" value="<?php echo $psw;?>" required><br/>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" value="<?php echo $psw_repeat;?>" required><br/>

    <br>
    <input type='submit' name='submit' value='Sign In'>
  </div>
</form>
    <?php
    if(empty($email))
        echo "Error: $emailErr <br>";
    else
        if(empty($pswErr)){
            $sql = "SELECT * from users WHERE User_email = \"$email\"";
            $result = $connection->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($row['User_password'] == $psw){
                        echo "Welcome back " . $row['User_fname'] . " " . $row['User_lname'] ."<br>";
                        setcookie("email", $email, time() + (86400 * 30), '/');
                        setcookie("psw", $psw, time() + (86400 * 30), '/');
                    } else {
                        echo "Incorrect Email or Password";
                    }
                } 
            } else {
                echo "Incorrect Email or Password";
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

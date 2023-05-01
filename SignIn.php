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

    <?php include 'navbar.php'; include 'dbconnection.php';?>
    <?php 
        if(isset($_SESSION['User_ID'])){
            header("Location: ProfilePage.php");
        } ?>
    <?php
        // define variables and set to empty values
        $acc_type = NULL;
        $email = $psw = $psw_repeat = NULL;
        $Err = NULL;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            switch(0){
                case 0:
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
                case 1:
                    if(empty($_POST['psw'])){
                        $Err = 'Password is Required';
                        break;
                    } else{
                        $psw = test_input($_POST['psw']);
                    }
                case 2:
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
            }
           
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
    <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>"><br/>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" value="<?php echo $psw;?>"><br/>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" value="<?php echo $psw_repeat;?>"><br/>

    <br>
    <input type='submit' name='submit' value='Sign In'>
  </div>
</form>
    <?php
    if(empty($email) || empty($psw) || empty($psw_repeat)){
        if($Err != NULL)
            echo "Error: $Err <br>";
    }
    else {
        $sql = sprintf("SELECT * from users
        WHERE User_email = '%s'",
        $connection->real_escape_string($email));
        try{
            $result = $connection->query($sql);
            if($result !== false && $result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($row['User_password'] == $psw){
                        $_SESSION['User_fname'] = $row['User_fname'];
                        $_SESSION['User_lname'] = $row['User_lname'];
                        $_SESSION['User_ID'] = $row['User_ID'];
                        $_SESSION['User_type'] = $row['User_type'];
                        echo "Welcome back " . $row['User_fname'] . " " . $row['User_lname'] ."<br>";
                        header("Location: ProfilePage.php");
                    } else {
                        echo "Incorrect Email or Password";
                    }
                } 
            } else {
                echo "Incorrect Email or Password";
            }
        } catch(Exception $e){
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

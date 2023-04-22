<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <?php
        // define variables and set to empty values
        $uname = $email = $psw = $psw_repeat = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = test_input($_POST["uname"]);
        $email = test_input($_POST["email"]);
        $psw = test_input($_POST["psw"]);
        $psw_repeat = test_input($_POST["psw-repeat"]);
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

    <label for="lname"><b>User Name</b></label>
    <input type="text" placeholder="Enter User Name" name="uname" required><br/>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required><br/>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required><br/>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required><br/>

    <br>
    <input type='submit' name='submit' value='Sign In'>
  </div>
</form> 
    <?php
    echo "<h2>Your Input:</h2>";
    echo $uname;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $psw;
    echo "<br>";
    echo $psw_repeat;
    ?>
</body>
</html>


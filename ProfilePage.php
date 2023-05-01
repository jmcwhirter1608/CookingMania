<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\styles.css">

    <title>Document</title>
</head>
<body>
    <?php include 'navbar.php'?>
    <?php include 'dbconnection.php'?>

    <?php include 'Profile/GetUser.php'?>
    <?php include 'Profile/UpdateUser.php'?>
    <h1> Welcome <?php echo $fname . " " . $lname; ?>!</h1>

    <div id='Update-Information'>
        <h2> Update Information </h2>
        <form method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            
            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname" value="<?php echo $fname;?>"><br/>

            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname" value="<?php echo $lname;?>"><br/>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email;?>"><br/>

            <label for="phone"><b>Phone Number</b></label>
            <input type="tel" name="phone" value="<?php echo $phone;?>" placeholder="xxxxxxxxxx"><br/>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" value="<?php echo $psw;?>"><br/>

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" value="<?php echo $psw_repeat;?>"><br/>

            <input type='submit' name='UpdateUser-submit' value="Update">
        </form>
    </div>

    <div id='UserType-Information'>
        <?php 
            if(isset($_SESSION['User_type'])){
                switch($_SESSION['User_type']){
                    case 1:
                        # Admin
                        echo "<h2>Accounts</h2>";
                        include 'Profile/Accounts.php';
                        break;
                    case 2:
                        # Teacher
                        echo "<h2>Classes Taught</h2>";
                        include 'Profile/ClassesTaught.php';
                        break;
                    case 3:
                        # Student
                        echo "<h2>Classes Attended</h2>";
                        include 'Profile/ClassesAttended.php';
                        break;
                }
            }
        ?>
    </div>
</body>
</html>
    <form class=UpdatePersonal method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 
        <label for="fname"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="fname" ><br/>

        <label for="lname"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="lname" ><br/>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" ><br/>

        <label for="phone"><b>Phone Number</b></label>
        <input type="tel" name="phone" placeholder="xxxxxxxxxx"><br/>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" ><br/>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat"><br/>
        <b>Account Type: </b> <br/>
        <label for="acc-type"><b>Admin</b>
        <input type="radio" name="acc-type" value=1>
        </label><br/>
        <label for="acc-type"><b>Teacher</b>
        <input type="radio" name="acc-type" value=2>
        </label><br/>
        <label for="acc-type"><b>Student</b>
        <input type="radio" name="acc-type" value=3>
        </label>
        </label>
        <br>
        <input type='submit' name='Create-submit' value='Create'>

    </form> 
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Create-submit'])){
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
                    WHERE User_email='%s' AND NOT User_ID=%d",
                    $connection->real_escape_string($email),
                    $_SESSION['User_ID']);
                    $result = $connection->query($query);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $Err = 'Email already in use: ' . $row['User_email'] . ' for User ID ' . $row['User_ID'];
                        }
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
                        $psw_repeat = test_input($_POST['psw-repeat']);
                        if($psw != $psw_repeat){
                            $Err = "Passwords Do not Match";
                            break;
                        }
                    }
                case 6:
                    $sql = sprintf("INSERT INTO users
                    (`User_ID`, `User_type`, `User_fname`, `User_lname`, `User_email`, `User_phonenumber`, `User_password`)
                    VALUES (NULL, %d , '%s', '%s', '%s', %d, '%s')", 
                    $_POST['acc-type'],
                    $connection->real_escape_string($fname),
                    $connection->real_escape_string($lname),
                    $connection->real_escape_string($email),
                    $connection->real_escape_string($phone),
                    $connection->real_escape_string($psw));
                    try {
                        $result = $connection->query($sql);
                        
                        if($result === TRUE){
                            echo "New Account Created for $fname $lname!";
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

            }
        ?>
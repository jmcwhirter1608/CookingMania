<?php
        // define variables and set to empty values
        $acc_type = NULL;
        $fname = $lname = $email = $phone = $psw = $psw_repeat = NULL;
        $Err = NULL;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Create-submit'])) {
          
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
                $Err = "Please select Account Type";
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
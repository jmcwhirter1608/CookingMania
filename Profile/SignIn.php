
<?php 
    session_start();
    include '../dbconnection.php';
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        } 

    if(isset($_SESSION['User_ID'])){
        header("Location: ProfilePage.php");
    };
    // define variables and set to empty values
    $acc_type = NULL;
    $email = $psw = $psw_repeat = NULL;
    $Err = NULL;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        switch(0){
            case 0:
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
            case 1:
                if(empty($_POST['psw'])){
                    $Err = 102;
                    break;
                } else{
                    $psw = test_input($_POST['psw']);
                }
            case 2:
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
        }
        
    }

    if(empty($email) || empty($psw) || empty($psw_repeat)){
        if($Err != NULL)
            header("Location: ../index.php?Err=$Err");
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
                        echo "Welcome back " . $row['User_fname'] . " " . $row['User_lname'] . "<br>";
                        header("Location: ../ProfilePage.php");
                    } else {
                        header("Location: ../index.php?Err=100");
                    }
                } 
            } else {
                header(htmlspecialchars("Location: ../index.php?Err=106"));
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
    ?>
<!-- </body>
</html> -->

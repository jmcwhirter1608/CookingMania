<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css\styles.css"> -->

    <title>Class Registration</title>
    <style>
        table{
            width: 70%;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
        }
        table, tr, th, td{
            border: 1px solid #d4d4d4;
            border-collapse: collapse;
            padding: 12px;
        }
        th, td{
            text-align: left;
            vertical-align: top;
        }
        tr:nth-child(even){
            background-color: #e7e9eb;
        }
    </style>
</head>
<body>
    <?php include "navbar.php"?>
    <?php include 'dbconnection.php'?>
    <?php $sql = "SELECT * FROM recipes" ; ?>
    <?php $all_categories = mysqli_query($connection,$sql)?>
    <?php $user_id = $_SESSION['User_ID']; ?>
    <?php $user_type = $_SESSION['User_type']; ?>
    <!-- Only allow visibility if user is a student -->

    <?php if($user_type == 3){ ?>

    <h1>Student Registration</h1>

    <h2>Create Registration:</h2>
    <p>Insert Class ID:</p>
    <!-- Forms for both Class registration and deletion for the user  -->
    <form action= <?php echo $_SERVER['PHP_SELF']; ?> method="post">
        <div class="class_registration" align="center">
            <label for="Class_ID"><b>Class ID:<b></label>
			<input type="number" name="Class_ID" required>
			<input type="submit" name="registration" value="submit" style="font-size:16px">
        </div>
    </form>

    <h2>Delete Registration:</h2>
    <form action= <?php echo $_SERVER['PHP_SELF']; ?> method="post">
        <div class="delete_class_registration" align="center">
            <label for="Class_ID_delete"><b>Class ID:<b></label>
			<input type="number" name="Class_ID_delete" required>
			<input type="submit" name="deletion" value="submit" style="font-size:16px">
        </div>
    </form>



    <?php } ?>

    <?php
    
    if(isset($_POST['registration']))
    {   
        $Class_Reg = $_POST['Class_ID'];
        //  Check count of that class id in the user's class enrollment to see if they are already registered.
        $sql_isregistered="SELECT COUNT(*) AS `count` FROM `class_enrollment` WHERE `Class_ID`=$Class_Reg AND `User_ID` = $user_id";
        $result_isregistered=mysqli_query($connection, $sql_isregistered);
        $data = mysqli_fetch_assoc($result_isregistered);
        $user_isregistered =  $data['count'];

        //  Check count of that class id in classes to see if the class even exists.
        $sql_ok = "SELECT * FROM classes WHERE Class_ID = $Class_Reg";

        if($result_classes = mysqli_query($connection, $sql_ok))
        {
            $rowcount = mysqli_num_rows( $result_classes );

            if($rowcount>0 && $user_isregistered==0){ //If there are instance of the class then proceed.

                while($row_class = mysqli_fetch_assoc($result_classes)){
                    $enrollment_max = $row_class["Class_Enrollment"]; //Find max enrollment limit
                }

                //Check if user is allowed registration
                $sql="SELECT COUNT(*) AS `count` FROM `class_enrollment` WHERE `Class_ID`=$Class_Reg";
                $result=mysqli_query($connection, $sql);
                $row = mysqli_fetch_assoc($result);
                $reg_count = $row['count'];
                if($reg_count < $enrollment_max){//check that if the user registers it doesn't exceed the enrollment max for that class
                    $sql_query = "INSERT INTO `class_enrollment`(`Class_ID`, `User_ID`) VALUES ('$Class_Reg','$user_id')";
                    if ($connection->query($sql_query) === TRUE) {
                        echo "Class Registration inserted successfully";
                    }
                    else{
                        echo "Class Registration Not Successful.";
                    }
                }
                else{
                    echo "Class Registration Not Successful. Registration Limit Met";
                }
                
            }
            else{
                echo " is an invalid class ID. Please try again. You may already be registered."; //submitted class idea is not true.
            }
        }
    }
    //Submit deletion sql request.
    if(isset($_POST['deletion']))
    {   
        $DClass_ID = $_POST['Class_ID_delete'];
        $sql_del = "DELETE FROM class_enrollment WHERE Class_ID = $DClass_ID AND `User_ID` = $user_id";

        if($connection->query($sql_del)==true && $con->affected_rows > 0){
            
        }
        else{
        }
    }

    ?>


<?php if($user_type == 3){ ?>
<h2>User's Class Enrollment:</h2>
<?php } ?>

<?php
if($user_type == 3){ //if the user is a student they can see their current registration records.
$sql_reg = "SELECT * FROM class_enrollment WHERE User_ID = $user_id";
$result_reg = mysqli_query($connection, $sql_reg);

    if(mysqli_num_rows($result_reg) > 0)
    {
        echo '<table> <tr> <th> Class ID </th> <th> User ID </th> </tr>';
        while($row = mysqli_fetch_assoc($result_reg)){

                echo '<tr > <td>' . $row["Class_ID"] . '</td>
                <td>' . $row["User_ID"] . '</td>
            </tr>';
            
        }
        echo '</table>';
    }
    else{
        echo "0 results";
    }
}
?>



    
</body>
</html>


<?php include "navbar.php"?>
<?php include 'dbconnection.php'?>

<?php

if(isset($_POST['save']))
{   
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "<br>";
    echo "<br>";
    $Recipe_ID = $_POST['Recipe'];
    $User_ID = $_POST['User_ID'];
    $Class_StartTime = $_POST['Class_StartTime'];
    $Class_EndTime = $_POST['Class_EndTime'];
    $Class_Date = $Class_Date = date('Y-m-d', strtotime($_POST['Class_Date']));
    $Class_RoomNum = $_POST['Class_RoomNum'];
    $Class_Enrollment = $_POST['Class_Enrollment'];
    
//    $Recipe_ID = $_POST['Recipe'];
    
    
    //check time
    //BOOLEAN FOR DATE
    if($Class_StartTime < $Class_EndTime){
        $Class_StartTimevalid = true;
    }
    else{
        $Class_StartTimevalid = false;
        echo 'Class Start time has to be ahead of end time <br>';
    }
    
    
    //CHECK IF DATE IS VALID
    $currentDate = new DateTime();
    $currentDate = $currentDate->format('Y-m-d');
    //BOOLEAN FOR DATE
    if($Class_Date >=$currentDate){
        $Class_Datevalid = true;
    }
    else{
        $Class_Datevalid = false;
        echo 'Class date is in the past. Not valid <br>';
    }
    
    $sql = "SELECT Recipe_ID FROM recipes WHERE Recipe_ID = $Recipe_ID";
    if ($result=$connection->query($sql))
    {
        $rowcount=mysqli_num_rows($result);
        mysqli_free_result($result);
    }
    
    //If user id is empty we use a different sql insert function
    if(empty($User_ID)) {
        echo "NULL value for user id <br>";
        $userid_null = true;
        $rowcount_user_valid = true;
    }
    else{ //make sure it's a valid user id!
        echo "not empty user id <br>";
        $userid_null = false;
        $sql = "SELECT User_ID FROM users WHERE User_ID = $User_ID";
        if ($result=$connection->query($sql))
        {
            $rowcount_user=mysqli_num_rows($result);
            mysqli_free_result($result);
        }
        
        //boolean for user id check
        if($rowcount_user>0){
            $rowcount_user_valid = true;
            echo "valid user!<br>";
        }
        else{
            $rowcount_user_valid = false;
            echo "Enter in a valid User ID. This field can also be left blank if teacher has
                not been assigned yet.<br>";
        }
        
    }

    //CHECK IF CLASS CAN BE BOOKED AT THAT TIME.
    $sql_check = "SELECT * FROM classes WHERE Class_Date = '$Class_Date'";
    $result_check = mysqli_query($connection, $sql_check);
    $canbook = true;
    if(mysqli_num_rows($result_check) > 0)
    {
    while($row = mysqli_fetch_assoc($result_check)){
        if($row["Class_RoomNum"] == $Class_RoomNum){
            // if($row["Class_StartTime"] <= $Class_EndTime || $row["Class_EndTime"]>= $Class_StartTime){
                if($row["Class_StartTime"] <= $Class_EndTime && $Class_EndTime <= $row["Class_EndTime"]){
                echo "scheduling conflict. Check with class checker to plan accordingly.<br>";
                $canbook = false;
                break;
            }
            if($row["Class_StartTime"] <= $Class_StartTime && $Class_StartTime <= $row["Class_EndTime"]){
                echo "scheduling conflict. Check with class checker to plan accordingly.<br>";
                $canbook = false;
                break;
            }
        }

    }
    }
    else
    {
        $canbook = true;
    }
    
        
        

    
    //boolean for recipe id check
    if($rowcount>0){
        $recipeid_true = 1;
    }
    else{
        $recipeid_true = 0;
        echo "Enter in a valid Recipe ID.<br>";
    }
    
        
    if($userid_null){
    $sql_query = "INSERT INTO `classes`(`Recipe_ID`, `User_ID`, `Class_Date`, `Class_StartTime`, `Class_RoomNum`, `Class_EndTime`, `Class_Enrollment`)
    VALUES ('$Recipe_ID',NULL,'$Class_Date','$Class_StartTime','$Class_RoomNum','$Class_EndTime','$Class_Enrollment')";
        }
    else{
        $sql_query = "INSERT INTO `classes`(`Recipe_ID`, `User_ID`, `Class_Date`, `Class_StartTime`, `Class_RoomNum`, `Class_EndTime`, `Class_Enrollment`)
        VALUES ('$Recipe_ID','$User_ID','$Class_Date','$Class_StartTime','$Class_RoomNum','$Class_EndTime','$Class_Enrollment')";
    }
      
    if($recipeid_true && $Class_Datevalid && $rowcount_user_valid && $Class_StartTimevalid && $canbook){
        if ($connection->query($sql_query) === TRUE) {
            echo "Class Record inserted successfully";
            } else {
            echo "Error: " . $sql_query . "<br>" . $connection->error;
            }
    }
    else{
        echo "Fields not filled correctly <br>";
    }
    
   
//    //$sql_query = "INSERT INTO `classes`(`Recipe_ID`, `User_ID`, `Class_Date`, `Class_StartTime`, `Class_RoomNum`, `Class_EndTime`) 
//    // VALUES ('$Recipe_ID','$User_ID','$Class_Date','$Class_StartTime','$Class_RoomNum','$Class_EndTime')";
//     $numrows = $connection->query("SELECT COUNT(*) FROM recipes WHERE Recipe_ID = 2");
//    // echo $numrows;

//    if ($connection->query($sql_query) === TRUE) {
//     echo "record inserted successfully";
//     } else {
//     echo "Error: " . $sql_query . "<br>" . $connection->error;
//     }

    // if (mysqli_query($connection, $sql_query)) 
    // {
    // echo "New Details Entry inserted successfully !";
    // } 
    // else
    // {
    // echo "Error: " . $sql . "" . mysqli_error($connection);
    // }

}




?>





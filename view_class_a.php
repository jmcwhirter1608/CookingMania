<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css\styles.css"> -->

    <title>View Classes</title>
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
    <h1>Classes</h1>
    <!-- Grab user type from navbar to restruct user access to certain pages. -->
    <?php
    $user_type = $_SESSION['User_type'];
    ?>
    <!-- Only if user is an admin or teacher can they update or delete classes -->
    <?php if($user_type == 1 || $user_type == 2){ ?>
    <h2>Class Update</h2>
    <p>Fill in the class ID of the class you wish to update.</p>
    <p></p>
    <form action= <?php echo $_SERVER['PHP_SELF']; ?> method="post">
        <div class="update_class" align="center">
            <label for="Class_ID_up"><b>Class ID:<b></label>
			<input type="number" name="Class_ID_up" required>

			<input type="submit" name="update_class" value="Submit" style="font-size:16px">
        </div>
    </form>

    <h2>Class Delete</h2>
    <form action= <?php echo $_SERVER['PHP_SELF']; ?> method="post">
        <div class="delete_class" align="center">
            <label for="Class_ID_up"><b>Class ID:<b></label>
			<input type="number" name="Class_ID_delete" required>

			<input type="submit" name="delete_class" value="Delete" style="font-size:16px">
        </div>
    </form>
    <?php } ?>

    <?php
    
    if(isset($_POST['update_class']))
    {   
        $UClass_ID = $_POST['Class_ID_up'];
        $sql_ok = "SELECT * FROM classes WHERE Class_ID = $UClass_ID";

        if($result_classes = mysqli_query($connection, $sql_ok))
        {
            $rowcount = mysqli_num_rows( $result_classes );

            if($rowcount>0){
                //Check if the class ID actually exists in the tables
                header("Location: update_classes.php?user=$UClass_ID");
            }
            else{
                echo $UClass_ID;
                echo " is an invalid class id. Please try again.";
            }
        }
    }

    if(isset($_POST['delete_class']))
    {   
        $DClass_ID = $_POST['Class_ID_delete'];
        $sql_del = "DELETE FROM classes WHERE Class_ID = $DClass_ID";
        //DELETE CLASS
        if($connection->query($sql_del)==true && $con->affected_rows > 0)
        {  
        }
        else{
        }
    }

?>

    <h2>Class Filter View</h2>
    <!--<h1>CLASS Filter view per date.</h1>-->
    <p>Filter to look for classes on specific days:</p>

    <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="create_class" align="center">
            <label for="Class_Date"><b>Class Date:</b></label>
            <input type="date" name="Class_Date_2" required>
            <input type="submit" name="class_search" value="Submit" style="font-size:16px">
        </div>
    </form>


    <?php

    
    if(isset($_POST['class_search'])){

    $Class_Date = date('Y-m-d', strtotime($_POST['Class_Date_2']));
    
    $sql_formal = "SELECT classes.User_ID, Recipe_name, Class_Date, Class_StartTime, Class_EndTime, Class_RoomNum, Class_Enrollment, Class_ID FROM (classes INNER JOIN recipes ON classes.Recipe_ID = recipes.Recipe_ID) WHERE Class_Date= '$Class_Date' ";
    //$sql = "SELECT * FROM classes WHERE Class_Date = '$Class_Date'";
    $result = mysqli_query($connection, $sql_formal);
    //$classes_c = mysqli_fetch_array($reult);


    if(mysqli_num_rows($result) > 0)
    {
        // IF the user is an admin or teachr the display does not include the instructor contact information.
        if($user_type == 1 || $user_type == 2){
            echo '<table> <tr> <th> Class ID </th> <th> Recipe_Name </th> <th> Class_Date </th> <th> Start Time </th> <th> End Time </th> <th> Room Num </th> <th> Instructor Name </th> <th> Enrollment Limit </th> </tr>';
        }
        if($user_type == 3){
            echo '<table> <tr> <th> Class ID </th> <th> Recipe_Name </th> <th> Class_Date </th> <th> Start Time </th> <th> End Time </th> <th> Room Num </th> <th> Instructor Name </th> <th> Instructor Email </th> <th> Enrollment Limit </th> </tr>';
        }
        while($row = mysqli_fetch_assoc($result)){
            if($user_type == 1 || $user_type == 2){
                if($row["User_ID"] == NULL){
                    $rowinstructor = NULL;
                    echo '<tr > <td>' . $row["Class_ID"] . '</td>
                    <td>' . $row["Recipe_name"] . '</td>
                    <td>' . $row["Class_Date"] . '</td>
                    <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
                    <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
                    <td>' . $row["Class_RoomNum"] . '</td>
                    <td>' . "-" . '</td>
                    <td>' . $row["Class_Enrollment"] . '</td>
                    </tr>';
                }
                else{
                    $id = $row["User_ID"];
                    $sql_findname = "SELECT * FROM users WHERE User_ID = $id";
                    $result_findname = mysqli_query($connection, $sql_findname);
                    while($row_me = mysqli_fetch_assoc($result_findname)){
                        $instructorname =  $row_me["User_fname"];
                        $instructorlname =  $row_me["User_lname"];
                    }
                    $rowinstructor = $row["User_ID"];
                    echo '<tr > <td>' . $row["Class_ID"] . '</td>
                    <td>' . $row["Recipe_name"] . '</td>
                    <td>' . $row["Class_Date"] . '</td>
                    <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
                    <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
                    <td>' . $row["Class_RoomNum"] . '</td>
                    <td>' . $instructorname . " ".$instructorlname . '</td>
                    <td>' . $row["Class_Enrollment"] . '</td>
                    </tr>';
                }
            }
            if($user_type == 3){
                if($row["User_ID"] == NULL){
                    $rowinstructor = NULL;
                    echo '<tr > <td>' . $row["Class_ID"] . '</td>
                    <td>' . $row["Recipe_name"] . '</td>
                    <td>' . $row["Class_Date"] . '</td>
                    <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
                    <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
                    <td>' . $row["Class_RoomNum"] . '</td>
                    <td>' . "-" . '</td>
                    <td>' . "-" . '</td>
                    <td>' . $row["Class_Enrollment"] . '</td>
                    </tr>';
                }
                else{
                    $id = $row["User_ID"];
                    $sql_findname = "SELECT * FROM users WHERE User_ID = $id";//Query given the user id of the instructor (the users table)
                    $result_findname = mysqli_query($connection, $sql_findname);
                    while($row_me = mysqli_fetch_assoc($result_findname)){
                        $instructorname =  $row_me["User_fname"];
                        $instructorlname =  $row_me["User_lname"];
                        $instructoremail =  $row_me["User_email"];//Retrieve user email as it is from the student view
                    }
                    $rowinstructor = $row["User_ID"];
                    echo '<tr > <td>' . $row["Class_ID"] . '</td>
                    <td>' . $row["Recipe_name"] . '</td>
                    <td>' . $row["Class_Date"] . '</td>
                    <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
                    <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
                    <td>' . $row["Class_RoomNum"] . '</td>
                    <td>' . $instructorname . " ".$instructorlname . '</td>
                    <td>' . $instructoremail . '</td>
                    <td>' . $row["Class_Enrollment"] . '</td>
                    </tr>';
                }
            }
        }
       echo '</table>';
       if($row["User_ID"] == NULL){
       }
    }
    else
    {
        echo "0 results";
    }
}

?>

    <h2>All Classes</h2>
    <p>View of all Classes:</p>

    <?php


    //SAME logic as filter view above, except after doing the inner join we are not filtering per any user inputs!
    $sql_all = "SELECT classes.User_ID, Recipe_name, Class_Date, Class_StartTime, Class_EndTime, Class_RoomNum, Class_Enrollment, Class_ID FROM (classes INNER JOIN recipes ON classes.Recipe_ID = recipes.Recipe_ID)";
    $result_all = mysqli_query($connection, $sql_all);

    if(mysqli_num_rows($result_all) > 0)
    {

    if($user_type == 1 || $user_type == 2){
        echo '<table> <tr> <th> Class ID </th> <th> Recipe_Name </th> <th> Class_Date </th> <th> Start Time </th> <th> End Time </th> <th> Room Num </th> <th> Instructor Name </th> <th> Enrollment Limit </th> </tr>';
    }
    if($user_type == 3){
        echo '<table> <tr> <th> Class ID </th> <th> Recipe_Name </th> <th> Class_Date </th> <th> Start Time </th> <th> End Time </th> <th> Room Num </th> <th> Instructor Name </th> <th> Instructor Email </th> <th> Enrollment Limit </th> </tr>';
    }
    while($row = mysqli_fetch_assoc($result_all)){ //While fetch information from the inner join table, access those values below row by row
        if($user_type == 1 || $user_type == 2){
            if($row["User_ID"] == NULL){
                $rowinstructor = NULL;
                echo '<tr > <td>' . $row["Class_ID"] . '</td>
                <td>' . $row["Recipe_name"] . '</td>
                <td>' . $row["Class_Date"] . '</td>
                <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
                <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
                <td>' . $row["Class_RoomNum"] . '</td>
                <td>' . "-" . '</td>
                <td>' . $row["Class_Enrollment"] . '</td>
                </tr>';
            }
            else{
                $id = $row["User_ID"];
                $sql_findname = "SELECT * FROM users WHERE User_ID = $id";
                $result_findname = mysqli_query($connection, $sql_findname);
                while($row_me = mysqli_fetch_assoc($result_findname)){
                    $instructorname =  $row_me["User_fname"];
                    $instructorlname =  $row_me["User_lname"];
                }
                $rowinstructor = $row["User_ID"];
                echo '<tr > <td>' . $row["Class_ID"] . '</td>
                <td>' . $row["Recipe_name"] . '</td>
                <td>' . $row["Class_Date"] . '</td>
                <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
                <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
                <td>' . $row["Class_RoomNum"] . '</td>
                <td>' . $instructorname . " ".$instructorlname . '</td>
                <td>' . $row["Class_Enrollment"] . '</td>
                </tr>';
            }
        }
        if($user_type == 3){
            if($row["User_ID"] == NULL){
                $rowinstructor = NULL;
                echo '<tr > <td>' . $row["Class_ID"] . '</td>
                <td>' . $row["Recipe_name"] . '</td>
                <td>' . $row["Class_Date"] . '</td>
                <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
                <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
                <td>' . $row["Class_RoomNum"] . '</td>
                <td>' . "-" . '</td>
                <td>' . "-" . '</td>
                <td>' . $row["Class_Enrollment"] . '</td>
                </tr>';
            }
            else{
                $id = $row["User_ID"];
                $sql_findname = "SELECT * FROM users WHERE User_ID = $id";
                $result_findname = mysqli_query($connection, $sql_findname);
                while($row_me = mysqli_fetch_assoc($result_findname)){
                    $instructorname =  $row_me["User_fname"];
                    $instructorlname =  $row_me["User_lname"];
                    $instructoremail =  $row_me["User_email"];
                }
                $rowinstructor = $row["User_ID"];
                echo '<tr > <td>' . $row["Class_ID"] . '</td>
                <td>' . $row["Recipe_name"] . '</td>
                <td>' . $row["Class_Date"] . '</td>
                <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
                <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
                <td>' . $row["Class_RoomNum"] . '</td>
                <td>' . $instructorname . " ".$instructorlname . '</td>
                <td>' . $instructoremail . '</td>
                <td>' . $row["Class_Enrollment"] . '</td>
                </tr>';
            }
        }
    }
    echo '</table>';
    }
    else
    {
        echo "0 results";
        echo $user_type;
        echo "dog";
    }

    ?>

    
</body>
</html>


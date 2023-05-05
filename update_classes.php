<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css\styles.css"> -->

    <title>Update Class</title>
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
    <?php $classid = $_GET['user']?>
    <?php 
    $sql_getclass = "SELECT * FROM classes WHERE Class_ID = $classid";
    // $class_results = mysqli_query($connection,$sql_getclass)
    // echo $class_results

    $class_results = $connection->query($sql_getclass);

    if ($class_results->num_rows > 0) {
    // output data of each row
    while($row = $class_results->fetch_assoc()) {
        $instructorid = $row["User_ID"];
        $current_date = $row["Class_Date"];
        $current_st = $row["Class_StartTime"];
        $current_et = $row["Class_EndTime"];
        $current_roomnum = $row["Class_RoomNum"];
        $current_enrollment = $row["Class_Enrollment"];
        
    }
    } else {
    echo "0 results";
    }
    
    echo "<br>";
    
    ?>
    <?php $sql = "SELECT * FROM recipes" ; ?>
    <?php $all_categories = mysqli_query($connection,$sql)?>

    <!-- This page shows the update form to only admins and teachers -->

    <?php
    $user_type = $_SESSION['User_type'];

    ?>
    
    <?php if($user_type == 1 || $user_type == 2){ ?>
    <form action= "process_class_update.php" method="post">
        <div class="update_classes" align="center">

            <h1>Update Class</h1>
            <label for="Recipe_name">Recipe Name:</label>
            <select name="Recipe">
            <?php
                // use a while loop to fetch data from the $all_categories variable and individually display as recipe name options (instead of ID)
                while ($category = mysqli_fetch_array(
                        $all_categories,MYSQLI_ASSOC)):;
            ?>
            <option value="<?php echo $category["Recipe_ID"];?>">
            <?php echo $category["Recipe_name"];?>
            <?php
                endwhile;
                // While loop must be terminated
            ?>
            </select><br/>
            <br/>

            <label for="User_ID"><b>Class Instructor ID:<b></label>
			<input type="number" value = "<?php echo $instructorid; ?>" name="User_ID" ><br/>

            <label for="Class_Date"><b>Class Date:</b></label>
			<input type="date" name="Class_Date" value = "<?php echo $current_date; ?>" required><br/>
            <br/>
			<label for="Class_StartTime"><b>Class Start Time:</b></label>
            <input type="time" name="Class_StartTime" value = "<?php echo $current_st; ?>" required>
            <br/>
            <label for="Class_EndTime"><b>Class End Time:</b></label>
            <input type="time" name="Class_EndTime" value = "<?php echo $current_et; ?>" required><br/>
            <br/>
            <!-- If admin they get to change room number and enrollment. -->
            <?php if($user_type == 1) { ?> 
                <label for="Class_RoomNum"><b>Class Room Number:<b></label>
                <input type="number" name="Class_RoomNum" value = "<?php echo $current_roomnum; ?>"required><br/>

                <label for="Class_Enrollment"><b>Class Enrollment:<b></label>
                <input style="width:50px" type="number" name="Class_Enrollment" value = "<?php echo $current_enrollment; ?>" min="5" max="60" required><br/>
            <?php } ?>
            <!-- If teacher they will not be able to update room number and enrollment -->
            <?php if($user_type == 2){ ?>
                <input type="hidden" name="Class_RoomNum" value = "<?php echo $current_roomnum; ?>">
                <input type="hidden" name="Class_Enrollment" value = "<?php echo $current_enrollment; ?>">
            <?php } ?>
            

            <input type="hidden" name="class_id" value = "<?php echo $classid; ?>">
			<input type="submit" name="process" value="Submit" style="font-size:20px">
        </div>
    </form>

    <h2>Class List</h2>
    <p>Search for classes to make sure no schedule overlap occurs:</p>

    <!-- Display all classes so updating is easier -->
    <?php
    $sql_all = "SELECT classes.User_ID, Recipe_name, Class_Date, Class_StartTime, Class_EndTime, Class_RoomNum, Class_Enrollment, Class_ID FROM (classes INNER JOIN recipes ON classes.Recipe_ID = recipes.Recipe_ID)";
    $result_all = mysqli_query($connection, $sql_all);

    if(mysqli_num_rows($result_all) > 0)
    {
    echo '<table> <tr> <th> Class ID </th> <th> Recipe_Name </th> <th> Class_Date </th> <th> Start Time </th> <th> End Time </th> <th> Room Num </th> <th> Instructor Name </th> <th> Enrollment Limit </th> </tr>';
        while($row = mysqli_fetch_assoc($result_all)){
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
                    // access individual variables of this user record from the users table
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
   echo '</table>';
}
else
{
    echo "0 results";
    echo $user_type;
    echo "dog";
}

?>
<?php } ?>
    
</body>
</html>







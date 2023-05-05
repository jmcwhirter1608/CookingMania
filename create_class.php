<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css\styles.css"> -->

    <title>Create Class</title>
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
    <!-- GET session information from sign in! -->
    <?php include "navbar.php"?>
    <?php include 'dbconnection.php'?>
    <?php $sql = "SELECT * FROM recipes" ; ?>
    <?php $all_categories = mysqli_query($connection,$sql)?>
    <?php $user_type = $_SESSION['User_type']; ?>
    <!-- comment back -->
    <?php if($user_type == 1){ ?>
    <h1>Classes</h1>
    <p>Admin Only: Create Class</p>
    <!--CLASS CREATION FORM: Allow class creation for admins only</h1>-->
    <form action= "classes_server.php" method="post">
        <div class="create_class" align="center">
            <h1>Create Class</h1>

            <label for="Recipe_name">Recipe Name:</label>
            <select name="Recipe">
            <?php
                // use a while loop to fetch data from the $all_categories variable (The recipe names)
                // and individually display as an option
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
			<!-- <label for="Recipe_ID"><b>Recipe ID:</b></label>
            <input type="text" placeholder="Choose Name" name="Recipe_ID" required><br/> -->

            <label for="User_ID"><b>Class Instructor ID:<b></label>
			<input type="number" placeholder = "optional(leave blank)" name="User_ID"><br/>

            <label for="Class_Date"><b>Class Date:</b></label>
			<input type="date" name="Class_Date" required><br/>
            <br/>
			<label for="Class_StartTime"><b>Class Start Time:</b></label>
            <input type="time" name="Class_StartTime" placeholder="09:00" required>
            <br/>
            <label for="Class_EndTime"><b>Class End Time:</b></label>
            <input type="time" name="Class_EndTime" required><br/>
            <br/>
			<label for="Class_RoomNum"><b>Class Room Number:<b></label>
			<input type="number" name="Class_RoomNum" required><br/>

            <label for="Class_Enrollment"><b>Class Enrollment:<b></label>
			<input style="width:50px" type="number" name="Class_Enrollment" placeholder="5 - 60" min="5" max="60" required><br/>
            <!-- Inforation is sent to be processed in different php file as a post method   -->
			<input type="submit" name="save" value="Submit" style="font-size:20px">
        </div>
    </form>
    <?php } ?>
    <!-- Check here that if the user is an admin only will we allow the class filter option to be shown -->
    <?php if($user_type == 1){ ?>
        <h2>Class List</h2>
        <p>Search for classes to make sure no schedule overlap occurs:</p>

        <form action= "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="create_class" align="center">
                
            <label for="Class_Date"><b>Class Date:</b></label>
            <input type="date" name="Class_Date_2" required>

        
                <input type="submit" name="class_search" value="Submit" style="font-size:20px">
            </div>
        </form>
    <?php } ?>





    <?php
    if(isset($_POST['class_search'])){
        //If the user choose to filter the classes
        $Class_Date = date('Y-m-d', strtotime($_POST['Class_Date_2'])); //Convert form input to correct date format.
        
        //Inner join the tables as that allows access to recipe information (Such as name) as well.
        $sql_formal = "SELECT * FROM (classes INNER JOIN recipes ON classes.Recipe_ID = recipes.Recipe_ID) WHERE Class_Date= '$Class_Date' ";
        $result = mysqli_query($connection, $sql_formal);

        if(mysqli_num_rows($result) > 0)
        {
        echo '<table> <tr> <th> Recipe_Name </th> <th> Class_Date </th> <th> Start Time </th> <th> End Time </th> <th> Room Num </th> </tr>';
        while($row = mysqli_fetch_assoc($result)){
           //Employ table output format and access one row from resulting sql array at a time.
            echo '<tr > <td>' . $row["Recipe_name"] . '</td>
            <td>' . $row["Class_Date"] . '</td>
            <td> ' . rtrim($row["Class_StartTime"],".00000") . '</td>
            <td>' . rtrim($row["Class_EndTime"],".00000") . '</td> 
            <td>' . $row["Class_RoomNum"] . '</td>
            </tr>';
        }
        echo '</table>';
        }
        else
        {
            echo "0 results";
        }
    }

?>




    
</body>
</html>


<?php
    /**
     * Table:
     * | Class_Scheduler.Date | Recipes.Recipe_name | Users.fname(teacher) and Users.lname(teacher) | Class_Scheduler.StartTime | Classes.Duration | Classes.RoomNum | count(Classes_Enrollment.class_ID)
     */
    

    $sql = sprintf(
        "SELECT 
            class_enrollment.Class_ID, 
            classes.Class_Date, 
            classes.Class_StartTime, 
            recipes.Recipe_name, 
            users.User_fname, 
            users.User_lname, 
            classes.Class_RoomNum
        FROM class_enrollment
        INNER JOIN classes
        ON class_enrollment.Class_ID = classes.Class_ID
        INNER JOIN recipes
        ON classes.Recipe_ID = recipes.Recipe_ID
        INNER JOIN users
        ON classes.User_ID = users.User_ID
        WHERE class_enrollment.User_ID = %d;",
        $_SESSION["User_ID"]
    );

    $result = $connection->query($sql);

    if($result->num_rows > 0){
        echo "<table class=ClassesProfile><tr><th>Date</th><th>Start Time</th><th>Recipe</th><th>Teacher</th><th>Room Number</th></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr>
                    <td>" . $row['Class_Date'] . "</td>
                    <td>" . $row['Class_StartTime'] . "</td>
                    <td>" . $row['Recipe_name'] . "</td>
                    <td>" . $row['User_fname'] . " " . $row['User_lname'] . "</td>
                    <td>" . $row['Class_RoomNum'] . "</td>
                   </tr>";
            
        }
    } else{
        echo "<h3>You have not Attended any Classes!</h3>";
    }

?>
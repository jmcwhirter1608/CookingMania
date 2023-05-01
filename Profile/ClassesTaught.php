<?php

    /**
     * Table:
     * | Date | Recipe_name | Start Time | Duration | RoomNum |
     */
   

    $sql = sprintf(
        "SELECT
            classes.Class_Date,
            classes.Class_StartTime,
            recipes.Recipe_name,
            classes.Class_duration,
            classes.Class_RoomNum,
            s.mycount AS Class_Attendance
        FROM classes
        INNER JOIN recipes
        ON recipes.Recipe_ID = classes.Recipe_ID
        INNER JOIN (
            SELECT 
                class_enrollment.Class_ID as Class_ID,
                COUNT(class_enrollment.User_ID) as mycount
            FROM class_enrollment
            GROUP BY class_enrollment.Class_ID) s
        ON s.Class_ID = classes.Class_ID
        WHERE classes.User_ID = %d;",
        $_SESSION["User_ID"]
    );

    $result = $connection->query($sql);

    if($result->num_rows > 0){
        echo "<table><tr><th>Date</th><th>Start Time</th><th>Recipe</th><th>Duration</th><th>Room Number</th><th>Attendance</tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr>
                    <td>" . $row['Class_Date'] . "</td>
                    <td>" . $row['Class_StartTime'] . "</td>
                    <td>" . $row['Recipe_name'] . "</td>
                    <td>" . $row['Class_duration'] . "</td>
                    <td>" . $row['Class_RoomNum'] . "</td>
                    <td>" . $row['Class_Attendance'] . "</td>
                    </tr>";
        }
    }
?>

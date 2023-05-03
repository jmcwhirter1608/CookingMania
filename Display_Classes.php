<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Records</title>
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


<?php

$sql = "SELECT * FROM classes";
$result = mysqli_query($connection, $sql);

if(mysqli_num_rows($result) > 0)
    {
    echo '<table> <tr> <th> Recipe_Name </th> <th> Class_Date </th> <th> Start Time </th> <th> End Time </th> </tr>';
    while($row = mysqli_fetch_assoc($result)){
         // to output mysql data in HTML table format
           echo '<tr > <td>' . $row["Recipe_ID"] . '</td>
           <td>' . $row["Class_Date"] . '</td>
           <td> ' . number_format((float)$row["Class_StartTime"],2,':','') . '</td>
           <td>' . number_format((float)$row["Class_EndTime"],2,':','') . '</td> </tr>';
    }
       echo '</table>';
    }
    else
    {
        echo "0 results";
    }

?>

</body>
</html>
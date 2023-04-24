<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="css\styles.css"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shri</title>
</head>
<body>
    <?php include "navbar.php"?>

    <!-- //uncomment -->
    <?php

    $server_name = "localhost";
    $user_name = "root";
    $password = "";
    $database_name = "CookingMania";

    // Create connection
    $conn = mysqli_connect($server_name, $user_name, $password, $database_name);

    $sql_query = "SELECT Recipe_name FROM Recipes";
    $result = mysqli_query($conn, $sql_query);
    while ( $row = mysqli_fetch_array($result) ) {
        $recipe_name = $row['Recipe_name'];
      }
    ?>
    <!-- comment back -->


    <h1>Classes</h1>
    <h2>Instructor Only: Create Class</h2>
    <!--<h1>CLASS CREATION FORM: Allow class creation only</h1>-->
    <p>should only be able to be done if user is a teacher! either check in the form with a field. Potentially this page is only visible to teachers</p>
    <form action="classes_server.php" method="post">
	<table border="1" align="center">
		<tr>
			<td>
			<label>Recipe Name:</label></td>
			<td><input type="text" name="Recipe_Name"></td>
		</tr>
		<tr>
			<td>
			<label>Class Duration:</label></td>
			<td><input type="text" name="Class_duration"></td>
		</tr>
		<tr>
			<td>
			<label>Teacher ID:</label></td>
			<td><input type="number" name="User_ID"></td>
		</tr>
		<tr>
			<td>
			<label>Class Size Limit (numerical):</label></td>
			<td><input type="number" name="Class_Size_Limit"></td>
		</tr>
		<tr>
			<td colspan="2" align="center" ><input type="submit" name="save" value="Submit" style="font-size:20px"></td>
		</tr>
	</table>
</form>

    <h2>Class Schedular</h2>
    <h2>Class List</h2>

    
</body>
</html>


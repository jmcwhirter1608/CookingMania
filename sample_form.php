<!DOCTYPE html>
<html>
<head>
	<title>
		A Sample Tutorial for database connection.
	</title>
</head>
<body>
	<div align="center">
		<!--<h1>Details Entry Form</h1>-->
	</div>
<form action="classes_server.php" method="post">
	<table border="1" align="center">
		<tr>
			<td>
			<label>Enter First Name</label></td>
			<td><input type="text" name="first_name"></td>
		</tr>
		<tr>
			<td>
			<label>Enter Last Name</label></td>
			<td><input type="text" name="last_name"></td>
		</tr>
		<tr>
			<td>
			<label>Gender</label></td>
			<td><input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="female">Female</td>
		</tr>
		<tr>
			<td>
			<label>Enter Email</label></td>
			<td><input type="email" name="email"></td>
		</tr>
		<tr>
			<td>
			<label>Enter Phone</label></td>
			<td><input type="phone" name="phone"></td>
		</tr>
		<tr>
			<td colspan="2" align="center" ><input type="submit" name="save" value="Submit" style="font-size:20px"></td>
		</tr>
	</table>
</form>
</body>
</html>
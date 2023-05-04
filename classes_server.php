<?php
session_start();

$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "CookingMania";

// Create connection
$conn = mysqli_connect($server_name, $user_name, $password, $database_name);

$sql_query = "SELECT Recipe_name FROM Recipes";
$result = mysqli_query($conn, $sql_query);
while ( $row = mysqli_fetch_array($result) ) {
   echo $row["Recipe_name"]. " . ";
 //   echo $row{'Ingredient_ID'}." . ". $row{'Ingredient_Name'}. "." ."<br>" ;
  }

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

if(isset($_POST['save']))
{	
	 $recipe_name = $_POST['Recipe_Name'];
	 $Class_duration = $_POST['Class_duration'];
	 $User_ID = $_POST['User_ID'];
	 $Class_Size_Limit = $_POST['Class_Size_Limit'];

     $sql_query = "INSERT INTO `Classes`(`Recipe_ID`, `Class_duration`, `User_ID`, `Class_Size_Limit`, `Recipe_Name`)
     VALUES ('2','$Class_duration','$User_ID','$Class_Size_Limit','$recipe_name')";

	 if (mysqli_query($conn, $sql_query)) 
	 {
		echo "New Details Entry inserted successfully !";
	 } 
	 else
     {
		echo "Error: " . $sql . "" . mysqli_error($conn);
	 }


	 mysqli_close($conn);
}


?>



<!-- // initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'CookingMania');

$conn=mysqli_connect($server_name,$username,$password,$database_name);

if(!$conn)
{die("Connection Failed:" . mysqli_connect_error());}

if(isset($_POST['save']))
{
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// // REGISTER USER
// if (isset($_POST['reg_user'])) {
//   // receive all input values from the form
//   $username = mysqli_real_escape_string($db, $_POST['username']);
//   $email = mysqli_real_escape_string($db, $_POST['email']);
//   $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
//   $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

//   // form validation: ensure that the form is correctly filled ...
//   // by adding (array_push()) corresponding error unto $errors array
//   if (empty($username)) { array_push($errors, "Username is required"); }
//   if (empty($email)) { array_push($errors, "Email is required"); }
//   if (empty($password_1)) { array_push($errors, "Password is required"); }
//   if ($password_1 != $password_2) {
// 	array_push($errors, "The two passwords do not match");
//   }

//   // first check the database to make sure 
//   // a user does not already exist with the same username and/or email
//   $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
//   $result = mysqli_query($db, $user_check_query);
//   $user = mysqli_fetch_assoc($result);
  
//   if ($user) { // if user exists
//     if ($user['username'] === $username) {
//       array_push($errors, "Username already exists");
//     }

//     if ($user['email'] === $email) {
//       array_push($errors, "email already exists");
//     }
//   }

//   // Finally, register user if there are no errors in the form
//   if (count($errors) == 0) {
//   	$password = md5($password_1);//encrypt the password before saving in the database

//   	$query = "INSERT INTO users (username, email, password) 
//   			  VALUES('$username', '$email', '$password')";
//   	mysqli_query($db, $query);
//   	$_SESSION['username'] = $username;
//   	$_SESSION['success'] = "You are now logged in";
//   	header('location: index.php');
//   }
// }

// // LOGIN USER
// if (isset($_POST['login_user'])) {
//   $username = mysqli_real_escape_string($db, $_POST['username']);
//   $password = mysqli_real_escape_string($db, $_POST['password']);

//   if (empty($username)) {
//   	array_push($errors, "Username is required");
//   }
//   if (empty($password)) {
//   	array_push($errors, "Password is required");
//   }

//   if (count($errors) == 0) {
//   	$password = md5($password);
//   	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
//   	$results = mysqli_query($db, $query);
//   	if (mysqli_num_rows($results) == 1) {
//   	  $_SESSION['username'] = $username;
//   	  $_SESSION['success'] = "You are now logged in";
//   	  header('location: index.php');
//   	}else {
//   		array_push($errors, "Wrong username/password combination");
//   	}
//   }
// } -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
</head>
<body>
    <?php include "navbar.php"?>
    <hr />
    <h1 align="center">Add Recipe as a Chef</h1>
    <?php include "dbconnection.php"?>

  

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <h1>Create Recipe</h1>


    <label for="fname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="fname" required><br/>

    <label for="lname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lname" required><br/>

    <label for="lname"><b>User Name</b></label>
    <input type="text" placeholder="Enter User Name" name="uname" required><br/>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required><br/>

    <label for="phone"><b>Phone Number</b></label>
    <input type="text" placeholder="(xxx) xxx-xxxx" name="phone" required><br/>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required><br/>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required><br/>

    <label for="acc-type"><b>Teacher</b></label>
    <input type="radio" name="acc-type" value='Teacher' required>
    <label for="acc-type"><b>Student</b></label>
    <input type="radio" name="acc-type" value='Student' required>

    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>



    //close the connection
    mysqli_close($connection);
    ?>


</body>
</html>

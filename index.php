<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css\styles.css">
    <title>Cooking Mania</title>
</head>
<body>
    <?php    
    include 'dbconnection.php'; 
    session_start();

    echo '<h1 class=Profileheader>Welcome to Cooking Mania</h1>';

    if(isset($_SESSION['User_ID'])){
      header('Location: ProfilePage.php');
    } 
    
    if(isset($_REQUEST['Err'])){
      switch($_REQUEST['Err']){
        case 100:
          echo '<h3>Incorrect Email or Password</h3>';
          break;
        case 101:
          echo '<h3>Email is Required</h3>';
          break;
        case 102:
          echo '<h3>Password is Required</h3>';
          break;
        case 103:
          echo '<h3>Repeat Password is Required</h3>';
          break;
        case 104:
          echo '<h3>Passwords are not Equal</h3>';
          break;
        case 105:
          echo '<h3>Invalid Email</h3>';
          break;
        case 106:
          echo '<h3>Email not found</h3>';
          break;
        case 200:
          echo '<h3>First Name is Required</h3>';
          break;
        case 201:
          echo '<h3>Last Name is Required</h3>';
          break;
        case 203:
          echo '<h3>Invalid Email</h3>';
          break;
        case 204:
          echo '<h3>Email Already In Use</h3>';
          break;
        case 205:
          echo '<h3>Phone Is Required</h3>';
          break;
        case 206:
          echo '<h3>Invalid Phone Number (Format: 1234567890)</h3>';
          break;
        case 207:
          echo '<h3>Please select Account Type</h3>';
          break;
        case 208:
          echo '<h3>Account Failed to Create, Try Again or contact Admin!</h3>';
          break;
      }
     
    }
    ?>
    <div class=Welcome>
      <form method="post" action="Profile/SignIn.php">
          <h1>Sign In</h1>

          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="email"><br/>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" ><br/>

          <label for="psw-repeat"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat Password" name="psw-repeat" ><br/>

          <br>
          <input type='submit' name='submit' value='Sign In'>

      </form>

      <form method='post' action="Profile/Register.php">
      
        <h1>Register</h1>


        <label for="fname"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="fname" ><br/>

        <label for="lname"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="lname"><br/>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" ><br/>

        <label for="phone"><b>Phone Number</b></label>
        <input type="tel" name="phone" placeholder="xxxxxxxxxx"><br/>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" ><br/>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat"><br/>

        <label for="acc-type"><b>Teacher</b></label>
        <input type="radio" name="acc-type" value=2>
        <label for="acc-type"><b>Student</b></label>
        <input type="radio" name="acc-type" value=3>
        <br>
        <input type='submit' name='Create-submit' value='Register'>

  
    </form> 
  </div>



    
</body>
</html>

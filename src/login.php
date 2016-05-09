<?php
/*
 *  Username and password authentication for creating session
 */
session_start();
$errormsg='';
if (isset($_POST['submit'])) {
    //If username and password is valid
    if (($_POST['username'] != "turtlebot") || ($_POST['passwd'] != "napelturbot")) {
	//Error message to display if username or password is invalid
        $errormsg = "Invalid Username or Password";
    }
    //If username and password is invalid
    else
    {   
	//Storing username in session variable
        $_SESSION['user_name']=$_POST['username'];
	//Storing host ip address in cookie variable to access it from javascript
        setcookie('host_ip', $_POST['hostip'], time() + (86400 * 30), "/");
	//Redirecting to manual navigation page
        header("location: manual_nav.php"); 
    }
}

//Redirect to manual navigation page if session is valid
if(isset($_SESSION['user_name'])){
    header("location: manual_nav.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Turtlebot Login</title>
</head>
<body>
</br></br></br>
<h1><center>TURTLEBOT NAVIGATION SYSTEM</center></h1>
<br><br><br><br>
<table width="50%" align="center">
<tr>
<td align="center">
<!-- LOGIN FORM -->
<form action="" method="POST">
  <fieldset>
    <legend>LOGIN INFORMATION</legend>
<br><br>
    Username : &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" id="username" name="username" />
    <br><br>
    Password &nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="password" id="passwd" name="passwd" />
    <br><br>
	Host IP &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" id="hostip" name="hostip" />
    <br><br>
	<div id="errormsg"><?php echo $errormsg; ?></div><br>
    <input type="submit" name="submit" value="LOGIN"/>
    <br><br><br>
  </fieldset>
</form>
</td>
</tr>
</table>
</body>
</html>

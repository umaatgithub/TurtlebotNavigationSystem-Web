<?php
session_start();
$errormsg='';
if (isset($_POST['submit'])) {
    if (($_POST['username'] != "turtlebot") || ($_POST['passwd'] != "napelturbot")) {
        $errormsg = "Invalid Username or Password";
    }
    else
    {
        $_SESSION['user_name']=$_POST['username'];
        setcookie('host_ip', $_POST['hostip'], time() + (86400 * 30), "/");
        header("location: manual_nav.php"); 
    }
}

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

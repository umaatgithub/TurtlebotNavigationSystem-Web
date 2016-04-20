<?php
session_start();
if(!(isset($_SESSION['user_name']))){
    header("location: logout.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manual Navigation</title>
<style>
td {
    border: 1px solid black;
}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/roslibjs/current/roslib.min.js"></script>
<script type="text/javascript" src="js/manual_nav.js"></script>
</head>

<body>

<h3 align="right">
    <?php echo $_SESSION['user_name']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php">LOGOUT</a>&nbsp;&nbsp;&nbsp;&nbsp;
</h3>

<h1 align="center">TURTLEBOT NAVIGATION SYSTEM</h1>

<table style="width:100%; height:100%; text-align: center;">

<tr>
    <td  width="250px" height="25px">Host IP address : <? echo $_COOKIE['host_ip']; ?></td> 
    <td colspan="2" align="left" height="25px">&nbsp;&nbsp;Connection status : 
	<input id="conn_img" name="conn_img" src="images/disconnected.png" type="image" width="10px" height="10px"/>     
	<span id="conn_status" name="conn_status"></span>
    </td>
</tr> 

<tr>
    <td width="250px" height="25px"><a href="manual_nav.php">Manual Control</a></td> 
    <td rowspan="4">
        <table style="width:100%; height:100%; text-align: center;">
            <tr>
            <td width='500px' height='500px'>
		<iframe id="video_stream" src="" width= "370" height="340"></iframe>
            </td>

            <td>
		<div align="left">
		&nbsp;&nbsp;&nbsp; Linear velocity &nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;
		<select id="linear_x_vel" name="linear_x_vel">
		    <option value="0.05">Low</option>
		    <option value="0.1" selected="selected">Medium</option>
		    <option value="0.15">High</option>
		</select></br></br>
		&nbsp;&nbsp;&nbsp; Angular velocity &nbsp;: &nbsp; 
		<select id="angular_z_vel" name="angular_z_vel">
		    <option value="0.25">Low</option>
		    <option value="0.5" selected="selected">Medium</option>
		    <option value="0.75">High</option>
		</select>
		</div>
		</br></br></br></br>
		<input id="move_left" src="images/left.png" type="image" width="48" height="48"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input id="move_forward" src="images/forward.png" type="image" width="40" height="40"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input id="move_right" src="images/right.png" type="image" width="48" height="48"/></br></br>
  		<input id="rotate_left" src="images/left.png" type="image" width="48" height="48"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input id="move_backward" src="images/backward.png" type="image" width="40" height="40"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input id="rotate_right" src="images/right.png" type="image" width="48" height="48"/></br></br></br></br>
		<input id="emergency_stop" type="button" value="  Emergency Stop!!!  "/>
            </td> 
	    </tr>
	</table>
    </td>
</tr>

<tr>
    <td width="250px" height="25px"><a href="map_nav.php">Map Navigation</a></td> 
</tr>

<tr>
    <td width="250px" height="25px"><a href="configure.php">Configure Base</a></td> 
</tr>

<tr>
    <td>&nbsp;</td> 
</tr>

</table>
</body>
</html>

<?php
session_start();
if(!(isset($_SESSION['user_name']))){
    header("location: logout.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Configure Base Parameters</title>
<style>
td {
    border: 1px solid black;
}
</style>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/roslibjs/current/roslib.min.js"></script>
<script type="text/javascript" src="js/configure.js"></script>
</head>

<body onload="fetchParameters()">

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
    <td rowspan="4" align="left">
	
	</br>
	<form onsubmit="return updateParameters()">

        &nbsp;&nbsp;&nbsp;Maximum linear velocity (0.3) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
        <input type="number" id="max_vel_x" name="max_vel_x" step="0.1" min="0.1" max="0.5"/> &nbsp;&nbsp;m/s
        <br><br>

        &nbsp;&nbsp;&nbsp;Minimum linear velocity (0.3) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; 
        <input type="number" id="min_vel_x" name="min_vel_x" step="0.05" min="0.05" max="0.5"/> &nbsp;&nbsp;m/s
        <br><br>

        &nbsp;&nbsp;&nbsp;Maximum angular velocity (1.0) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; 
        <input type="number" id="max_rotational_vel" name="max_rotational_vel" step="0.1" min="0.1" max="1.5"/> &nbsp;&nbsp;rad/s
        <br><br>

        &nbsp;&nbsp;&nbsp;Minimum in-place angular velocity (0.5) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; 
        <input type="number" id="min_in_place_vel_theta" name="min_in_place_vel_theta" step="0.1" min="0.1" max="1.5"/> &nbsp;&nbsp;rad/s
        <br><br>

        &nbsp;&nbsp;&nbsp;Maximum obstacle range considered for costmap (2.5) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; 
        <input type="number" id="obstacle_range" name="obstacle_range" step="0.1" min="2" max="3"/> &nbsp;&nbsp;m
        <br><br>

        &nbsp;&nbsp;&nbsp;Maximum distance from obstacles (0.3) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; 
        <input type="number" id="inflation_radius" name="inflation_radius" step="0.1" min="0.1" max="0.5"/> &nbsp;&nbsp;m
        <br><br>

        &nbsp;&nbsp;&nbsp;Update frequency of the global costmap (5.0) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; 
        <input type="number" id="update_frequency_global" name="update_frequency_global" step="1" min="1.0" max="10.0"/> &nbsp;&nbsp;Hz
        <br><br>

	&nbsp;&nbsp;&nbsp;Update frequency of the local costmap (5.0) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; 
        <input type="number" id="update_frequency_local" name="update_frequency_local" step="1" min="1.0" max="10.0"/> &nbsp;&nbsp;Hz
        <br><br>

	&nbsp;&nbsp;&nbsp;<input id="update" name="update" type="submit" value="Update Parameters"/>
	<br><br>

	</form>

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

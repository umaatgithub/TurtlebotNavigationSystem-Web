<?php
session_start();
if(!(isset($_SESSION['user_name']))){
    header("location: logout.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Map Navigation</title>
<style>
td {
    border: 1px solid black;
}
</style>

<script type="text/javascript" src="http://cdn.robotwebtools.org/EaselJS/current/easeljs.min.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/roslibjs/current/roslib.min.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/ros2djs/current/ros2d.min.js"></script>
<script type="text/javascript" src="http://cdn.robotwebtools.org/nav2djs/current/nav2d.min.js"></script>
<script type="text/javascript" src="js/map_nav.js"></script>
</head>

<body onload="loadMap()">

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
		<div id="map"></div>
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

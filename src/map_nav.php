<?php
session_start();

//Redirect to logout page if session does not exist
if(!(isset($_SESSION['user_name']))){
    header("location: logout.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Map Navigation</title>

<!-- Style for table columns -->
<style>
td {
    border: 1px solid black;
}
</style>

<!-- Include script files -->
<script type="text/javascript" src="js/lib/easeljs.min.js"></script>
<script type="text/javascript" src="js/lib/eventemitter2.min.js"></script>
<script type="text/javascript" src="js/lib/roslib.min.js"></script>
<script type="text/javascript" src="js/lib/ros2d.min.js"></script>
<script type="text/javascript" src="js/lib/nav2d.js"></script>
<script type="text/javascript" src="js/custom/map_nav.js"></script>
</head>

<body onload="loadMap()">

<h3 align="right">
    <!-- Display session username and logout link -->
    <?php echo $_SESSION['user_name']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php">LOGOUT</a>&nbsp;&nbsp;&nbsp;&nbsp;
</h3>

<h1 align="center">TURTLEBOT NAVIGATION SYSTEM</h1>

<table style="width:100%; height:100%; text-align: center;">

<tr>
    <!-- Display host ip address and connection status -->
    <td  width="250px" height="25px">Host IP address : <? echo $_COOKIE['host_ip']; ?></td> 
    <td colspan="2" align="left" height="25px">&nbsp;&nbsp;Connection status : 
	<input id="conn_img" name="conn_img" src="images/disconnected.png" type="image" width="10px" height="10px"/>     
	<span id="conn_status" name="conn_status"></span>
    </td>
</tr> 

<tr>
    <td width="250px" height="25px"><a href="manual_nav.php">Manual Control</a></td> 
    <td rowspan="6">
        <table style="width:100%; height:100%; text-align: center;">
            <tr>
            <td width='500px' height='500px'>
		<!-- Video stream from trutlebot -->
		<iframe id="video_stream" src="" width= "370" height="340"></iframe>
            </td>

            <td>
		Select one random goal point to navigate.</br></br>
		<!-- Display map -->
		<div id="map"></div>
            </td> 
	    </tr>
	</table>
    </td>
</tr>

<tr>
    <td width="250px" height="25px"><a href="init_pose.php">Initialize Pose</a></td> 
</tr>

<tr>
    <td width="250px" height="25px"><a href="map_nav.php">Map Navigation</a></td> 
</tr>

<tr>
    <td width="250px" height="25px"><a href="path_nav.php">Path Navigation</a></td> 
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

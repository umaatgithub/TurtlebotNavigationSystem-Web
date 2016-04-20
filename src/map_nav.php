<?php
session_start();
if(!(isset($_SESSION['user_name']))){
    header("location: logout.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Navigation</title>

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
<script type="text/javascript">
  /**
   * Setup all GUI elements when the page is loaded.
   */
  function init() {
    // Connect to ROS.
    var ros = new ROSLIB.Ros({
      url : 'ws://192.168.0.100:9090'
    });

    // Create the main viewer.
    var viewer = new ROS2D.Viewer({
      divID : 'nav',
      width : 750,
      height : 800
    });

    // Setup the nav client.
    var nav = NAV2D.OccupancyGridClientNav({
      ros : ros,
      rootObject : viewer.scene,
      viewer : viewer,
      continuous : true,
      serverName : 'move_base'
    });
  }
</script>
</head>
<h3 align="right"><?php echo $_SESSION['user_name']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php">LOGOUT</a>&nbsp;&nbsp;&nbsp;&nbsp;</h3>
<body onload="init()">
<table style="width:100%; height:100%; text-align: center;">

<tr>
    <th colspan='3'><h1>TURTLEBOT NAVIGATION SYSTEM</h1></th> 
</tr>

<tr>
    <td width='200px' height='25px'><a href="manual_nav.php">Manual Control</a></td> 
    <td rowspan='4'>
        <table style="width:100%; height:100%; text-align: center;">

<tr>
    <td width='500px' height='500px'>
	<iframe src="http://192.168.0.100:8080/stream_viewer?topic=/camera/rgb/image_color" width= "370" height="340"></iframe>
    </td>

<td>
	<div id="nav"></div>
    </td> 
  </tr>
        </table>
    </td> 
</tr>

<tr>
    <td width='200px' height='25px'><a href="map_nav.php">Map Navigation</a></td> 
</tr>

<tr>
    <td width='200px' height='25px'><a href="configure.php">Settings</a></td> 
</tr>

<tr>
    <td>&nbsp;</td> 
</tr>

</table>
</body>

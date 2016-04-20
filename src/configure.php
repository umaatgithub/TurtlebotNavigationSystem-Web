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

</head>
<body>
<h3 align="right"><?php echo $_SESSION['user_name']; ?>&nbsp;&nbsp;&nbsp;<a href="logout.php">LOGOUT</a>&nbsp;&nbsp;&nbsp;&nbsp;</h3>
<table style="width:100%; height:100%; text-align: center;">

<tr>
    <th colspan='3'><h1>TURTLEBOT NAVIGATION SYSTEM</h1></th> 
</tr>

<tr>
    <td width='200px' height='25px'><a href="manual_nav.php">Manual Control</a></td> 
    <td rowspan='4'>
        <br><br>
    Maximum forward velocity  ( max_vel_x: 0.3    base_local_planner_params    m/s)  : 
    <input type="text" name="max_vel_x" >
    <br><br>
    Minimum forward velocity ( min_vel_x: 0.3    base_local_planner_params    m/s)  :  &nbsp;: 
    <input type="text" name="min_vel_x" >
    <br><br>
    Maximum rotational velocity ( max_rotational_vel: 1.0    base_local_planner_params  rad/s)  :  &nbsp;: 
    <input type="text" name="max_rotational_vel" >
    <br><br>
    Minimum rotational velocity while performing in-place rotations ( min_in_place_vel_theta: 0.5  base_local_planner_params  rad/s)  :  &nbsp;: 
    <input type="text" name="min_in_place_vel_theta" >



<br><br>
     Maximum range sensor reading that will result in an obstacle being put into the costmap  ( obstacle_range: 2.5    costmap_common_params   m)  : 
    <input type="text" name="obstacle_range" >


<br><br>
    Maximum distance from obstacles ( inflation_radius: 0.3  costmap_common_params   m)  : 
    <input type="text" name="inflation_radius" >



<br><br>
    update_frequency of the global costmap ( update_frequency: 5.0  global_costmap_params   Hz)  : 
    <input type="text" name="update_frequency_global" >




<br><br>
    update_frequency of the local costmap ( update_frequency: 5.0  base_local_planner_params Hz )  : 
    <input type="text" name="update_frequency_local" >



    <br><br><br>
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

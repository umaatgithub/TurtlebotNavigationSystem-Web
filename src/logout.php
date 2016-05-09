<?php
session_start();
setcookie("host_ip", "", time() - 3600);
setcookie("initial_pose_set", "", time() - 3600);
if(session_destroy()) {
    header("Location: login.php");
}
?>

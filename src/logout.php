<?php
session_start();
setcookie("user", "", time() - 3600);
if(session_destroy()) {
    header("Location: login.php");
}
?>

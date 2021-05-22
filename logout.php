<?php
session_start();
//fetch the value from the session

session_destroy();	
header('location:index.php');
?>
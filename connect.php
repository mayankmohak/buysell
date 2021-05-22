<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "buy-sell";

// Connection for query for epizy.com
// $servername = "sql211.epizy.com";
// $username = "epiz_27178478";
// $password = "5Dkmn56NmlLvE";
// $dbname = "epiz_27178478_buysell";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
?>
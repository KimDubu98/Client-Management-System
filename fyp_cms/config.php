<?php

$servername="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$dbName="fyp"; // Database name
// Create connection
$db = new mysqli($servername, $username, $password, $dbName);
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
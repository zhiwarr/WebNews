<?php

define('DB_SERVER','localhost');
define('DB_USER','zhiwar');
define('DB_PASS' ,'root');
define('DB_NAME','lyz');
$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
$error="";
$msg="";
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
    
function getIP($condition){
    global $conn;
    $number=mysqli_query($conn,"SELECT ip FROM $condition");
 echo mysqli_num_rows($number);
 $ipAddress = $_SERVER['REMOTE_ADDR'];
 $query = mysqli_query($conn, "SELECT ip FROM visitors WHERE ip='$ipAddress'"); 
 if (mysqli_num_rows($query)==0) {
    $query2 = mysqli_query($conn,"INSERT INTO visitors(ip) VALUES('$ipAddress')");
 }
 
}
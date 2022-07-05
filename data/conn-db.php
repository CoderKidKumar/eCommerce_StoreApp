<?php
//Regular PHP
$servername = "n4m3x5ti89xl6czh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$DBuser = "t7xs9wf15xm0s7ql";
$DBpass = "s1poz3dm8p209okx";
$DBname = "smzomjz5osq3jb94";
$port = "3306";
$success = mysqli_connect(
    $servername,
    $DBuser,
    $DBpass,
    $DBname,
    $port
);
if (!$success) {
    die("Connection to DB failed: " . mysqli_connect_error());
} else {
    $connection = $success;
}
?>

<?php
//DAO
class DatabaseDAO {
private $servername = "n4m3x5ti89xl6czh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
private $DBuser = "t7xs9wf15xm0s7ql";
private $DBpass = "s1poz3dm8p209okx";
private $DBname = "smzomjz5osq3jb94";
private $port = "3306";
    function getConnection() {
        
        $conn = mysqli_connect(
            $this->servername,
            $this->DBuser,
            $this->DBpass,
            $this->DBname,
            $this->port
        );
        if ($conn->connect_error) {
            die("<h2> Connection to DB failed: #".$conn->connect_errno."</h2><br>".$conn->connect_error. "<br>");
        } else {
            return $conn;
        }
    }
}

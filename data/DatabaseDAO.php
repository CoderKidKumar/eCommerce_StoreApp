<?php
//DAO
class DatabaseDAO {
private $servername = "localhost";
private $DBuser = "root";
private $DBpass = "root";
private $DBname = "Wearhouse";
private $port = "8889";
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

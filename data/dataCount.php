<?php
require_once "../../autoloader.php";

class dataCount {
    function UserCount() {
        $db = new DatabaseDAO();
        $connection = $db->getConnection();

        $UserQuery = "SELECT * FROM Users";
        $UserResult = mysqli_query($connection, $UserQuery);
        $UserNum = mysqli_num_rows($UserResult);

        return $UserNum;
    }
    function ItemCount(){
        $db = new DatabaseDAO();
        $connection = $db->getConnection();

        $ItemQuery = "SELECT * FROM Products";
        $ItemResult = mysqli_query($connection, $ItemQuery);
        $ItemNum = mysqli_num_rows($ItemResult);

        return  $ItemNum;
    }

    function AdminCount(){
        $db = new DatabaseDAO();
        $connection = $db->getConnection();

        $Query = "SELECT * FROM Users WHERE Role = 1";
        $Result = mysqli_query($connection, $Query);
        $Num = mysqli_num_rows($Result);

        return  $Num;
    }

    function CustomerCount(){
        $db = new DatabaseDAO();
        $connection = $db->getConnection();

        $Query = "SELECT * FROM Users WHERE Role = 0";
        $Result = mysqli_query($connection, $Query);
        $Num = mysqli_num_rows($Result);

        return  $Num;
    }
    function LockedCount(){
        $db = new DatabaseDAO();
        $connection = $db->getConnection();

        $Query = "SELECT * FROM Users WHERE Role = 66";
        $Result = mysqli_query($connection, $Query);
        $Num = mysqli_num_rows($Result);

        return  $Num;
    }
    function ListedCount(){
        $db = new DatabaseDAO();
        $connection = $db->getConnection();

        $ItemQuery = "SELECT * FROM Products";
        $ItemResult = mysqli_query($connection, $ItemQuery);
        $ItemNum = mysqli_num_rows($ItemResult);

        $ItemQuery2 = "SELECT * FROM Products WHERE itemType = 0";
        $ItemResult2 = mysqli_query($connection, $ItemQuery2);
        $ItemNum2 = mysqli_num_rows($ItemResult2);

        $value = $ItemNum -  $ItemNum2;

        return $value;
    }

    function UnlistedCount(){
        $db = new DatabaseDAO();
        $connection = $db->getConnection();

        $ItemQuery = "SELECT * FROM Products WHERE itemType = 0";
        $ItemResult = mysqli_query($connection, $ItemQuery);
        $ItemNum = mysqli_num_rows($ItemResult);

        return  $ItemNum;
    }

    function Count(){
        $db = new DatabaseDAO();
        $connection = $db->getConnection();

        $ItemQuery = "SELECT * FROM Products WHERE itemType = 0";
        $ItemResult = mysqli_query($connection, $ItemQuery);
        $ItemNum = mysqli_num_rows($ItemResult);

        return  $ItemNum;
    }
}

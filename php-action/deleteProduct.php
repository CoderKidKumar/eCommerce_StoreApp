<?php
require_once "../autoloader.php";
if (isset($_GET['id'])){
    $db = new DatabaseDAO();
    $connection = $db->getConnection();

    $id = $_GET['id'];

    //get file name and then find location
    $select ="SELECT itemPicture FROM Products WHERE id = ?";
    $SLstmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($SLstmt, $select);
    mysqli_stmt_bind_param($SLstmt, "i", $id);
    mysqli_stmt_execute($SLstmt);
    $result = mysqli_stmt_get_result($SLstmt);
    $row = mysqli_fetch_assoc($result);
    $filename = "../img/products/".$row["itemPicture"];
    unlink($filename); //delete the file picture



    //delete the item from database
    $delete = "DELETE FROM Products WHERE id = ?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $delete);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: ../admin-info/page/products.php?deleteProduct=sucess");
}

<?php
require_once "../autoloader.php";
if (isset($_GET['id'])){
    $db = new DatabaseDAO();
    $connection = $db->getConnection();

    $id = $_GET['id'];
    $delete = "DELETE FROM Users WHERE id = ?";
    
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $delete);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header("Location: ../admin-info/page/users.php?deleteUser=sucess");
}

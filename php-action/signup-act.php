<?php
if (isset($_POST['signup'])) {
    require "../data/conn-db.php";

    $fullname = $_POST["name"];
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $repass = $_POST["re-pass"];

    if (empty($fullname) || empty($username) || empty($pass) || empty($repass)) {
        header("Location: ../account/signup.php?error=empty&name=" . $fullname . "&uname=" . $username);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../account/signup.php?error=xname&name=" . $fullname);
        exit();
    } else if (strlen($pass) <= 7) {
        header("Location: ../account/signup.php?error=length&name=" . $fullname . "&uname=" . $username);
        exit();
    } else if ($pass !== $repass) {
        header("Location: ../account/signup.php?error=pass&name=" . $fullname . "&uname=" . $username);
        exit();
    } else {
        $sql = "SELECT username FROM Users WHERE username=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../account/signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../account/signup.php?error=taken&name=" . $fullname);
                exit();
            } else {
                $sql2 = "INSERT INTO `Users`(`name`, `username`, `passkey`,`Role`) VALUES (?,?,?,?)";
                $stmt = mysqli_stmt_init($connection);
                if (!mysqli_stmt_prepare($stmt, $sql2)) {
                    header("Location: ../account/signup.php?error=sqlerror");
                    exit();
                } else {
                    $hashPass = password_hash($pass, PASSWORD_BCRYPT);
                    $customerInt = 0;


                    mysqli_stmt_bind_param($stmt, "sssi", $fullname, $username, $hashPass, $customerInt);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../account/login.php?signup=sucess");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
} else {
    header("Location: ../account/signup.php");
    exit();
}
?>

<?php
require_once "../autoloader.php";
require "../data/conn-db.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $keypass = $_POST['password'];

    if (empty($username) || empty($keypass)) {
        header("Location: ../account/login.php?error=empty");
        exit();
    } else {
        $sql = "SELECT * FROM Users WHERE username=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../account/login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($keypass, $row["passkey"]);
                if ($passCheck == false) {
                    header("Location: ../account/login.php?error=wrongpass");
                    exit();
                } else if ($passCheck == true) {
                    //the role # is 1 = admin
                    if ($row['Role'] == 1) {
                        session_start();
                        $_SESSION["sessionName"] = $row["name"];
                        $_SESSION["UserRole"] = $row["Role"];
                        header("Location: ../admin-info/page/dashboard.php");
                        exit();
                    } else { 
                    //the role # is 0 = customer or 66=locked account
                        session_start();
                        $_SESSION["UserRole"] = $row["Role"];
                        $_SESSION["sessionID"] = $row["id"];
                        $_SESSION["sessionName"] = $row["name"];
                        $cart = new cartObj($_SESSION["sessionID"]);
                        $_SESSION["shoppingCart"] = serialize($cart);
                        header("Location: ../index.php");
                        exit();
                    }
                } else {
                    header("Location: ../account/login.php?error=wrongpass");
                    exit();
                }
            } else {
                header("Location: ../account/login.php?error=nouser");
                exit();
            }
        }
    }


    mysqli_stmt_close($stmt);
    mysqli_close($connection);
} else {
    header("Location: ../account/login.php");
    exit();
}

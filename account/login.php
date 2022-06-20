<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title> Apostolic Men Wear-House | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../styles/logstyle.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor">
    </head>

    <body style="background-color: #102132">
        <?php
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
    if (isset($_GET['error'])) {
        if (($_GET['error']) == "empty") {
            echo '
                <div class="alert alert-danger" role="alert">
                Textfields are empty!
                </div>';
        } else if (($_GET['error']) == "sqlerror") {
            echo '
                <div class="alert alert-warning" role="alert">
                Database cannot handle inputs at this moment! Try again in a few seconds.
                </div>';
        } else if (($_GET['error']) == "wrongpass") {
            echo '
                <div class="alert alert-danger" role="alert">
                Wrong password was entered!
                </div>';
        } else if (($_GET['error']) == "nouser") {
            echo '
                <div class="alert alert-danger" role="alert">
                No username exist! Create a new user? <a href="signup.php">Sign Up</a>
                </div>';
        }else if (($_GET['error']) == "login") {
            echo '
                <div class="alert alert-info" role="alert">
                Login or <a href="signup.php">Create an account</a> to shop.
                </div>';
        }
    } else if (($_GET['signup']) == "sucess") {
        echo '
            <div class="alert alert-success" role="alert">
            New user sucessfully created!
            </div>';
    }
    ?>
        <form class="box" action="../php-action/login-act.php" method="post">
            <a href="../index.php"> <img src="../img/logo.png" /> </a>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="submit" value="Login">
            <p class="message">Not Registered? <a href="signup.php">Sign Up</a>
            <p>
        </form>
    </body>

</html>

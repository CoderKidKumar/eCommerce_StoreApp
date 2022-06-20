<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Apostolic Men Wear-House | Sign-up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../styles/logstyle.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor">
    </head>

    <body style="background-color: #102132">
        <?php
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
    if (isset($_GET['error'])) {
        $freshUsername = $_GET['uname'];
        $freshName = $_GET['name'];

        if (($_GET['error']) == "empty") {
            echo '
                <div class="alert alert-danger" role="alert">
                Textfields are empty!
                </div>';
        } else if (($_GET['error']) == "xname") {
            echo '
                <div class="alert alert-danger" role="alert">
                Username does not contain a-z, A-Z, 0-9
                </div>';
        } else if (($_GET['error']) == "pass") {
            echo '
                <div class="alert alert-danger" role="alert">
                Passwords do not match! Please try again.
                </div>';
        } else if (($_GET['error']) == "sqlerror") {
            echo '
                <div class="alert alert-warning" role="alert">
                Database cannot handle inputs at this moment! Try again in a few seconds.
                </div>';
        } else if (($_GET['error']) == "length") {
            echo '
                <div class="alert alert-warning" role="alert">
                The password must be 8 characters long!
                </div>';
        } else if (($_GET['error']) == "taken") {
            echo '
                <div class="alert alert-info" role="alert">
                Username is already taken. Please use another username.
                </div>';
        }
    }
    ?>
        <form class="registerbox" action="../php-action/signup-act.php" method="post">
            <a href="../index.php"> <img src="../img/logo.png" /> </a>
            <input type="text" name="name" placeholder="Full Name" <?php echo 'value ="' . $freshName . '"' ?>>
            <input type="text" name="username" placeholder="Username" <?php echo 'value ="' . $freshUsername . '"' ?>>
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="re-pass" placeholder="Re-Type Password">
            <input type="submit" name="signup" value="Sign Up">
            <p class="message">Already Registered? <a href="login.php">Log In</a>
            <p>
        </form>
    </body>

</html>

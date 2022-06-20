<!DOCTYPE html>
<?php
//session required only when users logs in
session_start();
?>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Locked Out?!</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
    </head>

    <body style="height: 100%;
    width: 100%;
    font-family: Georgia, 'Times New Roman', Times, serif;
    font-size: 1.1rem;
    background-color: #102132;">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 my-auto">
                    <div class="masthead-content py-5 py-md-0" style="color:white;">
                        <p class="mt-5 text-center"><i class="fas fa-user-lock" style="font-size: 500px;"></i></p>
                        <h1 class="mt-5 text-center">Sorry You Are Locked Out...</h1>
                        <p class="mt-5 text-center">For some reason, your account has been locked out / deleted.
                            Contact our
                            customer support at:
                            <strong>
                                <h3 class="text-center">1(800)777-0000</h3>
                            </strong>
                        </p>

                        <p class="mt-5 text-center">Error Code:
                            <strong>
                                <h3 class="text-center">
                                    LK-USR-8C8-<?php echo $_SESSION["sessionID"]; echo"-"; echo $_SESSION["UserRole"]?>
                                </h3>
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php 
    session_start();
    session_unset();
    session_destroy();
    ?>

</html>

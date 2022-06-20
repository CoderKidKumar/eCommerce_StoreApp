<!DOCTYPE html>
<html lang="en">
    <?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
require_once "data/cartObj.php";
$cart = serialize($_SESSION["shoppingCart"]);
//session required only when users logs in
session_start();

if ($_SESSION["UserRole"]==1){
    header("Location: admin-info/page/dashboard.php");
}else if($_SESSION["UserRole"]==66){
    header("Location: locked.php");
}
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Bootstrap link and other Stylesheets-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
        <link href="styles/theme.css" rel="stylesheet" />
        <link href="styles/account.css" rel="stylesheet" />

        <!--Change Title For Page and Call Proper CSS links-->
        <?php
            if (isset($_GET['account'])) {
                echo '<title> Apostolic Men Wear-House | ' . $_SESSION["sessionName"] . ' Profile</title>';
            } else if (isset($_GET['items'])) {
                echo '<title>Apostolic Men Wear-House | Products </title>';
            } else if (isset($_GET['cart'])) {
                echo '<title>Apostolic Men Wear-House | View Cart </title>';
            } else {
                echo '<title>Apostolic Men Wear-House</title>';
            }
        ?>
    </head>

    <body>
        <!-- Navigation Bar-->
        <nav class="navbar navbar-expand-md navbar-dark sticky-top">
            <div class="container-fluid">
                <!--brand logo/name here (clickable to go back home)-->
                <a class="navbar-brand" href="index.php"> <img src="img/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarReponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--navigation items-->
                <div class="collapse navbar-collapse" id="navbarReponsive">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                                <h4>&nbsp&nbsp Coats &nbsp&nbsp</h4>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="products.php?items=11">Sport Coats</a>
                                <a class="dropdown-item" href="products.php?items=12">Blazers</a>
                                <a class="dropdown-item" href="products.php?items=13">Casual Coats</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                                <h4>&nbsp&nbsp Shirts &nbsp&nbsp</h4>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="products.php?items=21">Dress Shirts</a>
                                <a class="dropdown-item" href="products.php?items=22">Casual Shirts</a>
                                <a class="dropdown-item" href="products.php?items=23">Polo Shirts</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                                <h4>&nbsp&nbsp Ties &nbsp&nbsp</h4>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="products.php?items=31">Neckties</a>
                                <a class="dropdown-item" href="products.php?items=32">Bowties</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                                <h4>&nbsp&nbsp Pants &nbsp&nbsp</h4>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="products.php?items=41">Dress Pants</a>
                                <a class="dropdown-item" href="products.php?items=42">Casual Pants</a>
                                <a class="dropdown-item" href="products.php?items=43">Jeans</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                                <h4>&nbsp&nbsp Shoes &nbsp&nbsp</h4>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="products.php?items=51">Dress Shoes</a>
                                <a class="dropdown-item" href="products.php?items=52">Casual Shoes</a>
                                <a class="dropdown-item" href="products.php?items=53">Sneakers</a>
                            </div>
                        </li>
                    </ul>
                    <div>
                        <!--Smaller nav for login / account & cart -->
                        <ul class="navbar-nav md-auto m-auto">
                            <?php
                            if (isset($_SESSION["sessionName"])) {
                                $cart = unserialize($_SESSION["shoppingCart"]);
                                $count = 0;
                                foreach ($cart->getItems() as $product_id => $qty){
                                    if(isset($product_id)){
                                        $count++;
                                    }else{
                                        $count = 0;
                                    }
                                }
                                echo ' 
                                <li class="nav-item loginName">
                                    <a class="nav-link" href="account.php?account=' . $_SESSION["sessionID"] . '" style="color: white">' . $_SESSION["sessionName"] . ' </a>
                                </li>
                                <li class="nav-item cartIco">
                                    <a class="nav-link" href="cart.php?cart" style="color: white">
                                    <span class="fa-stack fa-2x has-badge" data-count="'.$count.'"> 
                                        <i class="fa fa-shopping-cart white-cart"></i>
                                    </span>
                                    </a>
                                </li>';
                                $cart = serialize($_SESSION["shoppingCart"]);
                            } else {
                                echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="account/login.php" style="color: white">Login</a>
                                </li>';
                            }
                        ?>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Body and HTML tag continues on other pages -->

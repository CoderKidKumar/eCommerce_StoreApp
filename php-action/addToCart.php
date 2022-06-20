<?php
require_once "../data/cartObj.php";
require_once "../data/DatabaseDAO.php";




if (isset($_POST['Cart_ADD_NUM'])){
    session_start();
    $quant = $_POST['quant'];
    if(isset($_SESSION["shoppingCart"])){
        $cart = unserialize($_SESSION["shoppingCart"]);
    }else{
        $cart = new cartObj($_SESSION["sessionID"]);
    }

    if (isset($_GET['id']) && isset($_SESSION["sessionID"])) {
        $item = $_GET['id'];
        $query = "SELECT * FROM Products WHERE id = $item";
        $db = new DatabaseDAO();
        $connection = $db->getConnection();
        $result = mysqli_query($connection, $query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $addedItem = mysqli_fetch_assoc($result);
            }
        }
        $cart->addQty($addedItem["ID"], $quant);
        $cart->calcPrice();

        $_SESSION["shoppingCart"] = serialize($cart);
        header("Location: ../cart.php");
    }else{
        header("Location: ../account/login.php?error=login");
    }
} else if (isset($_POST['Cart_ADD'])){
    session_start();
    if(isset($_SESSION["shoppingCart"])){
        $cart = unserialize($_SESSION["shoppingCart"]);
    }else{
        $cart = new cartObj($_SESSION["sessionID"]);
    }

    if (isset($_GET['id']) && isset($_SESSION["sessionID"])) {
        $item = $_GET['id'];
        $query = "SELECT * FROM Products WHERE id = $item";
        $db = new DatabaseDAO();
        $connection = $db->getConnection();
        $result = mysqli_query($connection, $query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $addedItem = mysqli_fetch_assoc($result);
            }
        }
        $cart ->addItem($addedItem["ID"]);
        $cart->calcPrice();
        $_SESSION["shoppingCart"] = serialize($cart);
        header("Location: ../cart.php");
    }else{
        header("Location: ../account/login.php?error=login");
    }
} else if (isset($_POST['update'])){
    session_start();
    if(isset($_SESSION["shoppingCart"])){
        $cart = unserialize($_SESSION["shoppingCart"]);
    }else{
        $cart = new cartObj($_SESSION["sessionID"]);
    }
    if (isset($_POST['id']) && isset($_SESSION["sessionID"])) {
        $item = $_POST['id'];
        $quant = $_POST['changeQty'];
        $cart ->updateQty($item,$quant);
        $cart->calcPrice();
        $_SESSION["shoppingCart"] = serialize($cart);
        header("Location: ../cart.php");
    }else{
        header("Location: ../account/login.php?error=login");
    }
} else if (isset($_POST['removeProduct'])){
    session_start();
    if(isset($_SESSION["shoppingCart"])){
        $cart = unserialize($_SESSION["shoppingCart"]);
    }else{
        $cart = new cartObj($_SESSION["sessionID"]);
    }
    if (isset($_POST['id']) && isset($_SESSION["sessionID"])) {
        $item = $_POST['id'];
        $quant = 0;
        $cart ->updateQty($item,$quant);
        $cart->calcPrice();
        $_SESSION["shoppingCart"] = serialize($cart);
        header("Location: ../cart.php");
    }else{
        header("Location: ../account/login.php?error=login");
    }
} else {
    header("Location: ../index.php");
}

<?php require "header.php";
require_once "autoloader.php";

if (isset($_GET['items'])) {
    if (($_GET['items']) == "11") {
        $query = "SELECT * FROM Products WHERE itemType = 11";
    } else if (($_GET['items']) == "12") {
        $query = "SELECT * FROM Products WHERE itemType = 12";
    } else if (($_GET['items']) == "13") {
        $query = "SELECT * FROM Products WHERE itemType = 13";
    } else if (($_GET['items']) == "21") {
        $query = "SELECT * FROM Products WHERE itemType = 21";
    } else if (($_GET['items']) == "22") {
        $query = "SELECT * FROM Products WHERE itemType = 22";
    } else if (($_GET['items']) == "23") {
        $query = "SELECT * FROM Products WHERE itemType = 23";
    } else if (($_GET['items']) == "31") {
        $query = "SELECT * FROM Products WHERE itemType = 31";
    } else if (($_GET['items']) == "32") {
        $query = "SELECT * FROM Products WHERE itemType = 32";
    } else if (($_GET['items']) == "41") {
        $query = "SELECT * FROM Products WHERE itemType = 41";
    } else if (($_GET['items']) == "42") {
        $query = "SELECT * FROM Products WHERE itemType = 42";
    } else if (($_GET['items']) == "43") {
        $query = "SELECT * FROM Products WHERE itemType = 43";
    } else if (($_GET['items']) == "51") {
        $query = "SELECT * FROM Products WHERE itemType = 51";
    } else if (($_GET['items']) == "52") {
        $query = "SELECT * FROM Products WHERE itemType = 52";
    } else if (($_GET['items']) == "53") {
        $query = "SELECT * FROM Products WHERE itemType = 53";
    } else if (($_GET['items']) == 'all') {
        $query = "SELECT * FROM Products";
    } else if (($_GET['items']) == 'coats') {
        $query = "SELECT * FROM Products WHERE itemType >=11 AND itemType <=13 ";
    } else if (($_GET['items']) == 'shirts') {
        $query = "SELECT * FROM Products WHERE itemType >=21 AND itemType <=23 ";
    } else if (($_GET['items']) == 'ties') {
        $query = "SELECT * FROM Products WHERE itemType >=31 AND itemType <=32 ";
    } else if (($_GET['items']) == 'pants') {
        $query = "SELECT * FROM Products WHERE itemType >=41 AND itemType <=43 ";
    } else if (($_GET['items']) == 'shoes') {
        $query = "SELECT * FROM Products WHERE itemType >=51 AND itemType <=53 ";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="row">
                <?php
                $db = new DatabaseDAO();
                $connection = $db->getConnection();
                $result = mysqli_query($connection, $query);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($items = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-2 col-md-4 col-sm-3">
                    <div class="card h-100 w-95 border-light text-center">
                        <a href="viewItem.php?id=<?php echo $items['ID'] ?>"><img class="card-img-top"
                                src="img/products/<?php echo $items['itemPicture'] ?>"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a style="color:black; font-weight: bolder;"><?php echo $items['itemName'] ?></a>
                            </h4>
                            <h5><?php echo "$".number_format($items['itemPrice'], 2, '.', '')?></h5>
                            <i class="card-text"><small class="text-muted"><?php echo $items['itemQuant'] ?> in
                                    stock
                                </small></i>
                            <form class="mb-2" method="post" action="viewItem.php?id=<?php echo $items['ID'] ?>">
                                <input class="btn btn-outline-primary btn-block" type="submit" value="Quick View">
                            </form>
                            <form method="post" action="php-action/addToCart.php?id=<?php echo $items['ID'] ?>">
                                <input class="btn btn-outline-warning btn-block" type="submit" value="Add to Cart"
                                    name="Cart_ADD">
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                } else {
                    //no items can be found
                    echo "<h2>No items can be found. Please try your search result again</h2>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php require "footer.html"; ?>

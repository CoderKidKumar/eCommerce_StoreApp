<?php require "header.php";
require_once "autoloader.php";
if (isset($_GET['id'])) {
    $item = $_GET['id'];
    $query = "SELECT * FROM Products WHERE id = $item";
    $db = new DatabaseDAO();
    $connection = $db->getConnection();
    $result = mysqli_query($connection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $items = mysqli_fetch_assoc($result);
        }
    }
}
?>
<div class="col-sm-12 col-md-12 col-lg-12">
    <h5 style="color:royalblue"><a onclick="goBack()">
            < Back To Previous Page</a>
    </h5>
    <script>
    function goBack() {
        window.history.back();
    }
    </script>
    <!-- product -->
    <div class="product-content">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="product-image">
                    <div class="card">
                        <img class="card-img-top" src="img/products/<?php echo $items['itemPicture'] ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                <small class="text-muted">Item ID: <?php echo $items['ID'] ?></small>
                <h2 class="name"><?php echo $items['itemName'] ?></h2>
                <h6>Sold By Apostolic Men Wear-House</h6>
                <hr />
                <h3 class="price">
                    <b>Current Price:</b><?php echo "$".number_format($items['itemPrice'], 2, '.', '') ?>
                </h3>
                <i><small class="text-muted"><?php echo $items['itemQuant'] ?> in stock</small></i>
                <hr />
                <div class="description">
                    <?php echo $items['ItemDiscription'] ?>
                </div>
                <hr />
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <form method="post" action="php-action/addToCart.php?id=<?php echo $items['ID'] ?>">
                            <div class="form-group">
                                <input type="number" name="quant" min="1" max="100" value="1" step="1">
                                <input class="btn btn-outline-info btn-block mt-2" type="submit"
                                    value="Add to Cart"
                                    name="Cart_ADD_NUM">
                        </form>
                        <br>
                        <br>
                        <h5>Got Questions?</h5>
                        <button class="btn btn-white btn-default"><i class="fa fa-envelope"></i> Contact
                            Seller</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end product -->
</div>
<?php require "footer.html"; ?>

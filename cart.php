<?php 
require "header.php";
$cart = unserialize($_SESSION["shoppingCart"]);
?>
<div class="container mt-2 mb-4 d-flex justify-content-between align-items-center">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <table class="table table-responsive-md">
                    <tbody>
                        <?php
                        require_once "data/DatabaseDAO.php";
                        $db = new DatabaseDAO();
                        $connection = $db->getConnection();
                            foreach ($cart->getItems() as $product_id => $qty){
                                $query = "SELECT * FROM Products WHERE id = $product_id";
                                $result = mysqli_query($connection, $query);
                                $getItem = mysqli_fetch_assoc($result); ?>
                        <tr>
                            <td><a href="viewItem.php?id=<?php echo $getItem['ID'] ?>"><img
                                        src="img/products/<?php echo $getItem['itemPicture'] ?>"
                                        style="width: 100px; height: 100px; object-fit: contain;"></a></td>
                            <td><?php echo $getItem['itemName']."<br> <b> Each:($".number_format($getItem['itemPrice'], 2, '.', '').")</b>"; ?>
                            </td>
                            <td>
                                <form action="php-action/addToCart.php" method="post">
                                    <input type="number" name="changeQty" min="1" max="50" value="<?php echo $qty;?>"
                                        step="1">
                                    <input type="hidden" name="id" value="<?php echo $getItem['ID'] ?>">
                                    <button type="submit" class="btn btn-light ml-4" name="update">Update</button>
                                </form>
                            </td>
                            <td>
                                <form action="php-action/addToCart.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $getItem['ID'] ?>">
                                    <button type="submit" name="removeProduct" class="btn btn-danger ml-2"><i
                                            class="fas fa-times"></i>
                                        Remove</button>
                                </form>
                            </td>
                            <td>
                                <h6><?php echo "$".money_format('%.2n', $qty * $getItem['itemPrice']);?></h6>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Your Payment</h5>

                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                            Subtotal
                            <span><?php echo "$".money_format('%.2n', $cart->getTotal_price());?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Tax
                            <span><?php echo "$".money_format('%.2n', $cart->getTaxes());?></span>
                        </li>
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                            <div>
                                <strong>Total</strong>
                                <strong>
                                    <p class="mb-0">(with tax)</p>
                                </strong>
                            </div>
                            <span><strong><?php echo "$".money_format('%.2n', $cart->getTotal_price_Tax());?></strong></span>
                        </li>
                    </ul>
                    <a href="checkout.php" class="btn btn-info btn-block" role="button">Checkout</a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">

                    <a class="text-secondary justify-content-between" data-toggle="collapse" href="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Discount Code (Optional)
                        <span><i class="fas fa-chevron-down pt-1"></i></span>
                    </a>

                    <div class="collapse" id="collapseExample">
                        <div class="mt-3">
                            <div class="md-form md-outline mb-0">
                                <input type="text" id="discount-code" class="form-control font-weight-light"
                                    placeholder="Enter discount code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mt-3">
            <div class="card border-light mb-4 d-flex justify-content-between">
                <div class="card-body">

                    <h5 class="mb-4">We accept</h5>

                    <img class="mr-3" width="65px" src="img/pay/visa.png" alt="Visa">
                    <img class="mr-3" width="65px" src="img/pay/discover.png" alt="Discover">
                    <img class="mr-3" width="65px" src="img/pay/express.png" alt="American Express">
                    <img class="mr-3" width="65px" src="img/pay/master.png" alt="Mastercard">
                    <img class="mr-3" width="65px" src="img/pay/paypal.png" alt="PayPal">
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require "footer.html"; 
?>

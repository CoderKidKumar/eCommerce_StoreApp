<?php require "Header.php";?>

<section role="main" class="container-fluid">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card text-center mb-5">
                <div class="card-header">
                    <h1>Item Overview</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3><?php echo $dataCounter->ItemCount(); ?></h3>
                                    <h4>TOTAL</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3><?php echo $dataCounter->ListedCount(); ?></h3>
                                    <h4>LISTED</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3><?php echo $dataCounter->UnlistedCount(); ?></h3>
                                    <h4>NOT LISTED</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Main content-->
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header" style="background-color:#00354E; color: white">
                    <h3>All Products</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive-md">
                        <table id="Product" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name (Color)</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $join = "SELECT Products.ID, Products.itemPicture, Products.itemName, Products.itemPrice, Products.itemQuant, 
                                    ItemCategory.CategoryName 
                                    FROM Products
                                    INNER JOIN ItemCategory 
                                    ON Products.itemType = ItemCategory.CategoryID";
                                    $result = mysqli_query($connection, $join);
                                    if ($result) {
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($items = mysqli_fetch_assoc($result)) {
                                    ?>
                                <tr>
                                    <th><?php echo $items['ID'] ?></th>
                                    <td><img src="../../img/products/<?php echo $items['itemPicture'] ?>"
                                            style="height: 80px; width:auto; object-fit: cover;"></td>
                                    <td><?php echo $items['itemName'] ?></td>
                                    <td><?php echo money_format('%.2n',$items['itemPrice']) ?></td>
                                    <td><?php echo $items['itemQuant'] ?></td>
                                    <th><?php echo $items['CategoryName'] ?></th>
                                    <td>
                                        <a href="../../php-action/editProduct.php?id=<?php echo $items['ID'] ?>"
                                            style="color:deepskyblue" target="popup"
                                            onclick="window.open('../../php-action/editProduct.php?id=<?php echo $items['ID'] ?>','popup','width=600,height=1000'); return false;">
                                            EDIT</a>
                                    </td>
                                    <td>
                                        <a href=" ../../php-action/deleteProduct.php?id=<?php echo $items['ID'] ?>"
                                            style="color:red"> DELETE</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    $('#Product').DataTable({
        responsive: true,
    });
});
</script>
<?php require "footer.html"?>

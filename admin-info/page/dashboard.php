<?php require "Header.php";
?>

<section role="main" class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <!--Main info content-->
            <div class="col-md-12">
                <div class="card text-center mb-5">
                    <div class="card-header">
                        <h1>Summary Overview</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3><i class="fas fa-users" style="color:#5CA7D3"></i>
                                            <?php echo $dataCounter->UserCount(); ?>
                                        </h3>
                                        <h4>USERS</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3><i class="fas fa-warehouse" style="color:#5CA7D3"></i>
                                            <?php echo $dataCounter->ItemCount(); ?></h3>
                                        <h4>PRODUCTS</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h3><i class="fas fa-dollar-sign" style="color:#5CA7D3"></i>5K</h3>
                                        <h4>IN SALES</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Sub info content-->
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h3> Current Users as Admin</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            //$query = "SELECT * FROM Users ORDER BY id DESC LIMIT 12";
                            $query = "SELECT * FROM Users WHERE Role = 1";
                            $result = mysqli_query($connection, $query);
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($admin = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-lg-4 col-md-4">
                                <div class="card h-100 border-light text-center">
                                    <i class="card-text"><small class="text-muted">ID
                                            #<?php echo $admin['id'] ?></small></i>
                                    <h5 class="card-title">
                                        <a style="color:black; font-weight: bold;"><?php echo $admin['name'] ?></a>
                                    </h5>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card text-center mt-5">
                    <div class="card-header">
                        <h3> Lastest New Users</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $query = "SELECT * FROM Users ORDER BY id DESC LIMIT 6";
                            $result = mysqli_query($connection, $query);
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($user = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-lg-4 col-md-4">
                                <div class="card h-100 border-light text-center">
                                    <i class="card-text"><small class="text-muted">ID
                                            #<?php echo $user['id'] ?></small></i>
                                    <h5 class="card-title">
                                        <a style="color:black; font-weight: bold;"><?php echo $user['name'] ?></a>
                                    </h5>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card text-center mt-5">
                    <div class="lowItems card-header">
                        <h3> Items Need to Reorder</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $query = "SELECT * FROM Products WHERE itemQuant < 15";
                            $result = mysqli_query($connection, $query);
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($items = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-lg-4 col-md-4">
                                <div class="card h-100 border-light text-center">
                                    <i class="card-text"><small class="text-muted">ID
                                            #<?php echo $items['ID'] ?></small></i>
                                    <a href=""><img class="card-img-top"
                                            src="../../img/products/<?php echo $items['itemPicture'] ?>"
                                            style="height: 150px; width:auto; object-fit: cover;"></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a
                                                style="color:black; font-weight: bolder;"><?php echo $items['itemName'] ?></a>
                                        </h4>
                                        <i class="card-text"><?php echo $items['itemQuant'] ?> in stock</i>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                }else{ ?>
                            <div class="col-lg-12 col-md-12">
                                <div class="card h-100 border-light text-center">
                                    <h5 class="card-title">
                                        <a style="color:black; font-weight: bold;">No Items Are Low</a>
                                    </h5>
                                </div>
                            </div>
                            <?php }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        <h3>Most Recent Posted Products</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $query = "SELECT * FROM Products ORDER BY id DESC LIMIT 6";
                            $result = mysqli_query($connection, $query);
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($items = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="col-lg-4 col-md-4">
                                <div class="card h-100 w-95 border-light text-center">
                                    <a href=""><img class="card-img-top"
                                            src="../../img/products/<?php echo $items['itemPicture'] ?>"
                                            style="height: 150px; width:auto; object-fit: cover;"></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a
                                                style="color:black; font-weight: bolder;"><?php echo $items['itemName'] ?></a>
                                        </h4>
                                        <h5>Set At $<?php echo "$".number_format($items['itemPrice'], 2, '.', '') ?></h5>
                                        <i class="card-text"><small class="text-muted"><?php echo $items['itemQuant'] ?>
                                                in stock
                                            </small></i>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require "footer.html"?>

</html>

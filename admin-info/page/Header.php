<?php
session_start();

require_once "../../autoloader.php";
$db = new DatabaseDAO();
$connection = $db->getConnection();
$dataCounter = new dataCount();

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin QuickInfo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../quickinfo.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background-color: #102132">
            <a class="navbar-brand" href="dashboard.php">Admin QuickInfo&#8482</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php"><i class="fas fa-users"></i> Users <span
                                class="badge badge-dark"><?php echo $dataCounter->UserCount(); ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php"><i class="fas fa-warehouse"></i> Products <span
                                class="badge badge-dark"><?php echo $dataCounter->ItemCount(); ?></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sales.php"><i class="fas fa-dollar-sign"></i> Sales</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item active">
                        <a class="nav-link"> Welcome,
                            <?php echo $_SESSION["sessionName"] ?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../../php-action/logout-act.php"><i class="fas fa-sign-out-alt"></i>
                            Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
    if (isset($_GET['error'])) {
        $freshUsername = $_GET['uname'];
        $freshName = $_GET['name'];

        if (($_GET['error']) == "empty") {
            echo '
                <div class="alert alert-danger" role="alert">
                Textfields are empty!
                <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>';
        } else if (($_GET['error']) == "xname") {
            echo '
                <div class="alert alert-danger" role="alert">
                Username does not contain a-z, A-Z, 0-9
                <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>';
        } else if (($_GET['error']) == "pass") {
            echo '
                <div class="alert alert-danger" role="alert">
                Passwords do not match! Please try again.
                <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>';
        } else if (($_GET['error']) == "sqlerror") {
            echo '
                <div class="alert alert-warning" role="alert">
                Database cannot handle inputs at this moment! Try again in a few seconds.
                <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>';
        } else if (($_GET['error']) == "length") {
            echo '
                <div class="alert alert-warning" role="alert">
                The password must be 8 characters long!
                <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>';
        } else if (($_GET['error']) == "taken") {
            echo '
                <div class="alert alert-info" role="alert">
                Username is already taken. Please use another username.
                <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>';
        }
    } else if (($_GET['signup']) == "sucess") {
        echo '
            <div class="alert alert-success" role="alert">
            New user sucessfully created!
            <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>';
    }else if (($_GET['product']) == "sucess") {
        echo '
            <div class="alert alert-success" role="alert">
            A new product was sucessfully created and ready to sell!
            <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>';
    }else if (($_GET['deleteProduct']) == "sucess") {
        echo '
            <div class="alert alert-success" role="alert">
            A product was sucessfully deleted...
            <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>';
    }else if (($_GET['deleteUser']) == "sucess") {
        echo '
            <div class="alert alert-success" role="alert">
            A user was sucessfully deleted...
            <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>';
    }
    ?>
        <header id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h1><i class="fas fa-clipboard-list" style="font-size:65px;"></i> QuickInfo&#8482<h3>
                                <small>for</small>
                                Apostolic Men Wear-House.com
                            </h3>
                        </h1>
                    </div>
                    <div class="col-md-3 text-right">
                        <button type="button" class="btn btn-secondary mt-5" data-toggle="modal" data-target="#addUser">
                            Add User
                        </button>
                        <button type="button" class="btn btn-secondary mt-5" data-toggle="modal"
                            data-target="#addProduct">
                            Add Item
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <!-- Modals -->

        <!-- ADD USER -->
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <form action="../../php-action/addUser-act.php" method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Full Name"
                                    <?php echo 'value ="' . $freshName . '"' ?> required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="username" placeholder="Username"
                                    <?php echo 'value ="' . $freshUsername . '"' ?> required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="re-pass"
                                    placeholder="Re-Type Password" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">User Role</label>
                                <select class="form-control" name="selectedRole">
                                    <option value="0">Customer</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="signup" value="Add User">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ADD PRODUCT -->
        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <form action="../../php-action/addProduct-act.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input class="form-control" type="number" name="price" placeholder="Price" min="1"
                                        max="999" step="0.05" onkeydown="return false" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="discription" rows="4" placeholder="Discription"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Item Picture</label>
                                <input type="file" class="form-control-file" name="picture_file"
                                    accept="image/png, image/jpg, image/jpeg" required>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">#</div>
                                    </div>
                                    <input class="form-control" type="number" name="qty" placeholder="QTY" min="1"
                                        max="9999" step="1" onkeydown="return false" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Item Category</label>
                                <select class="form-control" name="selectedType">
                                    <option value="0">-- Not Listed/ Draft (Not Ready To Sell)--</option>
                                    <option value="11">Sport Coats</option>
                                    <option value="12">Blazers</option>
                                    <option value="13">Casual Coats</option>
                                    <option value="21">Dress Shirts</option>
                                    <option value="22">Casual Shirts</option>
                                    <option value="23">Polo Shirts</option>
                                    <option value="31">Neckties</option>
                                    <option value="32">Bowties</option>
                                    <option value="41">Dress Pants</option>
                                    <option value="42">Casual Pants</option>
                                    <option value="43">Jeans</option>
                                    <option value="51">Dress Shoes</option>
                                    <option value="52">Casual Shoes</option>
                                    <option value="53">Sneakers</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="add" value="Add Product">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

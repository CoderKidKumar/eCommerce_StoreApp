<?php
require_once "../autoloader.php";
$db = new DatabaseDAO();
$connection = $db->getConnection();

$id = $_GET['id'];
if (isset($_POST['close'])){
    echo "<script>window.opener.location.reload(); window.close();</script>";
}
if (isset($_POST['save_basic'])){
    require "../data/conn-db.php";
    $itemName = $_POST['pro_name'];
    $itemDiscrip = $_POST['pro_disc'];
    $itemPicture = $_FILES['pro_file'];
    if ($_FILES['pro_file']['size'] > 0 && $_FILES['pro_file']['error'] == 0){
        //get file name and then find location
        $select ="SELECT itemPicture FROM Products WHERE id = ?";
        $SLstmt = mysqli_stmt_init($connection);
        mysqli_stmt_prepare($SLstmt, $select);
        mysqli_stmt_bind_param($SLstmt, "i", $id);
        mysqli_stmt_execute($SLstmt);
        $result = mysqli_stmt_get_result($SLstmt);
        $row = mysqli_fetch_assoc($result);
        $oldfilename = "../img/products/".$row["itemPicture"];
        unlink($oldfilename); //delete the file picture

        //set up the new file for uploading into the databse and img file
        //get the parts of the file
        $fileName = $_FILES['pro_file']['name'];
        $fileType = $_FILES['pro_file']['type'];
        $fileTmpName = $_FILES['pro_file']['tmp_name'];
        $fileError = $_FILES['pro_file']['error'];
        $fileSize = $_FILES['pro_file']['size'];
        
        //get the file extension
        $fileExt = explode('.',$fileName);
        $fileRootName = current($fileExt);
        $fileActualExt = strtolower(end($fileExt));

        //set the allowed file types
        $allowed = array('png','jpg','jpeg');

        //check if the file ext is allowed
        if(in_array($fileActualExt,$allowed)){
            //check that the file has no errors
            if ($fileError === 0){
                //check that the file is the right size
                if($fileSize < 100000){
                    //create new name for the file
                $newFileName =  $fileRootName."-".uniqid('',false).".". $fileActualExt;

                //choose the file destination
                $fileDestination = "../img/products/". $newFileName;

                //move the picture file into webstorage
                move_uploaded_file($fileTmpName,$fileDestination);
                //Update data into database
                $sql = "UPDATE Products SET itemname = ?, ItemDiscription = ?, itemPicture = ? WHERE ID = ?";
                $stmt = mysqli_stmt_init($connection);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "There was a SQL error!";
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssi", $itemName, $itemDiscrip, $newFileName, $id);
                        mysqli_stmt_execute($stmt);
                        echo "<script>window.opener.location.reload(); location.reload();</script>";
                    }
                }else{
                    echo "The file is too big!";
                }
            }else{
                echo "The file was not uploaded correctly!";
            }
        } else {
            echo "The file type is not accepted!";
        }
    }else if ($_FILES['picture_file']['size'] == 0 && $_FILES['picture_file']['error'] == 0){
        //Update data into database
        $sql = "UPDATE Products SET itemname = ?, ItemDiscription = ? WHERE ID = ?";
        $stmt = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "There was a SQL error!";
            } else {
                mysqli_stmt_bind_param($stmt, "ssi", $itemName, $itemDiscrip, $id);
                mysqli_stmt_execute($stmt);
                echo "<script>window.opener.location.reload(); location.reload();</script>";
            }
    }
}
if (isset($_POST['save_sales'])){
    $itemPrice = $_POST['pro_price'];
    $itemQTY = $_POST['pro_qty'];
    $itemType = $_POST['pro_type'];

    //Update data into database
    $sql = "UPDATE Products SET itemPrice = ?, itemQuant = ?, itemType = ? WHERE ID = ?";
    $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "There was a SQL error!";
        } else {
            mysqli_stmt_bind_param($stmt, "diii", $itemPrice, $itemQTY, $itemType, $id);
            mysqli_stmt_execute($stmt);
            echo "<script>window.opener.location.reload(); location.reload();</script>";
        }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title> Admin QuickInfo | Edit Product #<?php echo $id;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
    </head>

    <body style="background-color:black;">
        <div class=" container mt-2">
            <?php
            if (isset($_GET['id'])){
            $query = "SELECT Products.ID, Products.itemPicture, Products.itemName, Products.ItemDiscription, Products.itemPrice, Products.itemQuant, 
            ItemCategory.CategoryName 
            FROM Products
            INNER JOIN ItemCategory 
            ON Products.itemType = ItemCategory.CategoryID WHERE Products.ID = $id";
            $result = mysqli_query($connection, $query);

             if ($result) {
                if (mysqli_num_rows($result) == 1) {
                $items = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-center">
                <div class="card-header text-white" style="background-color:#004e72">
                    <h2>Edit Product Information</h2>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $items['itemName'];?> </h4>
                    <h6 class="card-subtitle mb-3 text-muted">ID # <?php echo $items['ID']?></h6>
                    <form action="" method="post">
                        <button type="submit" name="close" class="btn btn-danger btn-sm btn-block"><i
                                class="fas fa-window-close"></i>
                            Close </button>
                    </form>
                    <hr style="border: 1px solid black;">
                    <div class="card text-center mb-3">
                        <div class="card-header bg-dark text-white">
                            <h4>Basic Information</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="input-group text-center">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Title/Name</span>
                                        </div>
                                        <input class="form-control" type="text" name="pro_name"
                                            value="<?php echo $items['itemName'];?>">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Discription</span>
                                        </div>
                                        <textarea class="form-control" name="pro_disc" rows="3"><?php echo $items['ItemDiscription'] ?>
                                    </textarea>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col"></div>
                                            <div class="col-7 input-group mb-3">
                                                <h5 class="text-center">Item Picture<br><small>(Currently:
                                                        <?php echo $items['itemPicture'] ?>)</small></h5>
                                                <input type="file" class="form-control-file" name="pro_file"
                                                    accept="image/png, image/jpg, image/jpeg">

                                            </div>
                                            <div class="col"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="save_basic" class="btn btn-info btn-sm btn-block"><i
                                        class="far fa-save"></i>
                                    Save Basic Information to Database </button>
                            </form>
                        </div>
                    </div>
                    <div class="card text-center">
                        <div class="card-header bg-success text-white">
                            <h4>Sales Information</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Price: $</div>
                                    </div>
                                    <input class="form-control" type="number" name="pro_price"
                                        value="<?php echo $items['itemPrice'] ?>" min="1" max="999" step="0.05"
                                        onkeydown="return false">

                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">QTY: #</div>
                                    </div>
                                    <input class="form-control" type="number" name="pro_qty"
                                        value="<?php echo $items['itemQuant'] ?>" min="1" max="9999" step="1"
                                        onkeydown="return false">

                                </div>
                                <h6>Item Category - Currently (<?php echo $items['CategoryName'] ?>) *</h6>
                                <select class="form-control form-control-sm" name="pro_type">
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
                                <p><small>* Must re-select from dropdown to save properly or will save as "not
                                        listed"</small>
                                </p>
                                <button type="submit" name="save_sales" class="btn btn-info btn-sm btn-block"><i
                                        class="far fa-save"></i>
                                    Save Sales Information to Database </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
        }
        ?>
            </div>
    </body>

</html>

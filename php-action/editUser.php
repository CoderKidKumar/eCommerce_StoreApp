<?php
require_once "../autoloader.php";
$db = new DatabaseDAO();
$connection = $db->getConnection();

$id = $_GET['id'];
if (isset($_POST['submit'])){
    $customerInt = $_POST['selectedRole'];
    $update = "UPDATE Users SET Role = $customerInt WHERE id = ?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $update);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    echo "<script>window.opener.location.reload(); window.close();</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title> Admin QuickInfo | Edit User #<?php echo $id;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    </head>

    <body style="background-color:black;">
        <div class=" container mt-3">
            <?php
            if (isset($_GET['id'])){

            $query = "SELECT * FROM Users WHERE id = $id";
            $result = mysqli_query($connection, $query);

             if ($result) {
                if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
            ?>
            <div class="card text-center">
                <div class="card-header text-white" style="background-color:#004e72">
                    <h2>Edit User Information</h2>
                </div>
                <div class="card-body">
                    <h4 class="card-title"> Editing User: <?php echo $user["name"]?> </h4>
                    <h6 class="card-subtitle mb-3 text-muted">ID # <?php echo $user["id"]?></h6>
                    <hr style="border: 1px solid black;">
                    <form action="" method="post" style="text-align: center;">
                        <h5>Username</h5>
                        <h3><input type="text" value="<?php echo $user['username']; ?>" readonly
                                class="form-control-plaintext" style="text-align: center;"></h3>
                        <div class="form-group">
                            <h5>User Role</h5>
                            <select class="form-control form-control-sm" name="selectedRole">
                                <option value="0">Customer</option>
                                <option value="1">Admin</option>
                                <option value="66">Locked</option>
                            </select>
                        </div>
                        <input type="submit" name="submit" value="Update">
                    </form>
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

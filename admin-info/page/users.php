<?php require "Header.php";?>

<section role="main" class="container-fluid">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card text-center mb-5">
                <div class="card-header">
                    <h1>User Overview</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3><i class="fas fa-users" style="color:#5CA7D3"></i>
                                        <?php echo $dataCounter->UserCount(); ?>
                                    </h3>
                                    <h4>TOTAL</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3><i class="fas fa-user" style="color:#5CA7D3"></i>
                                        <?php echo $dataCounter->CustomerCount(); ?></h3>
                                    <h4>CUSTOMERS</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3><i class="fas fa-user-tie" style="color:#5CA7D3">
                                        </i> <?php echo $dataCounter->AdminCount(); ?></h3>
                                    <h4>ADMIN</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3>
                                        <i class="fas fa-user-lock" style="color:#5CA7D3">
                                        </i> <?php echo $dataCounter->LockedCount(); ?>
                                    </h3>
                                    <h4>LOCKED</h4>
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
                    <h3>All Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive-md">
                        <table id="Users" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $join = "SELECT Users.id, Users.name, Users.username, Users.Role, userRoles.Roles
                                    FROM Users
                                    INNER JOIN userRoles 
                                    ON Users.Role = userRoles.ID";
                                    $result = mysqli_query($connection, $join);
                                    if ($result) {
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($user = mysqli_fetch_assoc($result)) {
                                    ?>
                                <tr>
                                    <th><?php echo $user['id'] ?></th>
                                    <td><?php echo $user['name'] ?></td>
                                    <td><?php echo $user['username'] ?></td>
                                    <th><?php echo $user['Roles'] ?></th>
                                    <td>
                                        <a href="../../php-action/editUser.php?id=<?php echo $user['id'] ?>"
                                            style="color:deepskyblue" target="popup"
                                            onclick="window.open('../../php-action/editUser.php?id=<?php echo $user['id'] ?>','popup','width=500,height=475'); return false;">
                                            EDIT</a>
                                    </td>
                                    <td>
                                        <a href="../../php-action/deleteUser.php?id=<?php echo $user['id'] ?>"
                                            style="color:red">
                                            DELETE</a>
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
    $('#Users').DataTable({
        responsive: true
    });
});
</script>
<?php require "footer.html"?>

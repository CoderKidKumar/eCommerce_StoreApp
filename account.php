<?php require "header.php"; ?>
<div class="row profile">
    <div class="col-md-2">
        <div class="profile-sidebar">
            <!-- Profile Name / Logout -->
            <div class="profile-usertitle">
                <?php
                echo '<div class="profile-usertitle-name">'
                    . $_SESSION["sessionName"] . '</div>';
                ?>
            </div>
            <div class="profile-userbuttons">
                <form class="logout" action="php-action/logout-act.php" method="post">
                    <input type="submit" value="Log Out">
                </form>
            </div>
            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
                <ul class="nav">
                    <?php
                    if (isset($_GET['account']) && ($_GET['p']) == "set") {
                        echo '
                        <li>
                            <a href="account.php?account=' . $_SESSION["sessionID"] . '">
                                <i class="fas fa-shipping-fast"></i>
                                Recent Orders </a>
                        </li>
                        <li class="active">
                            <a href="account.php?account=' . $_SESSION["sessionID"] . '&p=set">
                                <i class="fas fa-user"></i>
                                Account Settings </a>
                        </li>
                        <li>
                            <a href="account.php?account=' . $_SESSION["sessionID"] . '&p=faq">
                                <i class="far fa-question-circle"></i>
                                FAQ/Help </a>
                        </li>
                                ';
                    } else if (isset($_GET['account']) && ($_GET['p']) == "faq") {
                        echo '
                            <li>
                                <a href="account.php?account=' . $_SESSION["sessionID"] . '">
                                    <i class="fas fa-shipping-fast"></i>
                                    Recent Orders </a>
                            </li>
                            <li>
                                <a href="account.php?account=' . $_SESSION["sessionID"] . '&p=set">
                                    <i class="fas fa-user"></i>
                                    Account Settings </a>
                            </li>
                            <li class="active">
                                <a href="account.php?account=' . $_SESSION["sessionID"] . '&p=faq">
                                    <i class="far fa-question-circle"></i>
                                    FAQ/Help </a>
                            </li>
                                    ';
                    } else {
                        echo '
                    <li class="active">
                        <a href="account.php?account=' . $_SESSION["sessionID"] . '">
                            <i class="fas fa-shipping-fast"></i>
                            Recent Orders </a>
                    </li>
                    <li>
                        <a href="account.php?account=' . $_SESSION["sessionID"] . '&p=set">
                            <i class="fas fa-user"></i>
                            Account Settings </a>
                    </li>
                    <li>
                        <a href="account.php?account=' . $_SESSION["sessionID"] . '&p=faq">
                            <i class="far fa-question-circle"></i>
                            FAQ/Help </a>
                    </li>
                            ';
                    }
                    ?>

                </ul>
            </div>
            <!-- END MENU -->
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-9">
        <div class="profile-content">
            <?php
                    if (isset($_GET['account']) && ($_GET['p']) == "set") {
                        echo '<h1> Account Settings </h1>';
                    } else if (isset($_GET['account']) && ($_GET['p']) == "faq") {
                        echo '<h1> FAQ / Help </h1>';;
                    } else {
                        echo '<h1> Your Recent Orders </h1>';
                    }
                    ?>
        </div>
    </div>
</div>

<?php require "footer.html"; ?>

<?php 
    session_start();
    include("func.php");
    if(!isset($_SESSION['user']['type']) || !isset($_SESSION['user']['wc'])){ //non-login people got here
        header("Location: home.php");
    }
    else{ //caught at the end of the doc
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/index.js" async></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <title>My account</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand me-auto" href="home.php">
                        <img class="brand-logo" src="https://logopond.com/logos/8eaaac3a2fe79ea70f852b5c332c7efb.png" alt="brand-logo" height="50px">
                    </a>
                    <button class="navbar-toggler ms-auto" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="collapseNavbar">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="viewcart()">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">About Us</a>
                            </li>
                            <li class="nav-item">
                                <?php
                                    echo "<a class=\"nav-link\" href=\"" . $_SESSION['user']['type'] . "_account.php\">Account</a>";
                                ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Log out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <div class="account-info-wrapper">
                    <div class="profile-pic-section">
                        <h2>User profile</h2>
                        <div class="img-preview">
                            <img class="img-file" <?= "src=\"" . $_SESSION['user']['pfp'] . "\""; ?>>
                        </div>
                        <div class="profile-options">
                            <div class="upload-options">
                                <form action="change_pfp.php" method="POST" enctype="multipart/form-data">
                                    <input class="form-control pic-upload" type="file" id="formFile" name="newpfp"></input>
                                    <button class="btn btn-primary btn-form" type="submit" name="changepfp">Change profile picture</button>
                                </form>
                            </div>
                            <?php
                                if(isset($_SESSION['pfperror'])){
                                    echo '<div class="alert alert-warning" role="alert">Error choosing your new profile picture.</div>';
                                    unset($_SESSION['pfperror']);
                                }
                            ?>
                            <div class="account-details shipper">
                                <div>Username: <?= $_SESSION['user']['uname']; ?></div>
                                <div>Name: <?= $_SESSION['user']['fullname']; ?></div>
                                <div>Distribution hub: <?= $_SESSION['user']['wc']; ?></div>
                            </div>
                            <div class="divider"></div>
                            <a href="logout.php"><button class="btn btn-warning btn-lg">Logout</button></a>
                        </div>
                    </div>
                    <div class="account-details-section shipper">
                        <h2 class="title">Active orders</h2>
                        <div class="active-order-listing">
                            <div class="column-labels">
                                <label class="orders">Orders</label>
                                <label class="status">Order ID</label>
                                <label class="order-price">Price</label>
                                <label class="order-recipient">Address</label>
                            </div>
                            <div class="active-orders">
                                <?php
                                    $ord_fname = "../orders.csv";
                                    $fp = fopen($ord_fname, 'r');
                                    $first = fgetcsv($fp);
                                    //technically those would have the same amount of elements
                                    while ($row = fgetcsv($fp)) {
                                        $i = 0;
                                        $ord = []; //single row of order
                                        foreach ($first as $col_name) {
                                            $ord[$col_name] =  $row[$i];
                                            if($col_name == "products"){
                                                $ord[$col_name] = explode(',', $ord[$col_name]);
                                            }
                                            $i++;
                                        }
                                        //hub from session = hub in file -> match!
                                        if(($_SESSION['user']['wc'] == $ord['hub']) && ($ord['status'] == 'active')){ 
                                            //spit out items in $ord['products']
                                            $item_list = "";
                                            $ord_total = 0;
                                            foreach($ord['products'] as $pid){
                                                $item_list .= get_prod_deets($pid)['pname'] . ", ";
                                                $ord_total += get_prod_deets($pid)['price'];
                                            }
                                            $item_list = rtrim($item_list, ', '); //get rid of the last comma and space
                                            $oid = $ord['oid'];
                                            $pid_list = '[' . implode(',', $ord['products']) . ']';
                                            echo "<a class=\"order\" href=\"javascript:view_ship_order($oid,$pid_list)\">";
                                            echo "<div class=\"title\">$item_list</div>";
                                            echo "<div class=\"status\">" . $ord['oid'] . "</div>";
                                            echo "<div class=\"price\">$ord_total VND</div>";
                                            echo "<div class=\"recipient\">" . $ord['user_addr'] . "</div>";
                                            echo "</a>";
                                        }
                                        
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="footer-wrapper">
                <div class="footer-bg">
                    <div class="footer-content">
                        <div class="copyright">2022 - G29. All rights reserved.</div>
                        <div class="footer-links">
                            <ul>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="privacy.html">Privacy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Support</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contacts</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
<?php } ?>
<?php
    session_start();
    include("prod_func.php");
    if(!isset($_SESSION['user']['type']) && $_SESSION['user']['type'] != 'shipper'){
        header("Location: home.php");
    }
    if (count($_GET) <= 0 ) { 
        header("Location: home.php");
    }
    if (isset($_GET["ship_ord"])){
        $oid = $_GET['oid'];
        $pid_list = explode(',',$_GET["pids"]);
    }
    else{ //naked url -> tampering
        header("Location: home.php");
    }
    $total = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/index.js" async></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <title>Order Details</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand me-auto" href="index.html">
                        <img class="brand-logo" src="https://logopond.com/logos/8eaaac3a2fe79ea70f852b5c332c7efb.png" alt="Brand logo">
                    </a>
                    <button class="navbar-toggler ms-auto" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="collapseNavbar">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page 4</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <div class="bg-wrapper">
                    <div class="product-details order">
                        <div class="img-section">
                            <?php
                                if(isset($_SESSION['user']['pfp'])){
                                    echo "<img class=\"img-file\" src=\"" . $_SESSION['user']['pfp'] . "\" alt=\"Shipper profile picture\">";
                                }
                                if(isset($_SESSION['user']['wc'])){ //this should be set, but still
                                    echo "<div class=\"d-hub\">Distribution hub: " . $_SESSION['user']['wc'] . "</div>";
                                }
                            ?>
                        </div>
                        <div class="details-section">
                            <h1>Order details: Order <?= $oid; ?></h1>
                            <?php
                                foreach($pid_list as $pid){
                                    $prod = get_prod_deets($pid);
                                    if($prod){ ?>
                                        <div>
                                            <div class="divider"></div>
                                            <h2 class="product-title"><?= $prod['pname']; ?></h2>
                                            <h5 class="product-vendor">Vendor: <?= $prod['vendor']; ?></h5>
                                            <div class="product-price">Unit price: <?= $prod['price']; ?></div>
                                                <?php $total += $prod['price']; ?>
                                            <div class="product-description">
                                            <h6>Description: </h6>
                                            <p><?= $prod['description']; ?></p>
                                        </div>
                                    <?php }
                                }
                                    ?>
                            <div class="order-details">
                                <div class="info-section">
                                    <div class="product-line-price">Total: <?= $total; ?> VND</div>
                                </div>
                                <div class="info-section">
                                    <div class="order-recepient">Deliver to: <?= get_ord_deets($oid)['user_addr']; ?></div>
                                </div>
                            </div>
                            <form class="order-status-selection">
                                <div class="form-label">
                                    <label>Order status:</label>
                                </div>
                                <form class="form-field">
                                    <label>
                                        <input type="radio" id="order_active" name="order_status" value="active" checked>
                                        <i>Active</i>
                                    </label>
                                    <label>
                                        <input type="radio" id="order_delivered" name="order_status" value="delivered">
                                        <i>Delivered</i>
                                    </label>
                                    <label>
                                        <input type="radio" id="order_canceled" name="order_status" value="canceled">
                                        <i>Canceled</i>
                                    </label>
                                </form>
                                <div class="form-field">
                                    <button class="btn btn-lg btn-warning">Update order</button>
                                </div>
                            </form>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
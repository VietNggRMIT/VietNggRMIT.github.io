<?php 
    session_start(); 
    if (count($_GET) <= 0 ) { 
        header("Location: home.php");
    }
    if (isset($_GET["view_prod"])){
        $pid = $_GET["pid"];
        $pname = $_GET["pname"];
        $pvendor = $_GET["pvendor"];
        $price = $_GET["price"];
        $pimg = $_GET["pimg"];
        $pdesc = $_GET["pdesc"];
    }
    else{ //naked url -> tampering
        header("Location: home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/index.js" async></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <title>Home Page</title>
        <script type="text/javascript">
            function addtocart(){
                //this function accesses variable from this page only
                var ord_key = "<?= $pid ; ?>";
                var ord_val = "<?= $pname . "-" . $pvendor . "-" . $price; ?>";

                // const for adjusting alert msg
                const conf_msg = document.querySelector(".conf-msg");

                localStorage.setItem(ord_key,ord_val);
                conf_msg.classList.add("active");
                document.getElementById("add_conf").innerHTML = "Item added successfully.";
            }
        </script>
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
                                <a class="nav-link" href="#">Page 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Page 4</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">About Us</a>
                            </li>
                            <li class="nav-item">
                                <?php
                                    if(isset($_SESSION['user']['type'])){ //user has logged in
                                        echo "<a class=\"nav-link\" href=\"" . $_SESSION['user']['type'] . "_account.php\">Account</a>";
                                    }
                                    else{
                                        echo "<a class=\"nav-link\" href=\"login.php\">Login</a>";
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <div class="bg-wrapper">
                    <div class="product-details">
                        <div class="img-section">
                            <img class="img-file" src="<?= $pimg; ?>">
                        </div>
                        <div class="details-section">
                            <h1 class="product-title"><?= $pname; ?></h1>
                            <h5 class="product-vendor">Vendor: <?= $pvendor; ?></h5>
                            <div class="product description">
                                <h6>Product description: </h6>
                                <p><?= $pdesc; ?></p>
                            </div>
                            <div class="product-price">
                                <h2><?= $price; ?> VND</h2>
                            </div>
                            <div class="product-options">
                                <button class="btn btn-primary btn-warning btn-lg" onclick="addtocart()">Add to cart</button>
                                <button class="btn btn-primary btn-warning btn-lg" onclick="viewcart()">View cart</button>
                            </div>
                            <div class="alert-msg">
                                <div class="alert alert-success conf-msg" id="add_conf" role="alert"></div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
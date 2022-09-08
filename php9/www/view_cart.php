<?php
    session_start();
    include("func.php");
    $total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/index.js" async></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <title>Shopping Cart</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand me-auto" href="home.php">
                        <img class="brand-logo" src="https://logopond.com/logos/8eaaac3a2fe79ea70f852b5c332c7efb.png" alt="Brand logo">
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
                    <div class="shopping-cart">
                        <h1>Shopping cart</h1>
                        <div class="column-labels">
                            <div class="product-specs-labels">
                                <label class="product-img"></label>
                                <label class="product-description">Product</label>
                            </div>
                            <div class="cart-options-labels">
                                <label class="product-removal"></label>
                                <label class="product-line-price">Price</label>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="product-listing cart">
                        <?php
                            if (isset($_GET["view_cart"])){
                                $pid_list = explode(',',$_GET["pid"]);
                                //read csv file and return items with the same pids
                                $file_name = '../products.csv';
                                $fp = fopen($file_name, 'r');
                                $first = fgetcsv($fp);
                                while ($row = fgetcsv($fp)) {
                                    $i = 0;
                                    $product = [];
                                    foreach ($first as $col_name) {
                                        $product[$col_name] =  $row[$i];
                                        $i++;
                                    }
                                    if(in_array($product['pid'], $pid_list)){ //found product! doing stuff
                                        $total_price += $product['price'];
                                        $pimg = find_prod_pfp($product['pid']);
                                        ?>
                                        <div class="product">
                                            <div class="product-specs">
                                                <div class="product-image">
                                                    <img src="<?= $pimg; ?>" alt="Product image">
                                                </div>
                                                <div class="product-info">
                                                    <div class="product-title"><h6><?= $product['product_name']; ?></h6></div>
                                                    <div class="product-vendor">Vendor: <?= $product['vendor']; ?></div>
                                                    <p class="product-description"> <?= $product['description']; ?></p>
                                                </div>
                                            </div>
                                            <div class="cart-options">
                                                <div class="product-removal">
                                                    <button class="btn btn-danger" onclick="removeitem(<?= $product['pid']; ?>)">Remove</button>
                                                </div>
                                                <div class="product-line-price"><?= $product['price'];?> VND</div>
                                            </div>
                                        </div>
                                    <?php }
                                } 
                            } 
                        ?>
                            
                        <div class="divider"></div>
                        <div class="total-sum">
                            <div class="total-price">
                                <label for="cart-total"><b>Total</b></label>
                                <div class="total-value" id="cart-total"><?= $total_price; ?> VND</div>
                            </div>
                        </div>
                        <div class="place-order">
                            <?php //stop user from ordering if they haven't logged in
                                if(isset($_SESSION['user'])){
                                    echo "<button class=\"btn btn-warning btn-lg\" onclick=\"placeorder()\">Place order</button>";
                                }
                                else{
                                    echo "<button class=\"btn btn-warning btn-lg\" onclick=\"window.location.href = 'login.php';\">Place order</button>";
                                }
                            ?>
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
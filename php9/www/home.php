<?php 
    include("func.php");
    session_start(); 
    //putting this function on another page -> no items shown?
    function read_searchfilter() {
        $file_name = '../products.csv';
        $fp = fopen($file_name, 'r');
        $first = fgetcsv($fp);
        $products = [];
        while ($row = fgetcsv($fp)) {
            $i = 0;
            $product = [];
            foreach ($first as $col_name) {
                $product[$col_name] =  $row[$i];
                $i++;
            }
            if(isset($_POST['min_price']) && is_numeric($_POST['min_price'])){
                if($product['price'] < $_POST['min_price']){
                    continue;
                }
            }
            if(isset($_POST['max_price']) && is_numeric($_POST['max_price'])){
                if($product['price'] > $_POST['max_price']){
                    continue;
                }
            }
            if(isset($_POST['product_name']) && !empty($_POST['product_name'])){
                if(strpos($product['product_name'], $_POST['product_name']) === false){
                    continue;
                }
            }
            $products[] = $product;
        }
        // overwrite the session variable
        $_SESSION['products'] = $products;
    }
    read_searchfilter();
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
                            <?php
                                if(isset($_SESSION['user']['uname'])){ //only show this if user logged in
                                    echo "<li class=\"nav-item\">";
                                    echo "<a class=\"nav-link\" href=\"logout.php\">Log out</a>";
                                    echo "</li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <div class="bg-wrapper">
                    <div class="product-listing">
                        <p><?php
                            if (isset($_SESSION['ord_msg'])){
                                echo $_SESSION['ord_msg'];
                                unset($_SESSION['ord_msg']);
                            }
                        ?></p>
                        <div class="listing-title"><h1>New products</h1></div>
                        <div class="search-filter-section">
                            <!-- <form class="search-input">
                                <input class="form-control" type="search" placeholder="Search...">
                                <button class="btn btn-warning btn-lg">Search</button>
                            </form> -->
                            <form class="search-filter-form" method="post" action="home.php">
                                <!-- Search by name <input type="text" name="product_name"> -->
                                <div class="search-input">
                                    <input class="form-control" type="search" placeholder="Search..." name="product_name">
                                </div>
                                <div class="filter-input">
                                    <input class="form-control" type="number" oninput="validity.valid || (value='');" onkeypress="isNum(event)" id="min_price" name="min_price" min="0.00" step="1" placeholder="Min price">
                                    <input class="form-control" type="number" oninput="validity.valid || (value='');" onkeypress="isNum(event)" id="max_price" name="max_price" min="0.00" step="1" placeholder="Max price">
                                </div>
                                <div class="form-btn">
                                    <button class="btn btn-warning btn-lg" type="submit" name="act">Filter</button>
                                </div>
                            </form>
                        </div>
                        <div class="listing-grid">
                            <?php
                                if (isset($_SESSION['products'])){
                                    foreach($_SESSION['products'] as $p_details){
                                        $pid = $p_details['pid'];
                                        $pname = $p_details['product_name'];
                                        $pvendor = $p_details['vendor'];
                                        $price = $p_details['price'];
                                        $pdesc = $p_details['description'];
                                        $pimg = find_prod_pfp($pid);
                                ?>
                                        <div class="product card">
                                            <div class="img-section">
                                                <img src="<?= $pimg; ?>" class="card-img-top" alt="<?= $pname; ?>">
                                            </div>
                                            <div class=card-body>
                                                <p class="card-text"><?= $pname . ", by $pvendor"; ?></p>
                                                <p class="card-text price">Price: <?= $price; ?></p>
                                            </div>
                                            <form action="view_pdetails.php" method="GET" class="product card">
                                                <input type="hidden" name="pid" value="<?= $pid ?>">
                                                <input type="hidden" name="pname" value="<?= $pname ?>">
                                                <input type="hidden" name="pvendor" value="<?= $pvendor ?>">
                                                <input type="hidden" name="price" value="<?= $price ?>">
                                                <input type="hidden" name="pimg" value="<?= $pimg ?>">
                                                <input type="hidden" name="pdesc" value="<?= $pdesc ?>">
                                                <button class="btn btn-primary" type="submit" name="view_prod">View this product</button>
                                            </form>
                                        </div>
                                <?php } 
                                } ?>
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
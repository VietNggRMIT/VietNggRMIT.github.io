<?php 
    session_start(); 
    include("func.php");
    if(!isset($_SESSION['user']['type'])){ //non-login people got here
        header("Location: index.php");
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
                    <a class="navbar-brand me-auto" href="index.php">
                        <img class="brand-logo" src="https://logopond.com/logos/8eaaac3a2fe79ea70f852b5c332c7efb.png" alt="Brand logo">
                        <div class="web-title">G29-Lazada</div>
                    </a>
                    <button class="navbar-toggler ms-auto" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="collapseNavbar">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
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
                                <a class="nav-link" href="logout.php" onclick="clearcart()">Log out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container">
                <div class="account-info-wrapper vendor">
                    <div class="profile-pic-section">
                        <h2>User profile</h2>
                        <div class="img-preview">
                            <img class="img-file" <?= "src=\"" . $_SESSION['user']['pfp'] . "\""; ?> alt="profile picture">
                        </div>
                        <div class="profile-options">
                            <div class="upload-options">
                                <form action="change_pfp.php" method="POST" enctype="multipart/form-data">
                                    <input class="form-control pic-upload" type="file" id="formFile" name="newpfp">
                                    <button class="btn btn-primary btn-form" type="submit" name="changepfp">Change profile picture</button>
                                </form>
                            </div>
                            <?php
                                if(isset($_SESSION['pfperror'])){
                                    echo '<div class="alert alert-warning" role="alert">Error choosing your new profile picture.</div>';
                                    unset($_SESSION['pfperror']);
                                }
                            ?>
                            <div class="divider"></div>
                            <div class="account-options">
                                <a class="btn btn-warning btn-lg" href="vendor_addp.php">Add a product</a>
                                <a class="btn btn-warning btn-lg" href="logout.php" onclick="clearcart()">Log out</a>
                            </div>
                        </div>
                    </div>
                    <div class="account-details-section">
                        <h2>Vendor account information</h2>
                        <div class="account-details">
                            <div class="basic-info">
                                <div>Username: <?= $_SESSION['user']['uname']; ?></div>
                                <div>Business name: <?= $_SESSION['user']['fullname']; ?></div>
                                <div>Business address: <?= $_SESSION['user']['wc']; ?></div>
                            </div>
                            <div class="divider"></div>
                            <div class="title">My products:</div>
                            <div class="added-products">
                                <?php
                                    $v_fname = $_SESSION['user']['fullname']; //look for this in products.csv
                                    $file_name = '../db/products.csv';
                                    $fp = fopen($file_name, 'r');
                                    $first = fgetcsv($fp);
                                    while ($row = fgetcsv($fp)) {
                                        $i = 0;
                                        $product = [];
                                        foreach ($first as $col_name) {
                                            $product[$col_name] =  $row[$i];
                                            if ($col_name == 'size') {
                                                $product[$col_name] = explode(',', $product[$col_name]);
                                            }
                                            $i++;
                                        }
                                        if($product['vendor'] == $v_fname){
                                            $pimg = find_prod_pfp($product['pid']);
                                        ?>
                                            <a class="product-card" href="javascript:view_product(<?= $product['pid']; ?>)">
                                                <div class="product-info">
                                                    <div class="prod-thumbnail">
                                                        <img src="<?= $pimg; ?>" class="prod-img" alt="Product image">
                                                    </div>
                                                    <div class="prod-specs">
                                                        <div class="prod-id">PID: <?= $product['pid']; ?></div>
                                                        <div class="prod-title">Name: <?=$product['product_name']; ?> </div>
                                                        <div class="prod-price">Price: <?= $product['price']; ?></div>
                                                        <div class="prod-description">Description: <?= $product['description']; ?></div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php }
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
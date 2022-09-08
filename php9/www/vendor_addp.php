<?php 
    session_start();
    if(!isset($_SESSION['user']['type']) && $_SESSION['user']['type'] != 'vendor'){
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
        <title>Add New Product</title>
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
                                <a class="nav-link" href="vendor_account">Account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.html">About Us</a>
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
                <div class="bg-wrapper">
                    <div class="add-product">
                        <div class="form-title"><h1>Add new product</h1></div>
                        <?php
                            if(isset($_SESSION['addp_failed'])){
                                echo "Product registration failed. You may have added this product.";
                                unset($_SESSION['addp_failed']);
                            }
                        ?>
                        <form action="verify_product.php" method="POST" enctype="multipart/form-data">
                            <div class="form-flex">
                                <div class="upload-section">
                                    <div class="form-row upload">
                                        <div class="img-preview">
                                            <p class="caption">Default product image</p>
                                            <img class="img-file" src="res/prod/default_prod.jpg" alt="Product image">
                                        </div>
                                        <div class="upload-options">
                                            <input class="form-control pic-upload" type="file" id="prod_pfp" name="prod_pfp">
                                        </div>
                                    </div>
                                </div>
                                <div class="fields-section">
                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="pname">Product name</label>
                                        </div>
                                        <div class="form-field">
                                            <input class="form-control" required type="text" id="pname" name="pname" minlength="5" maxlength="20" placeholder="Product name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="price">Product price</label>
                                        </div>
                                        <div class="form-field">
                                            <input class="form-control" oninput="validity.valid || (value='');" onkeypress="isNum(event)" required type="number" id="price" name="price" min="0.00" step="0.01" placeholder="Product price">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="pdesc">Product description (advised)</label>
                                        </div>
                                        <div class="form-field">
                                            <textarea class="form-control"  type="textarea" id="pdesc" name="pdesc" maxlength="500" rows="8" placeholder="Product description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row confirm">
                                <button class="btn btn-lg btn-warning" name="addproduct">Add product</button>
                            </div>
                        </form>

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

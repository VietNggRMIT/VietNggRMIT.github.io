<?php 
    session_start(); 
    if (count($_GET) <= 0 ) { 
        header("Location: view_all_prod.php");
    }
    if (isset($_GET["view_prod"])){
        $pid = $_GET["pid"];
        $pname = $_GET["pname"];
        $pvendor = $_GET["pvendor"];
        $price = $_GET["price"];
        $pimg = $_GET["pimg"];
        $pdesc = $_GET["pdesc"];
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
                // var ord_num = document.getElementById("ord_num").value;
                var ord_key = "<?= $pid ; ?>";
                var ord_val = "<?= $pname . "-" . $pvendor . "-" . $price; ?>";
                localStorage.setItem(ord_key,ord_val);
            }
        </script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand me-auto" href="index.html">
                        <img class="brand-logo" src="https://logopond.com/logos/8eaaac3a2fe79ea70f852b5c332c7efb.png" alt="brand-logo" height="50px">
                    </a>
                    <button class="navbar-toggler ms-auto" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="collapseNavbar">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                <div class="product-detail-wrapper">
                    <div class="product-details d-flex">
                        <div class="img-section">
                            <img class="img-file" src="<?= $pimg; ?>">
                        </div>
                        <div class="details-section">
                            <div class="form-title"><h1><?= $pname; ?></h1></div>
                            <div class="product description">
                                <p><?= $pvendor; ?></p>
                                <p><?= $pdesc; ?></p>
                            </div>
                            <div class="product-price">
                                <h2><?= $price; ?> VND</h2>
                            </div>
                            <div class="product-options d-flex">
                                <button class="btn btn-primary btn-lg" onclick="addtocart()">Add to cart</button>
                                <button class="btn btn-primary btn-lg" onclick="viewcart()">View Cart</button>
                                <button class="btn btn-primary btn-lg" onclick="clearcart()">Clear cart (to test)</button>
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
<?php 
    session_start(); 
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
                    <a class="navbar-brand me-auto" href="index.html">
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
                            <button class="btn btn-warning btn-lg">Logout</button>
                        </div>
                    </div>
                    <div class="account-details-section shipper">
                        <h2>Shipper account information</h2>
                        <div class="active-order-listing">
                            <div class="form-title">Active orders</div>
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
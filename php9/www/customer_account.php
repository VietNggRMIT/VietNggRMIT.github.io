<?php 
    session_start(); 
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
                <div class="account-info-wrapper">
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
                            <div class="divider"></div>
                            <?php
                                if(isset($_SESSION['pfperror'])){
                                    echo '<div class="alert alert-warning" role="alert">Error choosing your new profile picture.</div>';
                                    unset($_SESSION['pfperror']);
                                }
                            ?>
                            <a class="btn btn-warning btn-lg" href="logout.php" onclick="clearcart()">Log out</a>
                        </div>
                    </div>
                    <div class="account-details-section">
                        <h2>Customer account information</h2>
                        <div class="account-details">
                            <?php
                                echo "<div>Username: " . $_SESSION['user']['uname'] . "</div>";
                                echo "<div>Name: " . $_SESSION['user']['fullname']."</div>";
                                echo "<div>Address: " . $_SESSION['user']['wc'] ."</div>";
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
    </body>
</html>
<?php } ?>
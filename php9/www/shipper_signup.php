<?php 
    session_start();
    $current = 'shipper_signup.php';
    if(isset($_SESSION['tryagain']) && $_SESSION['tryagain'] != $current){ //user tried to sign up in other pages
        unset($_SESSION['signup_failed']);
    }
    $_SESSION['tryagain'] = $current;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/index.js" async></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <title>Shipper Sign Up</title>
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
                                <a class="nav-link" href="index.html">Home</a>
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
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div class="container">
                <div class="signup-block-wrapper">
                    <div class="signup-block shipper">
                        <div class="form-title"><h1>Shipper sign up</h1></div>
                        <?php 
                            if(isset($_SESSION['signup_failed'])){
                                echo "<h2>Your username is taken.</h2>";
                            }
                        ?>
                        <form action="verify_signup.php" method="POST" enctype="multipart/form-data">
                            <div class="form-flex">
                                <div class="fields-section">
                                    <div class="form-row">
                                    <div class="form-label">
                                            <label for="biz_username">Username</label>
                                        </div>
                                        <div class="form-field">
                                            <input class="form-control" required type="text" id="biz_username" name="uname" minlength="8" maxlength="15" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="biz_password">Password</label>
                                        </div>
                                        <div class="form-field">
                                            <input class="form-control" required type="password" id="biz_password" name="psw" minlength="8" maxlength="20" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="biz_name">Full name</label>
                                        </div>
                                        <div class="form-field">
                                            <input class="form-control" required type="text" id="biz_name" name="fullname" minlength="5" placeholder="Full name">
                                        </div>
                                    </div>
                                    <input type="hidden" name="utype" value="shipper">
                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="d-hub">Select distribution hub: </label>
                                        </div>
                                        <div class="form-field">
                                            <div class="dropdown">
                                                <!-- wc: wildcard - for shippers -> dist hub -->
                                                <select class="btn dropdown-toggle" name="wc" id="d-hub">
                                                    <option value="Sample 1">Sample 1</option>
                                                    <option value="Sample 2">Sample 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="upload-section">
                                    <div class="form-row upload">
                                        <div class="img-preview">
                                            <img class="img-file" src="http://thichthucung.com/wp-content/uploads/cho-phoc-soc-lai-husky.jpg" alt="Profile picture">
                                        </div>
                                        <div class="upload-options">
                                            <input class="form-control pic-upload" type="file" id="formFile" name="fileup">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button class="btn btn-lg btn-warning" name="signup">Sign up</button>
                            </div>
                            <div class="form-row">
                                <p>By clicking "Sign up" you agree to the <a href="privacy.html">Terms and Privacy Policy</a></p>
                            </div>
                            <div class="form-row">
                                <p>Already have an account? <a href="login.html">Login</a></p>
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
                        <div class="copyright">2022 - Company, Inc. All rights reserved. Insert more info (optional)</div>
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
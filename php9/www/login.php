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
                    <a class="navbar-brand me-auto" href="index.html">
                        <img class="brand-logo" src="https://logopond.com/logos/8eaaac3a2fe79ea70f852b5c332c7efb.png" alt="Brand logo">
                    </a>
                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNavbar">
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
                <div class="signup-block-wrapper">
                    <div class="signup-block login">
                        <div class="form-title"><h1>Welcome to G29-Lazada!</h1></div>
                        <?php 
                            session_start();
                            if(isset($_SESSION['login'])){
                                echo "<div class=\"form-title\"><h2>Wrong username or password.</h2></div>";
                            }
                            else{
                                echo "<div class=\"form-title\"><h2>Please login</h2></div>";
                            }
                        ?>

                        <form action="verify_login.php" method="post">
                            <div class="form-row">
                                <div class="form-label">
                                    <label for="uname">Username</label>
                                </div>
                                <div class="form-field">
                                    <input class="form-control" required type="text" id="username" name="uname" minlength="8" maxlength="15" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">
                                    <label for="psw">Password</label>
                                </div>
                                <div class="form-field">
                                    <input class="form-control" required type="password" id="password" name="psw" minlength="8" maxlength="20" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-row">
                                <button class="btn btn-lg btn-form" type="submit" name="login">Sign in</button>
                            </div>

                            <div class="form-row signup-options">
                                <div class="divider"></div>
                                <p>Don't have an account yet?</p>
                                <p><a href="customer_signup.html">Sign up as customer</a></p>
                                <p><a href="vendor_signup.html">Sign up as vendor</a></p>
                                <p><a href="shipper_signup.html">Sign up as shipper</a></p>
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
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    </body>
</html>
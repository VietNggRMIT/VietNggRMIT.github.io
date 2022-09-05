<?php
    session_start();
    if (count($_GET) <= 0 ) { //no submitted data
        header("Location: view_cart.php");
    }
    if (isset($_SESSION['user']['wc']) && isset($_SESSION['user']['uname'])){ //address for customers
        echo "Sup, user " . $_SESSION['user']['uname'] . 
            ". Your order will be shipped to " . $_SESSION['user']['wc'] . " soon.";
    }
    else{ //users havent logged in; redirect on view_cart.php failed?
        header("Location: login.php");
    }
?>
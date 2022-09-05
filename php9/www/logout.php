<?php
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        header("Location: home.php");
    }
    else{ //users wander here
        header("Location: home.php");
    }
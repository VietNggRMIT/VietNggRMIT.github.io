<?php
    session_start();
    if(isset($_SESSION['login'])){ //unset login error message
        unset($_SESSION['login']);
    }
    if(!isset($_SESSION['user']['uname'])){ //users wander here
        header("Location: index.php");
    }
    else{
        $_SESSION['user'] = array();
        header("Location: index.php");
    }
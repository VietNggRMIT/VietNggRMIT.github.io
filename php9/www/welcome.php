<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: homepage.php");
    }
    else
    {
        printf("Hello %s %s, username %s. At the server, currently it is %s.<br>", $_SESSION['user']['type'],
        $_SESSION['user']['fullname'],$_SESSION['user']["uname"], date("g:i a"));
        //echo "<img src=\"" . $_SESSION['user']['pfp'] . "\" width=\"200\">";
    }
    
<?php
    session_start();
    if(!isset($_SESSION['user']['uname'])){ //users wander here
        header("Location: home.php");
    }
    else{
        // $deets = ['uname', 'type', 'fullname', 'wc', 'pfp'];
        // foreach($deets as $d){
        //     unset($_SESSION['user'][$d]);
        // }
        // unset($_SESSION['user']);
        // echo "woohoo";
        $_SESSION['user'] = array();
        header("Location: home.php");
    }
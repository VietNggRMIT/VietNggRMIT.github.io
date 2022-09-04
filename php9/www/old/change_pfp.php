<?php
session_start();
if (!isset($_POST["changepfp"])){
    header("Location: welcome.php");
}
else{
    if(isset($_SESSION['user']['uname'])){
        if(isset($_FILES['newpfp']) && $_FILES['newpfp']['error'] == UPLOAD_ERR_OK){
            $imageType = strtolower(pathinfo($_FILES['newpfp']['name'])['extension']);
            $pfp_dir = "pfp/";
            $new_pfp_name = $pfp_dir . $_SESSION['user']['uname'] . "." . $imageType;
            $def_pfp = "pfp/default_pfp.jpg";
            move_uploaded_file($_FILES['newpfp']['tmp_name'], $new_pfp_name);
            if(isset($_SESSION['user']['pfp']) && $_SESSION['user']['pfp'] != $def_pfp){ //delete old pfp if exists
                unlink($_SESSION['user']['pfp']);
            }
            $_SESSION['user']['pfp'] = $new_pfp_name;
            header("Location: welcome.php");
        }
        else {
            $_SESSION['pfperror'] = true;
            header("Location: welcome.php");
        }
    }
    else{
        header("Location: login.php");
    }
}
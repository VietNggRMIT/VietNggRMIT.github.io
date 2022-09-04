<?php
session_start();
if (!isset($_POST["changepfp"])){
    header("Location: welcome.php");
}
else{
    if(isset($_SESSION['user']['uname'])){
        if(isset($_FILES['newpfp'])){
            $imageType = strtolower(pathinfo($_FILES['newpfp']['name'])['extension']);
            $pfp_dir = "pfp/";
            $new_pfp_name = $pfp_dir . $_SESSION['user']['uname'] . "." . $imageType;
            move_uploaded_file($_FILES['newpfp']['tmp_name'], $new_pfp_name);
            $_SESSION['user']['pfp'] = $new_pfp_name;
            header("Location: welcome.php");
        }
        else {
            echo "upload error";
        }
    }
    else{
        echo "session uname error";
    }
}
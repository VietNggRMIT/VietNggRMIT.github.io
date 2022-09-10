<?php
session_start();
include("func.php");
//trying to access this page without submitting -> add product page
if (count($_POST) <= 0 ) { 
    header("Location: login.php");
}
if (isset($_POST["addproduct"]) && isset($_SESSION['user']['fullname'])){
    $plist = file ('../db/products.csv'); //read the file into an array of lines
    //get all the data from POST
    $new_pname      = $_POST["pname"];
    $new_price      = $_POST["price"];
    $new_pdesc      = $_POST["pdesc"];
    $new_pid        = 1;
    $add_success = TRUE;
    if(!$new_pdesc){
        $new_pdesc = "(none)";
    }
    //1. go line by line to check existing if the vendor-product combo exists
    foreach ($plist as $prod) { //$prod: a line in the csv file
        $p_details = explode(',', trim($prod));
        if($new_pname == $p_details[1] && $p_details[2] == $_SESSION['user']['fullname']){
            $add_success = false;
            break;
        }
    }
    if(!$add_success){ 
        $_SESSION['addp_failed'] = true;
        header("Location: vendor_addp.php");
        exit();
    }
    //no dupes -> ok
    //2. Get the product a new pid
    $file_name = '../db/products.csv';
    $fp = fopen($file_name, 'r');
    $first = fgetcsv($fp);
    while ($row = fgetcsv($fp)) { 
        $i = 0;
        $prod = [];
        foreach ($first as $col_name) {
            $prod[$col_name] =  $row[$i];
            $i++;
        }
        if ($new_pid == $prod['pid']){
            $new_pid ++;
        }
    }
    //3. handle product images; force the user to do this again if they don't submit an image
    $target_dir = "res/prod/";
    $def_pfp = $target_dir . "default_prod.jpg";
    $new_prod_pfp = "";
    //no pfp -> use default pfp
    if(!file_exists($_FILES['prod_pfp']['tmp_name']) || !is_uploaded_file($_FILES['prod_pfp']['tmp_name'])) {
        $new_prod_pfp = $def_pfp;
    }
    else{ //user uploaded some stuff
        $target_file = $target_dir . basename($_FILES["prod_pfp"]["name"]);
        $uploaded = TRUE;
        $imageFileType = strtolower(pathinfo($target_file)['extension']);
        $err_mes = "";
        // Disallow files that are too big
        if ($_FILES["prod_pfp"]["size"] > 5000000) {
            $err_mes = "Sorry, your file is too large.";
            $uploaded = FALSE;
        }
        if (!$uploaded) { 
            echo $err_mes . " Please try again.";
            $add_success = FALSE;
            header( "Refresh:5; url=vendor_addp.php", true, 303);
        } 
        else {
            $temp_pfp = $target_dir  . $new_pid . "." . $imageFileType;
            if (move_uploaded_file($_FILES["prod_pfp"]["tmp_name"], $temp_pfp)) {
                $new_prod_pfp = $temp_pfp;
            } else {
                echo "Sorry, there was an error uploading your file. Default pfp used.";
                $new_prod_pfp = $def_pfp;
                //header( "Refresh:5; url=index.php", true, 303);
            }
        }
    }
    if($add_success){    
        $pw_file = fopen("../db/products.csv", "a");
        $entry = sprintf("%s,%s,%s,%s,\"%s\"\n", $new_pid, $new_pname, 
                                    $_SESSION['user']['fullname'], $new_price, $new_pdesc);
        fwrite($pw_file, $entry);
        fclose($pw_file);
        unset($_SESSION['addp_failed']);
        header("Location: vendor_account.php");
    }
}
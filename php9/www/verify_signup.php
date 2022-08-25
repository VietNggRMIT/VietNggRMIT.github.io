<?php
session_start();
//trying to access this page without submitting -> login page
if (count($_POST) <= 0 ) { 
    header("Location: homepage.php");
}
if (isset($_POST["signup"])){
    $userlist = file ('../accounts.db'); //read the file into an array of lines
    //get all the data from POST bc why not
    $new_uname = trim($_POST["uname"]);
    $new_utype = $_POST["utype"];
    $new_pw = $_POST["psw"];
    $new_fullname = $_POST["fullname"];
    $new_wc = $_POST["wc"]; //wildcard: address for customers, business address for vendors, dist hub for shippers
    $reg_success = FALSE;
    //go line by line to check existing usernames
    if($new_utype == "vendor"){ //vendors cannot share business addresses
        foreach ($userlist as $user) { //$user: a line in the db file
            $user_details = explode('|', trim($user));
            if($new_uname == $user[1] && $new_wc == $user[3]){ //also check if username already exists
                echo "Username or business address already exists.\n";
                echo "<a href=\"homepage.php\" name=\"reg\">Home </a>";
                break;
            }
        }
    }
    else{ //only check username for customers and shippers
        foreach ($userlist as $user) {
            $user_details = explode('|', trim($user));
            if($new_uname == $user[1]){ //username already exists
                echo "Username already exists.\n";
                echo "<a href=\"homepage.php\" name=\"reg\">Home </a>";
                break;
            }
        }
    }
    $reg_success = TRUE;
    //no dupes -> ok
    //handle profile images; force the user to do this again if they don't submit an image
    $target_dir = "pfp/";
    $def_pfp = $target_dir . "default_pfp.jpg";
    //no pfp -> use default pfp
    if(!file_exists($_FILES['fileup']['tmp_name']) || !is_uploaded_file($_FILES['fileup']['tmp_name'])) {
        $_SESSION['user']['pfp'] = $def_pfp;
    }
    else{
        $target_file = $target_dir . basename($_FILES["fileup"]["name"]);
        $uploaded = TRUE;
        $imageFileType = strtolower(pathinfo($target_file)['extension']);
        $err_mes = "";
        // Disallow files that are too big (5mb)
        if ($_FILES["fileup"]["size"] > 5000000) {
            $err_mes = "Sorry, your file is too large.";
            $uploaded = FALSE;
        }
        // Only allow certain file formats. Doesnt check if the user omits pfp (use default)
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if(!in_array($imageFileType, $allowed)) {
            $err_mes = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploaded = FALSE;
        }
        if (!$uploaded) { 
            echo $err_mes . " Please try again.";
            $reg_success = FALSE;
            header( "Refresh:5; url=homepage.php", true, 303);
        } 
        else {
            $new_pfp = $target_dir  . $new_uname . "." . $imageFileType;
            if (move_uploaded_file($_FILES["fileup"]["tmp_name"], $new_pfp)) {
                $_SESSION['user']['pfp'] = $new_pfp;
            } else {
                echo "Sorry, there was an error uploading your file. Default pfp used.";
                $_SESSION['user']['pfp'] = $def_pfp;
                header( "Refresh:5; url=welcome.php", true, 303);
            }
        }
    }
    
    if($reg_success){    
        $pw_file = fopen("../accounts.db", "a");
        $entry = sprintf("%s|%s|%s|%s|%s\n", $new_utype, $new_uname, $new_fullname, $new_wc, $new_pw);
        fwrite($pw_file, $entry);
        fclose($pw_file);
        $_SESSION['user']['type'] = $new_utype;
        $_SESSION['user']['fullname'] = $new_fullname;
        $_SESSION['user']["uname"] = $new_uname;
        header("Location: welcome.php");
    }
}
<?php
session_start();
include("func.php");
//trying to access this page without submitting -> login page
if(count($_POST) <= 0 ) { 
    header("Location: login.php");
  }
if (isset($_POST["login"])){
    $userN = $_POST['uname'];
    $passW = $_POST['psw'];
    $userlist = file ('../accounts.db');
    $success = false;
    foreach ($userlist as $user) { //user: a line in the db file
        $user_details = explode('|+|', trim($user)); //trim so that the new line doesnt get counted as pw
        //using plain text to test, make sure to use hash
        if ($user_details[1] == $userN && password_verify($passW, $user_details[4])) {
            unset($_SESSION['login']);
            $_SESSION['user']['uname'] = $userN;
            $_SESSION['user']['type'] = $user_details[0];
            $_SESSION['user']['fullname'] = $user_details[2];
            $_SESSION['user']['wc'] = $user_details[3];
            //get user pfp
            $_SESSION['user']['pfp'] = get_pfp($_SESSION['user']['uname']);         
            $success = true;
            break;
        }
    }
    if ($success) {
        header("Location: ". $_SESSION['user']['type'] . "_account.php");
    } else {
        $_SESSION['login'] = false;
        header("Location: login.php");
    }
}
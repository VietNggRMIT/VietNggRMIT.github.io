<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: homepage.php");
    }
    else
    {
        printf("Hello %s %s, username %s. At the server, currently it is %s.<br>", $_SESSION['user']['type'],
        $_SESSION['user']['fullname'],$_SESSION['user']["uname"], date("g:i a"));
        $pfp_dir = "pfp/";
        $scan = scandir($pfp_dir);
        foreach($scan as $file) {
            if ($file == "." || $file == "..") { }//do nothing - just to be safe
            else{
                $file_uname = explode(".", $file)[0]; //username portion of img file
                if($_SESSION['user']['uname'] == $file_uname){
                    $_SESSION['user']['pfp'] = $pfp_dir . $file;
                }
            }
        }
        if(isset($_SESSION['user']['pfp'])){
            echo "<img src=\"" . $_SESSION['user']['pfp'] . "\" width=\"200\">";
        }
        else{
            echo "<img src=\"pfp/default_pfp.jpg\" width=\"200\">";
        }
    }
    if(isset($_SESSION['pfperror'])){
        echo "There is an error with your image, please choose another file.";
        unset($_SESSION['pfperror']);
    }
?>
<form action="change_pfp.php" method="POST" enctype="multipart/form-data">
    <label for="newpfp"><b>Upload new profile picture?</b></label>
    <input type="file" name="newpfp" id="newpfp">
    <button type="submit" name="changepfp">Change</button>
</form>

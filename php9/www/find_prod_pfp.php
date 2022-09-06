<?php
    function find_prod_pfp($pid){
        $pimg = "";
        //get product image, use default img if not available
        $prod_dir = "res/prod/";
        $def_prod = $prod_dir . "default_prod.jpg";
        $scan = scandir($prod_dir);
        foreach($scan as $file) {
            if ($file == "." || $file == "..") { }//do nothing - just to be safe
            else{
                $file_uname = explode(".", $file)[0]; //pid portion of img file
                if($pid == $file_uname){
                    $pimg = $prod_dir . $file;
                }
            }
        }
        if(!$pimg){
            $pimg = $def_prod;
        }
        return $pimg;
    }
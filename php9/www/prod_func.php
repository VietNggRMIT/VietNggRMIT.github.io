<?php
    //session_start();
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
    function read_searchfilter($p_min, $p_max, $p_name) {
        $file_name = '../products.csv';
        $fp = fopen($file_name, 'r');
        $first = fgetcsv($fp);
        $products = [];
        while ($row = fgetcsv($fp)) {
            $i = 0;
            $product = [];
            foreach ($first as $col_name) {
                $product[$col_name] =  $row[$i];
                $i++;
            }
            if(isset($p_min) && is_numeric($p_min)){
                if($product['price'] < $p_min){
                    continue;
                }
            }
            if(isset($p_max) && is_numeric($p_max)){
                if($product['price'] > $p_max){
                    continue;
                }
            }
            if(isset($p_name) && !empty($p_name)){
                if(strpos($product['product_name'], $p_name) === false){
                    continue;
                }
            }
            $products[] = $product;
        }
        // overwrite the session variable
        $_SESSION['products'] = $products;
    }
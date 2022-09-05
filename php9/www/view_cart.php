<?php
    session_start();
    if (count($_GET) <= 0 ) { 
        header("Location: view_all_prod.php");
    }
    if (isset($_GET["view_cart"])){
        $pid_list = explode(',',$_GET["pid"]);
        print_r($pid_list);
        //read csv file and return items with the same pid
        $file_name = '../nva_prod.csv';
        $fp = fopen($file_name, 'r');
        $first = fgetcsv($fp);
        while ($row = fgetcsv($fp)) {
            $i = 0;
            $product = [];
            foreach ($first as $col_name) {
                $product[$col_name] =  $row[$i];
                $i++;
            }
            if(in_array($product["pid"], $pid_list)){
                //display item stuff here
            }
        }
    }
<?php
session_start();
include("func.php");
//trying to access this page without submitting
if(count($_POST) <= 0 ) { 
    header("Location: index.php");
  }
if (isset($_POST["update_ord"])){
    $oid = $_POST['oid'];
    $status = $_POST['order_status'];
    $changing = true;
    //read all content into array
    $ord_fname = "../db/orders.csv";
    $fp = fopen($ord_fname, 'r');
    $first = fgetcsv($fp);
    $data = [];
    $data[] = $first;
    while ($row = fgetcsv($fp)) {
        $i = 0;
        $ord = []; //single row of order
        foreach ($first as $col_name) {
            $ord[$col_name] =  $row[$i];
            $i++;
        }
        if($ord['oid'] == $oid){
            if($ord['status'] == $status){ //no changes
                $changing = false;
                break;
            }
            else{
                $replace = [$ord['oid'], $ord['products'], $ord['hub'], $ord['user_addr'], $status];
                $data[] = $replace;
            }
        }
        else{ //keep finding
            $data[] = $row;
        }
    }
    if($changing){
        $fout = fopen($ord_fname, 'w');
        foreach ($data as $line) {
            fputcsv($fout, $line);
        }
        fclose($fout);
    }

    header("Location: shipper_account.php");
}
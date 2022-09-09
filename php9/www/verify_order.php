<?php
    session_start();
    if (count($_GET) <= 0 ) { //no submitted data
        header("Location: view_cart.php");
    }
    if (isset($_GET['verify_order'])){
        if (isset($_SESSION['user']['wc']) && isset($_SESSION['user']['uname'])){ //address for customers
            $new_oid = 1; //set an order id, increment until it is unique
            $prod_list = $_GET['pid'];
            if($prod_list){ //not an empty cart
                $user_adr = $_SESSION['user']['wc'];
                //Get a "random" hub from 1, 2, or 3. More random numbers include noises, after all.
                $hub = "Hub " . (date("s") % 3 + 1); 
                //read orders.csv row by row, increment new_oid if it is met
                $file_name = '../db/orders.csv';
                $fp = fopen($file_name, 'r');
                $first = fgetcsv($fp);
                while ($row = fgetcsv($fp)) { 
                    $i = 0;
                    $order = [];
                    foreach ($first as $col_name) {
                        $order[$col_name] =  $row[$i];
                        $i++;
                    }
                    if ($new_oid == $order['oid']){
                        $new_oid ++;
                    }
                }
                //output to be put in the orders.csv file
                $output = "$new_oid,\"$prod_list\",$hub,$user_adr,active\n";
                $ord_f = fopen($file_name, 'a');
                fwrite($ord_f, $output);
                fclose($ord_f);
                $_SESSION['ord_msg'] = "Your order will be delivered to $user_adr soon!";
                header("Location: index.php");
            }
            else{
                header("Location: index.php");
            }
        }
        else{ //users havent logged in; redirect on view_cart.php failed?
            header("Location: login.php");
        }
    }
    else {
        header("Location: index.php");
    }
?>
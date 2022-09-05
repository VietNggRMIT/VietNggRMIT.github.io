<!DOCTYPE HTML>
<script>
    function viewcart(){
        var output = "";
        for(var a in localStorage){
            if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
                output += "ID: " + a + " -- " + localStorage[a] + "  ///  ";
            }
        }
        document.getElementById("cart_items").innerHTML = output;
    }
    window.onload = viewcart;
    function place_ord(){
        var addurl = ""; //put this at the end of url later
        for(var a in localStorage){
            if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
                addurl += a + ",";
            }
        }
        addurl = addurl.replace(/,+$/, ""); //remove the last comma
        document.getElementById("newurl").innerHTML = addurl;
    }
</script>
<button onclick="place_ord()">Place Order</button>
<p>
  <span id="cart_items"></span><br>
  <span id="newurl"></span>
</p>
<!-- the above is just to test. real attempt starts below -->
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
        $cart = [];
        while ($row = fgetcsv($fp)) {
            $i = 0;
            $product = [];
            foreach ($first as $col_name) {
                $product[$col_name] =  $row[$i];
                $i++;
            }
            if(in_array($product["pid"], $pid_list)){
                $cart[] = $product;
            }
        }
        var_dump($cart);
    }
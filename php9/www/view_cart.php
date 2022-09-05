<script>
    function removeitem(pid){ //remove an item from localstorage. refresh page and show items.
        localStorage.removeitem(pid);
        var addurl = "view_cart.php?pid="; //put this at the end of url later
            for(var a in localStorage){
                if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
                    addurl += a + ",";
                }
            }
        addurl = addurl.replace(/,+$/, ""); //remove the last comma
        addurl += "&view_cart="
        window.location.replace(addurl);
    }
    function placeorder(){ //send GET data to another page, which would show order details
        var addurl = "view_order.php?pid="; //put this at the end of url later
            for(var a in localStorage){
                if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
                    addurl += a + ",";
                }
            }
        addurl = addurl.replace(/,+$/, ""); //remove the last comma
        addurl += "&view_order="
        localStorage.clear();
        window.location.replace(addurl);
    }
</script>
<?php
    session_start();
    if (count($_GET) <= 0 ) { 
        header("Location: view_all_prod.php");
    }
    if (isset($_GET["view_cart"])){
        $pid_list = explode(',',$_GET["pid"]);
        //print_r($pid_list);
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
            if(in_array($product['pid'], $pid_list)){
                echo "ID: ". $product['pid'] . "<br>";
                echo $product['product_name'] . " by " . $product['vendor'] . " costs " . $product['price'] . "<br>";
                if($product['description']){
                    echo "Description: " . $product['description'] . "<br><br>";
                }
                else{
                    echo "Description: (none) <br><br>";
                }
            }
        }
        echo "<button onclick=\"placeorder()\">Place Order</button>";
    }
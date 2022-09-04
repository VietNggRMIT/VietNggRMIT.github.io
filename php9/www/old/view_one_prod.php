<?php
session_start();
//trying to access this page without submitting -> login page
if (count($_GET) <= 0 ) { 
    header("Location: show_products.php");
}
if (isset($_GET["view_prod"])){
    $pname = $_GET["pname"];
    $pvendor = $_GET["pvendor"];
    $price = $_GET["price"];
    $psizes = explode(',',$_GET["psizes"]);
    $pstock = (int) $_GET["pstock"];
    $output = "Product $pname from $pvendor costs $price and has $pstock remaining.<br>";
    if(count($psizes) != 0){
        $output .= 'Size(s): ';
        $sz_output = "";
        foreach ($psizes as $size){
            $sz_output .= $size . " -- ";
        }
        $output .= rtrim($sz_output, ' -- ') . "<br>";
    }
    echo $output;
    $pot_order = ["big fat hat-nike-size m,l" => 2]; //get product name, vendor, size, ord num -> set to local storage
}?>
    <script type="text/javascript">
        function addtocart(){
            var ord_num = document.getElementById("ord_num").value;
            var ord_key = "<?= $pname . "-" . $pvendor . "-size " . $_GET['psizes']; ?>";
            localStorage.setItem(ord_key,ord_num);
        }
        function viewcart(){
            var output = '';
            var keys = Object.keys(localStorage), i = 0, key;
            for (; key = keys[i]; i++) {
                output += key + '=' + localStorage.getItem(key) + ";\n";
            }
            document.getElementById("cart_items").innerHTML = JSON.stringify(localStorage);
        }
    </script>
    <input type="text" id="ord_num" name="ord_num" placeholder="Number of orders" />
    <button onclick="addtocart()">Add to Cart</button>
    <button onclick="viewcart()">View Cart</button>
    <p id="cart_items" type="text"></p>
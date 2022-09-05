<?php
session_start();
//trying to access this page without submitting -> login page
if (count($_GET) <= 0 ) { 
    header("Location: view_all_prod.php");
}
if (isset($_GET["view_prod"])){
    $pid = $_GET["pid"];
    $pname = $_GET["pname"];
    $pvendor = $_GET["pvendor"];
    $price = $_GET["price"];
    $output = "Product $pname from $pvendor costs $price and has ID of $pid.<br>";
    echo $output;
}?>
    <script type="text/javascript">
        function addtocart(){
            // var ord_num = document.getElementById("ord_num").value;
            var ord_key = "<?= $pid ; ?>";
            var ord_val = "<?= $pname . "-" . $pvendor . "-" . $price; ?>";
            localStorage.setItem(ord_key,ord_val);
        }
        function viewcart(){
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
        function clearcart(){
            localStorage.clear();
            document.getElementById("cart_items").innerHTML = "";
        }
    </script>
    <!-- <input type="text" id="ord_num" name="ord_num" placeholder="Number of orders" /> -->
    <button onclick="addtocart()">Add to Cart</button>
    <button onclick="viewcart()">View Cart</button>
    <button onclick="clearcart()">Clear cart (to test)</button>
    <p id="cart_items" type="text"></p>
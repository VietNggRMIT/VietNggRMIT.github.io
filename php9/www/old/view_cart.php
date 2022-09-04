<!DOCTYPE HTML>
<script>
    function viewcart(){
        var output = "";
        for(var a in localStorage){
            if(localStorage.hasOwnProperty(a)){ //just for firefox users, who will also list functions
                output += "ID: " + a + " -- " + localStorage[a] + "\n";
            }
        }
        document.getElementById("cart_items").innerHTML = output;
    }
    window.onload = viewcart;
    function place_ord(){
        var addurl = "";
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
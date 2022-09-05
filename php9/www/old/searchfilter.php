<?php
session_start();

function read_searchfilter() {
    $file_name = 'data/products.csv';
    $fp = fopen($file_name, 'r');
    $first = fgetcsv($fp);
    $products = [];
    while ($row = fgetcsv($fp)) {
        $i = 0;
        $product = [];
        foreach ($first as $col_name) {
        $product[$col_name] =  $row[$i];
        if ($col_name == 'size') {
            $product[$col_name] = explode(',', $product[$col_name]);
        }
        $i++;
        }
        if(isset($_POST['min_price']) && is_numeric($_POST['min_price'])){
            if($product['price'] < $_POST['min_price']){
                continue;
            }
        }
        if(isset($_POST['max_price']) && is_numeric($_POST['max_price'])){
            if($product['price'] > $_POST['max_price']){
                continue;
            }
        }
        if(isset($_POST['product_name']) && !empty($_POST['product_name'])){
            if(strpos($product['product_name'], $_POST['product_name']) === false){
                continue;
            }
        }
        if(isset($_POST['vendor']) && !empty($_POST['vendor'])){
            if(strpos($product['vendor'], $_POST['vendor']) === false){
                continue;
            }
        }
        
            
        $products[] = $product;
    }
    // overwrite the session variable
    $_SESSION['products'] = $products;
}
read_searchfilter();

if (isset($_SESSION['products'])){
    echo '<pre>';
    print_r($_SESSION['products']);
    echo '</pre>';
}

?>
<html>
    <form method="post" action="../www/searchfilter.php">
    Search by name<input type="text" name = "product_name"><br>
    Min Price <input type="number" name="min_price"><br>
    Max Price <input type="number" name="max_price"><br>
    <br>
    <input type="submit" name="act" value="Filter">
    </form>
</html>
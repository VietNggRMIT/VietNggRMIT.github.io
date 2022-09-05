<?php session_start(); ?>

<form method="post" action="view_all_prod.php"> 
    Search by name<input type="text" name = "product_name">
    Min Price <input type="number" name="min_price">
    Max Price <input type="number" name="max_price">
    <input type="submit" name="act" value="Filter">
</form>

<?php
function read_searchfilter() {
    $file_name = '../nva_prod.csv';
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
    foreach($_SESSION['products'] as $p_details){
        $pid = $p_details['pid'];
        $pname = $p_details['product_name'];
        $pvendor = $p_details['vendor'];
        $price = $p_details['price'];
        $pdesc = $p_details['description'];
        echo "ID: $pid -- Product $pname from $pvendor costs {$price}.<br>";
        echo "Vendor description: $pdesc <br>";
?>
    <form action="view_one_prod.php" method="GET">
            <input type="hidden" name="pid" value="<?= $pid ?>">
            <input type="hidden" name="pname" value="<?= $pname ?>">
            <input type="hidden" name="pvendor" value="<?= $pvendor ?>">
            <input type="hidden" name="price" value="<?= $price ?>">
            <button type="submit" name="view_prod">View this product</button>
    </form>
<?php
    }
}
?>
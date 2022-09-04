<?php
$product_list = file("../products.db");
foreach ($product_list as $prod) { //user: a line in the db file
    $p_details = explode('|+|', trim($prod)); 
    $pname = $p_details[0];
    if ($pname == "----product_name"){
        continue;
    }
    $pvendor = $p_details[1];
    $price = $p_details[2];
    $psizes = $p_details[3];
    $pstock = (int) $p_details[4];
    echo "Product $pname from $pvendor costs $price and has $pstock remaining.";
    ?>
    <form action="view_one_prod.php" method="GET">
        <input type="hidden" name="pname" value="<?= $pname ?>">
        <input type="hidden" name="pvendor" value="<?= $pvendor ?>">
        <input type="hidden" name="price" value="<?= $price ?>">
        <input type="hidden" name="psizes" value="<?= $psizes ?>">
        <input type="hidden" name="pstock" value="<?= $pstock ?>">
        <button type="submit" name="view_prod">View this product</button>
    </form>
<?php } ?>

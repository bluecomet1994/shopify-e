<?php
require "../query/Cart.php";
$cart = new Cart();
$unique_id = "6374ae4b36291";
$dnt = "2022-11-16 10:32:59";
$product_paths = $cart->get_products($unique_id, $dnt);
$product_path_count = count($product_paths);
$product_link_body = "";

$address_domain = "";
if (!isset($_SERVER['HTTPS'])) {
    $address_domain = "/localhost";
} else {
    $address_domain = "https:{$_SERVER["HTTP_HOST"]}";
}
for ($i = 0; $i < $product_path_count; $i++) {

    // $product_link_body .=  "<a href = '$address_domain$product_paths[$i]'>$address_domain$product_paths[$i]</a>" . "<br>";
    $product_link_body .="<a href = $product_paths[$i]>Link </a>". "<br>";
}
echo "<br>";
echo $product_link_body;
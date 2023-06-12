<?php
require "query.php";
$query = new Cart();
$url = $_GET["unique_id"];
$purchased_unique_id = "rag.2022-11-13 14:31:53";
// $purchased_unique_id = $url;

$unique_id = explode(".", $purchased_unique_id)[0];
$dnt =  explode(".", $purchased_unique_id)[1];







$product_paths = $query->get_products($unique_id, $dnt);
$product_path_count = count($product_paths);

$product_link_body = "";

$address_domain = "";
if (!isset($_SERVER['HTTPS'])) {
  $address_domain = "http:localhost";
} else {
  $address_domain = "https:localhost";
}
for ($i = 0; $i < $product_path_count; $i++) {

  $product_link_body .=  $address_domain . $product_paths[$i] . "<br>";
}
echo $product_link_body;
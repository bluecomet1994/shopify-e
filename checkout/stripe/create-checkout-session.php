<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$vendor_path = GlobalLinkFiles::getFilePath("vendor_autoload");
$authenticate_download_path = GlobalLinkFiles::getRelativePath("authenticate_download");

require_once $vendor_path;
require_once "../query/Samples.php";
include_once "../query/User.php";
include_once "../util/Util.php";
include_once "config.php";


//client secret key
$client_secret = constant("CLIENT_SECRET");


//success url generating process
$protocol = "http";
if (isset($_SERVER["HTTPS"])) {
  $protocol = "https";
}
$host_name = "";
if (array_key_exists("HTTP_HOST", $_SERVER)) {
  $host_name = $_SERVER["HTTP_HOST"];
  
}
$link = "http://localhost/sampleSelling-master/file_testing/authenticate_download.php?unique_id=6374abd38d577&dnt=2022-11-16%2010:22:27";
$authenticate_download_url = $protocol . "://{$host_name}{$authenticate_download_path}";
//-----------------------




// This is your test secret API key.
\Stripe\Stripe::setApiKey($client_secret);
$stripe = new \Stripe\StripeClient(
  $client_secret
);

$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:80/sampleSelling-master';



$object = new Samples();
$util = new Util();
$sampleids;
$qtys;




if (isset($_POST["uniqueId"]) && isset($_POST["qty"]) && (count($_POST["uniqueId"]) == count($_POST["qty"]))) {
  $sampleids = $_POST["uniqueId"];
  $qtys = $_POST["qty"];
  $lineItems = array();
  $userId = "not_a_logged_in_user";
  if ($_SESSION["userEmail"]) {

    $userEmail = $_SESSION["userEmail"];
    $user = new User();
    $userId = $user->getCustomerUniqueIdByEmail($userEmail);
  }

  for ($i = 0; $i < count($sampleids); $i++) {
    $qty = $qtys[$i];
    if ($object->checkId($sampleids[$i])) {

      $sampledetails =  $object->getSampleDetails($sampleids[$i]);
      $sampleprice = $sampledetails[0]['SamplePrice'] * 100;
      $samplename = $sampledetails[0]['Sample_Name'];
      $sampleImagePath = $sampledetails[0]['source_URL'];
      $sampleId = $sampledetails[0]["UniqueId"];
      $sampleImagePath = str_replace(array('.'), "", $sampleImagePath);
      $sampleImagePath = str_replace(array('jpg'), ".jpg", $sampleImagePath);
      $sampleImagePath = $YOUR_DOMAIN . $sampleImagePath;


      //create a unique id to identify the purchase
      $unique_id = uniqid();

      //create meta data to attach to the price 
      $meta_data = array("user_id" => $userId, "sample_id" => $sampleId, "qty" => $qty, "unique_id" => $unique_id);
      $product = \Stripe\Product::create([
        'name' => "{$samplename}",
        'images' => [
          "{$sampleImagePath}"
        ]
      ]);

      $price = \stripe\price::create([
        'product' => "{$product['id']}",
        'unit_amount' => "{$sampleprice}",
        'currency' => 'usd',
        'metadata' => $meta_data

      ]);
      array_push($lineItems, [
        'price' => "{$price['id']}",
        'quantity' => $qtys[$i],
      ]);
    }
  }




  //session creation process
  $checkout_unique_id = $util->getCheckedRandomUniqueId();
  $dnt = date("Y-m-d h:i:s");
  $checkout_session_meta_data =  array("unique_id" => $checkout_unique_id, "dnt" => $dnt);

  //attaching parameters to the download url for success url 

  $unique_id = $checkout_unique_id;
  $dnt = str_replace(" ","%20",$dnt);
  $authenticate_download_url_parameters = $authenticate_download_url . "?unique_id={$unique_id}&dnt={$dnt}";


  if (count($lineItems) > 0) {
    $lineItems  = array('line_items' => $lineItems);
    $checkout_session = \Stripe\Checkout\Session::create([
      $lineItems,
      'mode' => 'payment',
      'success_url' => $authenticate_download_url_parameters,
      'cancel_url' => $YOUR_DOMAIN . '/payment-testing/cancel.html',
      'customer_creation' => 'always',
      'metadata' => $checkout_session_meta_data
    ]);


    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
  } else {
    header("Location: $YOUR_DOMAIN/payment-testing/viewcart.php");
  }
} else {
  header("Location: $YOUR_DOMAIN/payment-testing/viewcart.php");
}

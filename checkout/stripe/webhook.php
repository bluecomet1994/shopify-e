
<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$vendor_path = GlobalLinkFiles::getFilePath("vendor_autoload");
$sendEmail_path = GlobalLinkFiles::getFilePath("send_email");


//set success url


// webhook.php
//
// Use this sample code to handle webhook events in your integration.
//
// 1) Paste this code into a new file (webhook.php)
//
// 2) Install dependencies
//   composer require stripe/stripe-php
//
// 3) Run the server on http://localhost:4242
//   php -S localhost:4242

use Stripe\Stripe;

require $vendor_path;
require $sendEmail_path;
require "config.php";
require "../query/Cart.php";
require '../query/Customer.php';
require "../util/Util.php";

//instantiating object of class Util
$utill = new Util();

// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = constant("ENDPOINT_SECRET");
$client_secret = constant("CLIENT_SECRET");
$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload,
    $sig_header,
    $endpoint_secret
  );
} catch (\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}
$customer_entered_email = "brojogan";
// Handle the event
switch ($event->type) {
  case 'customer.created':
    $paymentIntent = $event->data->object;
    $customer_entered_email = $paymentIntent->id;
    $event_name = $paymentIntent->object;
    $customer = new Customer();
    break;
  case 'checkout.session.completed':
    //after completion of checkout session you can enter the details to db
    $event_name = $event->data->object->object;
    $checkout_session_id = $event->data->object->id;
    $dnt = $event->data->object->metadata->dnt;
    $unique_id = $event->data->object->metadata->unique_id;

    $customer_creation = $event->data->object->customer;
    \Stripe\Stripe::setApiKey($client_secret);
    $stripe = new \Stripe\StripeClient(
      $client_secret
    );

    $customer_search =  $stripe->customers->retrieve(
      $customer_creation
    );
    //retrive the customer email from the checkout event
    $customer_email = $customer_search->email;
    //retrive the line items
    $line_items = \Stripe\Checkout\Session::allLineItems($checkout_session_id);

    $list_items_array = $line_items->data;

    //customer query class
    $customer = new Customer();

   

    // $unique_id = uniqid();

    //get the customer id if there is no in database it will give zero
    $customer_id = $customer->get_user_id_from_stripe($customer_email);

    //insert to customer purchase table which will have the data and time, customer email and id
    $customer->insert_customer_purchase($unique_id, $dnt, $customer_id, $customer_email);

    //retive the customer purchase id to input in the customer purchase history table
    $customer_purchase_id = $customer->get_customer_purchase_id_by_unique_id_and_customer_email($unique_id, $customer_email);

    foreach ($list_items_array as $lists) {

      $price_id = $lists["price"]["id"];

      $sample_id = $lists["price"]["metadata"]["sample_id"];
      $user_id = $lists["price"]["metadata"]["user_id"];
      $qty = $lists["price"]["metadata"]["qty"];

      $sample_primary_key_id = $customer->get_sample_id($sample_id);



      $unique_id = $utill->getCheckedRandomUniqueIdCPHistory();
      $customer->insert_customer_purchase_history($unique_id,  $qty,  $sample_primary_key_id, $customer_purchase_id);


      // if ($user_id == "not_a_logged_in_user") {


      //   $sample_primary_key_id = $customer->get_sample_id($sample_id);

      //   if ($customer_id == 0 || $customer_id == '0') {
      //     $unique_id = uniqid();
      //     $customer->insert_customer_purchase_history($unique_id,  $qty,  $sample_primary_key_id, $customer_purchase_id);
      //   } else {
      //     $unique_id = uniqid();
      //     $customer->insert_customer_purchase_history($unique_id,  $qty,  $sample_primary_key_id, $customer_purchase_id);
      //   }
      // } else {
      //   $unique_id = uniqid();
      //   $sample_primary_key_id = $customer->get_sample_id($sample_id);
      //   $customer->insert_customer_purchase_history($unique_id,  $qty,  $sample_primary_key_id, $customer_purchase_id);
      // }
      //create a product

    }

    $cart = new Cart();

    $product_paths = $cart->get_products($unique_id, $dnt);
    $product_path_count = count($product_paths);

    $product_link_body = "This is the body ";

    $address_domain = "";
    if (!isset($_SERVER['HTTPS'])) {
      $address_domain = "http:localhost";
    } else {
      $address_domain = "https:localhost";
    }
    for ($i = 0; $i < $product_path_count; $i++) {

      $product_link_body .=  $address_domain . $product_paths[$i] . "<br>";
    }




    $sendmail = "kannadhasanragujan@gmail.com";
    $header = "Hey Hi";
    $body = "This is text message";
    // $email = new  SendEmail($sendmail,$header,$body);
   
    break;


  default:
    echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);

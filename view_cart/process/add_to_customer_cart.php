<?php
session_start();

require "../query/CheckUser.php";
if (isset($_SESSION["userEmail"])) {
    $email = $_SESSION["userEmail"];
    $cartItems = $_POST["array"];

    $array = json_decode($cartItems);
    $customerQuery = new CheckUser();
    $getId = $customerQuery->getCusIdByEmail($email);
    //echo $customerQuery->getCustomerCart($email);
    if ($array == null) {
        return;
    }
    foreach ($array as $c) {
        if (intval($c->id) && intval($c->qty) && $c->id > 0 && $c->qty > 0) {
            echo  $customerQuery->checkCusIdinCartByEmail($email, $c->id, $c->qty);
        } else {
            echo "not a valid input";
        }

        // 

    }
}

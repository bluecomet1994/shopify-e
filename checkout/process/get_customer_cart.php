<?php
session_start();

require "../query/User.php";
if (isset($_SESSION["userEmail"])) {
    $email = $_SESSION["userEmail"];
 


    $customerQuery = new User();
    $getId = $customerQuery->getCusIdByEmail($email);
    $cartArray = $customerQuery->getCustomerCart($email);
    echo json_encode($cartArray);

}
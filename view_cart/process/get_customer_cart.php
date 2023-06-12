<?php
session_start();

require "../query/CheckUser.php";
if (isset($_SESSION["userEmail"])) {
    $email = $_SESSION["userEmail"];
      


    $customerQuery = new CheckUser();
    $getId = $customerQuery->getCusIdByEmail($email);
    $cartArray = $customerQuery->getCustomerCart($email);
    echo json_encode($cartArray);

}
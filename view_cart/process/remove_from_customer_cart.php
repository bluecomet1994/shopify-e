<?php
session_start();


if (isset($_SESSION["userEmail"])) {
    require "../query/CheckUser.php";
    $email = $_SESSION["userEmail"];
    if (isset($_POST["id"]) && isset($_POST["cart"])) {
        $cart = json_decode($_POST["cart"]);
        $id = $_POST["id"];
        $newArray = array();
        $customerQuery = new CheckUser();
        foreach ($cart as $c) {
            if ($c->id != $id) {
                $subarray = array("id" => $c->id, "qty" => $c->qty);
                array_push($newArray, $subarray);
            } else if ($c->id == $id) {
                $customerQuery->removeRowsFromCustomerCart($email, $c->id);
            }
        }
        echo json_encode($newArray);
    }
} else if (!isset($_SESSION["userEmail"])) {
  
    if (isset($_POST["id"]) && isset($_POST["cart"])) {
        $cart = json_decode($_POST["cart"]);
        $id = $_POST["id"];
        $newArray = array();
        
        foreach ($cart as $c) {
            if ($c->id != $id) {
                $subarray = array("id" => $c->id, "qty" => $c->qty);
                array_push($newArray, $subarray);
            } 
        }
        echo json_encode($newArray);
    }
}

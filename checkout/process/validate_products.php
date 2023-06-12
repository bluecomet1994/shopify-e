<?php
$cart = json_decode($_POST["cart"]);

require_once "../query/Samples.php";
$object = new Samples();
$validCart = array();
foreach ($cart as $sample) {

    if ($object->checkId(($sample->id))) {
        array_push($validCart, array("id" => $sample->id, "qty" => $sample->qty));
    }
}

echo json_encode($validCart);

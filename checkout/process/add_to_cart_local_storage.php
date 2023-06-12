<?php

if ($_POST["id"] && !empty($_POST["id"]) && $_POST["id"] > 0 &&   $_POST["qty"] && $_POST["qty"] > 0  && !empty($_POST["qty"])) {
    require "../query/QueryFunctions.php";
    $ID = $_POST["id"];
    $QTY = $_POST["qty"];
    if (intval($ID) && intval($QTY) && $ID > 0 && $QTY > 0) {
        $object = new QueryFunctions();
        $row = $object->validateCardproductID($ID);
        if ($row == 1) {
            $validatedArray = array("id" => $ID, "qty" => $QTY);
            echo  json_encode($validatedArray);
        } else {
            $errorArray = array("id" => "Nope");
            echo  json_encode($errorArray);
        }
    } else {
        $errorArray = array("id" => "Nope");
        echo  json_encode($errorArray);
    }

?>
      
<?php
} else {
    $errorArray = array("ID" => "Nope");
    echo  json_encode($errorArray);
}
?>
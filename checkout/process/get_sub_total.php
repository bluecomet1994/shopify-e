<?php

if(isset($_POST["cartRows"])){
    $cartRows = $_POST["cartRows"];
    $subTotal=0;
    $a= json_decode($cartRows);
    require "../query/QueryFunctions.php";
    $object = new QueryFunctions();
    foreach($a as $c){
        if(intval($c->id) && $c->id>0 && intval($c->qty) && $c->qty>0){
            $pid= $c->id;
            $cartQty = $c->qty;
            $rowArray = $object->showCartRows($pid);
            $rowArray = $rowArray[0];
            $sPrice=  $rowArray["SamplePrice"]*$cartQty;
           
            $subTotal = $subTotal+$sPrice;
          
        }
        
    }
    echo $subTotal;
}
?>
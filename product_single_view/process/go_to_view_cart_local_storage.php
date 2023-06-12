<?php

if ($_POST["id"] && !empty($_POST["id"]) ) {
    require "../query/Sample_query_functions.php";
    $ID = $_POST["id"];
   
    if (intval($ID) && $ID>0 ) {
        $object = new Sample_query_functions();
        $row = $object->validateCardproductID($ID);
        if ($row == 1) {
            $validatedArray = array("id"=>$ID,"qty"=> 1);
           echo  json_encode($validatedArray);
        }else{
            $errorArray = array("id"=>"Nope");
            echo  json_encode($errorArray);
        }
    } else {
        $errorArray = array("id"=>"Nope");
        echo  json_encode($errorArray);
    }

?>
    
      
    
<?php
}else{
    $errorArray = array("ID"=>"Nope");
    echo  json_encode($errorArray);
}
?>
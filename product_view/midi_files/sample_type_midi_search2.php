<?php
require "../query/midi_search_query.php";
require "../utils/pagination.php";
require "../utils/product_view.php";
require "../utils/page_buttons.php";
require "../utils/Validations.php";
$object = new MidiSearchQueries();
$search_text = "";
$current_page_number = "0";
$validation_status = "0";
if (isset($_POST["current_page_number"])) {
  $current_page_number =  Validations::removeSpecialCharacters($_POST["current_page_number"]);
  $validation_status =  Validations::validatePageNumbers($current_page_number);
  echo "current page number is received " . $current_page_number ;
}else{
  $validation_status = 1;
  $current_page_number = "0";
}
if (isset($_POST["search_text"])) {
  $search_text = Validations::removeSpecialCharacters($_POST["search_text"]);
  if($search_text == ""){
    echo "search text is empty";
  }
  
}


$getRows;
$valueforBTN;
$exactResultsPerPage = $object->getExactResultsPerPage();
echo " validation status is ". $validation_status;
$jsMethodName = "nextfunctionsearch";
$pageName = str_replace(array('.php'), '', basename(__FILE__));
if ($validation_status == 1) {


  if ($search_text == "" ) {

    $getPages = $object->searchByTextPagesMidi($_POST["search_text"]);
    if ($current_page_number >= $getPages) {
      $current_page_number = $getPages;
    } else if ($current_page_number <= 0) {
      $current_page_number = 0;
    }
    $getRows = $object->searchByTextMidi($_POST["search_text"], $current_page_number * $exactResultsPerPage);
    $valueforBTN = 0;
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
  } else  if ($_POST["search_text"] !== "") {

    $getPages = $object->searchByTextPagesMidi($_POST["search_text"]);
    if ($current_page_number >= $getPages) {
      $current_page_number = $getPages;
    } else if ($current_page_number <= 0) {
      $current_page_number = 0;
    }
    $getRows = $object->searchByTextMidi($_POST["search_text"], $current_page_number * $exactResultsPerPage);
    $valueforBTN = $search_text;
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
  }

  $htmlContentObject = new ProductView();
  echo $htmlContentObject->view_midi_samples($getRows, $allowedPages, $current_page_number, $search_text, $pageName, $jsMethodName);
} else {
  echo "Nope";
}

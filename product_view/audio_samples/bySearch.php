<?php
require "../query/Sample_query_functions.php";
require "../utils/pagination.php";
require "../utils/product_view.php";
require "../utils/page_buttons.php";
$query_object = new Sample_query_functions();
$pageName = str_replace( array( '.php' ), ' ', basename(__FILE__));
$jsMethodName = "nextfunctionsearch";
$allowedPages = 0;
$valueforBTN = 0;
$exactResultsPerPage = $query_object->getExactResultsPerPage();

$current_page_number;
if(isset($_POST["search_text"])){


if (isset($_POST["current_page_number"]) && intval(($_POST["current_page_number"])) && !empty(($_POST["current_page_number"]))   && isset($_POST["search_text"])) {
   
    $current_page_number = $_POST["current_page_number"];
    $search_text = $_POST["search_text"];
    $valueforBTN = $search_text;
    $max_page_count = $query_object->searchByTextPages($search_text);
    if ($current_page_number >= $max_page_count) {
        $current_page_number = $max_page_count;
    } else if ($current_page_number <= 0) {
        $current_page_number = 0;
    }

    $melody = $query_object->searchByText($search_text, $current_page_number * $exactResultsPerPage);
    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else if (isset($_POST["search_text"])) {
    $current_page_number = 0;
    
    $search_text = $_POST["search_text"];
    if ($search_text == "") {
      
    }
    
    $valueforBTN = $search_text;
    $max_page_count = $query_object->searchByTextPages($search_text);
    if ($current_page_number >= $max_page_count) {
        $current_page_number = $max_page_count;
    } else if ($current_page_number <= 0) {
        $current_page_number = 0;
    }
    $melody = $query_object->searchByText($search_text, 0);
    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else if (isset($_POST["current_page_number"])) {
    $current_page_number = $_POST["current_page_number"];

    $search_text = "";
   
    $valueforBTN = $search_text;
    $max_page_count = $query_object->searchByTextPages($search_text);
    if ($current_page_number >= $max_page_count) {
        $current_page_number = $max_page_count;
    } else if ($current_page_number <= 0) {
        $current_page_number = 0;
    }
    $melody = $query_object->searchByText($search_text, 0);
    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else {

    $current_page_number = 0;
    
    $valueforBTN = "null";
    $melody = $query_object->searchByText($search_text, $current_page_number * $exactResultsPerPage);
    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
}
$getRows = $melody;
$htmlContentquery_object = new ProductView();
echo $htmlContentquery_object->view_audio_samples($getRows, $allowedPages, $current_page_number, $valueforBTN, $pageName,$jsMethodName);
}
if(isset($_POST["sub_sample_id"])){

}
?>

<?php
require "../query/Sample_query_functions.php";
require "../utils/pagination.php";
require "../utils/product_view.php";
require "../utils/page_buttons.php";
require "../utils/Validations.php";

$query_object = new Sample_query_functions();
$pageName = str_replace(array('.php'), '', basename(__FILE__));
$allowedPages = 0;
$valueforBTN = 0;
$exactResultsPerPage = $query_object->getExactResultsPerPage();
$DefaultSampleTypeNumber = 1;
$jsMethodName = "commonNextFunction";
$current_page_number;


$total_pages;
//validation
if (isset($_POST["current_page_number"]) && isset($_POST["sub_sample_id"])) {
    // echo "page number and sub sample id is received";
    if (!Validations::validateTypeIds($_POST["sub_sample_id"])) return;
    if (!Validations::validatePageNumbers($_POST["current_page_number"])) return;
}

if (isset($_POST["current_page_number"])) {
    // echo "Page number is received";
    if (!Validations::validatePageNumbers($_POST["current_page_number"])) return;
}
if (isset($_POST["sub_sample_id"])) {
    // echo "sub sample id is received";
    if (!Validations::validateTypeIds($_POST["sub_sample_id"])) return;
}
if (!isset($_POST["current_page_number"]) && !isset($_POST["sub_sample_id"])) {
    // echo "neither page number or sub sample id is received";
}


if (isset($_POST["current_page_number"]) && isset($_POST["sub_sample_id"])) {

    //if page number and the sub sample id is sent to the server 
    $current_page_number = $_POST["current_page_number"];
    $subsampletypenumber = $_POST["sub_sample_id"];

    if ($subsampletypenumber == 0) {
        // if the sub sample type number is zero which means 
        $valueforBTN = 0;

        $max_page_count = $query_object->sampleTypePages($DefaultSampleTypeNumber);
        if ($current_page_number >= $max_page_count) {
            $current_page_number = $max_page_count;
        } else if ($current_page_number <= 0) {
            $current_page_number = 0;
        }

        $results_per_page = $query_object->sampleType($DefaultSampleTypeNumber, $current_page_number * $exactResultsPerPage);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    } else {
        //if the sub sample type number is not zero and the page number is received
        $valueforBTN = $subsampletypenumber;
        $max_page_count = $query_object->subSampleTypePages($subsampletypenumber);
        if ($current_page_number >= $max_page_count) {
            $current_page_number = $max_page_count;
        } else if ($current_page_number <= 0) {
            $current_page_number = 0;
        }
        $results_per_page = $query_object->subSampleType($subsampletypenumber, $current_page_number * $exactResultsPerPage);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    }
} else if (isset($_POST["current_page_number"])) {
    $current_page_number = $_POST["current_page_number"];

    $valueforBTN = 0;
    $max_page_count = $query_object->sampleTypePages($DefaultSampleTypeNumber);
    if ($current_page_number >= $max_page_count) {
        $current_page_number = $max_page_count;
    } else if ($current_page_number <= 0) {
        $current_page_number = 0;
    }

    $results_per_page = $query_object->SampleType($DefaultSampleTypeNumber, $current_page_number * $exactResultsPerPage);
    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else {
    //incase it didn't receive any numbers or sample ids it will send this section as default
    $current_page_number = 0;
    $valueforBTN = 0;
    $results_per_page = $query_object->sampleType($DefaultSampleTypeNumber, $current_page_number * $exactResultsPerPage);

    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
}
$htmlContentObject = new ProductView();
echo $htmlContentObject->view_audio_samples($results_per_page, $allowedPages, $current_page_number, $valueforBTN, $pageName, $jsMethodName);

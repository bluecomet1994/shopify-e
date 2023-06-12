<?php
require "../query/midi_search_query.php";
require "../utils/pagination.php";
require "../utils/product_view.php";
require "../utils/page_buttons.php";
$query_object = new MidiSearchQueries();
$pageName = str_replace(array('.php'), ' ', basename(__FILE__));
$jsMethodName = "nextfunctionsearch";
$allowedPages = 0;
$valueforBTN = 0;
$exactResultsPerPage = $query_object->getExactResultsPerPage();

$current_page_number;

if (isset($_POST["current_page_number"]) && isset($_POST["search_text"])) {
    // echo "page number and serach text id is received <br>";
} else if (isset($_POST["current_page_number"])) {
    // echo "Page number is received <br>";
} else if (isset($_POST["search_text"])) {
    // if ($_POST["search_text"] == "") {
    //     echo "sub search text is empty";
    // }
    // // echo "sub search text is received <br>";
} else if (!isset($_POST["current_page_number"]) && !isset($_POST["search_text"])) {
    // echo "neither page number or search text  is received <br>";
}

if (isset($_POST["search_text"])) {


    if (isset($_POST["current_page_number"]) && intval(($_POST["current_page_number"])) && !empty(($_POST["current_page_number"]))   && isset($_POST["search_text"])) {
  
        $current_page_number = $_POST["current_page_number"];
        $search_text = $_POST["search_text"];
        $valueforBTN = $search_text;
        $max_page_count = $query_object->searchByTextPagesMidi($search_text);
        if ($current_page_number >= $max_page_count) {
            $current_page_number = $max_page_count;
        } else if ($current_page_number <= 0) {
            $current_page_number = 0;
        }

        $melody = $query_object->searchByTextMidi($search_text, $current_page_number * $exactResultsPerPage);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    } else if (isset($_POST["search_text"])) {
        // echo "hey search text came here";
        $current_page_number = 0;

        $search_text = $_POST["search_text"];
        if ($search_text == "") {
        }

        $valueforBTN = $search_text;
        $max_page_count = $query_object->searchByTextPagesMidi($search_text);
        if ($current_page_number >= $max_page_count) {
            $current_page_number = $max_page_count;
        } else if ($current_page_number <= 0) {
            $current_page_number = 0;
        }
        $melody = $query_object->searchByTextMidi($search_text, 0);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    } else if (isset($_POST["current_page_number"])) {
        $current_page_number = $_POST["current_page_number"];

        $search_text = "";

        $valueforBTN = $search_text;
        $max_page_count = $query_object->searchByTextPagesMidi($search_text);
        if ($current_page_number >= $max_page_count) {
            $current_page_number = $max_page_count;
        } else if ($current_page_number <= 0) {
            $current_page_number = 0;
        }
        $melody = $query_object->searchByTextMidi($search_text, 0);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    } else {
        $current_page_number = 0;

        $valueforBTN = "null";
        $melody = $query_object->searchByTextMidi($search_text, $current_page_number * $exactResultsPerPage);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    }
    $getRows = $melody;
    $htmlContentquery_object = new ProductView();
    echo $htmlContentquery_object->view_midi_samples($getRows, $allowedPages, $current_page_number, $valueforBTN, $pageName, $jsMethodName);
}
if (isset($_POST["sub_sample_id"])) {
}

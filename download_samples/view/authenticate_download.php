<?php



$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$folder_creation_path = GlobalLinkFiles::getFilePath("folder_creation");
$style_path = GlobalLinkFiles::getDirectoryPath("style");
$home_page_shortend = GlobalLinkFiles::getRelativePath("home_page_shortend");
$header_url = GlobalLinkFiles::getFilePath("header_url");
require_once $header_url;
require_once "../util/Validation.php";
require_once "../query/Cart.php";

$link = "http://localhost/sampleSelling-master/download_samples/view/authenticate_download.php?unique_id=6374abd38d577&dnt=2022-11-16%2010:22:27";
$style = $style_path . "authenticate_download.css";
$bootstap_path = $style_path . "bootstrap.css";
$sample_selling_path = $style_path . "sampleselling.css";

$unique_id;
$dnt;


//if it didn't receivethe request parameters through get request then redirect to homepage
//and kill the script
if (!isset($_GET["unique_id"]) || !isset($_GET["dnt"])) {

    HeaderUrl::headerFunction($home_page_shortend);
    die();
}


//make sure credentials are valid
if (isset($_GET["unique_id"]) && isset($_GET["dnt"])) {

    $cart = new Cart();
    $unique_id = $_GET["unique_id"];
    $dnt = $_GET["dnt"];

    //validate the unique id and dnt for security
    if (!Validation::isCustomerPurchaseIdValid($unique_id) || !Validation::isDateTimeValid($dnt)) {
        HeaderUrl::headerFunction($home_page_shortend);
        die();
    }


    //make sure these are in the tables, if not redirect to homepage and kill the script
    $status = $cart->confirmCustomerPurchase($unique_id, $dnt);
    if (!$status) {
        HeaderUrl::headerFunction($home_page_shortend);
        die();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $bootstap_path ?>">
    <link rel="stylesheet" href="<?= $sample_selling_path ?>">
    <link rel="stylesheet" href="<?= $style ?>">
    <title>authenticate_download</title>

</head>

<body>
    <div class="container-fluid">


        <div id="warning_div" class="bg-danger col-lg-6 offset-lg-3 col-10 offset-1  mt-3 py-2 px-2 fw-bold warningInfoDiv">
            <div>
                <span><b>Important! Please follow these guidance to avoid any troubles </b></span>
            </div>
            <div>
                <ul>

                    <li>Please do not share this link
                        <br>
                        <p>If someone downlaods before you, you won't be able to download the products
                            No repayment or redownloads allowed if it is not a server side mistake
                        </p>
                    </li>
                </ul>
                <ul>


                    <li>You can only download one time so be aware
                        <br>
                        <p>Once it shows where to download, that is considered as a download.
                            So, whatever the location is just download it to your PC first


                        </p>
                    </li>

                </ul>
                <ul>


                    <li>This is an onetime download link so be careful
                        <br>
                        <p>Since the samples sizes aren't huge make sure to download
                            them and have a good internet connection


                        </p>
                    </li>

                </ul>
            </div>
            <div class="text-end">
                <div>
                    <button onclick="acceptBtnProcess('<?= $unique_id ?>','<?= $dnt ?>');" id="accept-btn" class="accept-btn">accept</button>
                </div>
            </div>

        </div>
        <div class="row  p-5">
            <div id="download-form" class="col-12 d-none ">

            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
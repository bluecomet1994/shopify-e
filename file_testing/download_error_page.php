<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$home_page_shortend = GlobalLinkFiles::getRelativePath("home_page_shortend");
$authenticate_download_url = GlobalLinkFiles::getRelativePath("authenticate_download");
$header_url = GlobalLinkFiles::getFilePath("header_url");
require_once $header_url;
if (!isset($_GET["error_code"])) {

    // HeaderUrl::regularHeaderFunction($home_page_shortend);
    // exit();
}

if (isset($_GET["error_code"])) {

    $error_code = $_GET["error_code"];

    $html_content_error_message;

    if ($error_code == "0001") {

        $html_content_error_message =  "<div class='col-lg-6 offset-lg-3 p-4 col-md-8 offset-md-2 col-10 offset-1'>
            <h3><b>Wrong credentials</b></h3>
            <p>Do not edit or change any values in those two fields </p>
            <h5><a href={$home_page_shortend}>Back to home page</a></h5>
        </div> ";
    } else if ($error_code == "0003") {
        $html_content_error_message =  "<div class='col-lg-6 offset-lg-3 p-4 col-md-8 offset-md-2 col-10 offset-1'>
            <h3><b>Wrong credentials</b></h3>
            <p>Do not edit or change any values in those two fields </p>
            <h5><a href={$home_page_shortend}>Back to home page</a></h5>
        </div> ";
    } else {
        $html_content_error_message =  "<div style='height:100vh;' class='col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-10 offset-1  d-flex align-items-center justify-content-center'>

        <h1><a href={$home_page_shortend}>Back to home page</a></h1>
    </div> ";
    }


    if (isset($_GET["unique_id"]) && isset($_GET["dnt"])) {
        $unique_id = $_GET["unique_id"];
        $dnt = $_GET["dnt"];
        $url_dnt = str_replace(" ", "%20", $dnt);
        $authentication_url_with_localhost = HeaderUrl::getUrl($authenticate_download_url);
        $authenticate_download_url_with_paramenters = $authentication_url_with_localhost . "?unique_id={$unique_id}&dnt={$url_dnt}";
        if ($error_code == "0002") {
            $html_content_error_message =  "<div class='col-lg-6 offset-lg-3 p-4 col-md-8 offset-md-2 col-10 offset-1'>
            <h3><b>You already downloaded this product</b></h3>
            <p>This seems you are trying to download more than once,
             this system allows you to download only one time after a purchase.
             We already gave instructions on how to download in the download page
             </p>
             <h5><a href={$home_page_shortend}>Back to home page</a></h5>
             <h5><a href={$authenticate_download_url_with_paramenters}>Back to download page</a></h5>
        </div> ";
        } else if ($error_code == "0004") {
            $html_content_error_message =  "<div class='col-lg-6 offset-lg-3 p-4 col-md-8 offset-md-2 col-10 offset-1'>
                <h3><b>Please go back and refersh the page or try to redownload if the download didn't show up</b></h3>
                <p>If the downlaod location already shown then it is considered as a download </p>
                <h5><a href={$home_page_shortend}>Back to home page</a></h5>
                <h5><a href={$authenticate_download_url_with_paramenters}>Back to download page</a></h5>
            </div> ";
        } else if ($error_code == "0005") {
            $html_content_error_message =  "<div class='col-lg-6 offset-lg-3 p-4 col-md-8 offset-md-2 col-10 offset-1'>
            <h3><b>Please go back and refersh the page or try to redownload if the download didn't show up</b></h3>
            <p>If the downlaod location already shown then it is considered as a download </p>
            <h5><a href={$home_page_shortend}>Back to home page</a></h5>
            <h5><a href={$authenticate_download_url_with_paramenters}>Back to download page</a></h5>
        </div> ";
        }
    }

    $folder_creation_path = GlobalLinkFiles::getFilePath("folder_creation");
    $style_path = GlobalLinkFiles::getDirectoryPath("style");
    $home_page_shortend = GlobalLinkFiles::getRelativePath("home_page_shortend");
    $style = $style_path . "download_error_page";
    $bootstap_path = $style_path . "bootstrap.css";
    $sample_selling_path = $style_path . "sampleselling.css";
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
        <title>Download error page</title>
    </head>

    <body>
        <div class="">
            <?php echo $html_content_error_message ?>

        </div>
    </body>

    </html>

<?php
}
?>
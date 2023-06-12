<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$folder_creation_path = GlobalLinkFiles::getFilePath("folder_creation");
$style = GlobalLinkFiles::getDirectoryPath("style");
$home_page_shortend = GlobalLinkFiles::getRelativePath("home_page_shortend");
$header_url = GlobalLinkFiles::getFilePath("header_url");
$download_error_page = GlobalLinkFiles::getRelativePath("download_error_page");

require_once $header_url;
$protocol= "http";
if(isset($_SERVER["HTTPS"])){
   $protocol = "https";
}
$host_name = "";
if(array_key_exists("HTTP_HOST",$_SERVER)){
    $host_name = $_SERVER["HTTP_HOST"];
   
}
$link = "http://localhost/sampleSelling-master/file_testing/authenticate_download.php?unique_id=6374abd38d577&dnt=2022-11-16%2010:22:27";
$authenticate_download_url = $protocol."://{$host_name}";
$header = $authenticate_download_url.$home_page_shortend;
echo HeaderUrl::getUrl($download_error_page);
echo "<br>";
$authenticate_download_url = GlobalLinkFiles::getRelativePath("authenticate_download");
echo HeaderUrl::getUrl($authenticate_download_url);
//  HeaderUrl::headerFunction($home_page_shortend);
// header($header);
// header("http:localhost/sampleSelling-master/homepage.php");
// header('location:'.$header);
exit();
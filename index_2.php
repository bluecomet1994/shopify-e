<?php
$pageName = str_replace(array('.php'), '', basename(__FILE__));
echo $pageName;

echo 'PHP version: ' . phpversion();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$vendor_path = GlobalLinkFiles::getFilePath("vendor_autoload");
$sendEmail_path = GlobalLinkFiles::getFilePath("send_email");
$authenticate_download_url = GlobalLinkFiles::getRelativePath("authenticate_download");
echo "<br>";
echo $authenticate_download_url;
echo "<br>";
if(array_key_exists("HTTP_HOST",$_SERVER)){
    $host_name = $_SERVER["HTTP_HOST"];
    echo $host_name;
}
echo "______________";
echo "<br>";

$protocol= "http";
if(isset($_SERVER["HTTPS"])){
   $protocol = "https";
}
$host_name = "";
if(array_key_exists("HTTP_HOST",$_SERVER)){
    $host_name = $_SERVER["HTTP_HOST"];
    echo $host_name;
}
$link = "http://localhost/sampleSelling-master/file_testing/authenticate_download.php?unique_id=6374abd38d577&dnt=2022-11-16%2010:22:27";
$authenticate_download_url = $protocol."://{$host_name}{$authenticate_download_url}";

$unique_id = "6374abd38d577";
$dnt = "2022-11-16%2010:22:27";
$authenticate_download_url_parameters = $authenticate_download_url."?unique_id={$unique_id}&dnt={$dnt}";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta harset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="mydiv"></div>
    <form action="backend.php" method="post">
        <input type="text" name="HEY" value="RAGJN">
        <button type="submit">click</button>
    </form>
    <select id="abc">
        <option value="abc">abc</option>
        <option value="rag">rag</option>
    </select>
    <button onclick="clickFunction();">click</button>
<a href='#'>DDD</a>
    <input id="myfile" type="file">

    <script src="script.js"></script>
</body>

</html>
<?php

    $abc = "ragmarshall";
    $abc = "ragmarshall";
    $abc = "ragmarshall";
    $abc = "ragmarshall";
    $abc = "ragmarshall";
    $abc = "ragmarshall";

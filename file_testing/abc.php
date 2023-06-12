<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$folder_creation_path = GlobalLinkFiles::getFilePath("folder_creation");

$file = $ROOT . "/sampleSelling-master/file_testing/a.zip";
echo $file;
echo "<br>";
echo "<br>";


if (file_exists($file)) {

    $newly_generated_name = uniqid() . uniqid(). "product.zip";

    //initialzie a unique folder name
    $folder_name = $folder_creation_path . uniqid() . "folder_rag";

    //make folder

    echo "<br>";

    mkdir($folder_name);

    //newly generated path 
    $newly_generated_path = $folder_name . "/" . $newly_generated_name;
    echo "HELLO HELLO";
    echo "<br>";
    echo $newly_generated_path;
    //copy the zip file to that directoy
    $copy =  copy($file, $newly_generated_path);
    if ($copy) {
        echo "copying is sucess";
    } else {
        echo "copying isn't successful at all ";
    }
    echo "<br>";
    echo "root is " . $ROOT;
    echo "<br>";
    echo "Newly generated path is " . $newly_generated_path;
    if (file_exists($newly_generated_path)) {
        echo "<br>";
        echo "file exits";
    } else {
        echo "<br>";
        echo "file does not exits";
    }
} else {
    echo "No File is found";
}
echo "<br>";
// //download section 

// header('Content-Description: File Transfer');
// header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename="'
//     . basename($newly_generated_path) . '"');
// header('Expires: 0');
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
// header('Content-Length: ' . filesize($newly_generated_path));


// flush();
// readfile($newly_generated_path);
// unlink($newly_generated_path);
// rmdir($folder_name);



//replace the root directory with localhost
// now c/exampp/abc.php  will be localhost/abc.php
// $newly_generated_path = str_replace($ROOT, "localhost", $newly_generated_path);
// echo "now the newly generated path is " . $newly_generated_path;





// $download_url = $newly_generated_path;


//purchase_unique_id
// $purchased_unique_id = "?unique_id=abcded2021-11-10 10:47:42";
// $download_url = $download_url . $purchased_unique_id;
// echo $download_url;

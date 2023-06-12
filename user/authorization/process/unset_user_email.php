<?php


// if(isset($_SESSION['userEmail'])){
//     session_destroy ();
    

// }

session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$home_path = GlobalLinkFiles::getRelativePath("home_page_shortend");
unset($_SESSION['userEmail']);
if(isset($_SESSION['userEmail'])){
    echo "blah blah rasputin";
}else{

}
 header("Location: http://localhost/{$home_path}"); 
?>
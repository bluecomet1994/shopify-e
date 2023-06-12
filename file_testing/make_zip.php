<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$pathdir = "$ROOT/sampleSelling-master/folder_creation/"; 
echo $pathdir;
  
// Enter the name to creating zipped directory
$zipcreated = "abc.php";
  
// Create new zip class
$zip = new ZipArchive;
   
if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {
      
    // Store the path into the variable
    $dir = opendir($pathdir);
       
    while($file = readdir($dir)) {
        if(is_file($pathdir.$file)) {
            $zip -> addFile($pathdir.$file, $file);
        }
    }
    $zip ->close();
}
<?php

$type;
$name;
if (  $_POST["name"]) {
 
    $name = $_POST["name"];
    require_once "../path_config/global_link_files.php";

    echo  GlobalLinkFiles::getRelativePath($name);
}

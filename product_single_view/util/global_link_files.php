<?php

use GlobalLinkFiles as GlobalGlobalLinkFiles;

class GlobalLinkFiles
{

    static $root_dir;


    public static function getFilePath($path_name)
    {
        if (GlobalGlobalLinkFiles::$root_dir == null) {
            GlobalGlobalLinkFiles::$root_dir = $_SERVER["DOCUMENT_ROOT"] . "/sampleSelling-master/product_single_view/util/";
        }
        $file = $file =  GlobalGlobalLinkFiles::$root_dir . "file_paths.json";
        $unparsed_json_file = file_get_contents($file);
        $object = json_decode($unparsed_json_file);
        $actual_path = "";
        foreach ($object->paths as $key => $value) {
            if ($value->path_name == $path_name) {
                $actual_path = $value->actual_path;
                break;
            }
        }
        return $_SERVER['DOCUMENT_ROOT'] . $actual_path;
    }
    public static function getRelativePath($path_name)
    {
        if (GlobalGlobalLinkFiles::$root_dir == null) {
            GlobalGlobalLinkFiles::$root_dir = $_SERVER["DOCUMENT_ROOT"] . "/sampleSelling-master/product_single_view/util/";
        }
        $file =  GlobalGlobalLinkFiles::$root_dir . "file_paths.json";
     
        $unparsed_json_file = file_get_contents($file);
        $object = json_decode($unparsed_json_file);
        $actual_path = "";
        foreach ($object->paths as $key => $value) {
            if ($value->path_name == $path_name) {
                $actual_path = $value->actual_path;
                break;
            }
        }
        return  $actual_path;
    }
    public static function getDirectoryPath($path_name)
    {
        if (GlobalGlobalLinkFiles::$root_dir == null) {
            GlobalGlobalLinkFiles::$root_dir = $_SERVER["DOCUMENT_ROOT"] . "/sampleSelling-master/product_single_view/util/";
        }
        $file = $file =  GlobalGlobalLinkFiles::$root_dir . "directory_paths.json";
        $unparsed_json_file = file_get_contents($file);
        $object = json_decode($unparsed_json_file);
        $actual_path = "";
        foreach ($object->paths as $key => $value) {

            if ($value->directory_name == $path_name) {
                $actual_path = $value->actual_path;
                break;
            }
        }
        return  $actual_path;
    }
}

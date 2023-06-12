<?php


class GlobalLinkFiles
{
    public static function getFilePath($path_name)
    {
        //to get the file path with root directory 
        //for linking resources 
        $file = $_SERVER["DOCUMENT_ROOT"] . "/sampleSelling-master/util/path_config/file_paths.json";
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
    public static function getRelativePath($path_name){
        //for linking pages and javascript pages  
        $file = $_SERVER["DOCUMENT_ROOT"] . "/sampleSelling-master/util/path_config/file_paths.json";
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
        //to get folder directories not the file 
        //example ../db/folder_1
        $file = $_SERVER["DOCUMENT_ROOT"] . "/sampleSelling-master/util/path_config/directory_paths.json";
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


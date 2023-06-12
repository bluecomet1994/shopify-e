<?php

class DirectoryZip
{
    private $zip_creation_failed;
    private $zip_file_name;
    private $folder_to_be_zipped;
    function __construct($zip_file_name, $folder_to_be_zipped)
    {
        $this->zip_creation_failed = false;
        $this->zip_file_name = $zip_file_name;
        $this->folder_to_be_zipped = $folder_to_be_zipped;

    }
    public function getZipCreationStatus(){
        //if zip creation failed return false
        //if zip creation succeeded return true
        $status = false;
        if($this->zip_creation_failed == false){
            $status = true;
        }
        return $status;
    }
    public function makeDirectory()
    {   $status = false;
        $zip = new ZipArchive;
        if ($zip->open($this->zip_file_name, ZipArchive::CREATE) === TRUE) {
            //open directory
            if ($handle = opendir($this->folder_to_be_zipped)) {

                // Add all files inside the directory
                while (false !== ($entry = readdir($handle))) {

                    if ($entry != "." && $entry != ".." && !is_dir("$this->folder_to_be_zipped/" . $entry)) {
                        $add_file_status = $zip->addFile("$this->folder_to_be_zipped/" . $entry);
                        if (!$add_file_status) {
                            $this->zip_creation_failed = true;
                            break;
                        }
                    }
                }
                closedir($handle);
            }

            $zip->close();
            if ($this->zip_creation_failed) {
                unlink($this->zip_file_name);
            }
        } else {
            echo "Error";
        }
     
    }
}
// $zip_file_name = 'test_folder_change.zip';
// $folder_to_be_zipped = 'rag';

// $zip = new DirectoryZip($zip_file_name,$folder_to_be_zipped);
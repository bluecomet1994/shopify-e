<?php
require_once "../utils/Validations.php";
require_once "../utils/sample_unique_process.php";
require_once "../query/sample_queries.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/sampleSelling-master/util/path_config/global_link_files.php";

$image_path = GlobalLinkFiles::getDirectoryPath("audio_sample_image");

$zip_path = GlobalLinkFiles::getDirectoryPath("audio_sample_zip_file");

$audio_src_path = GlobalLinkFiles::getDirectoryPath("audio_sample_audio");

$file_handler_path = GlobalLinkFiles::getFilePath("file_handler");
$sname;
$sprice;
$subSampletype;
$sampledescription;

$sname_validation = false;
$sprice_validation = false;
$subSampletype_validation = false;
$sampledescription_validation = false;

$state_file = false;
$state_image = false;
$state_insert_query = false;

$file_insertion_state = false;
$file_uploading_state = false;
$image_insertion_state = false;
$image_uploading_state = false;

require_once $file_handler_path;
if (isset($_POST["SampleName"]) && !empty($_POST["SampleName"])) {
    $sname = Validations::removeSpecialCharacters($_POST["SampleName"]);
    $sname_validation = true;
}
if (isset($_POST["SamplePrice"]) && !empty($_POST["SamplePrice"])) {
    if (Validations::checkPrice($_POST["SamplePrice"])) {
        $sprice = $_POST["SamplePrice"];
        $sprice_validation = true;
    }
}
if (isset($_POST["SampleDescription"]) && !empty($_POST["SampleDescription"])) {
    $sampledescription = Validations::removeSpecialCharacters($_POST["SampleDescription"]);
    $sampledescription_validation = true;
}
if (isset($_POST["SampleSubMelody"]) && !empty($_POST["SampleSubMelody"])) {
    $subSampletype = Validations::removeSpecialCharacters($_POST["SampleSubMelody"]);
    $subSampletype_validation = true;
}
$charLength = 25;
if (
    $sname_validation && $sprice_validation && $subSampletype_validation && $sampledescription_validation
) {

    if (isset($_FILES["SampleFile"])) {
        if (
            $_FILES["SampleFile"]["type"] == "application/x-zip-compressed" &&  $_FILES["SampleImage"]["type"] == "image/jpeg"
        ) {
            $query = new SampleQueries();

            $date = date("Y-m-d h:i:s");
            $sampleUniqueiDProcess = new SampleUniqueiDProcess();
            $checked_random_id = $sampleUniqueiDProcess->getCheckedRandomUniqueId();
            $state_insert_query = $query->insertSamples($sname, $date, $sprice, $subSampletype, $sampledescription, $checked_random_id);
            if ($state_insert_query) {
                $last_id = $query->get_sample_id($checked_random_id);

                if ($last_id != null) {

                    if (isset($_FILES["SampleFile"])) {
                        $fileHandlerforzip = new FileHandler();
                        $file_uploading_state =  $fileHandlerforzip->addFile($_FILES["SampleFile"], $zip_path, "50000000", "zip");
                        if ($file_uploading_state) {
                            $zippathname = $zip_path . $fileHandlerforzip->getFilename();
                            // DB::insert("INSERT INTO `samplePath`(`samplePath`,`sampleID`) VALUES ('" . $zippathname . "','" . $lastID . "') ");
                            $state = $query->insertAudioSampleZipSrc($zippathname, $last_id);
                            if ($state) {
                                $file_insertion_state = true;
                            }
                        }
                    }
                  
                    if (isset($_FILES["SampleImage"])) {

                        $fileHandlerforzip = new FileHandler();
                        $image_uploading_state = $fileHandlerforzip->addFile($_FILES["SampleImage"], $image_path, "50000000", "jpg");
                        if ($image_uploading_state) {
                            $imagepathname = $image_path . $fileHandlerforzip->getFilename();
                            $state = $query->insertImageSrc($imagepathname, $last_id);
                            if ($state) {
                                $image_insertion_state = true;
                            }
                        }
                        // DB::insert("INSERT INTO `sampleimages`(`source_URL`,`sampleID`) VALUES ('" . $imagepathname . "','" . $lastID . "') ");
                    }

                    if($image_insertion_state  && $file_insertion_state){
                        echo "Success";
                    }
                }
            }
        } else {

            echo "Not the exact file type ";
        }
    }
} else {
    if (!intval($_POST["SamplePrice"])) {
        echo "Invalid Input for sample price";
    }

    if (!isset($_FILES["SampleFile"])) {
        echo "No zip files has been uploaded";
    }
    if (!isset($_FILES["SampleAudio"])) {
        echo "No audio files has been uploaded";
    }
    if (!isset($_FILES["SampleImage"])) {
        echo "No Image files has been uploaded";
    }
}

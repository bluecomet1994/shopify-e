<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$style_path = GlobalLinkFiles::getDirectoryPath("style");
$resources_path = GlobalLinkFiles::getDirectoryPath("resources");
$site_header = GlobalLinkFiles::getFilePath("site_header_php");
$sample_display_script_page = GlobalLinkFiles::getRelativePath("audio_sample_display_page_script");
$server_side_script = GlobalLinkFiles::getRelativePath("server_side");
require_once "../query/Sample_query_functions.php";
$sample_display_melodies_process_div = "sample_display_melodies_process";
$sample_display_drums_process_div = "sample_display_drums_process";
require_once "../utils/secondary_navbar.php";
$page_name_title = "melodies and drums";
$div_id = "sub_sample_melody_id";
$method_name = "show_sub_melody_samples()";
$sample_type_name = "melodies";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $style_path ?>bootstrap.css">

    <link rel="stylesheet" href="<?= $style_path ?>showsamples.css">
    <link rel="stylesheet" href="<?= $style_path ?>navbar.css">

    <link rel="shortcut icon" href="<?=$resources_path?>/icon_images/logo_transparent.png" type="image/x-icon">
    <title>sample display </title>
</head>


<body>

    <div id="loadingScreen" class=" d-none loadingScreenDiv">
        <div class="loadingThing"></div>
    </div>

    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="maindiv col-12">
                    <div class="row">

                        <?php
                        require_once $site_header;
                        ?>



                        <div style="position: relative;" class="thecontentdiv  col-12 ">
                            <div class="row">
                                <div class="col-12 pt-4">
                                    <div class="row">
                                        <?php
                                        SecondaryNavbar::setHtmlContent($div_id,$method_name,$sample_type_name,$resources_path,$page_name_title);
                                        ?>
                                    </div>
               
                                </div>
                                <div id="mainsampleDiv" class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-12">
                                                    <hr class="HRTAG ">
                                                </div>
                                            </div>
                                        </div>

                                        <div id="<?= $sample_display_melodies_process_div ?>" style="padding-left: 2.5%;padding-right: 2.5%;" class="col-12 pb-5 pt-3">

                                        </div>


                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr class="HRTAG">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12  ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-1 col-md-2 col-3  text-center">
                                                            <span class="fs-5 fw-bolder">Filter By</span>
                                                        </div>
                                                        <div class="col-lg-11 col-md-10 col-9 text-start">
                                                            <select onchange="show_sub_drum_samples()" class="selectTAG py-1 px-1" id="sub_sample_drum_id">
                                                                <?php

                                                                $query_object = new Sample_query_functions();
                                                                $subsamples = $query_object->listSubSampleTypes("drums");
                                                                $arrsize = count($subsamples);
                                                                if (!$subsamples > 0) {
                                                                ?>
                                                                    <option class="text-white"> NOPE</option>
                                                                <?php

                                                                } else {
                                                                ?>
                                                                    <option value="ALL" class="text-white"> All</option>
                                                                    <?php
                                                                    for ($i = 0; $i < $arrsize; $i++) {
                                                                        $sampleName = $subsamples[$i]['subsampleName'];
                                                                        $sampleID = $subsamples[$i]['subsampleID'];

                                                                    ?>
                                                                        <option value="<?php echo $sampleID; ?>" class="text-white"> <?php echo $sampleName; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 " id="<?= $sample_display_drums_process_div ?>">

                                        </div>

                                    </div>
                                </div>
                                <div id="bySearch" style="padding-left: 5%;padding-right: 5%;" class="col-12 py-5">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="newDivId"></div>
    <script src="<?= $server_side_script ?>"></script>
    <script src="<?= $sample_display_script_page ?>"></script>


</body>

</html>
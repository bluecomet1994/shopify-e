<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$style_path = GlobalLinkFiles::getDirectoryPath("style");
$resources_path = GlobalLinkFiles::getDirectoryPath("resources");
$site_header = GlobalLinkFiles::getFilePath("site_header_php");
$script_path = GlobalLinkFiles::getRelativePath("midi_sample_display_page_script");
$secondary_navbar = GlobalLinkFiles::getRelativePath("secondary_navbar_display");
require_once "../query/Sample_query_functions.php";
require_once "../utils/secondary_navbar.php";
$page_name_title = "midi_kits";
$div_id = "sub_sample_id_midies";
$method_name = "showsubsamples()";
$sample_type_name = "midi";
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
    <title>Midi Kits</title>
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


                                <div class="col-12 pt-4 ">
                                    <div class="row">
                                        <?php
                                        SecondaryNavbar::setHtmlContent($div_id, $method_name, $sample_type_name, $resources_path, $page_name_title);
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

                                    </div>
                                    <div id="sample_display_midies_process" style="padding-left: 2.5%;padding-right: 2.5%;" class="col-12 pb-5 pt-3">

                                    </div>



                                </div>
                            </div>
                            <div id="sampleTypeMidiSearch" style="padding-left: 5%;padding-right: 5%;" class="col-12 py-5">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <div id="newDivId"></div>
    <script src="<?= $script_path ?>"></script>

</body>

</html>
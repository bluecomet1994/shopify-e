<?php

session_start();
if (isset($_SESSION["admin_session"])) {

    if(isset($_SESSION["admin_verify_session"])){
        unset($_SESSION["admin_verify_session"]);
    }


}
if (isset($_SESSION["admin_verify_session"])) {
    if(isset($_SESSION["admin_session"])){
        unset($_SESSION["admin_session"]);
    }
    header('Location: http://localhost/sampleSelling-master/admin/view/admin_verify.php');
    die();
}

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$style_path = GlobalLinkFiles::getDirectoryPath("style");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $style_path ?>bootstrap.css">

    <link rel="stylesheet" href="<?= $style_path ?>common_theme_related.css">
    <link rel="stylesheet" href="<?= $style_path ?>upload.css">
    <title>Upload_Midi_Samples</title>
</head>

<body class="container-fluid">
    <div class="row p-4 ">
        <div class="col-12 ">
            <div class="row">
                <div class="col-12 text-start pt-2">
                    <h1 style="font-size: 30px;">Upload Midi Samples</h1>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-12 py-2">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-0 col-8 offset-2">
                                    <span class="">SampleName</span>
                                </div>
                                <div class="col-lg-6 offset-lg-0 col-8 offset-2">
                                    <input type="text" class="ps-2" id="sampleName">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-2">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-0 col-8 offset-2">
                                    <span class="">SamplePrice</span>
                                </div>
                                <div class="col-lg-6 offset-lg-0 col-8 offset-2">
                                    <input type="text" class="ps-2" id="samplePrice">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-2">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-0 col-8 offset-2">
                                    <span class="">SampleType</span>
                                </div>
                                <div class="col-lg-6 offset-lg-0 col-8 offset-2">
                             
                                    <select name="" class="ps-2  w-100" id="sampleType">
                                        <option value="null">Select Midi Type</option>

                                        <?php
                                        require_once "../query/sample_queries.php";
                                        $object = new SampleQueries();
                                        $sampleDB = $object->showMidiTypes();

                                        $typenum_rows = count($sampleDB);
                                        if ($typenum_rows > 0) {
                                            for ($i = 0; $i < $typenum_rows; $i++) {
                                                $typenamerow = $sampleDB;
                                                $typename = $typenamerow[$i]["typeName"];
                                                $typenameID = $typenamerow[$i]["sampleTypeID"];
                                        ?>
                                                <option value="<?php echo $typenameID; ?>"><?php echo $typename; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>




                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-2 d-none" id="mtDIV">

                        </div>
                        <div class="col-12 py-2">
                            <div class="row">
                                <div class=" col-12 pb-2">
                                    <span class="">Sample Description</span>
                                </div>
                                <div class=" col-12">
                                    <textarea name="" id="sampleDescription" class="ps-2" cols="40" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-6 pt-2">
                            <span class="">File</span>
                        </div>

                        <div class="col-6 pt-2">
                            <input type="file" id="sampleFile" class="d-none "> <label class="bg-white ps-2  text-dark w-100 " for="sampleFile">UploadZipFile</label>
                        </div>

                        <div class="col-6 pt-2">
                            <span class="">Sample Image</span>
                        </div>

                        <div class="col-6 pt-2">
                            <input type="file" id="sampleImage" class="d-none "> <label class="bg-white ps-2 text-dark w-100 " for="sampleImage">UploadImage</label>
                        </div>
                        <div class="col-12 pt-2">
                            <button class="w-100" id="uploadbutton">Upload</button>
                        </div>
                        <div class="col-6 pt-2">
                            <div id="showmessage">

                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <script src="upload_midi_sample.js"></script>
</body>

</html>
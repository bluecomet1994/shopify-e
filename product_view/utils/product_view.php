<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

class ProductView
{
    public $resources_path;
    public function getResourcePath()
    {
        $resources_path = GlobalLinkFiles::getDirectoryPath("resources");
        return $resources_path;
    }



    public function view_audio_samples($inputarray, $allowedPages, $A, $valueforBTN, $pageName, $jsMethodName)
    {

        if (count($inputarray) == 0 or $inputarray[0] == "Nothing") {
?>
            <div class="row ">
                <div class="col-12 text-center text-white">
                    <h1>Nothing to show here</h1>
                </div>
            </div>
        <?php
        } else {

        ?>
            <div class="row   ">
                <div class="col-12">
                    <div class="row">
                        <?php
                        for ($i = 0; $i < count($inputarray); $i++) {
                            $inputarraydetails = $inputarray;
                            $inputarrayname =  $inputarraydetails[$i]["Sample_Name"];
                            $inputarrayprice =  $inputarraydetails[$i]["SamplePrice"];
                            $inputarrayID =  $inputarraydetails[$i]["sampleID"];
                            $imagePath =  $inputarraydetails[$i]["source_URL"];
                            $audioPath = $inputarraydetails[$i]["sampleAudioSrc"];
                        ?>
                            <div class="  col-lg-3 py-3  col-md-4 offset-md-0 col-sm-6 offset-sm-3 col-10 offset-1">
                                <div class="row  ">

                                    <div id="beatPackDiv<?php echo $inputarrayID; ?>" class=" col-10 beatpackdiv  py-lg-0 py-md-0 py-0 offset-1">
                                        <div class="row">
                                            <div class="col-12   audiopreviewdiv px-0 pt-3 pb-1 ">
                                                <audio onended="audioEnded('audio'+<?=$inputarrayID?>);" id="audio<?php echo $inputarrayID ?>" class="audiopreviewImage">
                                                    <source src="<?php echo $audioPath; ?>" type="audio/ogg">
                                                    <source src="<?php echo $audioPath; ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                                <img src="<?php echo $imagePath ?>" class="beatPACKIMAGE " alt="">
                                                <img id="playmusic<?php echo $inputarrayID ?>" onclick="playmusic('<?php echo $inputarrayID ?>');" class="playcolrols audiopreview" src="<?= $this->getResourcePath() ?>play_back_images/play.png" alt="">
                                                <img id="pausemusic<?php echo $inputarrayID ?>" onclick="pausemusic('<?php echo $inputarrayID ?>');" class="playcolrols audiopreview d-none" src="<?= $this->getResourcePath() ?>play_back_images/pause.png" alt="">
                                            </div>

                                            <div class="col-12 d-flex  flex-column pb-3 px-4 ">
                                                <h5 style="" class="text-white mt-3  sampleDetailsBox-Name "><?php echo $inputarrayname ?></h5>
                                                <h5 class="text-white mt-1  sampleDetailsBox">$ 47.44</h5>
                                                <button class="viewBTN mt-1 sampleDetailsBox  py-lg-2 py-sm-1" onclick="viewbuy('<?php echo $inputarrayID ?>')">View</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="col-10 offset-1 col-md-12 offset-md-0 mt-5 py-1 text-center  navbuttons">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-12 offset-0">

                            <div class="row">
                                <?php

                                $P = new PageButtons();

                                $pageBtn = $P->produceBtns($allowedPages, $A, $valueforBTN, $jsMethodName, $pageName);
                                ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        <?php
        }
    }
    public function view_midi_samples($inputarray, $allowedPages, $A, $valueforBTN, $pageName, $jsMethodName)
    {

        if (count($inputarray) == 0 or $inputarray[0] == "Nothing") {
        ?>
            <div class="row ">
                <div class="col-12 text-center text-white">
                    <h1>Nothing to show here</h1>
                </div>
            </div>
        <?php
        } else {

        ?>
            <div class="row   ">
                <div class="col-12">
                    <div class="row">
                        <?php
                        for ($i = 0; $i < count($inputarray); $i++) {
                            $inputarraydetails = $inputarray;
                            $inputarrayname =  $inputarraydetails[$i]["Sample_Name"];
                            $inputarrayprice =  $inputarraydetails[$i]["SamplePrice"];
                            $inputarrayID =  $inputarraydetails[$i]["sampleID"];
                            $imagePath =  $inputarraydetails[$i]["source_URL"];

                        ?>
                            <div class="  col-lg-3 py-3  col-md-4 offset-md-0 col-sm-6 offset-sm-3 col-10 offset-1">
                                <div class="row  ">

                                    <div id="beatPackDiv<?php echo $inputarrayID; ?>" class=" col-10 beatpackdiv  py-lg-0 py-md-0 py-0 offset-1">
                                        <div class="row">
                                            <div class="col-12   audiopreviewdiv px-0 pt-3 pb-1 ">

                                                <img src="<?php echo $imagePath ?>" class="beatPACKIMAGE " alt="">

                                            </div>

                                            <div class="col-12 d-flex  flex-column pb-3 px-4 ">
                                                <h5 style="" class="text-white mt-3  sampleDetailsBox-Name "><?php echo $inputarrayname ?></h5>
                                                <h5 class="text-white mt-1  sampleDetailsBox">$ 47.44</h5>
                                                <button class="viewBTN mt-1 sampleDetailsBox  py-lg-2 py-sm-1" onclick="viewbuy('<?php echo $inputarrayID ?>')">View</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="col-10 offset-1 col-md-12 offset-md-0 mt-5 py-1 text-center  navbuttons">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-12 offset-0">

                            <div class="row">
                                <?php

                                $P = new PageButtons();

                                $pageBtn = $P->produceBtns($allowedPages, $A, $valueforBTN, $jsMethodName, $pageName);
                                ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

<?php
        }
    }

}

?>
<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$upload_audio_samples_url = GlobalLinkFiles::getRelativePath("upload_audio_samples");
$upload_midi_samples_url = GlobalLinkFiles::getRelativePath("upload_midi_samples");

?>
<div class="row  h-100   p-0">
    <div class="col-12 p-0">

        <div class="flex w-100 text-end ">
            <button id="closeBtn" class="p-1"><img class="closeIcon" src="../../resources/icons/close_icon.png"></button>
        </div>
        <div class="h-100 w-100    d-flex   align-items-center justify-content-center ">
            <div class=" gx-4  px-3 ">
                <form action="<?php echo $upload_audio_samples_url ?>" method="post">
                    <button class="px-2 py-2 uploadAudioSamplesBtn">upload audio samples</button>
                </form>
                <form action="<?php echo $upload_midi_samples_url ?>" method="post">
                    <button class="px-2 py-2 uploadMidiSamplesBtn">upload midi files</button>
                </form>
            </div>
        </div>
    </div>
</div>
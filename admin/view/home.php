<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$style_path = GlobalLinkFiles::getDirectoryPath("style");
$_SESSION["admin_session"] = "rag";
if (!isset($_SESSION["admin_session"]) && !isset($_SESSION["admin_verify_session"])) {

    // header('Location: http://localhost/sampleSelling-master/admin_login');
    // die();
} else if (isset($_SESSION["admin_verify_session"]) && !isset($_SESSION["admin_session"])) {

    // header('Location: http://localhost/sampleSelling-master/admin/view/admin_verify.php');
    // die();
} else if (!isset($_SESSION["admin_verify_session"]) && isset($_SESSION["admin_session"])) {

    class ChangeStatus
    {
        public $uploadNavigationButton = false;
        function changeUploadNavigationButton()
        {
            if ($this->uploadNavigationButton) {
                $this->uploadNavigationButton = false;
            }
            if (!$this->uploadNavigationButton) {
                $this->uploadNavigationButton = true;
            }
            return $this->uploadNavigationButton;
        }
    }
    $changeStatus = new ChangeStatus();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="<?php echo $style_path; ?>bootstrap.css">
        <link rel="stylesheet" href="<?php echo $style_path; ?>common.css">
        <link rel="stylesheet" href="<?php echo $style_path; ?>admin.css">
        <title>home</title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row py-3">
                <!-- to show the uploading buttons -->
                <div class="col-12 uploadBtnDiv d-none  " id="upload-btns-div">
                    
                </div>
                <div class="col-12">
                    <!-- 
                    upload samples button
                 -->
                    <button id="upload-samples-navigation">Upload Samples</button>
                    <button class="colorGreen">Manage Samples</button>
                </div>

            </div>
        </div>
        <script src="home.js"></script>
    </body>

    </html>
<?php
}
?>
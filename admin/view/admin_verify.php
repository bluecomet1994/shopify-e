<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$style_path = GlobalLinkFiles::getDirectoryPath("style");
$script_page = GlobalLinkFiles::getRelativePath("admin_login_script");

$style_path = "/sampleSelling-master/style/";
// session checking 
if (isset($_SESSION["admin_session"])) {

    if (isset($_SESSION["admin_verify_session"])) {
        unset($_SESSION["admin_verify_session"]);
    }

    echo "bro bro bro rahg";
     header('Location: http://localhost/sampleSelling-master/admin/view/home.php');
    die();
} else if (isset($_SESSION["admin_verify_session"])) {

    if (isset($_SESSION["admin_session"])) {
        unset($_SESSION["admin_session"]);
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= $style_path ?>bootstrap.css">
        <link rel="stylesheet" href="<?= $style_path ?>common.css">
        <link rel="stylesheet" href="<?= $style_path; ?>admin.css">
        <title>Admin verification</title>
    </head>

    <body>

        <div class="container  ">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3 px-md-3 px-5 py-5">
                    <div class="row ">
                        <!-- title -->
                        <div class="col-12 text-center">
                            <h1>Admin Verification</h1>
                        </div>
                        <!-- form -->
                        <div>
                       
                            <div class="col-12 d-flex flex-column py-3">
                                <span>Verification Code</span>
                                <input type="text" id="verify-code" class="w-100 px-2 py-2">
                            </div>
                            <div class="text-end py-3">
                                <button id="verify-btn" class="px-3 py-2   loginButton">Verify</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="admin_verify.js"></script>
    </body>

    </html>
<?php
} else {
    header('Location: http://localhost/sampleSelling-master/admin_login');
    die();
}

<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$style_path = GlobalLinkFiles::getDirectoryPath("style");
$site_header = GlobalLinkFiles::getFilePath("site_header_php");
$resource_path = GlobalLinkFiles::getDirectoryPath("resources");
$query_path = GlobalLinkFiles::getFilePath("sample_single_view_query");
$script_path = GlobalLinkFiles::getRelativePath("user_authorization_script");

if(isset($_SESSION["verifyForgotPasswordEmail"])){
    unset($_SESSION["verifyForgotPasswordEmail"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$style_path?>bootstrap.css">
    <link rel="stylesheet" href="<?=$style_path?>forgotPassword.css">

    <title>Forgot Password</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div id="signInOnly" class="col-12 signInOnly py-5">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 class="fw-bold">FORGOT PASSWORD</h3>
                        </div>
                        <div class="col-md-4 offset-md-4 col-8 offset-2">
                            <div class="row">
                                <div class="col-12 py-3 ">
                                    <div class="row">
                                        <div class="col-12 text-start">
                                            <span class=" ms-0  ">Email</span>
                                        </div>
                                        <div class="col-12 text-start  " id="errorMessage">
                                            <span  class=" ms-0   text-danger"></span>
                                        </div>
                                        <div class="col-12">
                                            <input id="inputFieldsEmail" class="w-100 py-2 px-2 inputFieldsEmail" type="Email">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 pt-1 pb-1 ">
                                    <div class="row">

                                        <div class="col-8 offset-2 pb-4 pt-2">
                                            <button onclick="forgotPassword();" class="w-100 logInButton py-2">Send Code To This Email</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="<?=$script_path?>"></script>
</body>

</html>
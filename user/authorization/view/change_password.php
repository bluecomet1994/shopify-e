<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$style_path = GlobalLinkFiles::getDirectoryPath("style");
$site_header = GlobalLinkFiles::getFilePath("site_header_php");
$resource_path = GlobalLinkFiles::getDirectoryPath("resources");
$query_path = GlobalLinkFiles::getFilePath("sample_single_view_query");
$script_path = GlobalLinkFiles::getRelativePath("user_authorization_script");

unset($_SESSION["userEmail"]);
if (!isset($_SESSION["verifyForgotPasswordEmail"])) {
    header('Location: /brymo8/userProcess/forgotPassword.php');
    // or die();
    exit();
} else {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/bootstrap.css">
        <link rel="stylesheet" href="../style/forgotPassword.css">

        <title>Change Password</title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="col-12">
                <div class="row">
                    <div id="signInOnly" class="col-12 signInOnly py-5">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h3 class="fw-bold">Create New Password</h3>
                            </div>
                            <div class="col-md-4 offset-md-4 col-8 offset-2">
                                <div class="row">
                                    <div class="col-12 py-3 ">
                                        <div class="row">
                                            <div class="col-12 text-start">
                                                <span class=" ms-0  ">Password</span>
                                            </div>
                                            <div class="col-12 text-start  " id="errorMessage">
                                                <span class=" ms-0   text-danger"></span>
                                            </div>
                                       

                                            <div class="col-12">
                                                <div class="row gx-0">
                                                    <div class="col-lg-11 col-10">
                                                        <input id="inputNewPassword" class="py-2 w-100 px-2  inputFieldsLogin" type="password">
                                                    </div>
                                                    <div class="col-lg-1 col-2 bg-white d-flex align-items-center justify-content-lg-center justify-content-md-end justify-content-center">
                                                        <img id="inputNewPasswordIcon" style="cursor: pointer;" class="my-auto" src="../icons/showPassEyeIcon.png" >

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-start">
                                                <span class=" ms-0  ">Re-Enter Password</span>
                                            </div>
                                            <div class="col-12 text-start  " id="errorMessage">
                                                <span class=" ms-0   text-danger"></span>
                                            </div>
                                          
                                            <div class="col-12">
                                                <div class="row gx-0">
                                                    <div class="col-lg-11 col-10">
                                                        <input id="inputReEnterNewPassword" class="py-2 w-100 px-2  inputFieldsLogin" type="password">
                                                    </div>
                                                    <div class="col-lg-1 col-2 bg-white d-flex align-items-center justify-content-lg-center justify-content-md-center justify-content-center">
                                                        <img id="inputReEnterNewPasswordIcon" style="cursor: pointer;" class="my-auto" src="../icons/showPassEyeIcon.png" >

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 pt-1 pb-1 ">
                                        <div class="row">

                                            <div class="col-8 offset-2 pb-4 pt-2">
                                                <button onclick="changePassword();" class="w-100 logInButton py-2">Create New Password</button>
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
        <script src="userProcess.js"></script>
    </body>

    </html>
<?php
}
?>
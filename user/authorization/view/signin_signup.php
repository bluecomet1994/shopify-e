<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$style_path = GlobalLinkFiles::getDirectoryPath("style");
$site_header = GlobalLinkFiles::getFilePath("site_header_php");
$resource_path = GlobalLinkFiles::getDirectoryPath("resources");
$query_path = GlobalLinkFiles::getFilePath("sample_single_view_query");
$script = GlobalLinkFiles::getRelativePath("user_authorization_script");

if (isset($_SESSION["userEmail"])) {
    header('Location: http://localhost/sampleSelling-master/homepage'); 
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=$style_path?>bootstrap.css">
        <link rel="stylesheet" href="<?=$style_path?>sampleselling.css">
        <link rel="stylesheet" href="<?=$style_path?>navbar.css">
        <link rel="stylesheet" href="<?=$style_path?>forgotPassword.css">

        <title>Signin Signup</title>
    </head>

    <body>

        <div class="container-fluid">
            <div class="col-12">
                <div class="row">
                    <!-- <?php
                    // require "../siteHeader/header.php"
                    ?> -->
                    <div id="signInSignUpPage" style="margin-top: 65px;z-index: 899;" class=" col-12 colorBlack   text-center signInSignUpPage">
                        <div class="row">
                            <div id="signInOnly" class=" col-md-4 offset-md-4 col-8 offset-2 signInOnly ">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h1 class="fw-bold">LOGIN</h1>
                                    </div>
                                    <div class="col-12 pt-3 pb-1 ">
                                        <div class="row">
                                            <div class="col-12 text-start">
                                                <span class="">Email</span>
                                            </div>
                                            <div class="col-12">
                                                <input id="signem" class="py-2  px-2 w-100 inputFieldsLogin" type="Email">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 pt-3 pb-1 ">
                                        <div class="row">
                                            <div class="col-12 text-start ">
                                                <span class="">Password</span>
                                            </div>
                                            <div class="col-12   ">
                                                <div class="row gx-0">
                                                    <div class="col-lg-11 col-10">
                                                        <input id="signpwd" class="py-2 w-100 px-2  inputFieldsLogin" type="password">
                                                    </div>
                                                    <div class="col-lg-1 col-2 bg-white d-flex align-items-center justify-content-lg-start justify-content-md-end justify-content-center">
                                                        <img id="showPasswordIcon" style="cursor: pointer;" class="my-auto" src="<?=$resource_path?>icons/showPassEyeIcon.png" alt="" srcset="">

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12 py-4">
                                                <button onclick="userSignIn();" class="w-100 logInButton py-2">Log In</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12 text-center pb-3">
                                        <span id="createAccount" onclick="hideSignInDiv();" class="fw-bold"><a href="#">Create account</a> </span>
                                    </div>
                                    <div class="col-12 text-center pb-3">
                                        <span id="createAccount" onclick="forgotPasswordClick();" class="fw-bold"><a href="#">Forgot Password</a> </span>
                                    </div>
                                </div>
                            </div>
                            <div id="signUpOnly" class="col-lg-4 offset-lg-4 col-8 offset-2 signUpOnly d-none">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h1 class="fw-bold">SIGNUP</h1>
                                    </div>
                                    <div class="col-12 pt-3 pb-1 ">
                                        <div class="row">
                                            <div class="col-lg-12 offset-lg-0 col-12  text-start">
                                                <span class="">First Name</span>
                                            </div>
                                            <div class="col-12 ">
                                                <input id="fn" class="py-2  px-2 w-100 inputFieldsLogin" type="text">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 pt-3 pb-1 ">
                                        <div class="row">
                                            <div class="col-lg-12 offset-lg-0 col-12 text-start">
                                                <span class="">Last Name</span>
                                            </div>
                                            <div class="col-12">
                                                <input id="ln" class="py-2  px-2 w-100 inputFieldsLogin" type="text">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12 pt-3 pb-1 ">
                                        <div class="row">
                                            <div class="col-lg-12 offset-lg-0 col-12 text-start">
                                                <span class="">User Name</span>
                                            </div>
                                            <div class="col-12">
                                                <input id="un" class="py-2  px-2 w-100 inputFieldsLogin" type="text">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12 pt-3 pb-1 ">
                                        <div class="row">
                                            <div class="col-lg-12 offset-lg-0 col-12 text-start">
                                                <span class="">Email</span>
                                            </div>
                                            <div class="col-12">
                                                <input id="em" class="py-2  px-2 w-100 inputFieldsLogin" type="Email">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 pt-3 pb-1 ">
                                        <div class="row">
                                            <div class="col-lg-12 offset-lg-0 col-12 text-start">
                                                <span class="">Password</span>
                                            </div>
                                            <!-- <div class="col-12">
                                            <input id="pwd" class="py-2  px-2 w-100 inputFieldsLogin" type="password">
                                        </div> -->

                                            <div class="col-12   ">
                                                <div class="row gx-0">
                                                    <div class="col-lg-11 col-10">
                                                        <input id="pwd" class="py-2 w-100 px-2  inputFieldsLogin" type="password">
                                                    </div>
                                                    <div class="col-lg-1 col-2 bg-white d-flex align-items-center justify-content-lg-start justify-content-md-end justify-content-center">
                                                        <img id="showPasswordIconSignUp" style="cursor: pointer;" class="my-auto" src="<?=$resource_path?>icons/showPassEyeIcon.png" alt="" srcset="">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 pt-3 pb-1 ">
                                        <div class="row">
                                            <div class="col-lg-12 offset-lg-0 col-12 text-start">
                                                <span class="">Re-Enter Password</span>
                                            </div>

                                            <div class="col-12   ">
                                                <div class="row gx-0">
                                                    <div class="col-lg-11 col-10">
                                                        <input id="repwd" class="py-2 w-100 px-2  inputFieldsLogin" type="password">
                                                    </div>
                                                    <div class="col-lg-1 col-2 bg-white d-flex align-items-center justify-content-lg-start justify-content-md-end justify-content-center">
                                                        <img id="reshowPasswordIconSignUp" style="cursor: pointer;" class="my-auto" src="<?=$resource_path?>icons/showPassEyeIcon.png" alt="" srcset="">

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12 py-4">
                                                <button onclick="userSignUp();" class="w-50 logInButton py-2">Sign Up</button>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-12 text-center pb-3">
                                        <span id="signInAccount" onclick="hideSignUPDiv();" class="fw-bold"><a href="#">Sign In</a> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?=$script?>"></script>

    </body>

    </html>

<?php
}
?>
<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$style_path = GlobalLinkFiles::getDirectoryPath("style");
$script = GlobalLinkFiles::getRelativePath("user_account_script");
$site_header = GlobalLinkFiles::getFilePath("site_header_php");
if (!isset($_SESSION["userEmail"])) {
    header('Location: http://localhost/sampleSelling-master/home/home.php');
    die();
?>

<?php
} else {
    require "../query/User.php";
    $userEmail = $_SESSION["userEmail"];
    $userQuery = new User();
    $userDetails = $userQuery->getUserDetails($userEmail);
    $userName = $userDetails[0]["UserName"];
    $userFName = $userDetails[0]["FName"];
    $userLName = $userDetails[0]["LName"];
    $userPassword = $userDetails[0]["Password"];
    $userCustomerId = $userDetails[0]["Unique_ID"];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=$style_path?>bootstrap.css">
        <link rel="stylesheet" href="<?=$style_path?>userAccount.css">
        <link rel="stylesheet" href="<?=$style_path?>navbar.css">
        
        <link rel="stylesheet" href="<?=$style_path?>purchasedHistory.css">


        <title>User Account</title>
    </head>

    <body>

        <div class="container-fluid">
            <div class="col-12">
                <div class="row">
                    <?php
                    require $site_header;
                    ?>
                    <div id="signInSignUpPage" class="userDetailsMainDiv pt-3 col-10 offset-1    text-center ">
                        <div class="row ">
                            <div class="col-lg-4 offset-lg-0 col-12  offset-0 text-start px-md-5 px-4 py-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class=" py-1 fw-bold">Email</h5>
                                    </div>
                                    <div class="col-12">
                                        <input class="w-100 userNameField px-2 py-1 d-none fw-bolder" type="text" value="<?php echo $userEmail; ?>" readonly>
                                        <h5><?php echo $userEmail; ?></h5>
                                    </div>
                                    <div class="col-12">
                                        <h5 class=" py-1 fw-bold">Customer Id</h5>
                                    </div>
                                    <div class="col-12">
                                        <input class="w-100 userNameField px-2 py-1 d-none fw-bolder" type="text" value="<?php echo $userEmail; ?>" readonly>
                                        <h5><?php echo $userCustomerId; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div id="userInfoDiv" class="col-lg-6 offset-lg-0 col-md-6 offset-md-1 col-12 offset-0  text-start px-lg-5 px-4 py-3">
                                <div class="row">




                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-4"><span class="px-2 py-1 ">User Name</span></div>
                                            <div class="col-8"><input class="w-100 userNameField px-2 py-1" type="text" value="<?php echo $userName; ?>" readonly></div>

                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-4"><span class="px-2 py-1 ">First Name</span></div>
                                            <div class="col-8"><input class="w-100 userNameField px-2 py-1" type="text" value="<?php echo $userFName; ?>" readonly></div>

                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row">
                                            <div class="col-4"><span class="px-2 py-1 ">Last Name</span></div>
                                            <div class="col-8"><input class="w-100 userNameField px-2 py-1" type="text" value="<?php echo $userLName; ?>" readonly></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="userInfobuttonDiv" class="col-lg-2 offset-lg-0 col-md-2 offset-md-1 col-10 offset-1 pt-2 pb-4 d-flex align-items-end flex-row-reverse">
                                <button id="updateModeButton" class=" updateRelatedButtons">Update Mode</button>

                            </div>



                        </div>
                    </div>
                    <div class="col-10 offset-1 pt-3 ">
                        <h5 class="fw-bolder">Customer purchased history</h5>
                    </div>
                    <div id="purchaseHistoryDiv" class="pt-3 col-12 pb-4">
                      
                    </div>
                </div>
            </div>
        </div>

        <script src="<?=$script?>"></script>

    </body>

    </html>
<?php
}

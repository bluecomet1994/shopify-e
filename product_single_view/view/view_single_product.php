<?php

session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$style_path = GlobalLinkFiles::getDirectoryPath("style");
$site_header = GlobalLinkFiles::getFilePath("site_header_php");
$resource_path = GlobalLinkFiles::getDirectoryPath("resources");
$query_path = GlobalLinkFiles::getFilePath("sample_single_view_query");
$single_product_view_script = GlobalLinkFiles::getRelativePath("single_product_view_script");
require_once $query_path;

$sampleID = $_GET["X"];

$searchobject = new Sample_query_functions();

$searchedarrays = $searchobject->getSampleDetails($sampleID);
$arrsize = count($searchedarrays);
$sampleRow = $searchedarrays[0];
$sampleName = $sampleRow["Sample_Name"];
$samplePrice = $sampleRow["SamplePrice"];
$imagePath = $sampleRow["source_URL"];
$sampleType = $sampleRow["subsampleName"];
$sampleDescription = $sampleRow["SampleDescription"];
$sampleArray = array('ID' => $sampleID, 'name' => $sampleName, 'price' => $samplePrice, 'image' => $imagePath);
// $site_header = "../sampleSelling-master/site_heaer/header.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="<?=$style_path?>bootstrap.css">
    <link rel="stylesheet" href="<?=$style_path?>sampleselling.css">
    <link rel="stylesheet" href="<?=$style_path?>viewsingleproduct.css">
    <link rel="stylesheet" href="<?=$style_path?>navbar.css">
    <link rel="shortcut icon" href="<?=$resource_path?>/icon_images/logo_transparent.png" type="image/x-icon">
    <title>Single View</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12 ">
                    <div class="row">
                        <?php
                        require $site_header;
                        ?>
                        <div class="d-none" id="cartItems"></div>
                        <div class="col-12  ">
                            <div class="row">
                                <div class="text-white col-12 text-center">

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="HRTAG ">
                        </div>
                        <div class="col-12 py-4">
                            <div class="row">
                                <div class="col-12  mainInfoDiv ">
                                    <div class="row">
                                        <div class="col-lg-6 col-12  text-center  sampleImageDiv py-lg-0 py-4">
                                            <img class="sampleImage  my-auto" src="<?=$imagePath ?>" alt="">
                                        </div>

                                        <div class="col-lg-6 col-12  px-lg-1  py-0  sampleInfoDIV ">
                                            <div class="row">
                                                <div class="col-lg-10 offset-lg-1  col-10 offset-1 ">
                                                    <div class="row">
                                                        <div class="col-12 pt-1">
                                                            <h1 class="sampleheaddiv  px-0 pt-4 pb-0 "> <?php echo $sampleName; ?>
                                                            </h1>

                                                        </div>
                                                        <div class="col-12 ">
                                                            <div class="py-1" id="borderLeft"></div>
                                                        </div>
                                                        <div class="col-12 py-2">
                                                            <h5 class="sampledescription"><?php echo $sampleDescription; ?></h5>
                                                        </div>
                                                        <div class="col-6 pt-2 pb-3 ">
                                                            <h3 class="fw-bolder py-lg-2 py-3 px-3 px-lg-2">Price : $<?php echo $samplePrice ?></h3>
                                                        </div>
                                                        <div class="col-6 pt-2 pb-3 ">
                                                            <input type="number" id="selectQTY" class=" py-lg-2 py-3 px-3 px-lg-2 bg-dark w-100">
                                                        </div>
                                                        <div class="col-12 pt-lg-1 pt-1 pb-5 pt-md-3">
                                                            <div class="row gy-3 gy-md-1">
                                                                <div class="col-md-6 offset-md-0 col-12 d-grid ">

                                                                    <button class="cartButton" onclick="newAddtoCart(<?php echo $sampleID; ?>);"> Cart </button>
                                                                </div>
                                                                <div class="col-md-6 offset-md-0 col-12 d-grid ">
                                                                    <button class="buyButton" onclick="goToviewCart(<?php echo $sampleID; ?>);">Buy</button>
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
                        </div>
                        <div class="col-6 thefooterdiv d-none">
                            <div class="row">
                                <div class="col-12 text-center pt-4">
                                    <h1 class="cardinfo">We accept</h1>
                                </div>
                                <div class="col-12 py-5">
                                    <div class="row">
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/1.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/2.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/3.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/4.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/5.png" class="paymentmethods" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6 thefooterdiv d-none">
                            <div class="row">
                                <div class="col-12 text-center pt-4">
                                    <h1 class="cardinfo">We accept</h1>
                                </div>
                                <div class="col-12 py-5">
                                    <div class="row">
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/1.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/2.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/3.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/4.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="<?=$resource_path?>payment_method_images/5.png" class="paymentmethods" alt="">
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


     
    <script src="<?=$single_product_view_script?>"></script>
</body>

</html>
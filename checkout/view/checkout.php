<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$style_path = GlobalLinkFiles::getDirectoryPath("style");
$site_header = GlobalLinkFiles::getFilePath("site_header_php");
$checkout_script = GlobalLinkFiles::getRelativePath("checkout_script");
$resource_path = GlobalLinkFiles::getDirectoryPath("resources");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $style_path ?>bootstrap.css">
    <link rel="stylesheet" href="<?= $style_path ?>sampleselling.css">
    <link rel="stylesheet" href="<?= $style_path ?>navbar.css">
    <link rel="stylesheet" href="<?= $style_path ?>checkout.css">

    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="shortcut icon" href="<?=$resource_path?>/icon_images/logo_transparent.png" type="image/x-icon">
    <title>Checkout</title>
</head>

<body style="background-color: black;">
    <div class="container-fluid">
        <div class="col-12">
            <form action="../stripe/create-checkout-session.php" method="post">
                <div class="row">
                   
                    <?php
                    require $site_header;
                    ?>
                    <div id="cartItems d-none"></div>
                    <div class="col-lg-9 col-12  showCartItemsDiv">
                        <div id="cartRowHolder" class="row">

                        </div>
                    </div>
                    <div class="col-lg-3 col-12 showTotalAmountDiv">
                        <div class="row">
                            <div class=" py-3 px-4 col-12 offset-0 d-flex flex-row justify-content-lg-between justify-content-center">
                                <span class="text-white">Sub Total</span>
                                <span class="text-white">$ <span id="subTotalValue"></span></span>
                            </div>
                            <div class=" pt-1 pb-4 px-4 col-12 offset-0 d-flex flex-row justify-content-center">
                                <input type="hidden" name="lookup_key" value="price_1L99mSKy85cwwCHPgHmvEJij" />
                                <button id="checkout-btn-click" class="checkOutButton w-75 py-2" type="submit"> Check Out</button>
                            </div>
                            <div class=" py-1 px-1 col-12 offset-0 d-flex flex-row justify-content-center">
                                <span class="text-white checkOutDescription">Shipping, taxes, and discount codes calculated at checkout.</span>

                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>
<script src="script.js"></script>

</html>
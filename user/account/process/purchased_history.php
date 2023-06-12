<div class="row">
    <?php
    session_start();

    if (!isset($_SESSION["userEmail"])) {
        echo "Error";
        exit();
    } else {
        require_once "../query/UserData.php";
        $results_per_page = 4;

        $userQuery = new UserData();
        $email = $_SESSION["userEmail"];
        $emailCheck = $userQuery->checkEmail($email);
        if ($emailCheck) {

            $customerId = $userQuery->getCusIdByEmail($email);

            $totalresultSet = $userQuery->getCustomerPurchasedHistory($customerId);

            $totalRowCount = count($totalresultSet);

            $maxnavivalue =  $results_per_page * floor($totalRowCount / $results_per_page);

            $navi_value_for_button_purpose = 0;
            //    echo "max value is ".$maxnavivalue;
            $naviValue = 0;
            if (!isset($_POST["navivalue"])) {
                $naviValue = 0;
                $navi_value_for_button_purpose = 0;
            } else {
                $naviValue = $_POST["navivalue"];
                //    $navi_value_for_button_purpose = $_POST["navivalue"];
                if ($maxnavivalue == $totalRowCount) {
                    $naviValue = 0;
                }
                if ($naviValue <= 0) {
                    $naviValue = 0;
                }
                if ($naviValue >=  $maxnavivalue) {
                    $navi_value_for_button_purpose = $naviValue;
                    $naviValue =  $maxnavivalue;
                }
            }
            //    echo $naviValue;
            $totalresultSet = $userQuery->getCustomerPurchasedHistory($customerId);
            $resultSet = $userQuery->getCustomerPurchasedHistoryLimit($customerId, $naviValue, $results_per_page);
            if (count($resultSet) > 0) {
    ?>
                <div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-10 offset-1 px-md-5  px-2 pt-4  darkBlack ">
                    <!-- <table  class="  tableDark tableborderradius table"> -->
                    <table class="purchasetable">
                        <thead>
                            <tr class="">
                                <th scope="col" class="">Id</th>
                                <th scope="col" class="">Price</th>
                                <th scope="col" class="">Qty</th>
                                <th scope="col" class="">Dnt</th>
                                <th scope="col" class="">UID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            for ($i = 0; $i < count($resultSet); $i++) {
                            ?>
                                <tr>
                                    <td class=" "><?php echo $resultSet[$i]["unique_id"] ?></td>
                                    <td class=" "><?php echo $resultSet[$i]["SamplePrice"] ?></td>
                                    <td class=" "><?php echo $resultSet[$i]["qty"] ?></td>
                                    <td class=" "><?php echo $resultSet[$i]["dnt"] ?></td>
                                    <td class=" "><?php echo "33Ik3*09326^^%BlRAGBAG"; ?></td>

                                </tr>

                            <?php
                            }


                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
            ?>
                <div class="col-10 offset-1  px-5 py-4  darkBlack ">
                    <h3>No Products has been purchased yet</h3>
                </div>
            <?php
            }
        }




        $totalbuttons = floor(count($totalresultSet) / $results_per_page);
        if (count($resultSet) > 0) {
            ?>
            <div class="col-md-10 offset-md-1 col-12 offset-0 darkBlack ">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12 offset-0  px-5 py-2  darkBlack ">
                        <div class="row">
                            <div class="col-3 py-1  text-start">
                                <button onclick="navigation('<?php echo (($naviValue / $results_per_page) - 1) * $results_per_page; ?>');" class="px-4 py-1 bg-dark text-white ">Previous</button>

                            </div>


                            <div class="col-6 py-1  ">
                                <div class="row">


                                    <?php
                                    if ($naviValue - $results_per_page >= 0) {
                                    ?>
                                        <div class="col-4 ">
                                            <button onclick="navigation('<?php echo $naviValue - $results_per_page ?>');" class="px-4 py-1  text-white nextButton"><?php echo (($naviValue - $results_per_page) / $results_per_page) + 1 ?></button>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <div class="col-4">
                                        <button onclick="navigation('<?php echo $naviValue ?>');" class="px-4 py-1 bg-danger text-white nextButton"><?php echo ($naviValue / $results_per_page) + 1 ?></button>

                                    </div>

                                    <?php
                                    if ($naviValue + $results_per_page <= $totalbuttons * $results_per_page) {
                                    ?>
                                        <div class="col-4">
                                            <button onclick="navigation('<?php echo $naviValue + $results_per_page ?>');" class="px-4 py-1  text-white nextButton"><?php echo (($naviValue + $results_per_page) / $results_per_page) + 1 ?></button>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>






                            </div>

                            <div class="col-3 py-1  text-end">
                                <?php
                                if (!$navi_value_for_button_purpose >=  $maxnavivalue) {
                                ?>
                                    <button onclick="navigation('<?php echo (($naviValue / $results_per_page) + 1) * $results_per_page; ?>');" class="px-4 py-1 bg-dark text-white ">Next</button>
                                <?php
                                }

                                ?>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>



</div>
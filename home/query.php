<?php

$abc = "abcd";


$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class Search extends Db
{

    function limitsearch()
    {
        $searchquery = "SELECT SUM(qty),
customer_purchase_history.sampleID,
unique_id,
source_URL,
SamplePrice,
Sample_Name 
FROM customer_purchase_history
INNER JOIN sampleimages 
ON sampleimages.sampleID = customer_purchase_history.sampleID
INNER JOIN samples
ON samples.sampleID = customer_purchase_history.sampleID
GROUP BY sampleID  ORDER BY qty  DESC LIMIT 3";
        $statement = $this->connect()->prepare($searchquery);
        $statement->execute([]);
        $resultset = $statement->fetchAll();
        $getrows = count($resultset);

        if ($getrows >= 1) {
            for ($i = 0; $i < $getrows; $i++) {



                $melodydetails = $resultset[0];
                $melodyname = $melodydetails["Sample_Name"];
                $melodyID = $melodydetails["sampleID"];
                $imagePath = $melodydetails["source_URL"];




?>
                <div class="py-3 py-md-3 py-lg-3 col-lg-4  offset-lg-0  col-md-4  offset-md-0 col-sm-8 offset-sm-2 col-10 offset-1">
                    <div class="row">
                        <div class="row">
                            <div class="col-12 audiopreviewdiv py-2">
                                <img src="<?php echo $imagePath; ?>" class="beatPACKIMAGE " alt="">


                            </div>

                            <div class="col-12 py-2">
                                <div class="row">
                                    <div class="col-12 pt-2 text-center">
                                        <span class="sampleName "><?php echo $melodyname; ?></span>
                                    </div>


                                    <div class="col-6 offset-3  pt-2 d-grid  text-center">
                                        <button class="buyBTN py-lg-2 py-sm-3 py-3">View</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
<?php

            }
        }
    }
}

?>
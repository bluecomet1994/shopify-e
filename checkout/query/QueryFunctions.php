<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class QueryFunctions extends Db
{


    private $totalcount;
    private $fetcharray;
    private $exactResultsPerPage = 8;
    private $subSamplesQuery = "SELECT * FROM samples 
    INNER JOIN subsampletype
    ON subsampletype.subsampleID =samples.SubsampleID
    INNER JOIN sampletype
    ON sampletype.sampleTypeID = subsampletype.sampleTypeID
    INNER JOIN sampleaudio
    ON sampleaudio.sampleID=samples.sampleID
    INNER JOIN sampleimages
    ON sampleimages.sampleID=samples.sampleID";

    private $sampleTypeQuery = "SELECT * FROM samples 
    INNER JOIN subsampletype
    ON subsampletype.subsampleID =samples.SubsampleID
    INNER JOIN sampletype
    ON sampletype.sampleTypeID = subsampletype.sampleTypeID
    INNER JOIN sampleaudio
    ON sampleaudio.sampleID=samples.sampleID
    INNER JOIN sampleimages
    ON sampleimages.sampleID=samples.sampleID";



   
    public function returnTotalCount()
    {
        return $this->totalcount;
    }
    public function validateCardproductID($cardID)
    {
        $cal = " SELECT * FROM samples WHERE samples.sampleID = ?";
        $propertext = $cardID;
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute(([$propertext]));
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return 0;
        } else {
            return $this->totalcount;
        }
    }
    public function checkCartrows($id)
    {
        $cal = "SELECT * FROM samples WHERE samples.sampleID =?";
        $properID  = $id;
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return 0;
        } else {
            return $this->totalcount;
        }
    }
    public function showCartRows($id)
    {
        $cal = "SELECT * FROM `samples` WHERE `samples`.`sampleID` =?";
        $properID  = $id;
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$properID]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {

            $this->fetcharray = array("Nothing");
            return $this->fetcharray;
        } else {

            $sql = "SELECT *
            FROM samples INNER JOIN
            sampleimages
            ON
            sampleimages.sampleID = samples.sampleID
            WHERE samples.sampleID =?";

            $statement2 = $this->connect()->prepare($sql);
            $statement2->execute([$id]);

            return $statement2->fetchAll();
        }
    }

    public function showSampleTypes()
    {
        $cal = "SELECT * FROM sampletype";
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute();
        return $statement1->fetchAll();
    }
    public function showSubSampleTypes($id)
    {
        $cal = "SELECT * FROM subsampletype WHERE sampleTypeID =?";
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        return $statement1->fetchAll();
    }

}

// $bbc = "INNER JOIN sampletype
//         ON sampletype.sampleTypeID = subsampletype.sampleTypeID
//         WHERE 
//         samples.SampleDescription REGEXP '^$value?'
//         OR samples.Sample_Name REGEXP '^$value?'
//         OR sampletype.typeName REGEXP '^$value?'
//         OR subsampletype.subsampleName REGEXP '^$value?';";

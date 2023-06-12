<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class SampleQueries extends Db
{
    public  function insertSamples($sname, $date, $sprice, $subSampletype, $sampledescription, $unique_id)
    {
        $state =false;
        $query = "INSERT INTO `samples` (`Sample_Name`,`Sample_Date`,`SamplePrice`,`SubsampleID`,`SampleDescription`,`UniqueId`)VALUES(?,?,?,?,?,?) ";
        $statement = $this->connect()->prepare($query);
        $state = $statement->execute([$sname, $date, $sprice, $subSampletype, $sampledescription, $unique_id]);
        return $state;
    }
    public  function insertAudioSampleZipSrc($zip_path_name, $last_id)
    {
        $state = false;
        $query = "INSERT INTO `samplePath`(`samplePath`,`sampleID`)  VALUES (?,? ) ";
        $statement = $this->connect()->prepare($query);
        $state = $statement->execute([$zip_path_name, $last_id]);
        return $state;
    }
    public  function insertAudioSampleSrc($audiopathname, $last_id)
    {
        $state = false;
        $query = "INSERT INTO `sampleaudio`(`sampleAudioSrc`,`sampleID`) VALUES (?,? ) ";
        $statement = $this->connect()->prepare($query);
        $state = $statement->execute([$audiopathname, $last_id]);
        return $state;
    }
    public  function insertImageSrc($imagepathname, $last_id)
    {
        $state = false;
        $query = "INSERT INTO `sampleimages`(`source_URL`,`sampleID`) VALUES (?,?)  ";
        $statement = $this->connect()->prepare($query);
        $state = $statement->execute([$imagepathname, $last_id]);
        return $state;
    }
    public function get_sample_id($unique_id)
    {
        $query = "SELECT * FROM `samples` WHERE `UniqueId`= ? ";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id]);
        $result_set = $statement->fetchAll();
        $row_Count = count($result_set);
        if ($row_Count == 1) {
            return $result_set[0]["sampleID"];
        }
    }
    public function showSampleTypes()
    {
        $cal = "SELECT * FROM sampletype WHERE `typeName` != 'midi' OR `sampleTypeID` != '4' ";
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute();
        return $statement1->fetchAll();
    }
    public function showSubSampleTypes($id)
    {
        $cal = "SELECT * FROM subsampletype WHERE sampleTypeID =? AND `sampleTypeId` != '4'";
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        return $statement1->fetchAll();
    }
    public function showMidiTypes()
    {
        $cal = "SELECT * FROM sampletype WHERE `typeName` = 'midi' AND `sampleTypeID` = '4' ";
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute();
        return $statement1->fetchAll();
    }
    public function showSubSampleMidiTypes($id)
    {
        $cal = "SELECT * FROM subsampletype WHERE sampleTypeID =? AND `sampleTypeId` = '4'";
        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        return $statement1->fetchAll();
    }
}

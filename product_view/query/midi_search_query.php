<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;

class MidiSearchQueries extends Db
{
    private $exactResultsPerPage = 2;
    private $totalcount;
    private $fetcharray;
    private $sample_type_id = 4;

    private $midi_sample_query = "SELECT * FROM samples 
    INNER JOIN subsampletype
    ON subsampletype.subsampleID =samples.SubsampleID
    INNER JOIN sampletype
    ON sampletype.sampleTypeID = subsampletype.sampleTypeID
    INNER JOIN sampleimages
    ON sampleimages.sampleID=samples.sampleID";

    public function getExactResultsPerPage()
    {
        return $this->exactResultsPerPage;
    }
    public function returnTotalCount()
    {
        return $this->totalcount;
    }

    public function getSampleTypeId(){
        return $this->sample_type_id;
    }

    public function searchByText($searchtext, $PG)
    {
        if ($searchtext == "") {
            $cal = $this->midi_sample_query;
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute();
        } else {
            $cal = $this->midi_sample_query . " " . "WHERE sampletype.sampleTypeID = '" . $this->sample_type_id . "' AND (samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ?) ;";
            $propertext = '%' . $searchtext . '%';
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute([$propertext, $propertext]);
        }



        $this->totalcount = count($statement1->fetchAll());

        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return $this->fetcharray;
        } else {
            $totalPages = ceil($this->totalcount / $this->exactResultsPerPage);

            if ($PG >= ($totalPages - 1) * $this->exactResultsPerPage) {
                $PG = ($totalPages - 1) * $this->exactResultsPerPage;
            } else if ($PG <= 0) {
                $PG = 0;
            }
            if ($searchtext == "") {
                $sql = $this->midi_sample_query . " " . "LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG ";
                $statement2 = $this->connect()->prepare($sql);
                $statement2->execute();
            } else {


                $sql = $this->midi_sample_query . " " . "WHERE sampletype.sampleTypeID = '" . $this->sample_type_id . "' AND (samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ?) LIMIT " . " " . $this->exactResultsPerPage . " " . "OFFSET $PG ";
                $propertext = '%' . $searchtext . '%';

                $statement2 = $this->connect()->prepare($sql);
                $statement2->execute([$propertext, $propertext]);
            }


            return $statement2->fetchAll();
        }
    }

    public function searchByTextPages($searchtext)
    {
        if ($searchtext == "") {
            $cal = $this->midi_sample_query;
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute();
        } else {
            $cal = "SELECT * FROM samples WHERE sampletype.sampleTypeID = '" . $this->sample_type_id . "' AND (samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ?);";
            $propertext = '%' . $searchtext . '%';
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute([$propertext, $propertext]);
        }





        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return 0;
        } else {
            $totalPages = (ceil($this->totalcount / $this->exactResultsPerPage) - 1);

            return $totalPages;
        }
    }
    public function searchByTextMidi($searchtext, $PG)
    {
        if ($searchtext == "") {
            $cal = $this->midi_sample_query . " WHERE sampletype.sampleTypeID = '".$this->sample_type_id."'";
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute();
        } else {
            $cal = $this->midi_sample_query . " " . "WHERE sampletype.sampleTypeID = '" . $this->sample_type_id . "' AND (samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ?);";
            $propertext = '%' . $searchtext . '%';
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute([$propertext, $propertext]);
        }



        $this->totalcount = count($statement1->fetchAll());

        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return $this->fetcharray;
        } else {
            $totalPages = ceil($this->totalcount / $this->exactResultsPerPage);

            if ($PG >= ($totalPages - 1) * $this->exactResultsPerPage) {
                $PG = ($totalPages - 1) * $this->exactResultsPerPage;
            } else if ($PG <= 0) {
                $PG = 0;
            }
            if ($searchtext == "") {
                $sql = $this->midi_sample_query . " WHERE sampletype.sampleTypeID = '" . $this->sample_type_id . "'  " . "LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG ";
                $statement2 = $this->connect()->prepare($sql);
                $statement2->execute();
            } else {


                $sql = $this->midi_sample_query . " " . "WHERE sampletype.sampleTypeID = '" . $this->sample_type_id . "' AND (samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ?) LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG ";
                $propertext = '%' . $searchtext . '%';
                
                $statement2 = $this->connect()->prepare($sql);
                $statement2->execute([$propertext, $propertext]);
            }


            return $statement2->fetchAll();
        }
    }

    public function searchByTextPagesMidi($searchtext)
    {
        if ($searchtext == "") {
            $cal = $this->midi_sample_query . " WHERE sampletype.sampleTypeID = '".$this->sample_type_id."' ";
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute();
        } else {
            $cal = $this->midi_sample_query . " WHERE sampletype.sampleTypeID = '" . $this->sample_type_id . "' AND (samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ?);";
            $propertext = '%' . $searchtext . '%';
            $statement1 = $this->connect()->prepare($cal);
            
            $statement1->execute([$propertext, $propertext]);
        }





        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return 0;
        } else {
            $totalPages = (ceil($this->totalcount / $this->exactResultsPerPage) - 1);

            return $totalPages;
        }
    }
}

<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;

class Sample_query_functions extends Db
{


    private $totalcount;
    private $fetcharray;
    private $exactResultsPerPage = 2;
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
    public function listSubSampleTypes($sample_type_name)
    {
        $query = "SELECT * FROM `subsampletype` WHERE `sampleTypeID` IN(SELECT `sampleTypeID` FROM `sampletype` WHERE `typeName`= ?);";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$sample_type_name]);
        $resultset = $statement->fetchAll();
        if (count($resultset) > 0) {
            return $resultset;
        } else {
            return $resultset;
        }
    }


    public function subSampleType($id, $PG)
    {
        $cal =  $this->subSamplesQuery . " " . "WHERE subsampletype.subsampleID = ?;";

        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
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

            $sql = $this->subSamplesQuery . " " . "WHERE subsampletype.subsampleID = ? LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG  ";

            $statement2 = $this->connect()->prepare($sql);
            $statement2->execute([$id]);

            return $statement2->fetchAll();
        }
    }
    public function subSampleTypeMidi($id, $PG)
    {
        $cal =  $this->midi_sample_query . " " . "WHERE subsampletype.subsampleID = ?;";

        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
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

            $sql = $this->midi_sample_query . " " . "WHERE subsampletype.subsampleID = ? LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG  ";

            $statement2 = $this->connect()->prepare($sql);
            $statement2->execute([$id]);

            return $statement2->fetchAll();
        }
    }
    public function subSampleTypePages($id)
    {
        $cal =  $this->subSamplesQuery . " " . "WHERE subsampletype.subsampleID = ?;";

        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return 0;
        } else {
            // echo count($statement1->fetchAll());
            $totalPages = (ceil($this->totalcount / $this->exactResultsPerPage) - 1);
            return $totalPages;
        }
    }
    public function subSampleTypePagesMidi($id)
    {
        $cal =  $this->midi_sample_query . " " . "WHERE subsampletype.subsampleID = ?;";

        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return 0;
        } else {
            // echo count($statement1->fetchAll());
            $totalPages = (ceil($this->totalcount / $this->exactResultsPerPage) - 1);
            return $totalPages;
        }
    }

    public function sampleType($id, $PG)
    {
        $joined_query = $this->sampleTypeQuery;

        $cal =  $joined_query . " " . "WHERE sampletype.sampleTypeID = ? ;";

        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return $this->fetcharray;
        } else {
            // echo count($statement1->fetchAll());
            $totalPages = ceil($this->totalcount / $this->exactResultsPerPage);

            if ($PG >= ($totalPages - 1) * $this->exactResultsPerPage) {
                $PG = ($totalPages - 1) * $this->exactResultsPerPage;
            } else if ($PG <= 0) {
                $PG = 0;
            }


            $sql = $joined_query . " " . "WHERE sampletype.sampleTypeID = ? LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG  ";

            $statement2 = $this->connect()->prepare($sql);
            $statement2->execute([$id]);

            return $statement2->fetchAll();
        }
    }

    public function sampleTypePages($id)
    {
        $joined_query = $this->sampleTypeQuery;

        $cal =  $joined_query . " " . "WHERE sampletype.sampleTypeID = ? ;";

        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");

            return 0;
        } else {
            // echo count($statement1->fetchAll());
            $totalPages = (ceil($this->totalcount / $this->exactResultsPerPage) - 1);
            return $totalPages;
        }
    }
    public function sampleTypePagesMidi($id)
    {
        $cal =  $this->midi_sample_query . " " . "WHERE sampletype.sampleTypeID = ? ;";

        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");

            return 0;
        } else {
            // echo count($statement1->fetchAll());
            $totalPages = (ceil($this->totalcount / $this->exactResultsPerPage) - 1);
            return $totalPages;
        }
    }

    public function sampleTypeMidi($id, $PG)
    {
        $cal =  $this->midi_sample_query . " " . "WHERE sampletype.sampleTypeID = ?;";

        $statement1 = $this->connect()->prepare($cal);
        $statement1->execute([$id]);
        $this->totalcount = count($statement1->fetchAll());
        if ($this->totalcount == 0) {
            $this->fetcharray = array("Nothing");
            return $this->fetcharray;
        } else {
            // echo count($statement1->fetchAll());
            $totalPages = ceil($this->totalcount / $this->exactResultsPerPage);

            if ($PG >= ($totalPages - 1) * $this->exactResultsPerPage) {
                $PG = ($totalPages - 1) * $this->exactResultsPerPage;
            } else if ($PG <= 0) {
                $PG = 0;
            }


            $sql = $this->midi_sample_query . " " . "WHERE sampletype.sampleTypeID = ? LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG  ";

            $statement2 = $this->connect()->prepare($sql);
            $statement2->execute([$id]);

            return $statement2->fetchAll();
        }
    }


    //Search section 

    public function searchByText($searchtext, $PG)
    {
        if ($searchtext == "") {
            $cal = $this->sampleTypeQuery;
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute();
        } else {
            $cal = $this->sampleTypeQuery . " " . "WHERE samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ? ;";
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
                $sql = $this->sampleTypeQuery . " " . "LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG ";
                $statement2 = $this->connect()->prepare($sql);
                $statement2->execute();
            } else {


                $sql = $this->sampleTypeQuery . " " . "WHERE samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ? LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG ";
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
            $cal = $this->sampleTypeQuery;
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute();
        } else {
            $cal = "SELECT * FROM samples WHERE samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ?;";
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
            $cal = $this->midi_sample_query;
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute();
        } else {
            $cal = $this->midi_sample_query . " " . "WHERE samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ? ;";
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


                $sql = $this->midi_sample_query . " " . "WHERE samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ? LIMIT" . " " . $this->exactResultsPerPage . " " . "OFFSET $PG ";
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
            $cal = $this->midi_sample_query;
            $statement1 = $this->connect()->prepare($cal);
            $statement1->execute();
        } else {
            $cal = "SELECT * FROM samples WHERE samples.Sample_Name LIKE ? OR samples.SampleDescription LIKE ?;";
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

    public function get_top_three_products()
    {
        $query = "SELECT SUM(qty),sampleID,unique_id,CustomerID,dnt,customer_email 
        FROM customer_purchase_history GROUP BY sampleID  ORDER BY qty  DESC LIMIT 3 ";
        $statement = $this->connect()->prepare($query);
        $statement->execute();
        $rows = count($statement->fetchAll());
        if ($rows > 2) {
            return $statement->fetchAll();
        }
    }
}

// $bbc = "INNER JOIN sampletype
//         ON sampletype.sampleTypeID = subsampletype.sampleTypeID
//         WHERE 
//         samples.SampleDescription REGEXP '^$value?'
//         OR samples.Sample_Name REGEXP '^$value?'
//         OR sampletype.typeName REGEXP '^$value?'
//         OR subsampletype.subsampleName REGEXP '^$value?';";

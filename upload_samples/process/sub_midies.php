<?php
$id = 4;
?>

<span class="">Midi Types</span>
<select name="" id="subMidiType">
    <?php
    require "../query/sample_queries.php";
    $object = new SampleQueries();
    $melodytypesearch = $object->showSubSampleMidiTypes($id);
    $melodytyperows = count($melodytypesearch);
    if ($melodytyperows >= 1) {
        for ($i = 0; $i < $melodytyperows; $i++) {
            $melodytyperowsfetch = $melodytypesearch;
            $melodytypename = $melodytyperowsfetch[$i]["subsampleName"];
            $melodytypeid = $melodytyperowsfetch[$i]["subsampleID"];
    ?>
            <option value="<?php echo $melodytypeid ?>"><?php echo $melodytypename; ?></option>
    <?php


        }
    }
    ?>
</select>
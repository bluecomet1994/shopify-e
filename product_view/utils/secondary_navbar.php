<?php
class SecondaryNavbar
{


   public static function setHtmlContent($div_id, $method_name, $sample_type_name, $resouces_path, $page_name)
   {
?>

      <div class="col-lg-4 col-md-5 col-6 text-start">
         <div class="row">
            <div class="col-lg-3 col-md-5 col-5 text-start">
               <span class="fs-5 fw-bolder">Filter By</span>
            </div>
            <div class="col-lg-6 col-md-7 col-7 text-start">
               <select  onchange="<?= $method_name ?>" class="selectTAG py-2 px-1" id="<?= $div_id ?>">
                  <?php

                  $query_object = new Sample_query_functions();
                  $subsamples = $query_object->listSubSampleTypes("$sample_type_name");
                  $arrsize = count($subsamples);
                  if (!$subsamples > 0) {
                  ?>
                     <option class="text-white"> NOPE</option>
                  <?php

                  } else {
                  ?>
                     <option value="ALL" class="text-white"> All</option>
                     <?php
                     for ($i = 0; $i < $arrsize; $i++) {
                        $sampleName = $subsamples[$i]['subsampleName'];
                        $sampleID = $subsamples[$i]['subsampleID'];

                     ?>
                        <option value="<?php echo $sampleID; ?>" class="text-white"> <?php echo $sampleName; ?></option>
                  <?php
                     }
                  }
                  ?>
               </select>
            </div>
         </div>


      </div>
      <div class="col-lg-4 col-md-7 col-6 text-start   text-center">
         <h1 class="sampleheading text-white"><?= $page_name ?></h1>
      </div>
      <div class="col-lg-4 col-12 text-start text-lg-end pt-3">

         <div class=" row">
            <div id="searchBoxDiv" class="col-lg-10 col-9  ">
               <input id="searchBox" class="text-dark px-2 py-1 " type="text">
            </div>
            <div class="col-lg-2 col-3 text-lg-start text-center">
               <img id="searchButton" class="searchIconImage" src="<?= $resouces_path ?>icons/search.png" alt="" srcset="">
            </div>
         </div>


      </div>
<?php
   }
}
?>
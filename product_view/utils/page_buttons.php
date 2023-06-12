<?php

class PageButtons
{
    

    public function produceBtns($totalpages, $currentPage, $subSampleType,$functionName,$pageName)
    {
        $A = $currentPage;
    
      
?>   
        <div class="col  text-center  d-grid ">
            <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo ($A - 1); ?>','<?php echo $subSampleType ?>','<?php echo $pageName; ?>');"><?php echo "Prev"; ?></button>
        </div>
        <?php
        if (($A - 2) < 0) {
        } else {
        ?>
            <div class="col  text-center  d-grid ">
                <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo ($A - 2); ?>','<?php echo $subSampleType ?>','<?php echo $pageName; ?>');"><?php echo $A - 1; ?></button>
            </div>

        <?php
        }
        if (($A - 1) < 0) {
        } else {
        ?>

            <div class="col  text-center  d-grid ">
                <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo ($A - 1); ?>','<?php echo $subSampleType ?>','<?php echo $pageName; ?>');"><?php echo $A; ?> </button>
            </div>
        <?php
        }
        ?>

        <div class="col  text-center  d-grid ">
            <button id="prev" style="background-color:black;color:white;border: white 1px solid;" class=" nextButton" onclick="<?php echo $functionName; ?>('<?php echo ($A); ?>','<?php echo $subSampleType ?>','<?php echo $pageName; ?>');"><?php echo $A + 1; ?></button>
        </div>

        <?php
        if (($A + 1) >= $totalpages) {
        } else {
        ?>
            <div class="col  text-center  d-grid ">
                <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo ($A + 1); ?>','<?php echo $subSampleType ?>','<?php echo $pageName; ?>');"><?php echo $A + 2; ?></button>
            </div>

        <?php
        }
        if (($A + 2) >= $totalpages) {
        } else {
        ?>

            <div class="col  text-center  d-grid ">
                <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo ($A + 2); ?>','<?php echo $subSampleType ?>','<?php echo $pageName; ?>');"><?php echo $A + 3; ?></button>
            </div>
        <?php
        }

        ?>
        <div class="col  text-center  d-grid">
            <button id="next" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo ($A + 1); ?>','<?php echo $subSampleType ?>','<?php echo $pageName; ?>');"><?php echo "Next"; ?></button>
        </div>

<?php

    }
    public function produceSearchBtns($totalpages, $currentPage, $subSampleType,$pageName)
    {
        $A = $currentPage;
?>
        <div class="col  text-center  d-grid ">
            <button id="prev" class=" nextButton" onclick="nextfunctionsearch('<?php echo ($A - 1); ?>','<?php echo $subSampleType ?>');"><?php echo "Prev"; ?></button>
        </div>
        <?php
        if (($A - 2) < 0) {
        } else {
        ?>
            <div class="col  text-center  d-grid ">
                <button id="prev" class=" nextButton" onclick="nextfunctionsearch('<?php echo ($A - 2); ?>','<?php echo $subSampleType ?>');"><?php echo $A - 1; ?></button>
            </div>

        <?php
        }
        if (($A - 1) < 0) {
        } else {
        ?>

            <div class="col  text-center  d-grid ">
                <button id="prev" class=" nextButton" onclick="nextfunctionsearch('<?php echo ($A - 1); ?>',<?php echo $subSampleType ?>);"><?php echo $A; ?></button>
            </div>
        <?php
        }
        ?>

        <div class="col  text-center  d-grid ">
            <button id="prev" class="bg-danger nextButton" onclick="nextfunctionsearch('<?php echo ($A); ?>',<?php echo $subSampleType ?>);"><?php echo $A + 1; ?></button>
        </div>

        <?php
        if (($A + 1) >= $totalpages) {
        } else {
        ?>
            <div class="col  text-center  d-grid ">
                <button id="prev" class=" nextButton" onclick="nextfunctionsearch('<?php echo ($A + 1); ?>',<?php echo $subSampleType ?>);"><?php echo $A + 2; ?></button>
            </div>

        <?php
        }
        if (($A + 2) >= $totalpages) {
        } else {
        ?>

            <div class="col  text-center  d-grid ">
                <button id="prev" class=" nextButton" onclick="nextfunctionsearch('<?php echo ($A + 2); ?>',<?php echo $subSampleType ?>);"><?php echo $A + 3; ?></button>
            </div>
        <?php
        }

        ?>
        <div class="col  text-center  d-grid">
            <button id="next" class=" nextButton" onclick="nextfunctionsearch('<?php echo ($A + 1); ?>',<?php echo $subSampleType ?>);"><?php echo "Next"; ?></button>
        </div>

<?php

    }
}
// $P = new PageButtons();
// $a = $P ->produceBtns(6,2,3,"null");
?>
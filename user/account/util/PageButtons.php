<?php

class PageButtons
{


    public function produceBtns($totalpages, $currentPage, $functionName, $functionParameters)
    {
        $A = $currentPage;

?>
        <div class="col  text-center  d-grid ">
            <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo $functionParameters; ?>');"><?php echo "Prev"; ?></button>
        </div>
        <?php
        if (!(($A - 2) < 0)) {
        
        ?>
            <div class="col  text-center  d-grid ">
                <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo $functionParameters * ($A - 2); ?>');"><?php echo $A - 1; ?></button>
            </div>

        <?php
        }
        if (($A - 1) < 0) {
        } else {
        ?>

            <div class="col  text-center  d-grid ">
                <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo $functionParameters * ($A - 1); ?>');"><?php echo $A; ?> </button>
            </div>
        <?php
        }
        ?>

        <div class="col  text-center  d-grid ">
            <button id="prev" style="background-color:black;color:white;border: white 1px solid;" class=" nextButton" onclick="<?php echo $functionName; ?>('<?php echo $functionParameters * $A; ?>');"><?php echo $A + 1; ?></button>
        </div>

        <?php
        if (($A + 1) >= $totalpages) {
        } else {
        ?>
            <div class="col  text-center  d-grid ">
                <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo $functionParameters * ($A + 1); ?>');"><?php echo $A + 2; ?></button>
            </div>

        <?php
        }
        if (($A + 2) >= $totalpages) {
        } else {
        ?>

            <div class="col  text-center  d-grid ">
                <button id="prev" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo $functionParameters * ($A + 2); ?>');"><?php echo $A + 3; ?></button>
            </div>
        <?php
        }

        ?>
        <div class="col  text-center  d-grid">
            <button id="next" class="bg-dark nextButton" onclick="<?php echo $functionName; ?>('<?php echo $functionParameters; ?>');"><?php echo "Next"; ?></button>
        </div>

<?php

    }
}

?>
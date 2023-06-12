     <?php
        if (!isset($_POST["unique_id"])  || !isset($_POST["dnt"])) {

            die();
        }
        $unique_id = $_POST["unique_id"];
        $dnt = $_POST["dnt"];

        ?>

     <form action="../process/authorize_download_process.php" onsubmit="return downloadConfirm('sdd');" method="post">
         <input type="text" readonly name="unique_id" value="<?php echo $unique_id ?>">
         <input type="text" readonly name="dnt" value="<?php echo $dnt ?>">
         <button type="submit">Download the product</button>
     </form>


<?php
session_start();
if (isset($_SESSION["userEmail"])) {

?>
    <button class=" updateRelatedButtons" onclick="updateuser();" class="text-dark">Update</button>
<?php
}
?>
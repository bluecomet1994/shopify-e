<?php
session_start();
if (!isset($_SESSION["userEmail"])) {
   die(); 
?>

<?php
} else {
    require_once "../query/User.php";
    $userQuery = new User();
    $userEmail = $_SESSION["userEmail"];
    $userDetails = $userQuery->getUserDetails($userEmail);
    $userName = $userDetails[0]["UserName"];
    $userFName = $userDetails[0]["FName"];
    $userLName = $userDetails[0]["LName"];
    $userPassword = $userDetails[0]["Password"];
    $userCustomerId = $userDetails[0]["CustomerID"];
   
?>
    <div class="row">

        


        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-4"><span class="px-2 py-1 ">User Name</span></div>
                <div class="col-8"><input id="username" class="w-100 userNameField px-2 py-1" type="text" value="<?php echo $userName; ?>"/></div>

            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-4"><span class="px-2 py-1 ">First Name</span></div>
                <div class="col-8"><input id="userfirstname" class="w-100 userNameField px-2 py-1" type="text" value="<?php echo $userFName; ?>"/></div>

            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="row">
                <div class="col-4"><span class="px-2 py-1 ">Last Name</span></div>
                <div class="col-8"><input id="userlastname" class="w-100 userNameField px-2 py-1" type="text" value="<?php echo $userLName; ?>"/></div>

            </div>
        </div>
    </div>
<?php
}
?>
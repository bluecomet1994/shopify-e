<?php
session_start();
unset($_SESSION["verifyForgotPasswordEmail"]);
if(!isset($_SESSION["userEmail"])){
    header('Location: /brymo8/userProcess/forgotPassword.php');
    // or die();
      exit();
}else{


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/forgotPassword.css">

    <title>Verify Forgot Password</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div id="signInOnly" class="col-12 signInOnly py-5">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 class="fw-bold">VERIFY CODE</h3>
                        </div>
                        <div class="col-md-4 offset-md-4 col-8 offset-2">
                            <div class="row">
                                <div class="col-12 py-3 ">
                                    <div class="row">
                                        <div class="col-12 text-start">
                                            <span class=" ms-0  ">CODE</span>
                                        </div>
                                        <div class="col-12 text-start  " id="errorMessage">
                                            <span  class=" ms-0   text-danger"></span>
                                        </div>
                                        <div class="col-12">
                                            <input id="inputVerifyCode" class="w-100 py-2 px-2 inputVerifyCode" type="Email">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 pt-1 pb-1 ">
                                    <div class="row">

                                        <div class="col-8 offset-2 pb-4 pt-2">
                                            <button onclick="verifyCode();" class="w-100 logInButton py-2">Verify Code</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="userProcess.js"></script>
</body>

</html>
<?php
}
?>
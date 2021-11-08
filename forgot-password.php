<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Forgot Password | Wesco</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
        <link rel="stylesheet" type="text/css" href="assets/fonts/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="assets/css/validationEngine.jquery.css" media="screen" />
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.validationEngine-en.js"></script>
        <script src="assets/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
         <?php
        require_once("web_admin/db.php");
        include('header.php');
    ?>
         <div class="container-fluid">
        <div class="loginWindow">
            <div class="logo">
                
            </div>
            <div class="forget-password text-center">
                <h4>Reset Your Password</h4>
                <p>Please enter the email address / username used to sign in to your account. An email will be sent with a link to reset your password.</p>

                <p>If you do not receive the reset email, please check your spam filter to ensure it wasn't filtered out. If you still don't find it, Click Here to request a manual password reset.</p>
                <!-- <form method="post" id="strRegisterForgetPassword" onsubmit="return false"> -->
                    <!-- <input type="text" class="validate[required,custom[email]]" id="user_email" name="user_email" placeholder="Registerd Email ID "> -->
                     <!-- <input type="hidden" id="frm_type" name="frm_type" value="forgot_password"> -->
                    <div class="btm-sec">
                        <span>
                            <a href="https://passwordreset.microsoftonline.com/" class="default-btn col-md-11">Reset Password Link</a>
                            <!-- <button type="button" id="SubmitForgotBtn" name="" class="default-btn"> Reset Password Link</button> -->
                        </span>
                        <a href="login.php" class="back-btn">Back</a>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
        <!-- <script src="assets/js/bootstrap.min.js"></script> -->
       <!--  <script type="text/javascript">
            $(document).ready(function(){
                $("#strRegisterForgetPassword").validationEngine();
                $("#SubmitForgotBtn").on('click',function(){
                    if( $("#strRegisterForgetPassword").validationEngine('validate') ){
                        var frmData = $("#strRegisterForgetPassword").serializeArray();
                        $.ajax({
                            type : 'POST',
                            data : frmData,
                            url : 'frmValidateData.php',
                            success: function(result){
                                alert('Password sent to your registered email id.');
                                window.location.href = "http://localhost:81/wesco_test/";
                            }
                        });
                    }
                });

            })
        </script> -->
    </body>
</html>

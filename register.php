<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Registration | Wesco</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
        <link rel="stylesheet" type="text/css" href="assets/fonts/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="assets/css/validationEngine.jquery.css" media="screen" />
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.validationEngine-en.js"></script>
        <script src="assets/js/jquery.validationEngine.js"></script>
<!-- <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script> -->
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
            <div class="register-form">
                <p>Create Account</p>
                <form method="post" id="strRegisterUser">
                    <div id="save"></div>
                    <input type="text" class="validate[required]" id="first_name" name="first_name" placeholder="First Name">
                    <input type="text" class="validate[required]" id="last_name" name="last_name" placeholder="Last Name">
                    <input type="email" class="validate[required,custom[email]]" id="email_create" name="email_create" placeholder="Your Email Id">
                    <input type="text" id="mobile_number" name="mobile_number"  placeholder="Mobile No (Optional)">
                    <input type="password" class="validate[required]"  id="password" name="password"  placeholder="Password">
                    <input type="password" class="validate[required, equals[password]]" id="confirm_password" name="confirm_password"  placeholder="Confirm Password">
                    <div class="btm-sec">
                        <span>
                            <input type="checkbox" class="validate[required]"  id="iagreeckh" name="iagreeckh">
                            I agree to the <a href="terms.php">Terms and Conditions</a>
                            <a href="http://localhost:81/wesco_test/login" class="back-btn">Back</a>
                        </span>
                        <span>
                            <button type="button" id="SubmitCreate" name="SubmitCreate" class="default-btn"> Submit</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <script src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                // $("#strRegisterUser").validationEngine();
                $("#SubmitCreate").on('click',function(){
                    // if( $("#strRegisterUser").validationEngine('validate') ){
                        $.ajax({
                            type : 'POST',
                            data : {fieldId:'email_create', fieldValue:$("#email_create").val()},
                            url : 'validateUserEmail.php',
                            success: function(result){
                                var json = $.parseJSON(result);
                                if(json[1] == false){
                                    $('#email_create').validationEngine('showPrompt', '*This email is already taken');
                                } else {
                                    registerUser();
                                }
                            }
                        });
                    // }
                });

                function registerUser(){
                    $.ajax({
                        type : 'POST',
                        data : $("#strRegisterUser").serializeArray(),
                        url : 'frmUserRegister.php',
                        success: function(result){
                            window.location.href = "http://localhost:81/wesco_test/register-thanks"
                        }
                    });   
                }

            })
        </script>
    </body>
</html>

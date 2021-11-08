<?php

    // ini_set('session.save_handler', 'redis');
    // ini_set('session.name', 'session');
    ini_set('session.cookie_domain', '.alidevops.tech');
    // ini_set('session.save_path', '/mnt/user-session-data');
    // ini_set('session.save_path', 'tcp://wesco-sso-poc.redis.cache.windows.net:6379?auth=U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');
    // ob_start();
    session_start();
    // $sessionId = session_id();
    require_once("web_admin/db.php");

    // if(!empty($_SESSION['get_user_id'])){
    //     header("location:index.php");
    // }
    $pgTitle = "Login | Wesco";


    if(isset($_GET['sso_status']) && ($_GET['sso_status'] == 'failed') ){
        $error = 'Invalid Login';
    }
    // if(isset($_POST['SubmitLogin'])){
    //     $uname = $_POST['email'];
    //     $upass = $_POST['passwd'];
            
    //     $stmtl = $conn->prepare("SELECT * FROM LWEB_USERS WHERE EMAIL=:username");
    //     $stmtl->execute(array(':username'=>$uname));
    //     $userRow=$stmtl->fetch(PDO::FETCH_ASSOC);
        
    //     // print_r($userRow);die;

    //     if(!empty($userRow)){
    //         if($upass == $userRow['PASS']){
    //             $_SESSION['get_user_id'] = $userRow['USERNAME'];
    //             $_SESSION['user_full_name'] = $userRow['EMAIL'];
    //             $connection->redirect('/wesco_web_app/home.php');
    //         }
    //         else
    //         {
    //             $error = "Wrong credentials provided";
    //         }
    //     }else{
    //         $error = "User not found";
    //     }
    // }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title><?php echo $pgTitle; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
        <link rel="stylesheet" type="text/css" href="assets/fonts/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css" />
        <script src="assets/js/jquery.min.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
    <?php
        require_once("web_admin/db.php");
        include("web_admin/functions.php");
        include('header.php');
        logEvent('Login screen accessed.');
    ?>
    
    <div class="container-fluid">

        <div class="loginWindow">
            <div class="logo">
                
            </div>
            <div class="row">
                <div class="col-md-8">
                    <p>Login into Your Account </p>
                    <!-- <form method="post" action="#"> -->
                        <input class="account_input form-control" id="sso_email" name="email" value="" placeholder='Email ID' type="email" required>
                        <!-- <input class="account_input form-control" id="passwd" placeholder="Password" name="passwd" value="" type="password" required> -->
                        <br/>
                        <?php if(!empty($error)){echo "<div class='alert alert-danger' style='padding:5px; margin-left:0px; margin-top:15px;'>".$error."</div>";} ?>
                        <!-- <button id="SubmitLogin" type="submit" name="SubmitLogin" class="default-btn signin">Sign In</button> -->
                        <a href="#" id="SubmitSsoLogin" class="btn default-btn">Login</a>
                    <!-- </form> -->
                     <div class="specs">
                        <!-- <span>
                            <input type="checkbox" name="">
                            Remember Me
                        </span> -->
                        <span><a href="forgot-password.php">Forgot Password ?</a></span>
                    </div>
                </div>
                <div class="lft-sec">
                   <!--  <p>Don't have an account? <a href="#">Sign Up!</a></p>
                    <a href="#" class="btn"><i class="fa-custom fa-icon-acc"></i></a>
                    <br/> <br/>
                    <a href="index_saml.php" class="btn default-btn">Login with SSO</a> -->

                   <!--  <div class="rth-sec">
                        <br/><br/>
                        <p>Login With SSO </p>
                        <form method="post" id="strSsoFrm" onsubmit="return false">
                            <div class="input-group mb-3">
                              <input type="text" id="sso_email" required class="account_input form-control" placeholder="Enter Email Id">
                              <div class="input-group-append">
                                <button class="btn btn-success" id="SubmitSsoLogin" type="button">Go</button> 
                              </div>
                            </div>
                        </form>
                    </div> -->                   
                </div>
            </div>
        </div>
        </div>
        <script src="assets/js/bootstrap.min.js"></script>

        <script type="text/javascript">
             $(document).ready(function(){
                $("#SubmitSsoLogin").on('click',function(){
                    var sso_email = $('#sso_email').val();
                    // console.log(sso_email);
                    if(sso_email != ''){
                        $.ajax({
                            type : 'POST',
                            data : {'sso_email' : sso_email},
                            url : 'frmValidateData.php',
                            success: function(result){
                                window.location.href = result;
                            }
                        });   
                    } else {
                        alert('Please enter valid email id.');
                    }
                });

            })
        </script>
    </body>
</html>

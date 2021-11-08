<?php
    // ob_start();
    ini_set('session.save_handler', 'redis');
    // ini_set('session.name', 'session');
    ini_set('session.cookie_domain', '.alidevops.tech');
    // ini_set('session.save_path', '/mnt/user-session-data');
    ini_set('session.save_path', 'tcp://wesco-sso-poc.redis.cache.windows.net:6379?auth=U3N4FNOJd9TNwHPpdaP41ELa3q8NB0pPlPyqVtJ5X3k=');
    
    session_start();
    $sessionId = session_id();
    require_once("web_admin/db.php");
    if(!empty($_SESSION['get_user_id'])){
        header("location:index.php");
    }
    $pgTitle = "Identity Validation | Wesco";
    $strEmailId = isset($_REQUEST['id']) ? base64_decode($_REQUEST['id']) : '';


    if(isset($_POST['SubmitLogin'])){
        $uname = $_POST['email'];
        $upass = $_POST['passwd'];
        
        $stmtl = $conn->prepare("SELECT * FROM LWEB_USERS WHERE EMAIL=:username");
        $stmtl->execute(array(':username'=>$uname));
        $userRow=$stmtl->fetch(PDO::FETCH_ASSOC);
        
        
        if(!empty($userRow)){
            if($upass == $userRow['PASS']){
                $_SESSION['get_user_id'] = $userRow['USERNAME'];
                $_SESSION['user_full_name'] = $userRow['EMAIL'];
                $_SESSION['login_type'] = 'oracle';
                $connection->redirect('/wesco_web_app/home.php');
            }
            else
            {
                $error = "Wrong credentials provided";
            }
        }else{
            $error = "User not found";
        }
    }

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
        include('header.php');
    ?>
    
    <div class="container-fluid">

        <div class="loginWindow">
            <div class="logo">
                
            </div>
            <div class="row">
                <div class="contact-form">
                    <div class="rth-sec">
                        <div id='identity-box'>
                            <h3>Wesco SSO Identity Validation </h3>
                            <p style="text-align: justify;font-size: 12px;">Notice: Our security systems are upgraded to SSO, this is the preferred method of authentication. 
Please validate your identity by clicking the "Validate Identity" button below and confirm via accepting the link sent in the email.
</p>
                            
                            <!-- https://myaccess.microsoft.com/@xoriant.onmicrosoft.com#/access-packages/24150cd8-049d-4848-98f9-80d6c72714b8 -->

                            <input class="account_input form-control" value="<?= $strEmailId ?>" id="user_sso_email" name="email" value="" placeholder='Email ID' type="email" required>
                            <br/>
                            <a href="#" id="valdateIdentity" class="btn btn-success col-md-8">Validate Identity</a>    
                        </div>
                        
                        <div class ="clearfix"></div><br/>
                        <div id='success-message' class="alert alert-success" role="alert" style="display: none;"></div>
                    </div>
                    <div class="lft-sec">
                         <p style="text-align: left;">Login into Your Account </p>
                        <form method="post" action="#">
                            <input class="account_input form-control" id="usrEmail" name="email" value="" placeholder='Email ID' type="email" required>
                            <input class="account_input form-control" id="usrPasswd" placeholder="Password" name="passwd" value="" type="password" required>
                            <?php if(!empty($error)){echo "<div class='alert alert-danger' style='padding:5px; margin-left:0px; margin-top:15px;'>".$error."</div>";} ?>
                            <button id="SubmitLogin" type="submit" name="SubmitLogin" class="default-btn signin">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <script src="assets/js/bootstrap.min.js"></script>

        <script type="text/javascript">
             $(document).ready(function(){
                $("#valdateIdentity").on('click',function(){
                    var user_sso_email = $('#user_sso_email').val();
                    
                    // console.log(sso_email);
                    if(user_sso_email != ''){
                        $.ajax({
                            type : 'POST',
                            data : {'emailid' : user_sso_email},
                            url : 'validate_email_activation.php',
                            success: function(result){
                                $("#success-message").show();
                                $("#success-message").html('We have sent invitation link to your email, please accept the invitation by logging into email account and re-login.');
                                $("#identity-box").hide();
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

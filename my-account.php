<!DOCTYPE HTML>
<!--[if gt IE 8]> <html class="ie9" lang="en"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" class="ihome">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Holistique Learning provides school educational event plans such as plans on workshops, assemblies etc for imparting skills, values and knowledge beyond academics.">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>My Account | Wesco</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
        <link rel="stylesheet" type="text/css" href="assets/fonts/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
        ob_start();
        require_once("web_admin/db.php");
        include("web_admin/functions.php");
        include('header.php');
        if(empty($_SESSION['get_user_id'])){
            header("location:login.php");
        } 
        logEvent('My account screen accessed.');
        ?>
    
    <div class="container-fluid">
        <div class="container">
          <div class="breadcrum row">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo DIR; ?>">Home</a></li>
                  <li class="breadcrumb-item active">My Account</li>
              </ol>
          </div>
          <div class="row my-account">
            <div class="container">
              <div class="row">
                
                  <!-- tabs left -->
                  <div class="tabbable tabs-left">
                  <div class="col-sm-3 pull-right">
                    
                    </div>
                    <div class="col-sm-9">
                      <div class="tab-content">
                       <div class="tab-pane active" id="a">
                        <div class="persnl-info">
                          <h5>Personal Information</h5>
                          <?php
                                //$userfetchQuery = $connection->OneRowCondition("*", "LWEB_USERS","EMAIL='{$_SESSION['user_full_name']}'");
                          ?>
                          <ul>
                              <!-- <li><span>Name :</span><?php //echo $sqlUserRow['user_full_name']; ?></li> -->
                              <li><span>Email :</span><?php echo $_SESSION['get_user_id']; ?></li>
                             <!--  <li>
                                <span>Password :</span>
                                <span>Password Changed </span></p>
                              </li> -->
                              <!-- <li><span>Mobile No</span><?php // echo $sqlUserRow['user_phone_no']; ?></li> -->
                          </ul>
                          
                        </div>
                        </div>
                      
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        
       
       <?php include('footer.php'); ?>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
     <script type="text/javascript">
            $(function(){
                $("#frmChangeUserPassword").validationEngine();
                $("#frmUpdatePersonalDetails").validationEngine();

                $("#SubmitUserPassword").on('click',function(){
                    if($("#frmChangeUserPassword").validationEngine('validate')){
                        var frmData = $("#frmChangeUserPassword").serializeArray();
                        $.ajax({
                            type : 'POST',
                            data : frmData,
                            url : 'frmValidateData.php',
                            success: function(result){
                                alert('Password Changed Sucessfully.');
                                window.location.href = "http://www.holistiquelearning.com/my-account.php"
                                // txtChangePassText
                            }
                        });
                    }
                });

                $("#SubmitUpdatePersonalDetails").on('click',function(){
                    if($("#frmUpdatePersonalDetails").validationEngine('validate')){
                        var frmData = $("#frmUpdatePersonalDetails").serializeArray();
                        $.ajax({
                            type : 'POST',
                            data : frmData,
                            url : 'frmValidateData.php',
                            success: function(result){
                                alert('Details Updated Sucessfully.');
                                window.location.href = "http://www.holistiquelearning.com/my-account.php"
                                // txtChangePassText
                            }
                        });
                    }
                });

                $("#edit-info").on('click', function(){
                  $("#editInfo").show();
                })

            })
        </script>
        <script type="text/javascript">
          

        </script>
    </body>
</html>

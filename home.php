<!DOCTYPE HTML>
<!--[if gt IE 8]> <html class="ie9" lang="en"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" class="ihome">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Holistique Learning strive to nurture all the needs of a child's life: emotional, physical, social, intellectual, creative and spiritual, aiming at holistic child development.">
        <meta name="author" content="">
        <link rel="icon" href="assets/images/favicon.ico">
        <title>Home | Wesco</title>
    
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
        require_once("web_admin/db.php");
        include("web_admin/functions.php");
        include('header.php');

        logEvent('Home screen accessed.');
    ?>
    <div class="container-fluid">
        
        <div class="bannerHolisti" style="margin-top: 100px;">
            <h4><span>What's New with  </span>WebBlox?</h4>

            <p>
            So much is new, where do we start? The entire WebBlox application has been rebuilt. We've tried to keep things similar so longtime users don't have to learn things all over again.
            </p>
            <p>
                If you are a Liberty dealer using a legacy user account, please register for a Liberty ecommerce account. That will provide access to both WebBlox and the entire Liberty site. We will link the new user account so you still have access to all of your previous parts.
            </p>
            <p>
                If you have any problems, please raise an issue here or using the "WebBlox Problems?" bottom on the right of the screen within WebBlox.
            </p>
            <?php 
                if(empty($_SESSION['get_user_id'])){
            ?>
                <a href="<?php echo DIR.'login.php' ?>"><div class="row text-center"><button>Login</button></div></a>
            <?php } ?>
        </div>
        
        <?php include('footer.php'); ?>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
    </body>
</html>

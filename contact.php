<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Writers can connect to join our team. Educators/clients can connect in case of any feedback/ query/ suggestions.">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <title>Contact | Wesco</title>

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
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <?php require_once("web_admin/db.php");
    include("web_admin/functions.php");
    include('header.php');
    logEvent('Contact screen accessed.');
    ?>

    <div class="container-fluid">
        <div class="container">
            <div class="breadcrum row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo DIR; ?>">Home</a></li>
                    <li class="breadcrumb-item active">CONTACT</li>
                </ol>
            </div>
            <div class="row contact-us">
                <div class="col-sm-6">
                    <h4><span>Get in </span>touch</h4>
                    <p>
                        Headquarters<br />
                        11675 Ridgeline Drive<br />
                        Colorado Springs, Colorado<br />
                        80921 USA<br />
                        <br />
                        Phone: 719-260-0061<br />
                        Fax: 719-260-0075<br /><br />

                        Toll-Free: 800-530-8998<br />
                        Order E-Mail: orders@libav.com
                    </p>

                </div>
                <div class="col-sm-6">
                    <h2>Feel free to write to us</h2>
                    Customer Service Team<br />
                    800-530-8998<br />
                    customerservice@libav.com<br /><br />

                    Liberty Product Support<br />
                    800-530-8998<br />
                    supportlibav@libav.com
                </div>
            </div>
        </div>


        <?php include('footer.php'); ?>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
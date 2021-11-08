<?php
require "vendor/autoload.php";
?>
<!DOCTYPE HTML>
<!--[if gt IE 8]> <html class="ie9" lang="en"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" class="ihome">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Holistique Learning provides school educational event plans such as plans on workshops, Innovative Ideas for School , All Round Development of Child.">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <title>Product | Wesco</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/fonts/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="assets/js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- google analytics code -->

    <!-- google analytics code -->

</head>

<body>
    <?php require_once("web_admin/db.php");
    include("web_admin/functions.php");
    include('header.php');
    logEvent('Product screen accessed.');
    ?>

    <div class="container-fluid">

        <div class="container">
            <div class="breadcrum row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo DIR; ?>">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </div>
            <div class="row about-us">
                <div class="bannerHolisti">
                    <h4>Product Details: </h4>
                </div>
                <div class="row row-full">
                    <div class="col-sm-12 para">
                       <?php
                            $objGuzzle = new \GuzzleHttp\Client();

                            $strPricingurl = "http://dev-libav-eapi.us-e2.cloudhub.io/api/pricing/12-2C-GRY?uom=FT";

                            $strPricingResponse = $objGuzzle->request('GET',$strPricingurl,['headers' => [
                                                                    'client_id' => 'c51e049c40b443d29c9b1e0b62202243',
                                                                    'client_secret' => '604E635D7e73493F8d56C1D21427c466',
                                                                ]
                                                            ]);
                            
                            echo '<b>Pricing Details : </b>'.$strPricingResponse->getBody();

                            echo '<br/>';
                            $strInventoryurl = "http://dev-libav-eapi.us-e2.cloudhub.io/api/inventory/12-2C-GRY?uom=FA";
                            $strInventoryResponse = $objGuzzle->request('GET',$strInventoryurl,['headers' => [
                                                                    'client_id' => 'c51e049c40b443d29c9b1e0b62202243',
                                                                    'client_secret' => '604E635D7e73493F8d56C1D21427c466',
                                                                ]
                                                            ]);
                            
                            echo '<b>Inventory Details : </b>'.$strInventoryResponse->getBody();

                       ?>
                    </div>

                </div>

            </div>
        </div>


        <?php include('footer.php'); ?>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
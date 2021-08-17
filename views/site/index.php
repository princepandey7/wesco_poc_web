<?php

/* @var $this yii\web\View */

$this->title = 'Wesco';
use yii\helpers\Html;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">What's New with WebBlox?</h1>

        <p class="lead">So much is new, where do we start? The entire WebBlox application has been rebuilt. We've tried to keep things similar so longtime users don't have to learn things all over again.</p>

        <p>
            <!-- <a class="btn btn-lg btn-success" href="#">Login</a> -->
            <?= Html::a('LOGIN', ['/site/login'], ['class' => 'btn btn-lg btn-success','target'=>'_self']); ?>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <p>If you are a Liberty dealer using a legacy user account, please register for a Liberty ecommerce account. That will provide access to both WebBlox and the entire Liberty site. We will link the new user account so you still have access to all of your previous parts.</p>
            </div>
            <div class="col-lg-12">
                <p>If you have any problems, please raise an issue here or using the "WebBlox Problems?" bottom on the right of the screen within WebBlox. </p>
            </div>
        </div>

    </div>
</div>

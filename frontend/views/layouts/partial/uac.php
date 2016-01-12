<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;



$items = [
    [
        'label'=>'<i class="fa fa-user"></i>&nbsp;<span>Login Panel</span>',
        'content'=>$this->render('uac/login.php'),
        'active'=>true
    ],
    [
        'label'=>'<i class="fa fa-sign-in"></i>&nbsp;<span>Register Panel</span>',
        'content'=>$this->render('uac/register.php'),
    ],
    [
        'label'=>'<i class="fa fa-key"></i>&nbsp;<span>Forgot Password</span>',
        'content'=>$this->render('uac/forgot.php'),
    ],
    [
        'label'=>'<i class="fa fa-envelope"></i>&nbsp;<span>Contact Us</span>',
        'content'=>$this->render('uac/contact.php'),
    ],
];

// Left
echo TabsX::widget([
    'items'=>$items,
    'bordered'=>true,
    'position'=>TabsX::POS_LEFT,
    'encodeLabels'=>false,
    'containerOptions'=>['class'=>'tabbable custom-tabs tabs-animated  flat flat-all hide-label-980 shadow track-url auto-scroll'],
]); 
?>
<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="card_container record-200 card-tile" id="card_container" style="float:none; clear:both;">                
    <div class="secondary-context center">
        <div class="fs_11 label label-<?= $user->isConfirmed ? 'success' : 'warning' ?>"><i class="fa fa-user"></i></div>
        <div class="fs_11 label label-<?= $user->isVerifiedPayment ? 'success' : 'warning' ?>"><i class="fa fa-euro"></i></div>
        <div class="fs_11 label label-<?= $user->isVerifiedPhone ? 'success' : 'warning' ?>"><i class="fa fa-phone"></i></div>
        <div class="fs_11 label label-<?= $user->isCompletedSetup ? 'success' : 'warning' ?>"><i class="fa fa-check"></i></div>
        <div class="fs_11 label label-<?= $user->isBlocked ? 'success' : 'warning' ?>"><i class="fa fa-ban"></i></div>
        <div class="fs_11 label label-<?= $user->hasCredit ? 'success' : 'warning' ?>"><i class="fa fa-credit-card"></i></div>                       
    </div>
</div>
<div class="card_container record-200 card-tile" id="card_container" style="float:none; clear:both;"> 
    <div class="secondary-context cont">                    
        <p>Lokacija: <b><?= $user->location->location_name ?></b></p>
        <p>Kredit: <b><?= $user->details->Mcoin ?> <?= $user->currency->code ?></b></p>
        <p>Registrovan od: <b><?= Yii::$app->formatter->asDate($user->created_at, 'MMMM yy') ?></b></p>
    </div>               
</div> 
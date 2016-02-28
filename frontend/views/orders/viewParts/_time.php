<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="card_container record-full" id="card_container" style="float:none;">
    
    <?php /* time/loc */ ?>
    <div class="header-context">  
        <div class="avatar center gray-color">
            <i class="fa fa-calendar fa-3x"></i>    
        </div>
        <div class="title">
            <div class="subhead"><?= Yii::t('app', 'vreme') ?></div> 
            <div class="head second"><?= $model->delivery_starts ?></div>                           
        </div>
    </div>                                                              
</div>
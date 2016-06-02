<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;

?>
<div class="card_container record-full transparent no-shadow no-margin fadeInUp animated" id="card_container" style="">
    <div class="primary-context overflow-hidden">
        <div class="avatar">
            <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'']) ?>
        </div>
        <div class="title">
            <div class="head grand"><?= c($object->tName) ?> <?= ($object->parent) ? '<span class="head major thin">['.c($object->parent->tName).']</span>' : null ?></div>
            <div class="subhead"><?= c($object->oType->tName) ?> <i class="fa fa-caret-right"></i> <?= c($object->oType->class->tName) ?></div>
        </div>          
    </div>
    <div class="secondary-context avatar-padded cont col-md-6">
        <p>Stan označava dio neke građevine koji služi za, u pravilu trajni, smještaj odnosno stanovanje pojedinca, porodice ili grupe osoba. Zgrada koja se većim dijelom sastoji od zasebnih stanova se naziva stambena zgrada.</p>
    </div>
</div>

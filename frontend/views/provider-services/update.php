<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjects */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Objects',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Objects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$this->pageTitle = [
    'icon' => 'credit-card',     
    'title' => Html::encode($this->title).Html::a('<i class="fa fa-arrow-circle-left"></i>&nbsp;'.Yii::t('app', 'Nazad na predmete'), Url::to('/'.$model->provider->user->username.'/objects'), ['class' => 'btn btn-default btn-sm float-right']),
    'description' => $pageDescription,
    'search' => null,
];
?>
<div class="user-objects-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

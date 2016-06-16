<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserPayment */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'načina plaćanja',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$this->params['user'] = $model->user;

$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$pageDescription .= Html::img('@web/images/general/credit-cards.png', ['width'=>130]);
$this->pageTitle = [
    'icon' => 'credit-card',     
    'title' => Html::encode($this->title).Html::a('<i class="fa fa-arrow-circle-left"></i>&nbsp;'.Yii::t('app', 'Nazad na listu načina plaćanja'), Url::to('/'.$model->user->username.'/payments'), ['class' => 'btn btn-default btn-sm float-right']),
    'description' => $pageDescription,
    'search' => null,
];
?>
<div class="user-payment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

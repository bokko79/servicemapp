<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Podešavanje profila';
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$this->pageTitle = [
    'icon' => 'cog',     
    'title' => Html::encode($this->title).Html::a('<i class="fa fa-arrow-circle-left"></i>&nbsp;'.Yii::t('app', 'Nazad na profil'), Url::to('/'.$model->username.'/home'), ['class' => 'btn btn-default btn-sm float-right']),
    'description' => $pageDescription,
    'search' => null,
];
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'details' => $details,
        'filters' => $filters,
        'images' => $images,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjects */

$this->title = Yii::t('app', 'Create User Objects');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Objects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$this->pageTitle = [
    'icon' => 'credit-card',     
    'title' => Html::encode($this->title),
    'description' => $pageDescription,
    'search' => null,
];
?>
	<span class="title_holder_home"> 
		<h2><i class="fa fa-wrench"></i>&nbsp;<?= Yii::t('app', 'My Service Object Setup') ?></h2>
		<p><?= Yii::t('app', 'Edit the details about your service object.') ?></p>
	</span>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

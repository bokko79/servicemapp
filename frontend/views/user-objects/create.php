<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjects */

$this->title = Yii::t('app', 'Create User Objects');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Objects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
	<span class="title_holder_home"> 
		<h2><i class="fa fa-wrench"></i>&nbsp;<?= Yii::t('app', 'My Service Object Setup') ?></h2>
		<p><?= Yii::t('app', 'Edit the details about your service object.') ?></p>
	</span>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

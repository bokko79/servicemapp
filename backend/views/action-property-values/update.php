<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsActionPropertyValues */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Action Property Value',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Action Property Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsServices */

$this->title = 'Update Service: ' . ' ' . $model->tName;
$this->params['breadcrumbs'][] = ['label' => 'Cs Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

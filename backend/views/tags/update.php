<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsTags */

$this->title = 'Update Tag: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
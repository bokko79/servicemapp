<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceSkills */

$this->title = 'Update Service Industry Property: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Service Industry Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<h2><?= Html::encode($this->title) ?></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>


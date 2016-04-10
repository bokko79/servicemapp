<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsActions */

$this->title = 'Update Cs Actions: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-actions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

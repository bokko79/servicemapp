<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsSpecs */

$this->title = 'Update Cs Specs: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cs Specs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-specs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsSectors */

$this->title = 'Update Cs Sectors: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-sectors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

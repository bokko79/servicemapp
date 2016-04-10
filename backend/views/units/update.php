<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsUnits */

$this->title = 'Update Cs Units: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-units-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectClasses */

$this->title = 'Update Cs Object Classes: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Object Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-object-classes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

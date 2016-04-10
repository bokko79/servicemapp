<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsServices */

$this->title = 'Update Cs Services: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

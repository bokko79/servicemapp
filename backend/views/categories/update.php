<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsCategories */

$this->title = 'Update Cs Categories: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

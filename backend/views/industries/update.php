<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsIndustries */

$this->title = 'Update Cs Industries: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Industries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-industries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsSimilarIndustries */

$this->title = 'Update Cs Similar Industries: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cs Similar Industries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-similar-industries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

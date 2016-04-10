<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsTags */

$this->title = 'Update Cs Tags: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cs Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-tags-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

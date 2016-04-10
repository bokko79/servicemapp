<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsSpecs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cs Specs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-specs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'object_id',
            'object_name',
            'property_id',
            'property_name',
            'default_value',
            'range_min',
            'range_max',
            'range_step',
            'display_order',
            'required',
            'description',
        ],
    ]) ?>

</div>

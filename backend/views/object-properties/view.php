<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectProperties */

$this->title = $model->property->tName . '  ' . $model->object->tNameGen;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Object Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-object-properties-view">

    <h1><?= Html::a($model->property->tName, ['/properties/view', 'id' => $model->property->id]) . '  ' . Html::a($model->object->tNameGen, ['/objects/view', 'id' => $model->object->id]) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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
            'property_unit_id',
            'property_unit_imperial_id',
            'property_class',
            'property_type',
            'input_type',
            'value_default',
            'value_min',
            'value_max',
            'step',
            'pattern',
            'display_order',
            'multiple_values',
            'specific_values',
            'read_only',
            'required',
            'description',
        ],
    ]) ?>

</div>

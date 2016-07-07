<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsProductProperties */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>

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
        'product_id',
        'product_name',
        'object_property_id',
        'property_name',
        'property_unit_id',
        'property_unit_imperial_id',
        'property_class',
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
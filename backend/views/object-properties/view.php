<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->property->tName . '  ' . $model->object->tNameGen;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Object Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= c(Html::encode($this->title)) ?> <small>id: <?= $model->id ?> required: <?= $model->required==1 ? 'yes' : 'no' ?></small></h2>

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

<?php
    if($values = $model->property->propertyValues){ ?>

    <div class="card_container record-33 grid-item grid-item fadeInUp animated" id="card_container">
        <div class="primary-context gray normal">
            <div class="head major">Values</div>
        </div>
        <div class="secondary-context">
            <ul>
            <?php
                foreach ($values as $value){
                    echo '<li>'.Html::a(c($value->tName), ['/property-values/view', 'id'=>$value->id]) . ' </li> ';
                } ?>
            </ul>
        </div>
    </div>

<?php
    } ?>

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
    ],
]) ?>

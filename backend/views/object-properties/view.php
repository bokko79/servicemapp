<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

$this->title = $model->property->tName . '  ' . $model->object->tNameGen;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Object Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card_container record-full grid-item fadeInUp animated" id="card_container" style="float:none;">
            <div class="primary-context gray">

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
                    <?= Html::a('Property Values', Url::to('#property-values'), ['class' => 'btn btn-link']) ?>
                </p>
            </div>


                
             <div class="secondary-context">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'label' => 'Object',
                            'format' => 'raw',
                            'value'=> $model->object ? Html::a($model->object->tName, Url::to(['/objects/view', 'id'=>$model->object_id]), []) : null,
                        ],
                        [
                            'label' => 'Property',
                            'format' => 'raw',
                            'value'=> $model->property ? Html::a($model->property->tName, Url::to(['/properties/view', 'id'=>$model->property_id]), []) : null,
                        ],
                        [
                            'label' => 'Unit',
                            'format' => 'raw',
                            'value'=> $model->unit ? Html::a($model->unit->tName, Url::to(['/units/view', 'id'=>$model->property_unit_id]), []) : null,
                        ],
                        [
                            'label' => 'Unit Imperial',
                            'format' => 'raw',
                            'value'=> $model->unitImperial ? Html::a($model->unitImperial->tName, Url::to(['/units/view', 'id'=>$model->property_unit_imperial_id]), []) : null,
                        ],
                        'property_class',
                        'property_type',
                        'input_type',
                        'value_default',
                        'value_min',
                        'value_max',
                        'step',
                        'pattern',
                        'display_order',
                        [
                            'label' => 'Multiple Values',
                            'value'=> $model->multiple_values==1 ? 'Yes' : 'No',
                        ],
                        [
                            'label' => 'Specific Values',
                            'value'=> $model->specific_values==1 ? 'Yes' : 'No',
                        ],
                        [
                            'label' => 'Read Only',
                            'value'=> $model->read_only==1 ? 'Yes' : 'No',
                        ],
                        [
                            'label' => 'Required object property',
                            'value'=> $model->required==1 ? 'Yes' : 'No',
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
        
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card_container record-full grid-item fadeInUp animated" id="property-values">
            <div class="primary-context gray normal">
                <div class="head"><?= ($model->objectPropertyValues) ? Html::a('Object Property Values', Url::to(['/object-property-values/index', 'CsObjectPropertyValuesSearch[object_property_id]'=>$model->id]), []) : 'Object Property Values' ?></div>
                <div class="subhead"><?= Html::a('New Object Property Value', ['/object-property-values/create', 'CsObjectPropertyValues[object_property_id]' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?></div>
            </div>
            <div class="secondary-context">
                <?= GridView::widget([
                    'dataProvider' => $propertyValues,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'label'=>'Object',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return Html::a($data->objectProperty->object->tName, ['object-properties/view', 'id' => $data->object_property_id]);
                            },
                        ],
                        [
                            'label'=>'Property Value',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return $data->propertyValue ? Html::a($data->propertyValue->tName, ['property-values/view', 'id' => $data->property_value_id]) : null;
                            },
                        ],
                        [
                            'label'=>'Object',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return $data->object ? Html::a($data->object->tName, ['object-properties/view', 'id' => $data->object_id]) : null;
                            },
                        ],
                        'value_type',
                        [
                            'attribute' => 'selected_value',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return $data->selected_value==1 ? 'Yes' : 'No';
                            },
                        ],       

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update}',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return \Yii::$app->user->can('manageCoreDatabase') ? Html::a('Update', ['/object-property-values/update', 'id' => $model->id], ['class' => '', 'target' => 'blank']) : '';
                                },
                            ],                        
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
        
</div>

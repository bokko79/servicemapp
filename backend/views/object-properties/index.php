<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Object Properties');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?> <small>Svojstva predmeta</small></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
<p>
    <?= Html::a(Yii::t('app', 'Create New Object Property'), ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('app', 'Objects'), ['/objects/index'], ['class' => 'btn btn-warning']) ?>
    <?= Html::a(Yii::t('app', 'Properties'), ['/properties/index'], ['class' => 'btn btn-danger']) ?>
</p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['style' =>'width:50px'],
            ],
            [
                'attribute' => 'object_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->object ? Html::a($data->object->tName, Url::to(['/objects/view', 'id'=>$data->object_id]), []) : null;
                },
            ],
            [
                'attribute' => 'property_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->property->tName, Url::to(['/properties/view', 'id'=>$data->property_id]), []);
                },
            ],
            [
                'attribute' => 'property_unit_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->unit ? Html::a($data->unit->tName, Url::to(['/units/view', 'id'=>$data->property_unit_id]), []) : null;
                },
            ],
            // 'property_unit_imperial_id',
            'property_class',
            'property_type',

            // 'input_type',
            // 'value_default',
            // 'value_min',
            // 'value_max',
            // 'step',
            // 'pattern',
            // 'display_order',
            [
                'attribute' => 'multiple_values',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->multiple_values==1 ? Html::a('Yes', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#object-property-values-modal'.$data->id]) : 'No';
                },
            ],
            [
                'attribute' => 'specific_values',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->specific_values==1 ? 'Yes' : 'No';
                },
            ],
            // 'read_only',
            // 'required',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>

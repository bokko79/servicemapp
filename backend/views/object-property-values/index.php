<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsObjectPropertyValuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Object Property Values');
$this->params['breadcrumbs'][] = $this->title;
?>

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create New Object Property Value'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->id, ['object-properties/view', 'id' => $data->id]);
                },
                'options' => ['style' =>'width:50px'],
            ],
            [
                'label' => 'Object',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->objectProperty->object->tName, ['objects/view', 'id' => $data->objectProperty->object_id]);
                },
            ],
            [
                'attribute' => 'Property',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->objectProperty->property->tName, ['properties/view', 'id' => $data->objectProperty->property_id]);
                },
            ],
            [
                'attribute' => 'property_value_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->propertyValue ? Html::a($data->propertyValue->tName, ['property-values/view', 'id' => $data->property_value_id]) : null;
                },
            ],

            [
                'attribute' => 'object_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->object ? Html::a($data->object->tName, ['objects/view', 'id' => $data->object_id]) : null;
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
                        return \Yii::$app->user->can('manageCoreDatabase') ? Html::a('Update', ['/object-properties/update', 'id' => $model->id], ['class' => '']) : '';
                    },
                ],                        
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Objects';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Predmeti</small></h2>    

<p>
    <?= Html::a('Create New Objects', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Object Properties', ['/object-properties/index'], ['class' => 'btn btn-info']) ?>
    <?= Html::a('Object Types', ['/object-types/index'], ['class' => 'btn btn-danger']) ?>
    <?= Html::a('Object Issues', ['/object-issues/index'], ['class' => 'btn btn-warning']) ?>
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
                'attribute' => 'name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->tName, ['objects/view', 'id' => $data->id]);
                },
            ],
            [
                'attribute' => 'object_type_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->oType->tName, ['object-types/view', 'id' => $data->object_type_id]);
                },
            ],
            [
                'attribute' => 'object_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return $data->parent ? Html::a($data->parent->tName, ['objects/view', 'id' => $data->object_id]) : null;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [

                    'update' => function ($url, $model, $key) {
                        return \Yii::$app->user->can('manageCoreDatabase') ? Html::a('Update', ['update', 'id' => $model->id], ['class' => '']) : '';
                    },
                ],                     
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>

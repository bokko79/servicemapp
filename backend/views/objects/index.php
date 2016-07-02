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
            'id',
            'name',
            'object_type_id',
            'object_id',
            [
                'class' => 'yii\grid\ActionColumn',
                /*'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="material-icons">remove_red_eye</i>', ['view', 'id' => $model->id], ['class' => '']);
                    },

                    'update' => function ($url, $model, $key) {
                        return \Yii::$app->user->can('manageCoreDatabase') ? Html::a('<i class="material-icons">edit</i>', ['update', 'id' => $model->id], ['class' => '']) : '';
                    },

                    'delete' => function ($url, $model, $key) {
                        return \Yii::$app->user->can('manageCoreDatabase') ? Html::a('<i class="material-icons">delete</i>', ['delete', 'id' => $model->id], ['class' => '', 'data' => [
                                'confirm' => 'Are you sure you want to delete this item?','method' => 'post']]) : '';
                    },
                ],   */                     
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>

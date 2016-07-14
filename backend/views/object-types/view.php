<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Object Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= c(Html::encode($this->title)) ?> <small>id: <?= $model->id ?></small></h2>

<p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Add New Object', Url::to(['/objects/create', 'CsObjects[object_type_id]'=>$model->id]), ['class' => 'btn btn-primary']) ?>
    <?= ($model->objects) ? null : Html::a('Delete Object Type', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger btn-disabled',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?php
    if($objects){ ?>

    <div class="card_container record-full grid-item grid-item" id="card_container">
        <div class="primary-context gray normal">
            <div class="head major"><?= ($model->objects) ? Html::a('Objects', Url::to(['/objects/index', 'CsObjectsSearch[object_type_id]'=>$model->id]), []) : 'Objects' ?></div>
        </div>
        <div class="secondary-context">
            <?= GridView::widget([
                'dataProvider' => $objects,
                'columns' => [
                    'id',
                    [
                        'attribute'=>'name',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->tName, ['objects/view', 'id' => $data->id]);
                        },
                    ],
                    'level',
                    [
                        'attribute'=>'parent',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return $data->parent ? Html::a($data->parent->tName, ['objects/view', 'id' => $data->object_id]) : null;
                        },
                    ],
                    'image_id',
                    [
                        'attribute' => 'favour',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return $data->favour==1 ? 'Yes' : 'No';
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>

<?php
    } ?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
    ],
]) ?>


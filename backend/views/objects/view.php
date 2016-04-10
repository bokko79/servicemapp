<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Objects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-objects-view">

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
            'name',
            'object_type_id',
            'has_model',
            'object_id',
            'type',
            'favour',
            'image_id',
            'status',
            'added_by',
            'added_time',
            'description',
        ],
    ]) ?>

</div>

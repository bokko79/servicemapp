<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsServices */

$this->title = $model->tName;
$this->params['breadcrumbs'][] = ['label' => 'Cs Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h2><?= Html::encode($this->title) ?></h2>

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
            'image_id',
            'industry_id',
            'action_id',
            'action_name',
            'object_id',
            'object_name',
            'object_model_relevance',
            'service_type',
            'unit_id',
            'amount',
            'amount_default',
            'amount_range_min',
            'amount_range_max',
            'amount_range_step',
            'consumer',
            'consumer_children',
            'consumer_default',
            'consumer_range_min',
            'consumer_range_max',
            'consumer_range_step',
            'service_object',
            'pic',
            'location',
            'time',
            'duration',
            'frequency',
            'support',
            'turn_key',
            'tools',
            'labour_type',
            'coverage',
            'geospecific',
            'process',
            'dat',
            'availability',
            'ordering',
            'pricing',
            'terms',
            'status',
            'added_by',
            'added_time',
            'hit_counter',
        ],
    ]) ?>
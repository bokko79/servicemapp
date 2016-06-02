<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CsServices */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-services-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'name',
            'industry_id',
            'action_id',
            'action_name',
            'object_id',
            'object_name',
            'unit_id',
            'service_type',
            'amount',
            'pic',
            'object_ownership',
            'consumer',
            'support',
            'location',
            'time',
            'duration',
            'turn_key',
            'tools',
            'labour_type',
            'frequency',
            'coverage',
            'process',
            'geospecific',
            'dat',
            'status',
            'added_by',
            'added_time',
            'hit_counter',
        ],
    ]) ?>

</div>

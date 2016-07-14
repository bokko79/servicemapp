<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceOrderingFlow */

$this->title = $model->service_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Service Ordering Flows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-service-ordering-flow-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->service_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->service_id], [
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
            'service_id',
            'industry_properties',
            'object_container',
            'object_models',
            'object_properties',
            'object_files',
            'object_issues',
            'action_properties',
            'quantitites',
            'locations',
            'times:datetime',
            'budget',
            'advanced',
            'notifications',
            'terms',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Presentations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => c($model->pService->industry->tName), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => c($model->pService->tName), 'url' => ['/s/'.slug($model->pService->name)]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['presentation'] = $model;
?>
<div class="presentations-view">

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
            'activity_id',
            'offer_id',
            'provider_service_id',
            'description',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceSkills */

$this->title = $model->service->tName . ' - ' . $model->industryProperty->property->tName;
$this->params['breadcrumbs'][] = ['label' => 'Service Industry Property', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= c(Html::encode($this->title)) ?> <small>requirement: <?= $model->requirement ?></small></h2>

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
        'service_id',
        'service.tName',
        'industry_property_id',
        'industryProperty.property.tName',
        'requirement',
        'readOnly',
    ],
]) ?>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsPropertyModels */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Property Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-property-models-view">

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
            'property_id',
            'property_name',
            'selected_value',
            'hint',
            'image_id',
            'entry_by',
            'entry_time',
            'description',
        ],
    ]) ?>

</div>

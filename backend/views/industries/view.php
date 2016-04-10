<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsIndustries */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Industries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-industries-view">

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
            'code',
            'name',
            'category_id',
            'image_id',
            'subtitle',
            'status',
            'added_by',
            'added_time',
            'hit_counter',
            'description',
        ],
    ]) ?>

</div>

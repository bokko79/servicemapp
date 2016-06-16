<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CsProducts */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-products-view">

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
<div class="row">
    <div class="col-md-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'object_id',
                'object_property_id',
                'property_name',
                'name',
                'product_id',
                'level',
                'class',
                'base_product_id',
                'predecessor_id',
                'successor_id',
                'description',
            ],
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= DetailView::widget([
            'model' => $model2,
            'attributes' => [
                'id',
                'object_id',
                'object_property_id',
                'property_name',
                'name',
                'product_id',
                'level',
                'class',
                'base_product_id',
                'predecessor_id',
                'successor_id',
                'description',
            ],
        ]) ?>
    </div>
</div>
    

        

</div>

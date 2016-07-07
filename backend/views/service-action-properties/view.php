<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceMethods */

$this->title = $model->service->tName . ': ' . $model->actionProperty->property->tName;
$this->params['breadcrumbs'][] = ['label' => 'Service Action Property', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>requirement: <?= $model->requirement ?></small></h2>

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
        'action_property_id',
        'actionProperty.property.tName',
        'requirement',
    ],
]) ?>

<div class="card_container record-33 grid-item grid-item fadeInUp animated" id="card_container">
    <div class="primary-context gray normal">
        <div class="head major">Values</div>
    </div>
    <div class="secondary-context">
        <ul>
        <?php
            if($serviceActionPropertyValues = $model->serviceActionPropertyValues){
                foreach ($serviceActionPropertyValues as $child){
                    echo '<li>'.Html::a(c($child->id), ['view', 'id'=>$child->id]) . ' </li> ';
                } 
            } else if($actionPropertyValues = $model->actionProperty->actionPropertyValues) {
                foreach ($actionPropertyValues as $child){
                    echo '<li>'.Html::a(c($child->propertyValue->tName), ['view', 'id'=>$child->id]) . ' </li> ';
                }
            } else {
                foreach ($model->actionProperty->property->propertyValues as $child){
                    echo '<li>'.Html::a(c($child->tName), ['view', 'id'=>$child->id]) . ' </li> ';
                }
            } ?>
        </ul>
    </div>
</div>


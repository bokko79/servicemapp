<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsSkills */

$this->title = $model->industry->tName. '::'. $model->property->tName;
$this->params['breadcrumbs'][] = ['label' => 'Industry Property', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= c(Html::encode($this->title)) ?> <small>id: <?= $model->id ?> required: <?= $model->required==1 ? 'yes' : 'no' ?></small></h2>

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

<?php
    if($values = $model->property->propertyValues){ ?>

    <div class="card_container record-33 grid-item grid-item fadeInUp animated" id="card_container">
        <div class="primary-context gray normal">
            <div class="head major">Values</div>
        </div>
        <div class="secondary-context">
            <ul>
            <?php
                foreach ($values as $value){
                    echo '<li>'.Html::a(c($value->tName), ['/property-values/view', 'id'=>$value->id]) . ' </li> ';
                } ?>
            </ul>
        </div>
    </div>

<?php
    } ?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'industry_id',
        'property_id',
        'value_default',
        'value_min',
        'value_max',
        'step',
        'pattern',
        'display_order',
        'multiple_values',
        'read_only',
        'required',
    ],
]) ?>


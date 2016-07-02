<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Object Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= c(Html::encode($this->title)) ?> <small>id: <?= $model->id ?></small></h2>

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
    if($objects = $model->objects){ ?>

    <div class="card_container record-33 grid-item grid-item fadeInUp animated" id="card_container">
        <div class="primary-context gray normal">
            <div class="head major">Predmeti</div>
        </div>
        <div class="secondary-context">
            <ul>
            <?php
                foreach ($objects as $object){
                    echo '<li>'.Html::a(c($object->tName), ['/objects/view', 'id'=>$object->id]) . ' </li> ';
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
        'name',
    ],
]) ?>


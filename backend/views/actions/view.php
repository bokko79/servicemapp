<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsActions */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= c(Html::encode($this->title)) ?> <small>Action: <?= $model->status ?></small></h2>

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

<p>Services</p>
<p>Industries</p>
<p>Properties</p>
<p>Objects</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'object_mode',
        'status',
    ],
]) ?>


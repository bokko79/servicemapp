<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectIssues */

$this->title = $model->issue;
$this->params['breadcrumbs'][] = ['label' => 'Object Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= c(Html::encode($this->title)) ?> <small>type: <?= $model->type ?></small></h2>

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
        'object_id',
        'issue',
        'type',
    ],
]) ?>

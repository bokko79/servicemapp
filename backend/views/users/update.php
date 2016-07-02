<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Update User: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h2><?= c(Html::encode($this->title)) ?> <small>id: <?= $model->id ?> / type: <?= ($model->is_provider==1) ? 'provider' : 'user' ?></small></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MsgThread */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Msg Thread',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Msg Threads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="msg-thread-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

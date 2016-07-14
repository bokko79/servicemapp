<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceOrderingFlow */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cs Service Ordering Flow',
]) . ' ' . $model->service_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Service Ordering Flows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->service_id, 'url' => ['view', 'id' => $model->service_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cs-service-ordering-flow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

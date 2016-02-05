<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderTerms */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Provider Terms',
]) . ' ' . $model->provider_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provider Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->provider_id, 'url' => ['view', 'id' => $model->provider_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="provider-terms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

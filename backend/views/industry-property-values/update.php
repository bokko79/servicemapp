<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsIndustryPropertyValues */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cs Industry Property Values',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Industry Property Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cs-industry-property-values-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

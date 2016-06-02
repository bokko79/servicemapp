<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CsProducts */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cs Products',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cs-products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

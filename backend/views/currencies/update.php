<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsCurrencies */

$this->title = 'Update Cs Currencies: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-currencies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

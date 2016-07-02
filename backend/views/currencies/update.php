<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsCurrencies */

$this->title = 'Update Currency: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h2><?= Html::encode($this->title) ?> <small>code: <?= $model->code ?></small></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

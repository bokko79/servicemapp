<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsMethods */

$this->title = 'Update Cs Methods: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cs Methods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-methods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

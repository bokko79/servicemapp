<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsProperties */

$this->title = 'Create Cs Properties';
$this->params['breadcrumbs'][] = ['label' => 'Cs Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-properties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_trans' => $model_trans,
    ]) ?>

</div>

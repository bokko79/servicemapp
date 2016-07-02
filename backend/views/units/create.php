<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsUnits */

$this->title = 'Create New Unit';
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?> <small>Nova jedinica mere</small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,
]) ?>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsRegulations */

$this->title = 'Create New Regulation';
$this->params['breadcrumbs'][] = ['label' => 'Regulations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?> <small>Nova regulativa</small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,
]) ?>

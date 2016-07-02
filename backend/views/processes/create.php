<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsProcesses */

$this->title = 'Create New Process';
$this->params['breadcrumbs'][] = ['label' => 'Processes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?> <small>Novi proces</small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,

]) ?>

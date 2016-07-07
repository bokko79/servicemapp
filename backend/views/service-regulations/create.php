<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceRegulations */

$this->title = 'Create New Service Regulation';
$this->params['breadcrumbs'][] = ['label' => 'Service Regulations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
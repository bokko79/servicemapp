<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceUnits */

$this->title = 'Create New Service Units';
$this->params['breadcrumbs'][] = ['label' => 'Service Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
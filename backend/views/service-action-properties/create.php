<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceMethods */

$this->title = 'Create New Service Action Property';
$this->params['breadcrumbs'][] = ['label' => 'Cs Service Methods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>


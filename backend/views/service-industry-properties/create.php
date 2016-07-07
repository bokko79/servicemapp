<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceSkills */

$this->title = 'Create New Service Industry Property';
$this->params['breadcrumbs'][] = ['label' => 'Service Industry Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Novo svojstvo delatnosti usluge</small></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

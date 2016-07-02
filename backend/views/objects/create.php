<?php

use yii\helpers\Html;

$this->title = 'Create New Object';
$this->params['breadcrumbs'][] = ['label' => 'Objects', 'url' => ['index'], 'class'=>'breadcrumb'];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/'], 'class'=>'breadcrumb'];
?>        

<h2><?= Html::encode($this->title) ?> <small>Novi Predmet</small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,
]) ?>

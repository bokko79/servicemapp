<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsMethods */

$this->title = 'Create New Action Property';
$this->params['breadcrumbs'][] = ['label' => 'Action Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Novo svojstvo akcije</small></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>


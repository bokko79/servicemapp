<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsSkills */

$this->title = 'Create New Industry Property';
$this->params['breadcrumbs'][] = ['label' => 'Industry Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Novo svojstvo delatnosti</small></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>


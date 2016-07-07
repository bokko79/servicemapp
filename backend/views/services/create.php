<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServices */

$this->title = 'Create New Service';
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

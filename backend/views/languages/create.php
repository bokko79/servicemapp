<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsLanguages */

$this->title = 'Create New Language';
$this->params['breadcrumbs'][] = ['label' => 'Cs Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Novi jezik</small></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

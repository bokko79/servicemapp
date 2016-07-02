<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsCurrencies */

$this->title = 'Create New Currency';
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Nova Valuta</small></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

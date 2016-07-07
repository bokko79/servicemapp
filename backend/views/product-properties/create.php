<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsProductProperties */

$this->title = Yii::t('app', 'Create New Product Property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

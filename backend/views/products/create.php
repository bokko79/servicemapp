<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsProducts */

$this->title = Yii::t('app', 'Create New Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

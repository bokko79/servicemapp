<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsProductIssues */

$this->title = Yii::t('app', 'Create New Product Issues');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Issues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
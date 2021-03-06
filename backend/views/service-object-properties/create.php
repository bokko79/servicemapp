<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceObjectProperties */

$this->title = Yii::t('app', 'Create New Service Object Properties');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Object Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
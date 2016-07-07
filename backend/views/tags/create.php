<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsTags */

$this->title = 'Create New Tag';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
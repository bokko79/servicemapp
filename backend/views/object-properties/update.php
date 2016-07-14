<?php

use yii\helpers\Html;

$this->title = 'Update Object Property: ' . ' ' . $model->property->tName . ' ' . $model->object->tNameGen;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Object Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<h2><?= Html::encode($this->title) ?> <small>id: <?= $model->id ?> required: <?= $model->required==1 ? 'yes' : 'no' ?></small></h2>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsObjectProperties */

$this->title = Yii::t('app', 'Create New Object Property');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Object Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?> <small>Novo svojstvo predmeta</small></h2>

<p>
    <?= Html::a('New Object', ['/objects/create'], ['class' => 'btn btn-warning']) ?>
    <?= Html::a('New Property', ['/properties/create'], ['class' => 'btn btn-danger']) ?>
</p>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

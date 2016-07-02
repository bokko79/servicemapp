<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsObjectIssues */

$this->title = 'Create New Object Issue';
$this->params['breadcrumbs'][] = ['label' => 'Object Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?> <small>Novi problem predmeta</small></h2>

<?= $this->render('_form', [
    'model' => $model,
    'model_trans' => $model_trans,
]) ?>
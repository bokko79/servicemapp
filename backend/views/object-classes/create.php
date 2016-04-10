<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsObjectClasses */

$this->title = 'Create Cs Object Classes';
$this->params['breadcrumbs'][] = ['label' => 'Cs Object Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-object-classes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

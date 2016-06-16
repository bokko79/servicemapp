<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsObjectProperties */

$this->title = Yii::t('app', 'Create Cs Object Properties');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Object Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-object-properties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

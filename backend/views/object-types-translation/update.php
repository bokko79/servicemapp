<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectTypesTranslation */

$this->title = 'Update Cs Object Types Translation: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Object Types Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-object-types-translation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

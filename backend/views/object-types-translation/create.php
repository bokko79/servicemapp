<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsObjectTypesTranslation */

$this->title = 'Create Cs Object Types Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Object Types Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-object-types-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

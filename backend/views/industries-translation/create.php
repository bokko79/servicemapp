<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsIndustriesTranslation */

$this->title = 'Create Cs Industries Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Industries Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-industries-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

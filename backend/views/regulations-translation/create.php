<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsRegulationsTranslation */

$this->title = 'Create Cs Regulations Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Regulations Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-regulations-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

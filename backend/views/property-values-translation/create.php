<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsPropertyModelsTranslation */

$this->title = 'Create Cs Property Models Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Property Models Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-property-models-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

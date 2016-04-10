<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServicesTranslation */

$this->title = 'Create Cs Services Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Services Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-services-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

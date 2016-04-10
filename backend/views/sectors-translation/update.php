<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsSectorsTranslation */

$this->title = 'Update Cs Sectors Translation: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Sectors Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-sectors-translation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CsUnitsTranslation */

$this->title = 'Update Cs Units Translation: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Units Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cs-units-translation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

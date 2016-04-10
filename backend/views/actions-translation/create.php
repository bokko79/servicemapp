<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsActionsTranslation */

$this->title = 'Create Cs Actions Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Actions Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-actions-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

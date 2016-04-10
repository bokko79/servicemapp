<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsCategoriesTranslation */

$this->title = 'Create Cs Categories Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Categories Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-categories-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

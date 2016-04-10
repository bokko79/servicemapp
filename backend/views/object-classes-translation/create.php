<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsObjectClassesTranslation */

$this->title = 'Create Cs Object Classes Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Object Classes Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-object-classes-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

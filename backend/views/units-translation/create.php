<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsUnitsTranslation */

$this->title = 'Create Cs Units Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Units Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-units-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

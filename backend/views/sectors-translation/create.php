<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsSectorsTranslation */

$this->title = 'Create Cs Sectors Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Sectors Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-sectors-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

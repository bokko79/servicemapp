<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsProcessesTranslation */

$this->title = 'Create Cs Processes Translation';
$this->params['breadcrumbs'][] = ['label' => 'Cs Processes Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-processes-translation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsPropertyModels */

$this->title = 'Create Cs Property Models';
$this->params['breadcrumbs'][] = ['label' => 'Cs Property Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-property-models-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsSpecs */

$this->title = 'Create Cs Specs';
$this->params['breadcrumbs'][] = ['label' => 'Cs Specs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-specs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

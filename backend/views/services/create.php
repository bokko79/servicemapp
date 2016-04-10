<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServices */

$this->title = 'Create Cs Services';
$this->params['breadcrumbs'][] = ['label' => 'Cs Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

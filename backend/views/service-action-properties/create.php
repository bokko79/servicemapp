<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceMethods */

$this->title = 'Create Cs Service Methods';
$this->params['breadcrumbs'][] = ['label' => 'Cs Service Methods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-service-methods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

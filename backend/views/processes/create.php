<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsProcesses */

$this->title = 'Create Cs Processes';
$this->params['breadcrumbs'][] = ['label' => 'Cs Processes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-processes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

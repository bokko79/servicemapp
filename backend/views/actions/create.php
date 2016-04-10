<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsActions */

$this->title = 'Create Cs Actions';
$this->params['breadcrumbs'][] = ['label' => 'Cs Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-actions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

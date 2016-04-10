<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsMethods */

$this->title = 'Create Cs Methods';
$this->params['breadcrumbs'][] = ['label' => 'Cs Methods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-methods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

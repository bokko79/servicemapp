<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsRegulations */

$this->title = 'Create Cs Regulations';
$this->params['breadcrumbs'][] = ['label' => 'Cs Regulations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-regulations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsSectors */

$this->title = 'Create Cs Sectors';
$this->params['breadcrumbs'][] = ['label' => 'Cs Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-sectors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

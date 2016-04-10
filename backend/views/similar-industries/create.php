<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsSimilarIndustries */

$this->title = 'Create Cs Similar Industries';
$this->params['breadcrumbs'][] = ['label' => 'Cs Similar Industries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-similar-industries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

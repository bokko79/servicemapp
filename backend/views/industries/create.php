<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsIndustries */

$this->title = 'Create Cs Industries';
$this->params['breadcrumbs'][] = ['label' => 'Cs Industries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-industries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

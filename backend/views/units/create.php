<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsUnits */

$this->title = 'Create Cs Units';
$this->params['breadcrumbs'][] = ['label' => 'Cs Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-units-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

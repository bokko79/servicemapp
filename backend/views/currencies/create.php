<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsCurrencies */

$this->title = 'Create Cs Currencies';
$this->params['breadcrumbs'][] = ['label' => 'Cs Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-currencies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

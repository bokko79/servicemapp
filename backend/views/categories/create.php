<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsCategories */

$this->title = 'Create Cs Categories';
$this->params['breadcrumbs'][] = ['label' => 'Cs Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsObjects */

$this->title = 'Create Cs Objects';
$this->params['breadcrumbs'][] = ['label' => 'Cs Objects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-objects-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

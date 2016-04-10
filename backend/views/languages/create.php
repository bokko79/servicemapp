<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsLanguages */

$this->title = 'Create Cs Languages';
$this->params['breadcrumbs'][] = ['label' => 'Cs Languages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-languages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

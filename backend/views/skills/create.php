<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsSkills */

$this->title = 'Create Cs Skills';
$this->params['breadcrumbs'][] = ['label' => 'Cs Skills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-skills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

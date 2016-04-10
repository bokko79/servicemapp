<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsSimilarServices */

$this->title = 'Create Cs Similar Services';
$this->params['breadcrumbs'][] = ['label' => 'Cs Similar Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-similar-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

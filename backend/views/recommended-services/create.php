<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsRecommendedServices */

$this->title = 'Create Cs Recommended Services';
$this->params['breadcrumbs'][] = ['label' => 'Cs Recommended Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-recommended-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

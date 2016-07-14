<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceIndustryPropertyValues */

$this->title = Yii::t('app', 'Create Cs Service Industry Property Values');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Service Industry Property Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-service-industry-property-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

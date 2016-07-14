<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceOrderingFlow */

$this->title = Yii::t('app', 'Create Cs Service Ordering Flow');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Service Ordering Flows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-service-ordering-flow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

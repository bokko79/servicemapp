<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsServiceActionPropertyValues */

$this->title = Yii::t('app', 'Create Cs Service Action Property Values');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Service Action Property Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-service-action-property-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

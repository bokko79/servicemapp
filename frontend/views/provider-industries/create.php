<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderIndustries */

$this->title = Yii::t('app', 'Create Provider Industries');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provider Industries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-industries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

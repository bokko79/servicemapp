<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderServices */

$this->title = Yii::t('app', 'Create Provider Services');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provider Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

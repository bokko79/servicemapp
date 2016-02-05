<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderIndustrySkills */

$this->title = Yii::t('app', 'Create Provider Industry Skills');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provider Industry Skills'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-industry-skills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

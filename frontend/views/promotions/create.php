<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Promotions */

$this->title = Yii::t('app', 'Create Promotions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Promotions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

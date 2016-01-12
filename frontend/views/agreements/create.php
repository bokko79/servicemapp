<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Agreements */

$this->title = Yii::t('app', 'Create Agreements');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

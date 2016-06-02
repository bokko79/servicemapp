<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\CsProducts */

$this->title = Yii::t('app', 'Create Cs Products');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

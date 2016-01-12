<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\MsgThread */

$this->title = Yii::t('app', 'Create Msg Thread');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Msg Threads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msg-thread-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

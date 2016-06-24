<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = Yii::t('app', 'Nova prezentacija');
$this->params['breadcrumbs'][] = $this->title;
$this->params['service'] = $service;
$this->params['presentation'] = $model;
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>
<div class="presentations-create">
    <?= $this->render('_form_action', [
    	'service' => $service,
        'model' => $model,
        'model_action_properties' => $model_action_properties,
        'user' => $user,
    ]) ?>
</div>

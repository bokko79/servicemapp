<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = Yii::t('app', 'Nova prezentacija');
$this->params['breadcrumbs'][] = $this->title;
$this->params['service'] = $service;
$this->params['object_model'] = $object_model;
$this->params['presentation'] = $model;
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>
<div class="presentations-create">
    <?= $this->render('_form_object', [
    	'service' => $service,
        'model' => $model,
        'model_object_properties' => $model_object_properties,
        'object_model' => $object_model,        
        'user' => $user,        
    ]) ?>
</div>

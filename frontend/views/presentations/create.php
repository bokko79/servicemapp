<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = Yii::t('app', 'Napravi prezentaciju');
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>
<div class="presentations-create">

    <?= $this->render('_form', [
    	'service' => $service,
        'model' => $model,
        'model_methods' => $model_methods,
        'model_specs' => $model_specs,
        'object_model' => $object_model,
        'new_provider' => $new_provider,
        'returning_user' => $returning_user,
        'location'=> $location,
    ]) ?>

</div>

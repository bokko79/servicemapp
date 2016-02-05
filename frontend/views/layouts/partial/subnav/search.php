<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use frontend\models\CsServices;
?>
<div class="service_autocomplete_search" style="margin:0 auto;">
	<?php $form = kartik\widgets\ActiveForm::begin([]); ?>
		<?= $form->field(new CsServices, 'name', [
			'addon' => [
				'prepend' => ['content'=>'Usluge'],
				'append' => [
		            'content' => Html::button('Traži', ['class'=>'btn btn-primary']), 
		            'asButton' => true
		        ],
			]
		]) ?>
	<?php ActiveForm::end(); ?>
</div>
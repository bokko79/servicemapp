<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wrapper body fadeIn animated" style="">
	
            <?= $form->field($model, 'title', ['showLabels'=>false, 
	            	'addon'=>[
	            		'prepend'=>['content'=>'<i class="fa fa-search"></i>'],
	            		//'append'=>['content'=>Html::submitButton('<i class="fa fa-search"></i> Pretraži ponude', ['class'=>'btn btn-info']),
	            					//'asButton'=>true]
	            	]
            	])->input([], ['placeholder'=>'Pretraži ponude pomoću ključnih reči'])->label('Pretraga') ?>
        
</div>
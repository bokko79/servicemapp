<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wrapper body fadeIn animated" style="border-top:none;">
<?= $form->field($model, 'title', ['addon'=>['prepend'=>['content'=>'<i class="fa fa-search"></i>']]])->input([], ['placeholder'=>'Pretraži ponude pomoću ključnih reči'])->label('Pretraga') ?>
</div>
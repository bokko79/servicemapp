<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">7</span>&nbsp;
        <?php echo Yii::t('app', 'Koliko osoba '); ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">
    <?= $form->field($model, 'consumer', [
        	'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
            'feedbackIcon' => [
                'default' => 'user',
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'defaultOptions' => ['class'=>'text-primary']
            ]])->input('number', ['min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step, 'value'=>$service->consumer_default])->hint('Enter address in 4 lines. First 2 lines must contain the street details and next 2 lines the city, zip, and country detail.') ?>

<?php if($service->consumer_children!=0): ?>
    <?= $form->field($model, 'consumer_children', [
            'feedbackIcon' => [
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'defaultOptions' => ['class'=>'text-primary']
            ]])->input('number', ['min'=>0]) ?>
<?php endif; ?>
</div>
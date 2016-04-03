<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$property = $industry->skills->property;
$model_list = ArrayHelper::map($property->models, 'id', 'tNameWithHint');

foreach($property->models as $prop_model){
	if($prop_model->selected_value==1){
		$model->skills[] = $prop_model->id;
	}
}

if($session['cart']!=null){
    if($session['cart']['industry'][$industry->id]['skills']!=null){
        foreach($session['cart']['industry'][$industry->id]['skills'] as $skill){
            $model->skills[] = $skill;
        }
    }
}
//print_r($model->skills); die();
$message = 'Za obavljanje pojedinih usluga, pružalac usluge bi trebalo da poseduje neophodan pribor, određeno stručno znanje i veštine ili neke druge osobine, karakteristične za usluge koje obavlja.';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">1</span>&nbsp;
        <?php echo Yii::t('app', 'Kakvo {industry} zahtevate?', ['industry'=>$industry->tName]); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?= Form::widget([
    'model'=>$model,
    'form'=>$form,
    'options'=>['tag'=>'div', 'style'=>'margin:10px 0;'],
    'attributes'=> [
    	'skills' => [
    		'type'=>Form::INPUT_CHECKBOX_LIST,
    		'label' => $property->label,
    		//'hint'=> $property->tHint,
    		'fieldConfig'=>[
                'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
            ],	    		
    		'items' => $model_list,
    		'options'=>['tag'=>'ul', 'class'=>'column2', 'style'=>'padding:13px 20px 20px; background:#f8f8f8; border:1px solid #ddd; border-radius:4px;'],
    	]
    ]
]) ?>
</div>
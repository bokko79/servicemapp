<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$object = $service->object;
switch ($object->t[0]->name_gender) {
    case 'm':
        $whatkind = 'kakav';
        $your = 'Vaš';
        break;
    case 'f':
        $whatkind = 'kakva';
        $your = 'Vašu';
        break;  
    default:
        $whatkind = 'kakvo';
        $your = 'Vaše';
        break;
}
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-cube fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Reč-dve o {object}...', ['your'=>$your, 'object'=>$object->tNameDat]) ?>
    </label>
    <?= ' <span class="red">*</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">
<p class="hint-text"><?= ($service->service_object!=1) ? Yii::t('app', 'Opišite ukratko {your} {object}...', ['your'=>$your, 'object'=>$object->tName]) :
        Yii::t('app', 'Opišite ukratko {whatkind} {object} zahtevate...', ['whatkind'=>$whatkind, 'object'=>$object->tName]) ?></p>
<?php foreach($model_specs as $model_spec) {
		$specification = $model_spec->specification;
		$property = $model_spec->property;
		echo $this->render('specification/'.$property->formType.'.php', ['form'=>$form, 'key'=>$property->id, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service, 'object_type'=>$object_type]);
	} ?>    
</div>
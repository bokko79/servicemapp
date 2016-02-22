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

$message = ($service->service_object!=1) ? Yii::t('app', 'Opišite ukratko {your} {object}...', ['your'=>$your, 'object'=>$object->tName]) :
        Yii::t('app', 'Opišite ukratko {whatkind} {object} zahtevate...', ['whatkind'=>$whatkind, 'object'=>$object->tName]);
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
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php if($userObjects && ($service->service_object==2 || $service->service_object==3)){ ?>
            <?= $form->field($model, 'user_object', [])->dropDownList(ArrayHelper::map($userObjects, 'id', 'objectName'), ['prompt'=>'Izaberite sačuvani predmet usluge', 'class'=>'input-lg']) ?>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9" style="">                 
                    <h4 class="divider"><i class="fa fa-sort"></i> ILI</h4>
                    <div class="center">
                        <?= Html::a('<i class="fa fa-plus-circle"></i> Opišite novi predmet usluge', null, ['class'=>'btn btn-default new_obj']) ?>
                    </div>
                </div>
            </div>
            <div class="enter_objectSpec fadeIn animated" style="display:none">
<?php } ?>
    <?php foreach($model_specs as $model_spec) {
    		$specification = $model_spec->specification;
    		$property = $model_spec->property;
    		echo $this->render('specification/'.$property->formType.'.php', ['form'=>$form, 'key'=>$property->id, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service, 'object_type'=>$object_type]);
    	} ?>
<?php if($userObjects && ($service->service_object==2 || $service->service_object==3)){ ?>
    </div>
<?php } ?>
</div>
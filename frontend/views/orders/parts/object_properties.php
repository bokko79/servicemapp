<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\slider\Slider;

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

$message = ($object_ownership=='user') ? Yii::t('app', 'Opišite ukratko {your} {object}...', ['your'=>$your, 'object'=>$object->tName]) :
        Yii::t('app', 'Opišite ukratko {whatkind} {object} zahtevate...', ['whatkind'=>$whatkind, 'object'=>$object->tName]);
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">1</span>&nbsp;
        <i class="fa fa-cube fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Reč-dve o {object}...', ['your'=>$your, 'object'=>$object->tNameDat]) ?>
    </label>
    <?= ' <span class="red">*</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php if($userObjects and $object_ownership=='user'){ ?>    
        <?= $form->field($model, 'user_object', [
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%'],
                    'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%; top: 6px;']
                ],
        ])->dropDownList(ArrayHelper::map($userObjects, 'id', 'objectName'), ['prompt'=>'Izaberite sačuvani '.$object->tNameAkk, 'class'=>'input-lg']) ?>
        <?= Html::activeHiddenInput($model, 'checkUserObject', ['id'=>'checkUserObject_model']) ?>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-9" style="">                 
                <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
                <div class="center" style="margin:30px 0 20px">
                    <?= Html::a('<i class="fa fa-plus-circle"></i> Opišite novi '.$object->tName, null, ['class'=>'btn btn-default new_obj']) ?>
                </div>
            </div>
        </div>
        <div class="enter_objectSpec fadeIn animated" style="display:none">                
<?php } ?>
<?php foreach($model_object_properties as $model_object_property) {
		$objectProperty = $model_object_property->objectProperty;
		$property = $model_object_property->property;
        //$serviceObjectProperty = $objectProperty->serviceSpec($service->id);
        //if($serviceSpec and $serviceSpec->readOnly==0):
        switch($objectProperty->property_type)
        {
            

            default:
                echo $this->render('objectProperty/'.$property->formType($object_ownership).'.php', ['form'=>$form, 'key'=>$property->id, 'model_object_property'=>$model_object_property, 'objectProperty'=>$objectProperty, 'property'=>$property, 'service'=>$service, 'object_ownership'=>$object_ownership]);        
                echo Html::activeHiddenInput($model_object_property, 'checkUserObject', ['id'=>'checkUserObject_model_spec'.$property->id]);
                echo Html::activeHiddenInput($model_object_property, '['.$property->id.']checkIfRequired', ['id'=>'checkIfRequired_model_spec'.$property->id]);
        }
		
        //endif;   
    }
// 
    /*if($service->service_object==3 or $service->service_object==4){ ?>
        <h6 class="col-sm-offset-1 margin-top-20 gray-color">Količina ovakvih <?= $service->object->tNamePlGen ?></h6>
        <p class="hint-text col-sm-offset-1 margin-bottom-20">Koliko ovakvih <?= (($objects and count($objects)==1) ? $objects[0]->tNamePlGen : $service->object->tNamePlGen) ?> Vam je potrebno?</p>    
        <div class="form-group kv-fieldset-inline" style="margin:40px 0 0px;">
            <?php $model->item_count = 1; ?>
            <?= Html::activeLabel($model, 'item_count', [
                'label'=>Yii::t('app', 'Broj '). (($objects and count($objects)==1) ? $objects[0]->tNamePlGen : $service->object->tNamePlGen), 
                'class'=>'col-sm-3 control-label'
            ]); ?>
            <div class="col-sm-3" style="padding-right:0">
                <?= $form->field($model, 'item_count',[                
                    'showLabels'=>false
                ])->widget(Slider::classname(), [
                    'sliderColor'=>Slider::TYPE_INFO,
                    'handleColor'=>Slider::TYPE_INFO,
                    'pluginOptions'=>[
                        'min'=>1,
                        'max'=>20,
                        'step'=>1,
                        'tooltip'=>'always'
                    ]
                ])->hint($property->tHint) ?>           
            </div>        
        </div>
<?php }*/ ?>
<?php if($userObjects and $object_ownership=='user'){ ?>
    </div>
<?php } ?>
</div>
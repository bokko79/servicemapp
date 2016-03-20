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

$message = ($service->service_object==1) ? Yii::t('app', 'Opišite ukratko {your} {object}...', ['your'=>$your, 'object'=>($object_model and count($object_model)==1) ? $object_model[0]->tName : $object->tName]) :
        Yii::t('app', 'Opišite ukratko {whatkind} {object} nudite...', ['whatkind'=>$whatkind, 'object'=>($object_model and count($object_model)==1) ? $object_model[0]->tName : $object->tName]);
?>
<div class="wrapper headline" id="specification">
    <label class="head">
        <span class="badge">1</span>&nbsp;
        <i class="fa fa-cube fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Reč-dve o {object}...', ['your'=>$your, 'object'=>($object_model and count($object_model)==1) ? $object_model[0]->tNameDat : $object->tNameDat]) ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections01">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php if($user && $user->provider->presWithSameObject($object->id)!=null && $service->service_object==1){ ?>    
    <?= $form->field($model, 'provider_presentation_specs', [
            'feedbackIcon' => [
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%'],
                'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%; top: 6px;']
            ],
            'hintType' => ActiveField::HINT_SPECIAL,
            'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList(ArrayHelper::map($user->provider->presWithSameObject($object->id), 'id', 'name'), ['prompt'=>'Izaberite opis '.$object->tNameGen.' iz Vaših postojećih ponuda', 'class'=>'input-lg'])->hint('Već ste sačuvali ponudu usluge sa istim predmetom usluge. Ukoliko se radi o istom predmetu, ne morate ga ponovo opisivati, već izaberite tu ponudu iz padajućeg menija, radi uštede vremena.') ?>
    <?php // Html::activeHiddenInput($model, 'checkUserObject', ['id'=>'checkUserObject_model']) ?>
    <div class="form-group pres-specs-plaza" style="display:none;">
        <div class="col-md-offset-3 col-md-9">                 
            <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">                 
            <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
            <div class="center" style="margin:30px 0 20px">
                <?= Html::a('<i class="fa fa-plus-circle"></i> Opišite novi '.$object->tName, null, ['class'=>'btn btn-default new_pres_spec']) ?>
            </div>
        </div>
    </div>
    <div class="enter_presSpec fadeIn animated" style="display:none">
<?php } ?>
<?php 
    if($service->object->isPart()){ // ako je objekat "part", odvojiti specs od njega i od Object-a(parenta)
        $parent = $service->object->parent;
        $parentData = [];
        foreach($parent->specs as $sp){
            $parentData[] = $sp->id;
        }
        echo '<h5 class="col-sm-offset-3 gray-color margin-bottom-20">'.c($service->object->tName).'</h5>';
        foreach($model_specs as $index=>$model_spec) {
            $specification = $model_spec->specification;
            $property = $model_spec->property;
            if(!ArrayHelper::isIn($specification->id, $parentData)){
                if($property->formTypePresentation($service->service_object)!=null){
                    echo $this->render('specification/'.$property->formTypePresentation($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service]);        
                    echo Html::activeHiddenInput($model_spec, 'checkUserObject', ['id'=>'checkUserObject_model_spec'.$property->id]);
                    echo Html::activeHiddenInput($model_spec, '['.$index.']spec_id', ['value'=>$specification->id]);   
                }
            }                 
        }
        echo '<h5 class="col-sm-offset-3 gray-color"><hr>'.c($parent->tName).'</h5>';
        echo '<p class="col-sm-offset-3 hint margin-bottom-20">Opišite i detalje '.$parent->tNameGen.', kao celine.</p>';
        foreach($model_specs as $index=>$model_spec) {
            $specification = $model_spec->specification;
            $property = $model_spec->property;
            if(ArrayHelper::isIn($specification->id, $parentData)){
                if($property->formTypePresentation($service->service_object)!=null){
                    echo $this->render('specification/'.$property->formTypePresentation($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service]);        
                    echo Html::activeHiddenInput($model_spec, 'checkUserObject', ['id'=>'checkUserObject_model_spec'.$property->id]);
                    echo Html::activeHiddenInput($model_spec, '['.$index.']spec_id', ['value'=>$specification->id]);   
                }                    
            }                 
        }
    } else {
        foreach($model_specs as $index=>$model_spec) {
            $specification = $model_spec->specification;
            $property = $model_spec->property;
            if($property->formTypePresentation($service->service_object)!=null){
                echo $this->render('specification/'.$property->formTypePresentation($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service]);        
                echo Html::activeHiddenInput($model_spec, 'checkUserObject', ['id'=>'checkUserObject_model_spec'.$property->id]);
                echo Html::activeHiddenInput($model_spec, '['.$index.']spec_id', ['value'=>$specification->id]);   
            }      
        }
    }
if($user && $user->provider->presWithSameObject($object->id)!=null && $service->service_object==1){ ?>
    </div>
<?php } ?>
<?= $this->render('_submitButton.php') ?>
</div>
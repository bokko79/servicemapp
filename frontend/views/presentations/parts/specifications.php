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
<?= $this->render('specification/_similar_specifications.php', ['form'=>$form, 'model'=>$model, 'user'=>$user, 'service'=>$service, 'object'=>$object]) ?>
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
    } else { // ako objekat nije part
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
if($user && $user->provider->presWithSameObject($object->id)!=null && $service->service_object!=1 and Yii::$app->controller->action->id=='create'){ ?>
    </div>
<?php } ?>
<?= $this->render('_submitButton.php') ?>
</div>
<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$object_model = null;
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

$message = ($service->service_object==1) ? Yii::t('app', 'Opišite ukratko {your} {object}...', ['your'=>$your, 'object'=>$object->tName]) :
        Yii::t('app', 'Opišite ukratko {whatkind} {object} nudite...', ['whatkind'=>$whatkind, 'object'=>$object->tName]);
?>
<div class="wrapper headline search">
    <label class="head">
        <i class="fa fa-cube fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Opis {object}...', ['object'=>$object->tNameGen]) ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
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
                    echo $this->render('specification/'.$property->formTypePresentation($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service, 'input'=>Yii::$app->request->get('PresentationSpecs')]);        
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
                    echo $this->render('specification/'.$property->formTypePresentation($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service, 'input'=>Yii::$app->request->get('PresentationSpecs')]);        
                    echo Html::activeHiddenInput($model_spec, '['.$index.']spec_id', ['value'=>$specification->id]);   
                }                    
            }                 
        }
    } else { // ako objekat nije part
        foreach($model_specs as $index=>$model_spec) {
            $specification = $model_spec->specification;
            $property = $model_spec->property;
            if($property->formTypePresentation($service->service_object)!=null){
                echo $this->render('specification/'.$property->formTypePresentation($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_spec'=>$model_spec, 'specification'=>$specification, 'property'=>$property, 'service'=>$service, 'input'=>Yii::$app->request->get('PresentationSpecs')]);        
                echo Html::activeHiddenInput($model_spec, '['.$index.']spec_id', ['value'=>$specification->id]);   
            }      
        }
    } ?>
</div>
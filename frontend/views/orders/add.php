<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\web\Session;

$this->title = Yii::t('app', 'Naručivanje usluge');

$this->cart = [
    'session' => (Yii::$app->session['cart']['industry']!=null) ? Yii::$app->session['cart']['industry'][$service->industry_id]['data'] : null,
    'industry' => $service->industry_id,
];

$service = $model->service;
$object_ownership = $service->object_ownership;

$session = Yii::$app->session;
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>

<div class="card_container record-full transparent no-shadow fadeInUp animated overflow-hidden" id="card_container" style="float:none;">  
    <div class="header-context">                
        <div class="avatar">
            <?= Html::img('@web/images/cards/default_avatar.png') ?>          
        </div>
        <div class="title">
            <div class="subhead">Naručujete...</div>
            <div class="head colos gray-color regular"><?= c($service->tNameAkk) . ($object_models!=null ? ': '.$objects[0]->tName : null) ?></div>
            <div class="subhead">Globalno <i class="fa fa-question-circle"></i></div> 
        </div>
        <div class="subaction">
            Aukcijsko naručivanje usluge <i class="fa fa-question-circle"></i>
        </div>
    </div>
</div>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <fieldset class="settings" style="margin:30px 0 !important;">      


    <?php if($objectProperties!=null): // SERVICE OBJECT SPECIFICATIONS ?>
        <?= $this->render('parts/object_properties.php', ['form'=>$form, 'model'=>$model, 'service'=>$service, 'model_object_properties'=>$model_object_properties, 'userObjects'=>$userObjects, 'object_ownership'=>$object_ownership, 'serviceObjectProperties'=>$objectProperties, 'objects' => $objects]) ?>
    <?php endif; ?>

    <?php if($service->pic==1 && $object_ownership=='user'): // SERVICE OBJECT IMAGES ?>
        <?= $this->render('parts/pics.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>

    <?php if($service->service_type==3 && $service->object->issues!=null): // SERVICE OBJECT ISSUES ?>
        <?= $this->render('parts/issues.php', ['form'=>$form, 'service'=>$service, 'object_ownership'=>$object_ownership, 'serviceObjectProperties'=>$serviceObjectProperties, 'object_models' => $object_models]) ?>
    <?php endif; ?>

    <?php if($service->amount!=0): // SERVICE AMOUNT ?>
        <?= $this->render('parts/amount.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>   

    <?php  /*if($service->serviceActionProperties): // SERVICE ACTION METHODS ?>
        <?= $this->render('parts/action_properties.php', ['form'=>$form, 'service'=>$service, 'model'=>$model, 'model_action_properties'=>$model_action_properties, 'object_ownership'=>$object_ownership, 'serviceActionProperties'=>$serviceActionProperties]) ?>
    <?php endif; */ ?>

    <?php // ORDER NOTE AND TITLE ?>        
        <?= $this->render('parts/note.php', ['model'=>$model, 'form'=>$form, 'service'=>$service, 'objects' => $objects]) ?>

    <?php if($service->processes): // SERVICE PROCESS ?>
        <?= $this->render('parts/process.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>

        <hr>
        <div class="float-right col-sm-offset-5 col-sm-7 center" style="margin:20px;">
            <?= Html::hiddenInput('industry', $service->industry_id) ?>
            <?php if($service->service_type!=5 and $service->service_type!=7 and $service->service_type!=9 and $service->service_type!=13): ?>
                
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-basket"></i> Ubacite u korpu i dodajte {new} {object} <i class="fa fa-plus-circle"></i>', ['new'=>($service->object->tGender=='f' ? 'novu' : 'novi'), 'object'=>$service->object->tNameAkk]), ['class' => 'btn btn-default btn-lg', 'name' => 'addMoreServices']) ?>
                <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
            <?php endif; ?>
            <?= Html::submitButton(Yii::t('app', 'Pređite na završni korak i pošaljite porudžbinu <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-primary btn-lg']) ?>
            
                <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
            <?= Html::submitButton(Yii::t('app', 'Pretražite postojeće ponude za opisanu '.$service->tNameAkk.' <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-info', 'name' => 'searchPresentationIndex']) ?>
        </div>

    </fieldset>
<?php ActiveForm::end(); ?>


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
$object_type = $service->service_object;

$session = Yii::$app->session;
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>

<h6 class="gray-color regular">Naručujete globalno...</h6>
<h1 class="thin"><?= c($service->tName) . ($object_models!=null ? ': '.$objects[0]->tName : null) ?></h1>
<p class="hint gray-color regular">Aukcijsko naručivanje usluge</p>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <fieldset class="settings" style="margin:30px 0 !important;">      

    <?php if($service->serviceSkills && !isset($session['cart']) && $session['cart']['industry'][$service->industry_id]==null): // SERVICE INDUSTRY SKILLS ?>
        <?= $this->render('parts/skills.php', ['form'=>$form, 'service'=>$service, 'model'=>$model, 'industry'=>$service->industry, 'session'=>$session, 'model_skills' => $model_skills,]) ?>
    <?php endif; ?>    

    <?php if($objectSpecifications!=null): // SERVICE OBJECT SPECIFICATIONS ?>
        <?= $this->render('parts/specifications.php', ['form'=>$form, 'model'=>$model, 'service'=>$service, 'model_specs'=>$model_specs, 'userObjects'=>$userObjects, 'object_type'=>$object_type, 'serviceSpecs'=>$objectSpecifications, 'objects' => $objects]) ?>
    <?php endif; ?>

    <?php if($service->pic==1 && $object_type!=1): // SERVICE OBJECT IMAGES ?>
        <?= $this->render('parts/pics.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>

    <?php if($service->service_type==3 && $service->object->issues!=null): // SERVICE OBJECT ISSUES ?>
        <?= $this->render('parts/issues.php', ['form'=>$form, 'service'=>$service, 'object_type'=>$object_type, 'serviceSpecs'=>$serviceSpecs, 'object_models' => $object_models]) ?>
    <?php endif; ?>

    <?php if($service->amount!=0): // SERVICE AMOUNT ?>
        <?= $this->render('parts/amount.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>

    <?php if($service->consumer!=0): // SERVICE CONSUMERS ?>
        <?= $this->render('parts/consumers.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>

    <?php if($service->serviceMethods): // SERVICE ACTION METHODS ?>
        <?= $this->render('parts/methods.php', ['form'=>$form, 'service'=>$service, 'model'=>$model, 'model_methods'=>$model_methods, 'object_type'=>$object_type, 'serviceMethods'=>$serviceMethods]) ?>
    <?php endif; ?>

    <?php // ORDER NOTE AND TITLE ?>        
        <?= $this->render('parts/note.php', ['model'=>$model, 'form'=>$form, 'service'=>$service, 'objects' => $objects]) ?>

    <?php if($service->processes): // SERVICE PROCESS ?>
        <?= $this->render('parts/process.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>

        <hr>
        <div class="float-left col-sm-5 left" style="margin:20px;">            
            <?= Html::a(Yii::t('app', '<i class="fa fa-arrow-circle-left"></i> Odustani'), null, ['class' => 'btn btn-default', 'name' => 'searchPresentationIndex']) ?>
        </div>

        <div class="float-right col-sm-offset-7 col-sm-5 center" style="margin:20px;">
            <?= Html::hiddenInput('industry', $service->industry_id) ?>
            <?php if($service->service_type!=5 and $service->service_type!=7 and $service->service_type!=9 and $service->service_type!=13): ?>
                
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-basket"></i> Ubaci u korpu i dodaj {new} {object} <i class="fa fa-plus-circle"></i>', ['new'=>($service->object->tGender=='f' ? 'novu' : 'novi'), 'object'=>$service->object->tNameAkk]), ['class' => 'btn btn-default btn-lg', 'name' => 'addMoreServices']) ?>
                <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
            <?php endif; ?>
            <?= Html::submitButton(Yii::t('app', 'Završni korak i slanje porudžbine <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-primary btn-lg']) ?>
            
                <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
            <?= Html::submitButton(Yii::t('app', 'Pretraži ponude usluga za date kriterijume <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-info', 'name' => 'searchPresentationIndex']) ?>
        </div>

    </fieldset>
<?php ActiveForm::end(); ?>


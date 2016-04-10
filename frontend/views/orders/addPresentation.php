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

$object_type = $service->service_object;

$session = Yii::$app->session;
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>


<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <fieldset class="settings" style="margin:30px 0 !important;">      

    <?php if($service->industry->skills && !isset($session['cart']) && $session['cart']['industry'][$service->industry_id]==null): // SERVICE INDUSTRY SKILLS ?>
        <?= $this->render('parts/skills.php', ['form'=>$form, 'service'=>$service, 'model'=>$model, 'industry'=>$service->industry, 'session'=>$session]) ?>
    <?php endif; ?>

    <?php if($serviceMethods): // SERVICE ACTION METHODS ?>
        <?= $this->render('parts/methods.php', ['form'=>$form, 'service'=>$service, 'model'=>$model, 'model_methods'=>$model_methods, 'object_type'=>$object_type, 'serviceMethods'=>$serviceMethods]) ?>
    <?php endif; ?>

    <?php if($objectSpecifications!=null): // SERVICE OBJECT SPECIFICATIONS ?>
        <?= $this->render('parts/specifications.php', ['form'=>$form, 'model'=>$model, 'service'=>$service, 'model_specs'=>$model_specs, 'userObjects'=>$userObjects, 'object_type'=>$object_type, 'serviceSpecs'=>$objectSpecifications, 'object_models' => $object_models]) ?>
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

    <?php // ORDER NOTE AND TITLE ?>        
        <?= $this->render('parts/note.php', ['model'=>$model, 'form'=>$form, 'service'=>$service, 'objects' => $objects]) ?>

        <hr>
        <div class="float-right" style="margin:20px;">
            <?= Html::hiddenInput('industry', $service->industry_id) ?>
            <?= Html::submitButton(Yii::t('app', 'Nastavite <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-primary btn-lg']) ?>
            <?= Html::submitButton(Yii::t('app', 'Ubaci u korpu i dodaj još'), ['class' => 'btn btn-default btn-lg', 'name' => 'addMoreServices']) ?>
            <?= Html::submitButton(Yii::t('app', 'Pretraži ponude usluga za date kriterijume <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-primary btn-lg', 'name' => 'searchPresentationIndex']) ?>
        </div>

    </fieldset>
<?php ActiveForm::end(); ?>


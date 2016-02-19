<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\web\Session;

$this->title = Yii::t('app', 'Naručivanje usluge');
$this->params['breadcrumbs'][] = $this->title;

$this->pageTitle = [
    'icon' => 'cube',     
    'title' => Html::encode($this->title),
    'description' => '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', '').'</p>',
    'search' => null,
];

$service = $model->service;
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

    <?php if($service->industry->skills && !isset($session['cart'])): // SERVICE INDUSTRY SKILLS ?>
        <?= $this->render('parts/skills.php', ['form'=>$form, 'service'=>$service, 'model'=>$model, 'industry'=>$service->industry]) ?>
    <?php endif; ?>

    <?php if($serviceMethods): // SERVICE OBJECT SPECIFICATIONS ?>
        <?= $this->render('parts/methods.php', ['form'=>$form, 'service'=>$service, 'model_methods'=>$model_methods, 'object_type'=>$object_type, 'serviceMethods'=>$serviceMethods, 'no'=>2-$no_skill]) ?>
    <?php endif; ?>

    <?php if($serviceSpecs!=null) {
            echo $this->render('parts/specifications.php', ['form'=>$form, 'service'=>$service, 'model_specs'=>$model_specs, 'object_type'=>$object_type, 'serviceSpecs'=>$serviceSpecs, 'object_models' => $object_models, 'no'=>3-$no_skill-$no_method]);
        } elseif($object_models!=null){
            foreach($object_models as $key=>$object_model) {
                $object = \frontend\models\CsObjects::findOne($object_model);
                if ($object) {
                    if ($object->specs) {
                        echo $this->render('parts/specifications.php', ['form'=>$form, 'service'=>$service, 'model_specs'=>$model_specs, 'object_type'=>$object_type, 'serviceSpecs'=>$serviceSpecs, 'object_models' => $object_models, 'no'=>3-$no_skill-$no_method]);
                    }           
                }       
            }
        } ?>
    <?php if($service->pic==1 && $object_type!=1): // SERVICE OBJECT IMAGES ?>
        <?= $this->render('parts/pics.php', ['model'=>$model, 'form'=>$form, 'service'=>$service, 'no'=>4-$no_skill-$no_method-$no_spec]) ?>
    <?php endif; ?>

    <?php if($service->service_type==3 && $service->object->issues!=null): // SERVICE OBJECT ISSUES ?>
        <?= $this->render('parts/issues.php', ['form'=>$form, 'service'=>$service, 'object_type'=>$object_type, 'serviceSpecs'=>$serviceSpecs, 'object_models' => $object_models, 'no'=>5-$no_skill-$no_method-$no_spec-$no_pic]) ?>
    <?php endif; ?>

    <?php if($service->amount!=0): // SERVICE AMOUNT ?>
        <?= $this->render('parts/amount.php', ['model'=>$model, 'form'=>$form, 'service'=>$service, 'no'=>6-$no_skill-$no_method-$no_spec-$no_pic-$no_issue]) ?>
    <?php endif; ?>

    <?php if($service->consumer!=0): // SERVICE CONSUMERS ?>
        <?= $this->render('parts/consumers.php', ['model'=>$model, 'form'=>$form, 'service'=>$service, 'no'=>7-$no_skill-$no_method-$no_spec-$no_pic-$no_issue-$no_amount]) ?>
    <?php endif; ?> 

    <?php // ORDER NOTE AND TITLE ?>        
        <?= $this->render('parts/note.php', ['model'=>$model, 'form'=>$form, 'service'=>$service, 'no'=>8-$no_skill-$no_method-$no_spec-$no_pic-$no_issue-$no_amount-$no_consumer]) ?>

        <div class="float-right" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', 'Nastavite <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-primary btn-lg']) ?>
        </div>

    </fieldset>
<?php ActiveForm::end(); ?>


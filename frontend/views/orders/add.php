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

$session = Yii::$app->session;

$this->title = Yii::t('app', 'Index usluga');
$this->params['breadcrumbs'][] = $this->title;

echo count($session['cart']);
$service = $model->service;
$object_type = $service->service_object;

echo c($service->tName);
?>
<?= $this->render('_steps.php') ?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>
<?php
/*echo FormGrid::widget([
    'model'=>$model,
    'form'=>$form,
    'autoGenerateColumns'=>true,
    'rows'=>[
        [
            'contentBefore'=>'<legend class="text-info"><small>Account Info</small></legend>',
            'attributes'=>[       // 2 column layout
                'amount'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
                'amount_operator'=>['type'=>Form::INPUT_PASSWORD, 'options'=>['placeholder'=>'Enter password...']],
            ]
        ],
        [
            'attributes'=>[       // 1 column layout
                'note'=>['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter notes...']],
            ],
        ],
    ]
]); */?>
    <fieldset class="settings" style="margin-bottom:10px !important;">      

    <?php if($serviceMethods): // SERVICE OBJECT SPECIFICATIONS ?>
        <?= $this->render('parts/methods.php', ['form'=>$form, 'service'=>$service, 'model_methods'=>$model_methods, 'object_type'=>$object_type, 'serviceMethods'=>$serviceMethods,]) ?>
    <?php endif; ?>

    <?php if($serviceSpecs!=null) {
        echo $this->render('parts/specifications.php', ['form'=>$form, 'service'=>$service, 'model_specs'=>$model_specs, 'object_type'=>$object_type, 'serviceSpecs'=>$serviceSpecs, 'object_models' => $object_models,]);
    } elseif($object_models!=null){
            foreach($object_models as $key=>$object_model) {
                $object = \frontend\models\CsObjects::findOne($object_model);
                if ($object) {
                    if ($object->specs) {
                        echo $this->render('parts/specifications.php', ['form'=>$form, 'service'=>$service, 'model_specs'=>$model_specs, 'object_type'=>$object_type, 'serviceSpecs'=>$serviceSpecs, 'object_models' => $object_models,]);
                    }           
                }       
            }
    } ?>

    <?php if($service->pic!=0 && $service->service_object!=1): // SERVICE OBJECT IMAGES ?>
        <?= $this->render('parts/pics.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>

    <?php if($service->service_type==3 && $service->object->issues!=null): // SERVICE OBJECT ISSUES ?>
        <?= $this->render('parts/issues.php', ['form'=>$form, 'service'=>$service, 'object_type'=>$object_type, 'serviceSpecs'=>$serviceSpecs, 'object_models' => $object_models,]) ?>
    <?php endif; ?>

    <?php if($service->amount!=0): // SERVICE AMOUNT ?>
        <?= $this->render('parts/amount.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>

    <?php if($service->consumer!=0): // SERVICE CONSUMERS ?>
        <?= $this->render('parts/consumers.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?> 

    <?php // ORDER NOTE AND TITLE ?>        
        <?= $this->render('parts/note.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>

        <div class="float-right" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', 'Nastavite <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-primary btn-lg']) ?>
        </div>

    </fieldset>
<?php ActiveForm::end(); ?>


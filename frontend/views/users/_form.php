<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjects */
/* @var $form yii\widgets\ActiveForm */
?>
    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'form-horizontal',
        'type' => ActiveForm::TYPE_VERTICAL,
    ]); ?>
        <fieldset class="settings new_object_atts" style="margin-bottom:10px !important;">
            <div class="wrapper headline" style="">

                <label class="head">
                    <i class="fa fa-map-marker"></i>&nbsp;
                    <?php echo Yii::t('app', 'Account info'); ?>
                </label>
                <i class="fa fa-chevron-right chevron"></i>
            </div>

            <div class="wrapper body fadeIn animated" style="border-top:none;">
<?php
        echo FormGrid::widget([
            'model'=>$model,
            'form'=>$form,
            'autoGenerateColumns'=>true,
            'rows'=>[
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'username'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'password_hash'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'email'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'fullname'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'invite_hash'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'type'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                        'phone'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                    ]
                ],
            ]
        ]); ?>
            </div>

            <div class="wrapper headline">

                <label class="head">
                    <i class="fa fa-map-marker"></i>&nbsp;
                    <?php echo Yii::t('app', 'User profile info'); ?>
                </label>
                <i class="fa fa-chevron-right chevron"></i>
            </div>

            <div class="wrapper body" style="border-top:none;">
<?php
        echo FormGrid::widget([
            'model'=>$details,
            'form'=>$form,
            'autoGenerateColumns'=>true,
            'rows'=>[                
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'loc_id'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'image_id'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'lang_code'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter address...'],
                            'columnOptions'=>['colspan'=>3],
                        ],
                        'currency_id'=>[
                            'type'=>Form::INPUT_HTML5, 
                            'options'=>['placeholder'=>'Zip...'],
                            'columnOptions'=>['colspan'=>1],
                            'html5type'=>'number',
                        ],
                        'role_id'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'city...'],
                            'columnOptions'=>['colspan'=>2],
                        ],
                        'units'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'country...'],
                            'columnOptions'=>['colspan'=>2],
                        ],
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'DOB'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'gender'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                    ]
                ],
            ]
        ]); ?>
            </div>

            <div class="wrapper headline">

                <label class="head">
                    <i class="fa fa-map-marker"></i>&nbsp;
                    <?php echo Yii::t('app', 'User profile info'); ?>
                </label>
                <i class="fa fa-chevron-right chevron"></i>
            </div>

            <div class="wrapper body" style="border-top:none;">
<?php
        echo FormGrid::widget([
            'model'=>$filters,
            'form'=>$form,
            'autoGenerateColumns'=>true,
            'rows'=>[                
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'kat'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'del'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                        'act'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'del'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],                        
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'loc_country'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'loc_state'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                        'loc'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'status'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],                        
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'time'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'deadline'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                        'ratingmin'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'ratingmax'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'prate'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'urate'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                        'language'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'lang'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                    ]
                ],
            ]
        ]); ?>
            </div>

<?php
        echo FormGrid::widget([
            'model'=>$model,
            'form'=>$form,
            'autoGenerateColumns'=>true,
            'rows'=>[                                
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[ 
                        
                        'actions'=>[    // embed raw HTML content
                            'type'=>Form::INPUT_RAW, 
                            'value'=>  '<div style="text-align: right; margin-top: 20px">' . 
                                Html::resetButton('Reset', ['class'=>'btn btn-default']) . ' ' .
                                Html::submitButton('Submit', ['class'=>'btn btn-primary']) . 
                                '</div>'
                        ],
                    ],
                ],
            ]
        ]); ?>

                        
        </fieldset>
    <?php ActiveForm::end(); ?>

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
                    'options' => ['tag'=>'div', 'class'=>'row', 'style'=>'margin-left:30px;'],
                    'attributes'=>[
                        'payment_type'=>[
                            'type'=>Form::INPUT_RAW,
                            'value'=> $form->field($model, 'payment_type')->radioButtonGroup([ 'MasterCard' => 'Master Card', 'Visa' => 'Visa', 'AmericanExpress' => 'American Express', 'PayPal' => 'PayPal',], [
                                                                                                'class' => '',
                                                                                                'itemOptions' => ['labelOptions' => ['class' => 'btn btn-info']]
                                                                                            ]),
                        ],                        
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'details'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
                        'card_no'=>[
                            'type'=>Form::INPUT_WIDGET,
                            'widgetClass'=>'\yii\widgets\MaskedInput',
                            'options'=>[
                                'mask' => '9999 9999 9999 9',
                            ],
                        ],
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'autoGenerateColumns'=>false,
                    'columns'=>12,
                    'attributes'=>[
                        'exp_mnth'=>[
                            'type'=>Form::INPUT_DROPDOWN_LIST, 
                            'items'=>[ 1 => 'Januar', 2 => 'Februar', 3 => 'Mart', 4 => 'April', 5 => 'Maj', 6 => 'Jun', 7 => 'Jul', 8 => 'Avgust', 9 => 'Septembar', 10 => 'Oktobar', 11 => 'Novembar', 12 => 'Decembar', ], 
                            'hint'=>'Type and select state',
                            'columnOptions'=>['colspan'=>6],
                        ],
                        'exp_year'=>[
                            'type'=>Form::INPUT_HTML5, 
                            'options'=>['placeholder'=>'Enter year...', 'value'=>date('Y')], 
                            'html5type'=>'number',
                            'columnOptions'=>['colspan'=>3],
                        ],
                        'scc'=>[
                            'type'=>Form::INPUT_HTML5, 
                            'options'=>['placeholder'=>'Enter year...'], 
                            'html5type'=>'number',
                            'columnOptions'=>['colspan'=>3],
                        ],
                    ]
                ]
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
            'model'=>$model,
            'form'=>$form,
            'autoGenerateColumns'=>true,
            'rows'=>[                
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'first_name'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter first name...'],
                        ],
                        'last_name'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter last name...'],
                        ],
                    ]
                ],
                [
                    'options' => ['tag'=>'div'],
                    'attributes'=>[
                        'street'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'Enter address...'],
                            'columnOptions'=>['colspan'=>3],
                        ],
                        'zip'=>[
                            'type'=>Form::INPUT_HTML5, 
                            'options'=>['placeholder'=>'Zip...'],
                            'columnOptions'=>['colspan'=>1],
                            'html5type'=>'number',
                        ],
                        'city'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'city...'],
                            'columnOptions'=>['colspan'=>2],
                        ],
                        'country'=>[
                            'type'=>Form::INPUT_TEXT, 
                            'options'=>['placeholder'=>'country...'],
                            'columnOptions'=>['colspan'=>2],
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



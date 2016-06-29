<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\RegistrationProviderForm;
use frontend\models\Locations;

$model = new RegistrationProviderForm();
$location = new Locations();
?>
<div class="container-fluid">
	<div class="row">
        <div class="col-md-5">
            <h4><i class="fa fa-sign-in"></i>&nbsp;&nbsp; Registracija provajdera</h4>
            <div class="margin-top-20" onclick="initialize_reg_pro_loc();">
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'provider-registration-form', 
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'action' => Url::to('/register-provider'),
                    //'enableAjaxValidation'   => true,
                    //'enableClientValidation' => false,
                    //'validationUrl' => Url::to('/user/registration/validate-form'),
                ]); 
            ?>
                <?= $form->field($model, 'username', [
                    'enableAjaxValidation' => true,
                    'feedbackIcon' => [
                        'default' => 'user',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->input('text') ?>
                <?= $form->field($model, 'password', [
                    'feedbackIcon' => [
                        'default' => 'lock',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->passwordInput() ?>
                <?= $form->field($model, 'password_repeat', [
                    'feedbackIcon' => [
                        'default' => 'lock',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->passwordInput() ?>
                <?= $form->field($model, 'email', [
                    'enableAjaxValidation' => true,
                    'feedbackIcon' => [
                        'default' => 'envelope',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->input('email') ?>
                <?= $form->field($location, 'name', [
                        'feedbackIcon' => [
                            'default' => 'screenshot',
                            'success' => 'ok',
                            'error' => 'exclamation-sign',
                            'successOptions' => ['class'=>'text-primary'],
                            'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
                        ],
                    ])->input([],[]) ?>                    
                    <?= $form->field($location, 'lat')->hiddenInput(['data-geo'=>'lat', 'id'=>'hidden-geo-input'])->label(false) ?>
                    <?= $form->field($location, 'lng')->hiddenInput(['data-geo'=>'lng', 'id'=>'hidden-geo-input'])->label(false) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'country', ['data-geo'=>'country', 'id'=>'hidden-geo-input']) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'state', ['data-geo'=>'state', 'id'=>'hidden-geo-input']) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'district', ['data-geo'=>'sublocality', 'id'=>'hidden-geo-input']) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'city', ['data-geo'=>'locality', 'id'=>'hidden-geo-input']) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'zip', ['data-geo'=>'postal_code', 'id'=>'hidden-geo-input']) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'mz', ['data-geo'=>'neighborhood', 'id'=>'hidden-geo-input']) ?>     
                    <?= yii\helpers\Html::activeHiddenInput($location, 'street', ['data-geo'=>'route', 'id'=>'hidden-geo-input']) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'no', ['data-geo'=>'street_number', 'id'=>'hidden-geo-input']) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'location_name', ['data-geo'=>'formatted_address', 'id'=>'hidden-geo-input']) ?>
                <?= $form->field($model, 'industry')->widget(Select2::classname(), [
                                'data' => frontend\models\CsIndustries::getAllIndustriesByCategories(),
                                'options' => ['placeholder' => 'Izaberite delatnost ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>

                <?= $form->field($model, 'registration_type')->hiddenInput(['value'=>1])->label(false) ?>
                <label>Klikom na dugme "Registracija provajdera", slažete se sa <a href="#">Uslovima korišćenja websajta.</a></label>
                <div class="form-group">
                    <?= Html::submitButton('Registracija provajdera', ['class' => 'btn btn-primary', 'style'=>'width:100%']) ?>
                </div>
            <?php ActiveForm::end(); ?>    
            </div>
        </div>
        <div class="col-md-7">
            <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Login</h4>
            <div class="box">
                Već ste se registrovali i imate aktivan nalog na servicemapp.com?<br>
                Da bi se prijavili, <a href="#w21-tab0" data-toggle="tab">kliknite ovde.</a>
            </div>
            <div class="box">
                Niste pružalac usluga? Da bi se registrovali kao korisnik, <a href="#w21-tab1" data-toggle="tab">kliknite ovde.</a>
            </div>
            <div id="my_map_register_pro" class="" style="height:320px; margin-bottom:20px;"></div>
        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use common\models\SignupProviderForm;
use frontend\models\Locations;

$model = new SignupProviderForm();
$location = new Locations();
$model->location = $location;
?>
<div class="container-fluid">
	<div class="row">
        <div class="col-md-5">
            <h4><i class="fa fa-sign-in"></i>&nbsp;&nbsp; Registrujte se kao korisnik</h4>


           <div class="margin-top-20" onclick="initialize_reg_loc();">
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'signupprovider-form-vertical', 
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'action' => Url::to('/registerProvider'),
                ]); 
            ?>
                <?= $form->field($model, 'username', [
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
                    'feedbackIcon' => [
                        'default' => 'envelope',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->input('email') ?>
                <?= $form->field($location, 'name', [
                        'addon' => ['prepend' => ['content'=>'<i class="fa fa-map-marker"></i>']],
                        'feedbackIcon' => [
                            'success' => 'ok',
                            'error' => 'exclamation-sign',
                            'successOptions' => ['class'=>'text-primary'],
                            'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
                        ],
                    ])->input([],[]) ?>                    
                    <?= yii\helpers\Html::activeHiddenInput($location, 'lat', ['data-geo'=>'lat', 'id'=>'hidden-geo-input']) ?>
                    <?= yii\helpers\Html::activeHiddenInput($location, 'lng', ['data-geo'=>'lng', 'id'=>'hidden-geo-input']) ?>         
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
                                'options' => ['placeholder' => 'Select a state ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                <label>I Aggree With <a href="#">Terms &amp; Conditions</a></label>
                <div class="form-group">
                    <?= Html::submitButton('Registracija provajdera', ['class' => 'btn btn-primary', 'style'=>'width:100%']) ?>
                </div>
            <?php ActiveForm::end(); ?>    
            </div>
        </div>
        <?php /*<div class="col-md-3">
            <h4><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Social</h4>
            <div class="socials clearfix">
                <a class="fa fa-facebook facebook"></a>
                <a class="fa fa-twitter twitter"></a>
                <a class="fa fa-google-plus google-plus"></a>
                <a class="fa fa-pinterest pinterest"></a>
                <a class="fa fa-linkedin linked-in"></a>
                <a class="fa fa-github github"></a>
            </div>
        </div> */ ?>
        <div class="col-md-7">
            <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Login</h4>
            <div class="box">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in.
                </p>
            </div>
            <div class="box">
                Already Have An Account.<br>
                Click Here For <a href="#panel2" data-toggle="tab">Login</a>
                <?= 333 ?>
            </div>
            <div id="my_map_register" class="" style="height:200px; margin-bottom:20px;"></div>
        </div>
    </div>
</div>
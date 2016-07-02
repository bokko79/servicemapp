<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dektrium\user\models\RegistrationForm;
use common\models\Locations;
use yii\bootstrap\Modal;

$model = Yii::createObject(RegistrationForm::className());
$location = new Locations();
?>
<div class="container-fluid">
	<div class="row">
        <div class="col-md-5">
            <h4><i class="fa fa-sign-in"></i>&nbsp;Registracija korisnika</h4>
            <div class="margin-top-20" onclick="initialize_reg_loc();">
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'signup-form-vertical', 
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'action' => Url::to('/user/registration/register'),
                    //'enableAjaxValidation'   => true,
                    //'enableClientValidation' => false,
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
                    ])->input('text',[]) ?>
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
                
                <label>Klikom na dugme "Registracija provajdera", slažete se sa <a data-toggle="modal" href="#stack2">Uslovima korišćenja websajta.</a></label>
                <div class="form-group">
                    <?= Html::submitButton('Registracija korisnika', ['class' => 'btn btn-primary', 'style'=>'width:100%']) ?>
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
                Već ste se registrovali i imate aktivan nalog na servicemapp.com?<br>
                Da bi se prijavili, <a href="#w21-tab0" data-toggle="tab">kliknite ovde.</a>
            </div>
            <div class="box">
                Da bi se registrovali kao pružalac usluga, <a href="#w21-tab2" data-toggle="tab">kliknite ovde.</a>
            </div>
            <div id="my_map_register" class="" style="height:260px; margin-bottom:20px;"></div>
        </div>
    </div>
</div>
<?php

  Modal::begin([
        'id'=>'stack2',
        'size'=>Modal::SIZE_LARGE,
        'options'=>['class'=>'whiteback fade','tabindex' => null,]
    ]); ?>

   <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?= $this->render('../terms-conditions.php') ?>
      </div>
    </div>
  </div>

<?php Modal::end(); ?>
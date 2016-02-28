<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$data = [0=>'<i class="fa fa-user-plus"></i> Napravite Servicemapp nalog', 1=>'<i class="fa fa-user"></i> Imate postojeći nalog?'];
$message = 'Da bi poslali porudžbinu, morate imate nalog i biti prijavljeni korisnik Servicemapp-a.';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->noUac ?></span>&nbsp;
        <i class="fa fa-sign-in fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Login/Registracija'); ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	<div class="form-group" style="margin: 0 0 20px;">
        <div class="col-md-offset-3 col-md-9" >
            <?= $form->field($model, 'new_user')->radioButtonGroup($data)->label(false) ?>                
        </div>
    </div>
    <div class="form-group loginForm fadeIn animated">
	    <div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($returning_user, 'username', [
	            'label'=>'Korisničko ime', 
	            'class'=>'col-sm-3 control-label'
	        ]); ?>
	        <div class="col-sm-5" style="padding-right:0">
	            <?= $form->field($returning_user, 'username',[
	                    'feedbackIcon' => [
	                    	'default' => 'user',
	                        'success' => 'ok',
	                        'error' => 'exclamation-sign',
	                        'defaultOptions' => ['class'=>'text-primary', 'style'=>''],
	                        'successOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;'],
	                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
	                    ],
	                    'showLabels'=>false
	                ])->input('text', ['class'=>'input-lg']) ?>
	        </div>        
	    </div>

	    <div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($returning_user, 'password', [
	            'label'=>'Lozinka', 
	            'class'=>'col-sm-3 control-label'
	        ]); ?>
	        <div class="col-sm-5" style="padding-right:0">
	            <?= $form->field($returning_user, 'password',[
	                    'feedbackIcon' => [
	                    	'default' => 'lock',
	                        'success' => 'ok',
	                        'error' => 'exclamation-sign',
	                        'defaultOptions' => ['class'=>'text-primary', 'style'=>''],
	                        'successOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;'],
	                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
	                    ],
	                    'showLabels'=>false
	                ])->input('password', ['class'=>'input-lg']) ?>
	        </div>        
	    </div>

	    <?= $form->field($returning_user, 'rememberMe')->checkbox() ?>

	    <div class="col-md-offset-3 col-md-9" style="color:#999;">
	        If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
	    </div>
	</div>
	<?php /*
    <div class="signUpForm fadeIn animated" style="display:none;">
		<div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($new_user, 'username', [
	            'label'=>'Korisničko ime', 
	            'class'=>'col-sm-3 control-label'
	        ]); ?>
	        <div class="col-sm-5" style="padding-right:0">
	            <?= $form->field($new_user, 'username',[
	                    'feedbackIcon' => [
	                    	'default' => 'user',
	                        'success' => 'ok',
	                        'error' => 'exclamation-sign',
	                        'defaultOptions' => ['class'=>'text-primary', 'style'=>''],
	                        'successOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;'],
	                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
	                    ],
	                    'showLabels'=>false
	                ])->input('text', ['class'=>'input-lg']) ?>
	        </div>        
	    </div>
	    <div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($new_user, 'email', [
	            'label'=>'E-mail adresa', 
	            'class'=>'col-sm-3 control-label'
	        ]); ?>
	        <div class="col-sm-5" style="padding-right:0">
	            <?= $form->field($new_user, 'email',[
	                    'feedbackIcon' => [
	                    	'default' => 'envelope',
	                        'success' => 'ok',
	                        'error' => 'exclamation-sign',
	                        'defaultOptions' => ['class'=>'text-primary', 'style'=>''],
	                        'successOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;'],
	                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
	                    ],
	                    'showLabels'=>false
	                ])->input('email', ['class'=>'input-lg']) ?>
	        </div>        
	    </div>
	    <div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($new_user, 'password', [
	            'label'=>'Lozinka', 
	            'class'=>'col-sm-3 control-label'
	        ]); ?>
	        <div class="col-sm-5" style="padding-right:0">
	            <?= $form->field($new_user, 'password',[
	                    'feedbackIcon' => [
	                    	'default' => 'lock',
	                        'success' => 'ok',
	                        'error' => 'exclamation-sign',
	                        'defaultOptions' => ['class'=>'text-primary', 'style'=>''],
	                        'successOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;'],
	                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
	                    ],
	                    'showLabels'=>false
	                ])->input('password', ['class'=>'input-lg']) ?>
	        </div>        
	    </div>
	    <div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($new_user, 'password_repeat', [
	            'label'=>'Ponovite lozinku', 
	            'class'=>'col-sm-3 control-label'
	        ]); ?>
	        <div class="col-sm-5" style="padding-right:0">
	            <?= $form->field($new_user, 'password_repeat',[
	                    'feedbackIcon' => [
	                    	'default' => 'lock',
	                        'success' => 'ok',
	                        'error' => 'exclamation-sign',
	                        'defaultOptions' => ['class'=>'text-primary', 'style'=>''],
	                        'successOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;'],
	                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
	                    ],
	                    'showLabels'=>false
	                ])->input('password', ['class'=>'input-lg']) ?>
	        </div>        
	    </div>
	</div>
	<?php */ ?>
</div>
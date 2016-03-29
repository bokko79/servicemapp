<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;

$message = 'Odredite način na koji želite da primate obaveštenja o porudžbinama ove usluge, u slučaju da je korisnici globalno naruče (ne direktno od Vas).';
$data = ['any'=>'Uključi notifikacije za svaku porudžbinu ove usluge (bez ograničenja)', 'matching'=>'Uključi notifikacije samo za porudžbine koje odgovaraju mojim uslovima <i class="fs_11 gray-color">(preporučeno)</i>', 'none'=>'Isključi notifikacije za ovu uslugu', 'setup'=>'Prilagođene notifikacije']
?>
<div class="wrapper headline" style="" id="notifications">
    <label class="head">
        <span class="badge"><?= $model->noNotifications ?></span>&nbsp;
        <i class="fa fa-bell fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Notifikacije'); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections12">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	<div class="form-group">
		<?php $model_notifications->notification_type = 'matching'; ?>
		<?= $form->field($model_notifications, 'notification_type')->radioList($data, []) ?>
    </div>
    <div class="enter_notifications fadeIn animated" style="margin-top:30px; display:none;">
    	<h6 class="col-sm-offset-3 margin-top-20 gray-color">Prilagođene notifikacije</h6>
    	<p class="hint-text col-sm-offset-3">Uključi/isključi notifikacije kada korisnik poruči ovu uslugu za sledeće uslove:</p>
	        <?php $model_notifications->coverage = true; ?>
	        <?= $form->field($model_notifications, 'coverage', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->widget(SwitchInput::classname(), [
			    	'value'=>true,
				    'pluginOptions' => [
				        'onText' => 'Da',
				        'onColor' => 'info',
				        'offText' => 'Ne',
				        //'size' => 'mini',
				        'inlineLabel' => false,
				    ]
			    ])->hint('') ?>
			<?php $model_notifications->specs = true; ?>
			<?= $form->field($model_notifications, 'specs', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->widget(SwitchInput::classname(), [
			    	'value'=>true,
				    'pluginOptions' => [
				        'onText' => 'Da',
				        'onColor' => 'info',
				        'offText' => 'Ne',
				        //'size' => 'mini',
				        'inlineLabel' => false,
				    ]
			    ])->hint('') ?>
			<?php $model_notifications->methods = true; ?>
			<?= $form->field($model_notifications, 'methods', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->widget(SwitchInput::classname(), [
			    	'value'=>true,
				    'pluginOptions' => [
				        'onText' => 'Da',
				        'onColor' => 'info',
				        'offText' => 'Ne',
				        //'size' => 'mini',
				        'inlineLabel' => false,
				    ]
			    ])->hint('') ?>
			<?php $model_notifications->qty = true; ?>
			<?= $form->field($model_notifications, 'qty', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->widget(SwitchInput::classname(), [
			    	'value'=>true,
				    'pluginOptions' => [
				        'onText' => 'Da',
				        'onColor' => 'info',
				        'offText' => 'Ne',
				        //'size' => 'mini',
				        'inlineLabel' => false,
				    ]
			    ])->hint('') ?>
			<?php $model_notifications->consumer = true; ?>
			<?= $form->field($model_notifications, 'consumer', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->widget(SwitchInput::classname(), [
			    	'value'=>true,
				    'pluginOptions' => [
				        'onText' => 'Da',
				        'onColor' => 'info',
				        'offText' => 'Ne',
				        //'size' => 'mini',
				        'inlineLabel' => false,
				    ]
			    ])->hint('') ?>
			<?php $model_notifications->price = true; ?>
			<?= $form->field($model_notifications, 'price', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->widget(SwitchInput::classname(), [
			    	'value'=>true,
				    'pluginOptions' => [
				        'onText' => 'Da',
				        'onColor' => 'info',
				        'offText' => 'Ne',
				        //'size' => 'mini',
				        'inlineLabel' => false,
				    ]
			    ])->hint('') ?>
			<?php $model_notifications->issues = true; ?>
			<?= $form->field($model_notifications, 'issues', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->widget(SwitchInput::classname(), [
			    	'value'=>true,
				    'pluginOptions' => [
				        'onText' => 'Da',
				        'onColor' => 'info',
				        'offText' => 'Ne',
				        //'size' => 'mini',
				        'inlineLabel' => false,
				    ]
			    ])->hint('') ?>
			<?php $model_notifications->availability = true; ?>
			<?= $form->field($model_notifications, 'availability', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->widget(SwitchInput::classname(), [
			    	'value'=>true,
				    'pluginOptions' => [
				        'onText' => 'Da',
				        'onColor' => 'info',
				        'offText' => 'Ne',
				        //'size' => 'mini',
				        'inlineLabel' => false,
				    ]
			    ])->hint('') ?>
	</div>
<?= $this->render('_submitButton.php') ?>
</div>
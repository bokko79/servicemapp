<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;
?>
<?php
/*
* 	TABLE W/ INPUTS
*
*/
?>
<?php
/*
* 	additional expenses
*
*/ 
$expense_list = ['fuel'=>'Gorivo', 'toll'=>'Putarina', 'delivery'=>'Dostava', 'accessories'=>'Dodatna oprema/pribor', 'other'=>'Ostalo'];
$payable_list = ['provider'=>'Pružalac usluge', 'client'=>'Korisnik usluge', 'split'=>'Po dogovoru'];
?>

<h6 class="col-sm-offset-3 margin-top-20 gray-color">Dodatni gotovinski troškovi izvršenja ove usluge</h6>
<p class="col-sm-offset-3 hint-text margin-bottom-20">Za izvršenje ove usluge postoji bar još jedan dodatni gotovinski trošak? <?= Html::a('Kliknite ovde', null, ['class'=>'']) ?> da unesete novi trošak <i class="fs_11 gray-color">(maksimalno 4)</i>.</p>
<div class="" style="display:;">
<?php
/*
* 	additional expenses
*
*/ /*
?>
<?= $form->field($model_termexpenses, 'expense', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->dropDownList($expense_list)->hint('') ?>
<div class="" style="display:;">
<?= $form->field($model_termexpenses, 'expense_name', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->input('text', [])->hint('') ?>	
</div>
<?= $form->field($model_termexpenses, 'payable_by', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList($payable_list)->hint('') ?>
<?= $form->field($model_termexpenses, 'amount',[
        'addon' => [
            'append' => ['content'=>'RSD'],
            'groupOptions' => ['class'=>'input-group-lg']],
        'hintType' => ActiveField::HINT_SPECIAL,
        'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->input('number', ['min'=>0]); ?>
*/ ?>					
</div>

<h6 class="col-sm-offset-3 margin-top-20 gray-color">Načini plaćanja</h6>
<p class="col-sm-offset-3 hint-text margin-bottom-20"></p>
<?php
/*
* 	Payment Methods
*
*/
$payment_list = ['at_once'=>Yii::t('app', 'Odjednom'), 'installments'=>Yii::t('app', 'Na rate'), /*'milestones'=>Yii::t('settings', 'Po fazama'), */'advance'=>Yii::t('app', 'Avansno')];
?>
<?= $form->field($model_terms, 'payment', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList($payment_list)->hint('') ?>
				
<?php
/*
* 	payment_advance_percentage
*
*/
?>
<div class="advanced_payment" style="display:">
<?= $form->field($model_terms, 'payment_advance_percentage',[
        'addon' => [
            'append' => ['content'=>'<i class="fa fa-percent"></i>'],
            'groupOptions' => ['class'=>'input-group-lg']],
        'hintType' => ActiveField::HINT_SPECIAL,
        'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->input('number', ['min'=>0, 'max'=>100]); ?>											
</div>

<?php
/*
* 	payment_installment_no_rates
*
*/ 
?>
<?= $form->field($model_terms, 'payment_installment_no_rates',[
        'addon' => [
            'append' => ['content'=>'<i class="fa fa-percent"></i>'],
            'groupOptions' => ['class'=>'input-group-lg']],
        'hintType' => ActiveField::HINT_SPECIAL,
        'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->input('number', ['min'=>0, 'max'=>120]); ?>	
				

<?php
/*
* 	payment_installment_frequency
* 	payment_installment_frequency_unit
*
*/ 
$frequency_list = ['day'=>Yii::t('app', 'dnevno'), 'week'=>Yii::t('app', 'nedeljno'), 'month'=>Yii::t('app', 'mesečno'), 'year'=>Yii::t('app', 'godišnje')];
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_terms, 'payment_installment_frequency', ['label'=>'Učestalost naplate rata za ugovorenu cenu izvršenja usluge', 'class'=>'col-sm-3 control-label']) ?>
    <div class="col-sm-2">
        <?= $form->field($model_terms, 'payment_installment_frequency',[
	        'addon' => [
	            'append' => ['content'=>'<i class="fa fa-times"></i>'],
	            'groupOptions' => ['class'=>'']],
	        'hintType' => ActiveField::HINT_SPECIAL,
	        'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    	'showLabels' => false,
	    ])->input('number', ['min'=>0, 'max'=>100]); ?>	
    </div>
    <div class="col-sm-3">
        <?= $form->field($model_terms, 'payment_installment_frequency_unit', [
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		    'showLabels' => false,
		    ])->dropDownList($frequency_list)->hint('') ?>
    </div>
</div>

<?php
/*
* 	payment_at_once_time
*
*/ 
$payment_at_once_time_list = ['after_delivery'=>Yii::t('app', 'Nakon izvršenja usluge'), 'after_invoicing'=>Yii::t('app', 'Nakon isporuke fakture'), 'upon_start'=>Yii::t('app', 'Na samom početku izvršenja'), 'other'=>Yii::t('app', 'Drugo')];
?>
<?= $form->field($model_terms, 'payment_at_once_time', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList($payment_at_once_time_list)->hint('') ?>
		
<?php
/*
* 	Invoicing
*
*/
$invoicing_list = ['servicemapp'=>Yii::t('app', 'Preko Servicemapp platforme'), 'no'=>Yii::t('app', 'Direktno'), 'irrelevant'=>Yii::t('app', 'Nebitno')];
?>
<?= $form->field($model_terms, 'invoicing', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList($invoicing_list)->hint('') ?>											


<h6 class="col-sm-offset-3 margin-top-20 gray-color">Uslovi važenja ugovora o izvršenju</h6>
<p class="col-sm-offset-3 hint-text margin-bottom-20"></p>
<?php
/*
* 	agreement_effective_until
*
*/
$agreement_effective_until_list = ['end_date'=>Yii::t('app', 'Do završetka izvršenja usluge'), '1 month'=>Yii::t('app', 'Mesec dana nakon izvršenja usluge'), '3 months'=>Yii::t('app', '3 meseca nakon izvršenja usluge'), '6 months'=>Yii::t('app', '6 meseci nakon izvršenja usluge'), '12 months'=>Yii::t('app', '12 meseci nakon izvršenja usluge'), '24 months'=>Yii::t('app', '24 meseca nakon izvršenja usluge')];
?>
<?= $form->field($model_terms, 'agreement_effective_until', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList($agreement_effective_until_list)->hint('') ?>											


<h6 class="col-sm-offset-3 margin-top-20 gray-color">Politika otkazivanja i refundiranja</h6>
<p class="col-sm-offset-3 hint-text margin-bottom-20">Uslovi u slučaju otkazivanja ugovorenih uslova ugovorom i uslovi refundiranja plaćenog iznosa korisniku usluge.</p>								
<?php
/*
* 	cancellation_policy
*
*/
$cancellation_policy_list = ['flex'=>Yii::t('app', 'Fleksibilna'), 'moderate'=>Yii::t('app', 'Umerena'), 'strict'=>Yii::t('app', 'Striktna'), 'very_strict'=>Yii::t('app', 'Veoma striktna'), 'long_term'=>Yii::t('app', 'Dugoročna'), 'short_term'=>Yii::t('app', 'Kratkoročna')];
?>
<?= $form->field($model_terms, 'cancellation_policy', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList($cancellation_policy_list)->hint('') ?>											
								

<h6 class="col-sm-offset-3 margin-top-20 gray-color">Pravni uslovi</h6>
<p class="col-sm-offset-3 hint-text margin-bottom-20"></p>
<?php
/*
* 	liability
*
*/
$liability_list = ['none'=>Yii::t('app', 'Bez odgovornosti'), 'possible'=>Yii::t('app', 'Ograničena'), 'full'=>Yii::t('app', 'Puna odgovornost')];
?>
<?= $form->field($model_terms, 'liability', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList($liability_list)->hint('') ?>

<?php
/*
* 	Intelectual property Warranty
*
*/
$ip_warranty_list = ['yes'=>Yii::t('app', 'Da'), 'no'=>Yii::t('app', 'Ne'), 'irrelevant'=>Yii::t('app', 'Nebitno')];
?>
<?= $form->field($model_terms, 'ip_warranty', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->radioButtonGroup($ip_warranty_list)->hint('') ?>

<?php
/*
* 	Performance Warranty
*
*/
?>
<?= $form->field($model_terms, 'performance_warranty', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->radioButtonGroup($ip_warranty_list)->hint('') ?>


<h6 class="col-sm-offset-3 margin-top-20 gray-color">Ostali uslovi</h6>
<p class="col-sm-offset-3 hint-text margin-bottom-20">Ukoliko imate sopstvene uslove, koji nisu navedeni, dodajte ih ovde.</p>
<?php
/*
* 	additional clauses
*
*/
?>

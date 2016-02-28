<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;

$model->phone_contact = 1;
$model->turn_key = $service->turn_key;
$model->tools = $service->tools;
$model->support = $service->support;
$model->order_type = 'single';
$message = 'Dodatne opcije za ovu porudžbinu, koji mogu da pomognu pružaocima usluge da se bolje upoznaju sa detaljima Vašeg zahteva, daju Vam precizniju ponudu i pruže kvalitetniju uslugu.';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->noOther ?></span>&nbsp;
        <i class="fa fa-cogs fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Ostali detalji porudžbine'); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>  
     <?= $form->field($model, 'phone_contact', [                
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ]
                ])->hint('') ?>
    <?= $form->field($model, 'turn_key', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Ključ u ruke', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ]
                ])->hint('Da li želite da pružalac usluge ponudi objedinjenu cenu i za ruke i za upotrebljeni materijal i opermu, po principu "ključ u ruke"?') ?>

    <?= $form->field($model, 'tools', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Pribor i oprema', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ]
                ])->hint('Da li pružalac usluge može korisiti Vaš alat, pribor i opremu tokom izvršenja usluge?') ?>

    <?= $form->field($model, 'support', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Podrška pružaoca usluge', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ]
                ])->hint('Da li zahtevate besplatnu podršku i nakon izvršenja usluge, kao dodatnu vrstu garancije pružaoca usluge na kvalitet izvrešnih usluga?<p>Napomena: Ukoliko se odlučite za "da", to može povećati ukupnu ponuđenu cenu usluge.</p>') ?>

   
    <?= $form->field($model, 'order_type')->dropDownList([ 'single' => 'Single', 'multi' => 'Multi', 'operation' => 'Operation', 'process' => 'Process', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'loc_within')->textInput() ?>
</div>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;

$this->title = 'Naručivanje usluge';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$this->pageTitle = [
    'icon' => 'user',     
    'title' => Html::encode($this->title),
    'description' => $pageDescription,
    'h' => 2,
];

$this->steps = null;

// steps
?>
<?= $this->render('_steps.php') ?>
<?php
    $form = kartik\widgets\ActiveForm::begin(
    [
        'id' => 'signup-form',
        //'action' => Url::to(),
    ]); ?>
       
            <p><i class="fa fa-lightbulb-o"></i>&nbsp;Birajte delatnost, zatim aktivnost i na kraju predmet usluge i naručite uslugu. 
                        Npr.: Treba mi... <b>arhitekta</b> za <b>projektovanje kuće</b></p>
       
            Treba mi
            <?= $form->field(new \frontend\models\CsServices, 'industry_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\frontend\models\CsIndustries::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Izaberite delatnost ...', 'id'=>'ind_id'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false) ?>

            ... da se obavi...
            <?= $form->field(new \frontend\models\CsServices, 'action_id')->widget(DepDrop::classname(), [
                'options'=>['id'=>'act_id'],
                'pluginOptions'=>[
                    'depends'=>['ind_id'],
                    'placeholder'=>'Izaberite akciju...',
                    'url'=>Url::to(['/glob-nav-act-services'])
                ],
            ])->label(false) ?>


            <?= $form->field(new \frontend\models\CsServices, 'object_id')->widget(DepDrop::classname(), [
                'options'=>['id'=>'obj_id'],
                'pluginOptions'=>[
                    'depends'=>['act_id'],
                    'placeholder'=>'Izaberite predmet...',
                    'url'=>Url::to(['/glob-nav-ser-objects'])
                ],
            ])->label(false) ?>            
            <?= Html::submitButton('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Naruči'), ['class'=>'btn btn-info']); ?>
<?php kartik\widgets\ActiveForm::end(); ?>        

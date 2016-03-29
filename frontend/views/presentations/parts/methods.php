<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$action = $service->action;
switch ($action->t[0]->name_gender) {
	case 'm':
		$whatkind = 'Kakav';
		break;
	case 'f':
		$whatkind = 'Kakva';
		break;	
	default:
		$whatkind = 'Kakvo';
		break;
}

$message = Yii::t('app', '{whatkind} {action} vršite?', ['whatkind'=>$whatkind, 'action'=>$action->tName]);
?>
<div class="wrapper headline" style="" id="action">
    <label class="head">
        <span class="badge"><?= $model->noMethods ?></span>&nbsp;
        <?= Yii::t('app', '{whatkind} {action} vršite?', ['whatkind'=>$whatkind, 'action'=>$action->tName]) ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections03">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php if($user && $user->provider->presWithSameAction($service->action_id)!=null){ ?>
    <?= $form->field($model, 'provider_presentation_methods', [
            'feedbackIcon' => [
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%'],
                'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%; top: 6px;']
            ],
            'hintType' => ActiveField::HINT_SPECIAL,
            'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList(ArrayHelper::map($user->provider->presWithSameAction($service->action_id), 'id', 'title'), ['prompt'=>'Izaberite opis '.$service->action->tName.' iz Vaših postojećih ponuda', 'class'=>'input-lg'])->hint('Već ste sačuvali ponudu usluge sa istom akcijom. Ukoliko se radi o istoj akciji, ne morate ga ponovo opisivati, već izaberite tu ponudu iz padajućeg menija, radi uštede vremena.') ?>
    <?php // Html::activeHiddenInput($model, 'checkUserObject', ['id'=>'checkUserObject_model']) ?>
    <div class="form-group pres-methods-plaza" style="display:none;">
        <div class="col-md-offset-3 col-md-9">                 
            <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">                 
            <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
            <div class="center" style="margin:30px 0 20px">
                <?= Html::a('<i class="fa fa-plus-circle"></i> Opišite novu '.$service->action->tName, null, ['class'=>'btn btn-warning shadow new_pres_method']) ?>
            </div>
        </div>
    </div>
    <div class="enter_presMethod fadeIn animated" style="display:none">
<?php } ?>
<?php foreach($model_methods as $index=>$model_method) {
		$method = $model_method->csMethod;
		$property = $model_method->property;	
		echo $this->render('method/'.$property->formTypePresentation($service->service_object).'.php', ['form'=>$form, 'index'=>$index, 'model_method'=>$model_method, 'method'=>$method, 'property'=>$property, 'service'=>$service]);
		echo Html::activeHiddenInput($model_method, '['.$index.']method_id', ['value'=>$method->id]);
	} ?>
<?php if($user && $user->provider->presWithSameAction($service->action_id)!=null){ ?>
    </div>
<?php } ?>
<?php if($service->service_type==7 or $service->service_type==9 or $service->service_type==10 or $service->service_type==11): ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'duration', [
            'label'=>'Uobičajeno trajanje izvršenja usluge', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'duration_operator',[
                    'showLabels'=>false
                ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'], ['class'=>'input-lg']) ?>
        </div>
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model, 'duration',[
                    'addon' => [
                        'prepend' => ['content'=>'<i class="fa fa-clock-o"></i>'],
                        'groupOptions' => ['class'=>'input-group-lg']],
                    'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
                    ],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'showLabels'=>false
                ])->input('number', ['step'=>1, 'min'=>0, 'placeholder'=>'Trajanje', 'class'=>'input-lg']); ?>
        </div>  
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'duration_unit',[
                    'showLabels'=>false
                ])->dropDownList([ 27 => 'minut(a)', 26 => 'sat(i)', 28 => 'dan(a)'], ['class'=>'input-lg']) ?>
        </div>
    </div>
<?php endif; ?>
<?= $this->render('_submitButton.php') ?>
</div>
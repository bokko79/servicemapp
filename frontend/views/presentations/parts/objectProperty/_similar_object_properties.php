<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>
<?php if($user and $user->provider and $user->provider->presWithSameObject($object->id)!=null && $service->object_ownership!='provider' and Yii::$app->controller->action->id=='create'){ ?>    
    <?= $form->field($model, 'provider_presentation_object_properties', [
            'feedbackIcon' => [
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%'],
                'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%; top: 6px;']
            ],
            'hintType' => ActiveField::HINT_SPECIAL,
            'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList(ArrayHelper::map($user->provider->presWithSameObject($object->id), 'id', 'title'), ['prompt'=>'Izaberite opis '.$object->tNameGen.' iz Vaših postojećih ponuda', 'class'=>'input-lg'])->hint('Već ste sačuvali ponudu usluge sa istim predmetom usluge. Ukoliko se radi o istom predmetu, ne morate ga ponovo opisivati, već izaberite tu ponudu iz padajućeg menija, radi uštede vremena.') ?>
    <?php // Html::activeHiddenInput($model, 'checkUserObject', ['id'=>'checkUserObject_model']) ?>
    <div class="form-group pres-specs-plaza" style="display:none;">
        <div class="col-md-offset-3 col-md-9">                 
            <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">                 
            <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
            <div class="center" style="margin:30px 0 20px">
                <?= Html::a('<i class="fa fa-plus-circle"></i> Opišite novi '.$object->tName, null, ['class'=>'btn btn-warning shadow new_pres_spec']) ?>
            </div>
        </div>
    </div>
    <div class="enter_presSpec fadeIn animated" style="display:none">
<?php } ?>
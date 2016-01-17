<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
?>          
<?php kartik\widgets\ActiveForm::begin(); ?>    
    <label class="cbx-label" for="s_<?= $model->id ?>">
    <div class="card_container record-270 grid-item fadeInUp animated" id="card_container" style="">        
            <div class="media-area square">                
                <div class="image">
                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                                        
                </div>
                <div class="primary-context in-media dark">
                    <div class="head"><?= $model->name ?></div>
                </div>
                <div class="action-area" style="height:40px; position: absolute; top:0; right:0;">
                    <?= CheckboxX::widget([
                        'name'=>'s_'.$model->id,
                        'options'=>['id'=>'s_'.$model->id],
                        'pluginOptions'=>['threeState'=>false, 'size'=>'xl']
                    ]) ?>
                </div> 
            </div>            
                  
    </div>
    </label>
<?php ActiveForm::end(); ?>
    
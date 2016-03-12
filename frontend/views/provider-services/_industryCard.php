<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<div class="card_container record-full grid-item no-shadow bordered fadeInUp animated" id="card_container" style="margin: 20px 0">
    <div class="header-context collapsing inverted">                
        <div class="avatar">
            <?= Html::img('@web/images/cards/info/info_docs'.rand(0,9).'.jpg') ?>          
        </div>
        <div class="title">
            <div class="head black"><?= c($model->industry->tName) ?></div>
            <div class="subhead"><?= $model->industry->category->tName ?> | <?= ($model->main==1) ? '<b>Pretežna delatnost</b>' : Html::a(Yii::t('app', 'Postavi kao pretežnu delatnost'), ['/provider-industries/main', 'id'=>$model->id], ['class'=>'btn btn-link btn-sm', 'data'=>['method'=>'post'], 'style'=>'padding:0']) ?> | <?= ($model->industry->skills) ? Html::a('<i class="fa fa-wrench"></i>&nbsp;'.Yii::t('app', 'Podesi veštine'), Url::to(), ['class'=>'btn btn-link btn-sm', 'style'=>'padding:0', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#industry-skills'.$model->id]) : null ?></div> 
        </div>
        <div class="subaction">
            <?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Dodaj nove usluge'), Url::to(), [
                'class' => 'btn btn-info btn-sm',
                'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#industry-services'.$model->id
            ]) ?>            
            <?= ($model->main==0) ? Html::a('<i class="fa fa-times"></i>', Url::to(), [
            'class' => 'btn btn-danger btn-sm',
            'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#industry-delete'.$model->id
        ]) : null ?>
        </div>
    </div>    

    <?php if($model->industry->skills):
        if($model->skills){
            echo '<div class="secondary-context cont avatar-padded gray">';
            foreach ($model->skills as $skill){
                echo '<div class="label label-default fs_11 margin-right-10">'.$skill->model->tName.'</div>';
            }
            echo '</div>';
        }
        endif; ?>
    
    <div class="secondary-context avatar-padded" style="overflow:hidden;">
    <?php
        if($model->services){ 
            foreach($model->services as $proService) {
                echo $this->render('_serviceCard.php', ['model'=>$proService]);
            } 
        } else { 
            echo '<a href="" data-toggle="modal" data-backdrop="false" data-target="#industry-services'.$model->id.'" class="createProject">
                    <i class="fa fa-plus-circle fa-3x"></i>
                    <h4>Dodaj nove usluge</h4>
                    <p>Ubacite usluge kojima se bavite u Vaš portfolio.</p>
                </a>'; 
        } ?>		
    </div>
</div>
<?php
if($model->industry->skills) {
    Modal::begin([
        'id'=>'industry-skills'.$model->id,
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> '<h3>Izaberite usluge u okviru ove delatnosti kojima se bavite</h3>',
    ]); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_industry_skills.php', ['industry'=>$model->industry, 'model'=>$model]) ?>
            </div>
        </div>
    </div>

<?php Modal::end(); } ?>
<?php 
if($model->industry->services) {
    Modal::begin([
        'id'=>'industry-services'.$model->id,
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> '<h3>Izaberite usluge u okviru ove delatnosti kojima se bavite</h3>',
    ]); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_industry_services.php', ['model'=>$model]) ?>
            </div>
        </div>
    </div>

<?php Modal::end(); } ?>

<?php Modal::begin([
        'id'=>'industry-delete'.$model->id,
        //'size'=>Modal::SIZE_SMALL,
        'options' => ['class'=>'overlay_modal fade'],
        'header'=> '<h4 class="thin center">Da li zaista želite da izbacite delatnost <b>'.$model->industry->tName.'</b> iz svog portfolia?</h4>',
    ]); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 center">
                <?= Html::a(Yii::t('app', 'Potvrdi'), ['/provider-industries/delete', 'id' => $model->id], ['class' => 'btn btn-danger margin-right-20', 'data'=>['method'=>'post']]) ?>
                <?= Html::button(Yii::t('app', 'Odustani'), ['class' => 'btn btn-default', 'data-dismiss'=>"modal"]) ?>
            </div>
        </div>
    </div>
<?php Modal::end(); ?>

<?php
if($model->services){ 
    foreach($model->services as $proService) { ?>
<?php Modal::begin([
        'id'=>'service-delete'.$proService->id,
        'size'=>Modal::SIZE_LARGE,
        'options' => ['class'=>'overlay_modal fade'],
        'header'=> '<h4 class="thin center">Da li zaista želite da izbacite uslugu <b>'.$proService->service->tName.'</b> iz svog portfolia?</h4>',
    ]); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 center">
                <?= Html::a(Yii::t('app', 'Potvrdi'), ['/provider-services/delete', 'id' => $proService->id], ['class' => 'btn btn-danger margin-right-20', 'data'=>['method'=>'post']]) ?>
                <?= Html::button(Yii::t('app', 'Odustani'), ['class' => 'btn btn-default', 'data-dismiss'=>"modal"]) ?>
            </div>
        </div>
    </div>
<?php Modal::end(); ?>
<?php if($proService->service->object->models){ ?>
    <?php Modal::begin([
        'id'=>'object-models'.$proService->id,
        'size'=>Modal::SIZE_SMALL,
        //'options' => ['class'=>'overlay_modal fade'],
        'header'=> '<h3>Izaberite vrstu '. $proService->service->object->tNameGen.' koju želite da ponudite</h3>',
    ]); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_object_models.php', ['object'=>$proService->service->object, 'model'=>$proService->service, 'proService'=>$proService]) ?>
            </div>
        </div>
    </div>
<?php Modal::end(); ?>
<?php } ?>
<?php    
    } 
}
?>
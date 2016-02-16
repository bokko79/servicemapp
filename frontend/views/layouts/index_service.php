<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* SUBNAV/SCREEN */ ?>
<?php /* SCREEN */ ?>
<?php /* 6BOX INDUSTRIES */ ?>
<?php /* PROFILE INFO */ ?>
<?php /* INDEX (CONTENT) */ ?>
<?php /* COMMERCIAL (CONTENT) */ ?>
<?php /* FOOTER *//* ?>
<div class="subnav-fixed">
    <ul class="">
        <li><?= Html::a('Sve usluge', Url::to('/services'), ['class'=>'', 'onclick'=>'']) ?></li>
        <li><?= Html::a('Obeležene', Url::to(), []) ?></li>
        <li><?= Html::a('Poručene', Url::to(), []) ?></li>
        <li><?= Html::a('Pregledane', Url::to(), []) ?></li>
        <li class="float-right button">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <?= Html::a('Naruči uslugu', Url::to('choose-service'), ['class'=>'btn btn-default control order-service']); ?>
                <?= Html::a('Ponudi uslugu', null, ['class'=>'btn btn-default control promote-service']); ?>
            </div>
        </li> 
    </ul>
</div>
<?php */ ?>
<div class="screen <?= (!$this->params['getService']) ? '' : 'mini' ?>">
    <?= $this->render('partial/screen.php', ['getService'=>$this->params['getService']]) ?>
</div>

    <?= $this->render('partial/six_boxes.php') ?>


<?php if(isset($this->params['getService']['industry_id'])): ?>
    <?= $this->render('partial/service_head.php') ?>
<?php endif; ?>


<?php if($this->params['getService']): ?>
<div class="grid-container" style="">    
    <div class="grid-row">
        <div class="grid-full">           
            <?= $content ?>
        </div>
    </div>
</div>
<?php endif; ?>

    <?= $this->render('//services/_commercial.php', ['services'=>$this->params['getService']]) ?>

<?php $this->endContent(); // HTML ?>
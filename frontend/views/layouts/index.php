<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>
<div class="subnav-fixed">
    <ul class="">
        <li><?= Html::a('Svi provajeri', Url::to('/providers'), ['class'=>'', 'onclick'=>'']) ?></li>
        <li><?= Html::a('Obeleženi', Url::to('/market'), ['class'=>'', 'onclick'=>'']) ?></li>
        <li><?= Html::a('Pregledani', Url::to(), []) ?></li>
        <li><?= Html::a('Popularni', Url::to(), []) ?></li>
        <li class="float-right button">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <?= Html::a('Naruči uslugu', null, ['class'=>'btn btn-default control order-service']); ?>
                <?= Html::a('Promoviši uslugu', null, ['class'=>'btn btn-default control promote-service']); ?>
                <?= Html::a('Najavi događaj', null, ['class'=>'btn btn-default control announce-event']); ?>
            </div>
        </li> 
    </ul>
</div>

<div class="grid-container" style="margin-top:70px;">
    <div class="grid-row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>

    <div class="grid-row">
        <div class="grid-left" style="margin-top:20px;">
            <?php // Filters ?>            
            <?= $this->render('../provider/filters/location.php', ['model' => new \frontend\models\Activities]) ?>
            <?= $this->render('../provider/filters/industry.php', ['model' => new \frontend\models\Activities]) ?>
        
        </div>

        <div class="grid-center" style="margin-top:20px;">        
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Stats ?>
            <?= $this->render('partial/news.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;

$events = [];
//Testing
$Event = new \yii2fullcalendar\models\Event();
$Event->id = 1;
$Event->title = $model->orderServices[0]->title;
$Event->start = $model->delivery_starts;
$Event->end = $model->delivery_ends;
$events[] = $Event;
?>
<div class="card_container record-full" id="service-time" style="float:none;">
    
    <?php /* time/loc */ ?>
    <div class="header-context">  
        <div class="avatar center gray-color">
            <i class="fa fa-calendar fa-3x"></i>    
        </div>
        <div class="title">
            <div class="subhead"><?= Yii::t('app', 'Vreme izvršenja usluge') ?></div> 
            <div class="head second"><?= f_datetime($model->delivery_starts) ?> <i class="fa fa-caret-right"></i> <?= f_datetime($model->delivery_ends) ?></div>                           
        </div>
    </div> 
    <div class="secondary-context">                   
        <?= \yii2fullcalendar\yii2fullcalendar::widget([
            'events'=> $events,
            'options' => [
                'lang' => 'sr',
                'defaultView' => 'agendaWeek',
                //... more options to be defined here!
            ],
        ]) ?>
    </div>                                                             
</div>
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $user = \frontend\models\User::findOne(Yii::$app->user->id); ?>

<ul class="">
    <li class="title">
        <?= Html::img('@web/images/cards/default_avatar.jpg') ?>
        <?= $user->username ?></li>
    <li class="<?= ((Yii::$app->controller->getRoute()=='user/view') ? 'active' : null) ?>"><?= Html::a('Feed', Url::to('home'), []) ?></li>
    <li class="<?= ((Yii::$app->controller->getRoute()=='user/activities') ? 'active' : null) ?>"><?= Html::a('Vaši poslovi', Url::to('activities'), ['class'=>'', 'onclick'=>'']) ?></li>
    <li class="<?= ((Yii::$app->controller->getRoute()=='user/finances') ? 'active' : null) ?>"><?= Html::a('Finansije', Url::to('finances'), []) ?></li>    
    <li class="<?= ((Yii::$app->controller->getRoute()=='message-threads/index') ? 'active' : null) ?>"><?= Html::a('Inbox', Url::to('inbox'), []) ?></li>
    <li><?= Html::a('Vaš profil', Url::to('profile'), []) ?></li>
    <li class="float-right button">
        <div class="btn-group btn-group-sm" role="group" aria-label="...">
            <?= Html::a('Naruči uslugu', null, ['class'=>'btn btn-default control order-service']); ?>
            <?= Html::a('Promoviši uslugu', null, ['class'=>'btn btn-default control promote-service']); ?>
            <?= Html::a('Najavi događaj', null, ['class'=>'btn btn-default control announce-event']); ?>
        </div>
    </li> 
</ul>
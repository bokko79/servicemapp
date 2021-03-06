<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<ul class="">
    <li class="title <?= ((Yii::$app->controller->getRoute()=='user/view') ? 'active' : null) ?>">
        <?php $link = Html::img('@web/images/cards/default_avatar.jpg').$user->username; ?>
        <?= Html::a($link, Url::to('home'), []) ?>
    </li>
    <?= ($user->is_provider==1) ? '<li class="'.(Yii::$app->controller->getRoute()=='provider-services/index' ? 'active' : null).'">'.Html::a('Moje usluge', Url::to('services'), []).'</li>' : null ?>
    <?= ($user->is_provider==1) ? '<li>'.Html::a('Profil', Url::to('profile'), []).'</li>' : null ?>
    <li class="<?= ((Yii::$app->controller->getRoute()=='user/orders') ? 'active' : null) ?>"><?= Html::a('Moje porudžbine', Url::to('orders'), ['class'=>'', 'onclick'=>'']) ?></li>
    <li class="<?= ((Yii::$app->controller->getRoute()=='user/finances') ? 'active' : null) ?>"><?= Html::a('Finansije', Url::to('finances'), []) ?></li>    
    <li class="<?= ((Yii::$app->controller->getRoute()=='message-threads/index') ? 'active' : null) ?>"><?= Html::a('Inbox', Url::to('inbox'), []) ?></li>
    
    <li><?= Html::a('<i class="fa fa-cog fa-lg"></i>', Url::to('setup'), ['class'=>'']) ?></li>
    <li class="float-right button">
        <div class="btn-group btn-group-sm" role="group" aria-label="...">
            <?= Html::a('Naruči uslugu', null, ['class'=>'btn btn-default control order-service']); ?>
            <?= Html::a('Promoviši uslugu', null, ['class'=>'btn btn-default control promote-service']); ?>
        </div>
    </li> 
</ul>
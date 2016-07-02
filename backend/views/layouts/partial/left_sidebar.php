<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use \common\models\User;

$logo_url = Html::img(Yii::$app->homeUrl.'images/logo/logo46.png', ['alt'=>'Servicemapp Logo', 'class'=>'', 'style' => 'margin:15px 10px;', 'width'=>180]);

$user = User::findOne(Yii::$app->user->id);

$menuItems[] = [
        ['label' => '<i class="fa fa-home"></i>&nbsp'.Yii::t('app', 'Početna'), 'url' => ['/'.$user->username.'/home']],
        ['label' => '<i class="fa fa-cogs"></i>&nbsp'.Yii::t('app', 'Podešavanja'), 'url' => ['/'.$user->username.'/setup']],        
        ['label' => '<i class="fa fa-sign-out"></i>&nbspLogout (' . $user->username . ')', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
];
$menuItems[] = [
        ['label' => Yii::t('app', 'Usluge'), 'url' => ['/services/index']],
        ['label' => Yii::t('app', 'Akcije'), 'url' => ['/actions/index']],  
        ['label' => Yii::t('app', 'Delatnosti'), 'url' => ['/industries/index']],                                                      
        ['label' => Yii::t('app', 'Predmeti'), 'url' => ['/objects/index']],
        ['label' => Yii::t('app', 'Svojstva'), 'url' => ['/properties/index']],
        //['label' => Yii::t('app', 'Modeli svojstava'), 'url' => ['/property-values/index']],
        //['label' => Yii::t('app', 'Metode'), 'url' => ['/methods/index']],
        //['label' => Yii::t('app', 'Specifikacije'), 'url' => ['/specs/index']],
        //['label' => Yii::t('app', 'Skilovi'), 'url' => ['/skills/index']],
        //['label' => Yii::t('app', 'Problemi'), 'url' => ['/object-issues/index']],
        //['label' => Yii::t('app', 'Specifikacije usluge'), 'url' => ['/service-specs/index']],
        //['label' => Yii::t('app', 'Metode usluge'), 'url' => ['/service-methods/index']],
        //['label' => Yii::t('app', 'Procesi usluge'), 'url' => ['/service-processes/index']],
        //['label' => Yii::t('app', 'Skilovi usluge'), 'url' => ['/service-skills/index']],
        //['label' => Yii::t('app', 'Jedinice mere usluge'), 'url' => ['/service-units/index']],
        //['label' => Yii::t('app', 'Vrste predmeta usluge'), 'url' => ['/service-object-models/index']],
];   
$menuItems[] = [
        ['label' => Yii::t('app', 'Valute'), 'url' => ['/currencies/index']],
        ['label' => Yii::t('app', 'Jezici'), 'url' => ['/languages/index']],
        ['label' => Yii::t('app', 'Jedinice mere'), 'url' => ['/units/index']],
        ['label' => Yii::t('app', 'Tagovi'), 'url' => ['/tags/index']],
];
$menuItems[] = [
        //['label' => Yii::t('app', 'Sektori'), 'url' => ['/services/index']],
        //['label' => Yii::t('app', 'Kategorije'), 'url' => ['/services/index']],
        ['label' => Yii::t('app', 'Klase predmeta'), 'url' => ['/object-classes/index']],
        ['label' => Yii::t('app', 'Vrste predmeta'), 'url' => ['/object-types/index']],
        ['label' => Yii::t('app', 'Procesi'), 'url' => ['/processes/index']],
        ['label' => Yii::t('app', 'Regulativa'), 'url' => ['/regulations/index']],
];
?>

<!-- START LEFT SIDEBAR NAV-->
<aside id="left-sidebar-nav" class="col-md-2 bg-blue-gray-900 white">
    <?php /* Menu::widget([
        'options' => ['class' => 'side-nav fixed leftside-navigation', 'id' => 'slide-out'],
        'encodeLabels' => false,
        'items' => [
            ['label' => '<i class="fa fa-home"></i>&nbsp'.Yii::t('app', 'Početna'), 'url' => ['/'.$user->username.'/home']],
            ['label' => '<i class="fa fa-cogs"></i>&nbsp'.Yii::t('app', 'Podešavanja'), 'url' => ['/'.$user->username.'/setup']],        
            ['label' => '<i class="fa fa-sign-out"></i>&nbspLogout (' . $user->username . ')', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],

            ['label' => Yii::t('app', 'Core'), 'url' => ['/services/index'], 'options' => ['class' => 'collapsible collapsible-accordion'], 'items' => [
                ['label' => Yii::t('app', 'Usluge'), 'url' => ['/services/index']],
                ['label' => Yii::t('app', 'Akcije'), 'url' => ['/actions/index']],  
                ['label' => Yii::t('app', 'Delatnosti'), 'url' => ['/industries/index']],                                                      
                ['label' => Yii::t('app', 'Predmeti'), 'url' => ['/objects/index']],
                ['label' => Yii::t('app', 'Svojstva'), 'url' => ['/properties/index']],
            ]],
                
            //['label' => Yii::t('app', 'Modeli svojstava'), 'url' => ['/property-values/index']],
            //['label' => Yii::t('app', 'Metode'), 'url' => ['/methods/index']],
            //['label' => Yii::t('app', 'Specifikacije'), 'url' => ['/specs/index']],
            //['label' => Yii::t('app', 'Skilovi'), 'url' => ['/skills/index']],
            //['label' => Yii::t('app', 'Problemi'), 'url' => ['/object-issues/index']],
            //['label' => Yii::t('app', 'Specifikacije usluge'), 'url' => ['/service-specs/index']],
            //['label' => Yii::t('app', 'Metode usluge'), 'url' => ['/service-methods/index']],
            //['label' => Yii::t('app', 'Procesi usluge'), 'url' => ['/service-processes/index']],
            //['label' => Yii::t('app', 'Skilovi usluge'), 'url' => ['/service-skills/index']],
            //['label' => Yii::t('app', 'Jedinice mere usluge'), 'url' => ['/service-units/index']],
            //['label' => Yii::t('app', 'Vrste predmeta usluge'), 'url' => ['/service-object-models/index']],

            ['label' => Yii::t('app', 'Valute'), 'url' => ['/currencies/index']],
            ['label' => Yii::t('app', 'Jezici'), 'url' => ['/languages/index']],
            ['label' => Yii::t('app', 'Jedinice mere'), 'url' => ['/units/index']],
            ['label' => Yii::t('app', 'Tagovi'), 'url' => ['/tags/index']],

            ['label' => Yii::t('app', 'Klase predmeta'), 'url' => ['/object-classes/index']],
            ['label' => Yii::t('app', 'Vrste predmeta'), 'url' => ['/object-types/index']],
            ['label' => Yii::t('app', 'Procesi'), 'url' => ['/processes/index']],
            ['label' => Yii::t('app', 'Regulativa'), 'url' => ['/regulations/index']],
        ],
    ]); */ ?>
    <ul id="slide-out" class="side-nav fixed leftside-navigation">
        <li class="">
            <?= Yii::$app->user->avatar ?>
            <ul class="dropdown-content">
                <li><a href="#"><i class="mdi-action-face-unlock"></i> <?= Yii::$app->user->username ?></a></li>                        
            </ul>                   
            <p class="user-roal">Administrator</p>                
        </li>

        <li class=""><?= Html::a('Dashboard', Url::to('/'), []) ?></li>
        <li class=""><?= Html::a('Application Manager', Url::to('/'), []) ?></li>
        <li class=""><?= Html::a('Users Manager', Url::to('/'), []) ?></li>
        <li class="">
            <?= Html::a('Core Database', Url::to('/'), []) ?>
            <ul class="dropdown-content">
                <li class=""><?= Html::a('Usluge', Url::to('/services/index'), []) ?></li>
                <li class=""><?= Html::a('Akcije', Url::to('/actions/index'), []) ?></li>
                <li class=""><?= Html::a('Delatnosti', Url::to('/industries/index'), []) ?></li>
                <li class=""><?= Html::a('Predmeti', Url::to('/objects/index'), []) ?></li>
                <li class=""><?= Html::a('Svojstva', Url::to('/properties/index'), []) ?></li>
                <li class=""><?= Html::a('Jezici', Url::to('/languages/index'), []) ?></li>
                <li class=""><?= Html::a('Valute', Url::to('/currencies/index'), []) ?></li>
                <li class=""><?= Html::a('Jedinice mere', Url::to('/units/index'), []) ?></li>
            </ul>
        </li>
        <li class=""><?= Html::a('Post Manager', Url::to('/'), []) ?></li>
        <li class=""><?= Html::a('Inbox', Url::to('/'), []) ?></li>            
    </ul>
   
</aside>
<!-- END LEFT SIDEBAR NAV-->



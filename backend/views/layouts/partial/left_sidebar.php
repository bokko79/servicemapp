<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use \common\models\User;

$logo_url = Html::img(Yii::$app->homeUrl.'images/logo/logo46.png', ['alt'=>'Servicemapp Logo', 'class'=>'', 'style' => 'margin:15px 10px;', 'width'=>180]);

$user = User::findOne(Yii::$app->user->id);
?>

<!-- START LEFT SIDEBAR NAV-->
<aside id="left-sidebar-nav" class="col-md-2 bg-blue-gray-900 white">

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
        <li class=""><?= Html::a('Users Manager', Url::to('/users/index'), []) ?></li>
        <li class="">
            <?= Html::a('Core Database', Url::to('/'), []) ?>
            <ul class="dropdown-content">
                <li class="">
                    <?= Html::a('Usluge', Url::to('/services/index'), []) ?>
                    <ul>
                        <li class=""><?= Html::a('Industry Properties', Url::to('/service-industry-properties/index'), []) ?></li>
                        <li class=""><?= Html::a('Action Properties', Url::to('/service-action-properties/index'), []) ?></li>
                        <li class=""><?= Html::a('Action Property Values', Url::to('/service-action-property-values/index'), []) ?></li>
                        <li class=""><?= Html::a('Object Properties', Url::to('/service-object-properties/index'), []) ?></li>
                        <li class=""><?= Html::a('Object Property Values', Url::to('/service-object-property-values/index'), []) ?></li>
                        <li class=""><?= Html::a('Regulations', Url::to('/service-regulations/index'), []) ?></li>
                        <li class=""><?= Html::a('Processes', Url::to('/service-processes/index'), []) ?></li>
                        <li class=""><?= Html::a('Units', Url::to('/service-units/index'), []) ?></li>
                    </ul>
                </li>
                <li class="">
                    <?= Html::a('Akcije', Url::to('/actions/index'), []) ?>
                    <ul>
                        <li class=""><?= Html::a('Action Properties', Url::to('/action-properties/index'), []) ?></li>
                        <li class=""><?= Html::a('Action Property Values', Url::to('/action-property-values/index'), []) ?></li>
                    </ul>
                </li>
                <li class="">
                    <?= Html::a('Delatnosti', Url::to('/industries/index'), []) ?>
                    <ul>
                        <li class=""><?= Html::a('Industry Properties', Url::to('/industry-properties/index'), []) ?></li>
                        <li class=""><?= Html::a('Categories', Url::to('/categories/index'), []) ?></li>
                        <li class=""><?= Html::a('Sectors', Url::to('/sectors/index'), []) ?></li>
                    </ul>
                </li>
                <li class="">
                    <?= Html::a('Predmeti', Url::to('/objects/index'), []) ?>
                    <ul>
                        <li class=""><?= Html::a('Object Properties', Url::to('/object-properties/index'), []) ?></li>
                        <li class=""><?= Html::a('Object Property Values', Url::to('/object-property-values/index'), []) ?></li>
                        <li class=""><?= Html::a('Object Types', Url::to('/object-types/index'), []) ?></li>
                        <li class=""><?= Html::a('Object Issues', Url::to('/object-issues/index'), []) ?></li>
                    </ul>
                </li>
                <li class="">
                    <?= Html::a('Proizvodi', Url::to('/products/index'), []) ?>
                    <ul>
                        <li class=""><?= Html::a('Product Properties', Url::to('/product-properties/index'), []) ?></li>
                        <li class=""><?= Html::a('Product Property Values', Url::to('/product-property-values/index'), []) ?></li>                        
                        <li class=""><?= Html::a('Product Issues', Url::to('/product-issues/index'), []) ?></li>
                    </ul>
                </li>
                <li class="">
                    <?= Html::a('Svojstva', Url::to('/properties/index'), []) ?>
                    <ul>
                        <li class=""><?= Html::a('Values', Url::to('/property-values/index'), []) ?></li>
                    </ul>
                </li>
                <li class=""><?= Html::a('Jezici', Url::to('/languages/index'), []) ?></li>
                <li class=""><?= Html::a('Valute', Url::to('/currencies/index'), []) ?></li>
                <li class=""><?= Html::a('Jedinice mere', Url::to('/units/index'), []) ?></li>
                <li class=""><?= Html::a('Tagovi', Url::to('/tags/index'), []) ?></li>
                <li class=""><?= Html::a('Procesi', Url::to('/processes/index'), []) ?></li>
                <li class=""><?= Html::a('Regulativa', Url::to('/regulations/index'), []) ?></li>
            </ul>
        </li>
        <li class=""><?= Html::a('Post Manager', Url::to('/'), []) ?></li>
        <li class=""><?= Html::a('Inbox', Url::to('/'), []) ?></li>            
    </ul>
   
</aside>
<!-- END LEFT SIDEBAR NAV-->



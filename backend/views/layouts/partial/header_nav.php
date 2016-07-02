<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use \common\models\User;
use yii\bootstrap\Modal;

$logo_url = Html::img(Yii::$app->homeUrl.'images/logo/logo46.png', ['alt'=>'Servicemapp Logo', 'class'=>'', 'style' => 'margin:15px 10px;', 'width'=>180]);
?>
<div style="position:relative;">
 <!-- HEADER -->
  <header class="main">
    <!-- NAVBAR FULL RESOLUTION -->
    <nav>
      <div class="grid-container">
        <div class="grid-row">
          <div class="grid-left">
            <!-- LOGO -->
            <?= Html::a($logo_url, '/site/index', ['class' => '']) ?>
          </div>          
          <div class="grid-center" style="position:static;">
          </div>
          <!-- KORISNIČKI KONTROLNI PANEL NA NAVBAR-U -->
          <div class="grid-right media_control">
              <?php                   
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => '<i class="fa fa-sign-in fa-lg"></i>', 'url' => ['/user/security/login']]; 
                    $logo = Html::img(Yii::$app->homeUrl.'images/logo/logo3.png', ['alt'=>'User avatar', 'class'=>'', 'style' => 'border-radius:3px;', 'width'=>16]);
                    $menuItems[] = ['label' => $logo, 'url' => ['/info']];                   
                } else {
                    $user = User::findOne(Yii::$app->user->id);
                    
                    $menuItems[] = [
                        'label' => $user->username,    
                        'items' => [
                            ['label' => '<i class="fa fa-home"></i>&nbsp'.Yii::t('app', 'Početna'), 'url' => ['/'.$user->username.'/home']],
                            
                            '<li class="divider"></li>',
                            '<li class="dropdown-header">'.Yii::t('app', 'Podešavanja').'</li>',
                            ['label' => '<i class="fa fa-cogs"></i>&nbsp'.Yii::t('app', 'Podešavanja'), 'url' => ['/'.$user->username.'/setup']],                            
                            
                            ['label' => '<i class="fa fa-sign-out"></i>&nbspLogout (' . $user->username . ')', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                        ],
                        'linkOptions' => ['class'=>'btn btn-default']
                    ];
                    $menuItems[] = [
                        'label' => '<i class="fa fa-list fa-lg"></i>',    
                        'items' => [
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
                        ],
                        'linkOptions' => ['class'=>'btn btn-default']
                    ];   
                    $menuItems[] = [
                        'label' => '<i class="fa fa-euro fa-lg"></i>',    
                        'items' => [
                            ['label' => Yii::t('app', 'Valute'), 'url' => ['/currencies/index']],
                            ['label' => Yii::t('app', 'Jezici'), 'url' => ['/languages/index']],
                            ['label' => Yii::t('app', 'Jedinice mere'), 'url' => ['/units/index']],
                            ['label' => Yii::t('app', 'Tagovi'), 'url' => ['/tags/index']],
                        ],
                        'linkOptions' => ['class'=>'btn btn-default']
                    ];
                    $menuItems[] = [
                        'label' => '<i class="fa fa-bars fa-lg"></i>',    
                        'items' => [
                            //['label' => Yii::t('app', 'Sektori'), 'url' => ['/services/index']],
                            //['label' => Yii::t('app', 'Kategorije'), 'url' => ['/services/index']],
                            ['label' => Yii::t('app', 'Klase predmeta'), 'url' => ['/object-classes/index']],
                            ['label' => Yii::t('app', 'Vrste predmeta'), 'url' => ['/object-types/index']],
                            ['label' => Yii::t('app', 'Procesi'), 'url' => ['/processes/index']],
                            ['label' => Yii::t('app', 'Regulativa'), 'url' => ['/regulations/index']],
                        ],
                        'linkOptions' => ['class'=>'btn btn-default']
                    ];                                    
                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar_control_box'],
                    'encodeLabels' => false,
                    'items' => $menuItems,
                ]);
                ?>
          </div><!-- END OF KORISNIČKI KONTROLNI PANEL NA NAVBAR-U -->
        </div><!-- row fluid -->
      </div>
    </nav>
  </header>
</div>



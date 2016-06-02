<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use \frontend\models\User;
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
            <?= $this->render('global_nav.php') ?>
            <?php /*include (Yii::getPathOfAlias( 'ext.widgets.header._search').'.php');*/ ?>
          </div>
          <!-- KORISNIČKI KONTROLNI PANEL NA NAVBAR-U -->
          <div class="grid-right media_control">
              <?php                   
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => '<i class="fa fa-sign-in fa-lg"></i>', 'linkOptions' => ['data-toggle'=>'modal', 'data-target'=>'#uac-modal']]; 
                    //$menuItems[] = ['label' => '<i class="fa fa-sign-in fa-lg"></i>', 'url'=>'/user/security/login']; 
                    $logo = Html::img(Yii::$app->homeUrl.'images/logo/logo3.png', ['alt'=>'User avatar', 'class'=>'', 'style' => 'border-radius:3px;', 'width'=>16]);
                    $menuItems[] = ['label' => $logo, 'url' => ['/info']];                   
                } else {
                    $user = User::findOne(Yii::$app->user->id);
                    $user_avatar = Html::img(Yii::$app->homeUrl.'images/cards/default_avatar.png', ['alt'=>'User avatar', 'class'=>'', 'style' => 'border-radius:3px;', 'width'=>24]);
                    $menuItems[] = [
                        'label' => $user_avatar,    
                        'items' => [
                            ['label' => '<i class="fa fa-home"></i>&nbsp'.Yii::t('app', 'Početna'), 'url' => ['/'.$user->username.'/home']],
                            ['label' => '<i class="fa fa-dot-circle-o"></i>&nbsp'.Yii::t('app', 'Vaše usluge'), 'url' => ['/'.$user->username.'/services'], 'visible' => $user->is_provider==1],
                            ['label' => '<i class="fa fa-file-text-o"></i>&nbsp'.Yii::t('app', 'Vaši poslovi'), 'url' => ['/'.$user->username.'/orders']],
                            ['label' => '<i class="fa fa-save"></i>&nbsp'.Yii::t('app', 'Vaše spremne porudžbine'), 'url' => ['/'.$user->username.'/ready-orders']],                               
                            (($user->is_provider==1) ? '<li class="divider"></li>' : ''),
                            ['label' => '<i class="fa fa-user"></i>&nbsp'.Yii::t('app', 'Vaš profil'), 'url' => ['/'.$user->username.'/profile'], 'visible' => $user->is_provider==1],                              
                            (($user->is_provider==1) ? '<li class="divider"></li>' : ''),
                            ['label' => '<i class="fa fa-line-chart"></i>&nbsp'.Yii::t('app', 'Finansije'), 'url' => ['/'.$user->username.'/finances']],
                            ['label' => '<i class="fa fa-envelope-o"></i>&nbsp'.Yii::t('app', 'Inbox'), 'url' => ['/'.$user->username.'/inbox']],                             
                            '<li class="divider"></li>',
                            '<li class="dropdown-header">'.Yii::t('app', 'Podešavanja').'</li>',
                            ['label' => '<i class="fa fa-cogs"></i>&nbsp'.Yii::t('app', 'Podešavanja'), 'url' => ['/'.$user->username.'/setup']],
                            
                            ['label' => '<i class="fa fa-users"></i>&nbsp'.Yii::t('app', 'Članstvo'), 'url' => ['/membership']],
                            '<li class="divider"></li>',
                            ['label' => '<i class="fa fa-sign-out"></i>&nbspLogout (' . $user->username . ')', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
                        ],
                        'linkOptions' => ['class'=>'btn btn-default']
                    ];
                    $menuItems[] = [
                        'label' => '<i class="fa fa-bell-o fa-lg"></i> <span class="label label-info">17</span>',    
                        'items' => [
                              $this->render('notifications_excerpt.php')
                        ],
                        'options' => ['class'=>'notif_li badger'],
                        'linkOptions' => ['class'=>'btn btn-default'],
                    ];                    
                }
                $menuItems[] = [
                  'label' => Yii::$app->user->currency,
                  'items' => [
                      ['label' => 'RSD', 'url' => ['/site/currency', 'currency'=>1]],
                      ['label' => 'EUR', 'url' => ['/site/currency', 'currency'=>3]],
                     
                  ],
                ];
                $menuItems[] = [
                  'label' => c(Yii::$app->language),
                  'items' => [
                      ['label' => 'srpski', 'url' => ['/site/language', 'language'=>'sr-Latn']],
                      ['label' => 'English', 'url' => ['/site/language', 'language'=>'en-US']],
                     
                  ],
                ];
                $menuItems[] = ['label' => '<i class="fa fa-shopping-cart fa-lg"></i> '.(count(Yii::$app->session['cart'])>0 ? '<span class="label label-warning">'.count(Yii::$app->session['cart']).'</span>' : null), 'url' => ['/index'], 'options' => ['class'=>'shopping-cart badger'], 'linkOptions' => ['class'=>'btn btn-success']];  
                //$menuItems[] = ['label' => '<i class="fa fa-support fa-lg"></i>', 'url' => ['/posts'], 'options' => ['class'=>'help-button'], 'linkOptions' => ['class'=>'btn btn-default']];
                              
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
<?php
if(Yii::$app->user->isGuest){
  Modal::begin([
        'id'=>'uac-modal',
        'size'=>Modal::SIZE_LARGE,
        'options'=>['class'=>'overlay_modal fade','tabindex' => null,]
    ]); ?>

   <div class="container-fluid uac">
    <div class="row">
      <div class="col-md-12">
        <?= $this->render('uac.php') ?>
      </div>
    </div>
  </div>

<?php Modal::end();
}  ?>



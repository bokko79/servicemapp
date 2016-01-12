<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use \frontend\models\User;
use yii\bootstrap\Modal;

$logo_url = Html::img(Yii::$app->homeUrl.'images/logo/logo46.png', ['alt'=>'Servicemapp Logo', 'class'=>'', 'style' => 'margin:10px;', 'width'=>180]);
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
                    $menuItems[] = ['label' => 'Login/Registracija', 'linkOptions' => ['data-toggle'=>'modal', 'data-target'=>'#uac-modal']];
                } else {
                    $user = User::findOne(Yii::$app->user->id);
                    $user_avatar = Html::img(Yii::$app->homeUrl.'images/cards/default_avatar.jpg', ['alt'=>'User avatar', 'class'=>'', 'style' => 'border-radius:3px; margin:0 5px 0 0;', 'width'=>24]);
                    $menuItems[] = [
                        'label' => $user_avatar . Yii::$app->user->identity->username,    
                        'items' => [
                              ['label' => '<i class="fa fa-home"></i>&nbsp'.Yii::t('app', 'Your profile'), 'url' => ['/site/index']],
                              ['label' => '<i class="fa fa-save"></i>&nbsp'.Yii::t('app', 'Your saved orders'), 'url' => ['/site/index']],                               
                              (($user->is_provider==1) ? '<li class="divider"></li>' : ''),
                              ['label' => '<i class="fa fa-bell-o"></i>&nbsp'.Yii::t('app', 'Your Services'), 'url' => ['/site/index'], 'visible' => $user->is_provider==1],
                              (($user->is_provider==1) ? '<li class="divider"></li>' : ''),
                              ['label' => '<i class="fa fa-bell-o"></i>&nbsp'.Yii::t('app', 'Notifications'), 'url' => ['/site/index']],
                              ['label' => '<i class="fa fa-envelope-o"></i>&nbsp'.Yii::t('app', 'Messages'), 'url' => ['/site/index']],   
                              
                              '<li class="divider"></li>',
                              '<li class="dropdown-header">'.Yii::t('app', 'Settings').'</li>',
                              ['label' => '<i class="fa fa-cogs"></i>&nbsp'.Yii::t('app', 'Profile settings'), 'url' => ['/site/index']],
                              ['label' => '<i class="fa fa-wrench"></i>&nbsp'.Yii::t('app', 'Notifications settings'), 'url' => ['/site/index']],
                              '<li class="divider"></li>',
                              ['label' => '<i class="fa fa-sign-out"></i>&nbspLogout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                        ],
                        'linkOptions' => ['class'=>'btn btn-default']
                    ];

                    $menuItems[] = [
                        'label' => '<i class="fa fa-bell fa-lg"></i> <span class="label label-info">17</span>',    
                        'items' => [
                              $this->render('notifications_excerpt.php')
                        ],
                        'options' => ['class'=>'notif_li badger'],
                        'linkOptions' => ['class'=>'btn btn-default'],
                    ];
                }
                $menuItems[] = ['label' => '<i class="fa fa-support fa-lg"></i>', 'url' => ['/index'], 'options' => ['class'=>'help-button'], 'linkOptions' => ['class'=>'btn btn-default']];
                $menuItems[] = ['label' => '<i class="fa fa-shopping-cart fa-lg"></i> <span class="label label-info">2</span>', 'url' => ['/index'], 'options' => ['class'=>'shopping-cart badger'], 'linkOptions' => ['class'=>'btn btn-success']];                
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
    <!-- NAVBAR MOBILE RESOLUTION -->
      <!--<nav class="m_container">

        <div class="row-fluid">
          <?php /* $this->beginContent('//layouts/header/mobile'); ?>
          <?php $this->endContent(); */ ?>
        </div>
      </nav>-->
  </header>
</div>
<?php Modal::begin([
        'id'=>'uac-modal',
        'size'=>Modal::SIZE_LARGE,
    ]); ?>

   <div class="container-fluid uac">
    <div class="row">
      <div class="col-md-12">
        <?= $this->render('uac.php') ?>
      </div>
    </div>
  </div>

<?php Modal::end(); ?>



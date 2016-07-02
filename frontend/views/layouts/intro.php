<?php
use yii\helpers\Html;
use yii\helpers\Url;
use \common\models\User;
use yii\bootstrap\Modal;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php $this->beginContent('@app/views/layouts/html/html_intro.php'); ?>

<?php /* PROFILE HEADING */ ?>
	<!-- Loader -->
	<div class="loader" style="display: none;">
		<div class="loader-img" style="display: none;"></div>
	</div>
			
    <!-- Top content -->
    <div class="top-content" style="position: relative; z-index: 0; background: url(../images/backgrounds/land_back_4.jpg) center center no-repeat;">
    	     	
    	<?= $this->render('partial/intro_nav.php') ?>

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <?= $content ?>                    
                </div>
            </div>
        </div>        
    	<div class="backstretch" style="left: 0px; top: 0px; bottom:0; right:0; overflow: hidden; margin: 0px; padding: 0px; width: 100%; z-index: -999998; position: absolute; background-image:linear-gradient(to bottom, rgba(69,90,100,.5),rgba(35,150,155,1))"></div>
    </div>

<?php Modal::begin([
    'id'=>'uac-modal',
    'size'=>Modal::SIZE_LARGE,
]); ?>

   <div class="container-fluid uac">
    <div class="row">
      <div class="col-md-12">
        <?= $this->render('partial/uac.php') ?>
      </div>
    </div>
  </div>

<?php Modal::end(); ?>

	<?= $this->render('partial/intro/what-is.php') ?>
	<?= $this->render('partial/intro/how-it-works.php') ?>
	
	<?= $this->render('partial/intro/pricing.php') ?>
	<?= $this->render('partial/intro/excerpt.php') ?>
	<?= $this->render('partial/intro/about-us.php') ?>
	<?= $this->render('partial/intro/footer.php') ?>

<?php $this->endContent(); // HTML ?>
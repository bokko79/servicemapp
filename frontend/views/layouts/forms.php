<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
use frontend\widgets\PageTitle;
use frontend\widgets\Steps;
use frontend\widgets\Cart;
use frontend\widgets\Help;
use yii\web\Session;
$session = Yii::$app->session;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">
    <div class="grid-row">
        <div class="grid-leftacross">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>        
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData' => $this->pageTitle, // Card Picture
                ]) ?>
            <?php /* WIDGET: PAGETITLE */ /* ?>
                <?= Steps::widget([
                    'steps' => $this->steps, // Card Picture
                ]) */?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Progress Meter ?>
            <?php /* WIDGET: CART */ 
                if(Yii::$app->controller->id=='orders' && Yii::$app->controller->action->id=='add' && isset($session['cart'])): ?>
                <?= Cart::widget([
                    'cart' => $this->cart, // Card Picture
                ]);
                endif;
                ?>
            <?= $this->render('partial/help.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
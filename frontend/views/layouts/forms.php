<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
use frontend\widgets\PageTitle;
use frontend\widgets\Steps;
use frontend\widgets\Cart;
use frontend\widgets\Help;
use yii\web\Session;
use frontend\widgets\ProfileSubNav;
$session = Yii::$app->session;
?>

<?php $this->beginContent('@app/views/layouts/html/html_forms.php'); ?>

<?php /* PROFILE HEADING */ ?>
<div class="grid-container">
    <div class="grid-row">
        <div class="grid-leftacross">
            <?php /* Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) */?>        
            <?php /* WIDGET: PAGETITLE */ if(Yii::$app->controller->id!='orders' && Yii::$app->controller->id!='presentations'): ?>
                <?= PageTitle::widget([
                    'titleData' => $this->pageTitle, // Card Picture
                ]) ?>
            <?php endif; ?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Progress Meter ?>
            <?php /* WIDGET: CART */ 
                if(Yii::$app->controller->id=='orders' && (Yii::$app->controller->action->id=='add' || Yii::$app->controller->action->id=='create') && isset($session['cart'])): ?>
                <?= Cart::widget([
                    'cart' => $this->cart,
                    'card_class' => 'record-270 no-shadow',
                ]);
                endif;
                ?>
            <?php if(Yii::$app->controller->id=='orders' && Yii::$app->controller->action->id=='add' && !isset($session['cart'])): ?>
            <?= $this->render('partial/order_hint.php') ?>
            <?php endif; ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
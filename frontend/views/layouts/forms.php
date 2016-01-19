<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
use frontend\widgets\PageTitle;
use frontend\widgets\Steps;
use frontend\widgets\Cart;
use frontend\widgets\Help;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">
    <div class="grid-row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>

    <div class="grid-row">
        <div class="grid-leftacross">
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData' => $this->pageTitle, // Card Picture
                ]);
                ?>

            <?php /* WIDGET: PAGETITLE */ ?>
                <?= Steps::widget([
                    'steps' => $this->steps, // Card Picture
                ]);
                ?>

            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Progress Meter ?>
            <?php /* WIDGET: CART */ ?>
                <?= Cart::widget([
                    'cart' => $this->cart, // Card Picture
                ]);
                ?>
            <?= $this->render('partial/help.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
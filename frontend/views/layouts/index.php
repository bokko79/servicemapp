<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
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
        <div class="grid-left">
            <?php // Filters ?>
        </div>

        <div class="grid-center" style="">
            <?php // QuickForm Widgets ?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Stats ?>
            <?php // Feed ?>
            <?php // News/Ads ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
<?php
/* @var $this \yii\web\View */
/* @var $content string */

?>

<?php $this->beginContent('@app/views/layouts/html/html_simple.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">

    <div class="grid-row">
        <div class="grid-leftacross">
            <?php // Title Widget ?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
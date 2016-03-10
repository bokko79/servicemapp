<?php
/* @var $this \yii\web\View */
/* @var $content string */

?>

<?php $this->beginContent('@app/views/layouts/html/html_blank.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">

    <div class="grid-row">
        <div class="grid-full">
            
            <?= $content ?>
            <?= $this->render('partial/footer.php') ?>
        
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
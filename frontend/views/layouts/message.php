<?php
/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">
    <div class="grid-row">
        <div class="grid-left">
            <?php // Menu: Message THreads Index Widget ?>           
        </div>

        <div class="grid-center">
            <?= $content ?>           
        </div>   
                
        <div class="grid-right">
            <?php // Progress Meter ?>
            <?php // Help ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
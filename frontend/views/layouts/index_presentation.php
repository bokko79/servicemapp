<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>


<div class="grid-container" style="">
    <div class="grid-row">
        <div class="grid-full">
            <?= $content ?>
        </div>
    </div>
</div>

<div style="background:#f8f8f8">
    <?= $this->render('//services/_commercial.php', ['services'=>false]) ?>
    <?= $this->render('partial/footer.php') ?>
</div>

<?php $this->endContent(); // HTML ?>
<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<div class="screen <?= ($renderIndex = $this->params['renderIndex']) ? '' : 'mini' ?>">
    <?= $this->render('partial/screen.php', ['renderIndex'=>$renderIndex]) ?>
</div>
    <?= $this->render('partial/six_boxes.php') ?>
<?php if(isset($this->params['industry']) && $this->params['industry']!=null): ?>
    <?= $this->render('partial/service_head.php') ?>
<?php endif; ?>
<?php if(!$renderIndex): ?>
<div class="grid-container" style="">
    <div class="grid-row">
        <div class="grid-full">
            <?= $content ?>
        </div>
    </div>
</div>
<?php endif; ?>
<div style="background:#f8f8f8">
    <?= $this->render('//services/_commercial.php', ['services'=>$renderIndex]) ?>
    <?= $this->render('partial/footer.php') ?>
</div>

<?php $this->endContent(); // HTML ?>
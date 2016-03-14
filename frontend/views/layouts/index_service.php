<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<div class="screen <?= (!$this->params['getService']) ? '' : 'mini' ?>">
    <?= $this->render('partial/screen.php', ['getService'=>$this->params['getService']]) ?>
</div>
    <?= $this->render('partial/six_boxes.php') ?>
<?php if(isset($this->params['getService']['industry_id'])): ?>
    <?= $this->render('partial/service_head.php') ?>
<?php endif; ?>
<?php if($this->params['getService']): ?>
<div class="grid-container" style="">
    <div class="grid-row">
        <div class="grid-full">
            <?= $content ?>
        </div>
    </div>
</div>
<?php endif; ?>
    <?= $this->render('//services/_commercial.php', ['services'=>$this->params['getService']]) ?>
<?php $this->endContent(); // HTML ?>
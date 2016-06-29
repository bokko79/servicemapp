<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
$logo_url = Html::img(Yii::$app->homeUrl.'images/logo/logo46.png', ['alt'=>'Servicemapp Logo', 'width'=>180]);
?>

<?php $this->beginContent('@app/views/layouts/html/html_blank.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">

    <div class="grid-row">
        <div class="grid-full">
            <?= Html::a($logo_url, '/services', ['class' => '']) ?>

            <?= $content ?>
            <?= $this->render('partial/footer.php') ?>
        
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\GoogleAsset;
use common\widgets\Alert;

AppAsset::register($this);
//GoogleAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- FONTS -->  
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,700,400,500,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="http://maps.googleapis.com/maps/api/js?libraries=places&amp;language=hr"></script>

    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

        <?= $this->render('../partial/header_nav_forms.php') ?> 

        <?= $content ?>   

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\IntroAppAsset;
use common\widgets\Alert;

IntroAppAsset::register($this);
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
	<link href="https://fonts.googleapis.com/css?family=Arimo:400,700" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.0.0/normalize.min.css"/>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>    

    <?= $content ?>   

<a href="#" id="back-to-top" title="Back to top">&uarr;</a>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

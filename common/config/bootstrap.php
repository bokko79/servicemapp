<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
// an alias of a URL
Yii::setAlias('@frontend-images', 'http://servicemapp/images');
Yii::setAlias('@backend-images', 'http://back.servicemapp/images');

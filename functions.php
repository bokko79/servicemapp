<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\ArrayHelper;

function url($url = '', $scheme = false)
{
    return Url::to($url, $scheme);
}

function h($text)
{
    return Html::encode($text);
}

function ph($text)
{
    return HtmlPurifier::process($text);
}

function t($message, $params = [], $category = 'app', $language = null)
{
    return Yii::t($category, $message, $params, $language);
}

function param($name, $default = null)
{
    return ArrayHelper::getValue(Yii::$app->params, $name, $default);
}
/* Za prva slova č, ć, š, đ, ž */
function c($string)
{
    $strlen = mb_strlen($string, 'UTF-8');
    $firstChar = mb_substr($string, 0, 1, 'UTF-8');
    $then = mb_substr($string, 1, $strlen - 1, 'UTF-8');
    return mb_strtoupper($firstChar, 'UTF-8') . $then;
}

function now()
{
    return date('Y-m-d H:i:s');
}

function f_date($date)
{
    return Yii::$app->formatter->asDate($date, 'd. MMM yy');
}

function f_date_short($date)
{
    return Yii::$app->formatter->asDate($date, 'd. MMMM yy');
}
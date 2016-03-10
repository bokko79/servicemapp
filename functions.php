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

function f_datetime($date)
{
    return Yii::$app->formatter->asDate($date, 'd. MMMM yyyy. HH:mm');
}

/* titles/slugs */
function slug($string)
{
    return mb_strtolower(str_replace(' ', '-', $string));
}

function distance($lat1, $lon1, $lat2, $lon2, $unit='K') {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
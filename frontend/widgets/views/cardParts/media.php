<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$items = [];

foreach ($medias as $image) {
	$items[] = ['img' => Url::to('/images/cards/'.$image->ime)];
}
?>
<div class="media-area <?= ($version==1) ? null : 'square' ?> <?= $class ?>">                
    <div class="image">
		<?= \metalguardian\fotorama\Fotorama::widget([
        	'items' => $items,
        	'options' => [
                'loop' => 'true',
                'width' => '100%',
                'ratio' => ($version==1) ? '16/9' : '1/1',
                'fit' => 'cover',
                'autoplay' => 3000,
                'nav' => 'false',
                'allowfullscreen' => 'native',
                'transition' => 'dissolve',
			],
        ]) ?>
    </div>
</div>
<?= ($hr) ? '<hr class="no-margin">' : null ?>
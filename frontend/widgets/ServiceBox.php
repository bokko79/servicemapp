<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * ServiceBox displays the page specific stats on the right sidebar.
 *
 * To use ServiceBox, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo ServiceBox::widget([
 *
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class ServiceBox extends Widget
{
	public $serviceId;

    public $containerOptions = null;

    public $link;

    public $image = [];

    public $imageHeader = null;

    public $name;

    public $description = [];

    public $stats = [];

    public $price = [];

    public $actionButton = [];

    /**
     * Renders the widget
     */
    public function run()
    {
    	?>
        <div id="box_service" class="fadeInUp animated" style="<?= $this->containerOptions ?>">							
			<a href="<?= Url::to($this->link) ?>">
				<?php if($this->image) { ?>
				<div class="image">
					<?= Html::img('@web/images/cards/info/'.$this->image['source'], ['style'=>(!empty($this->image['style'])) ? $this->image['style'] : '']) ?>
					<?php if($this->imageHeader) { ?>
					<div class="image_header" style="<?= ($this->imageHeader['containerOptions']) ? $this->imageHeader['containerOptions'] : '' ?>">
						<?= Html::a(((strlen($this->name)<20) ? $this->name : substr($this->name, 0, 20).'...'), Url::to($this->link)) ?>
					</div>
					<?php } ?>
				</div>
				<?php } ?>

				<div class="content">
					<div class="header">
						<?= Html::a(((strlen($this->name)<20) ? $this->name : substr($this->name, 0, 20).'...'), Url::to($this->link)) ?>
					</div>					
					
					<div class="stats">
						<span><i class="fa fa-globe"></i>&nbsp;<?= (!empty($this->stats['orders'])) ? $this->stats['orders'] : '' ?></span>
						<span>&nbsp;<i class="fa fa-users"></i>&nbsp;<?= (!empty($this->stats['providers'])) ? $this->stats['providers'] : '' ?></span>
						<span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;<?= (!empty($this->stats['promotions'])) ? $this->stats['promotions'] : ''  ?></span>
					</div>

					<div class="desc"><?= ((!empty($this->description['categoryName'])) ? $this->description['categoryName'] : '').', '.((!empty($this->description['industryName'])) ? $this->description['industryName'] : '') ?></div>

					<div class="footer">
					<?php if($this->price) { ?>
						<div class="price">
							<?= '<span class="amount">'.$this->price['amount'].'</span>&nbsp;'.$this->price['currencyCode'].'/'.$this->price['unit'] ?> 
						</div>
					<?php } ?>
 						

						<div class="button">
							<?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to('/add-service/'.$this->serviceId), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;']); ?>
						</div>
					</div>
				</div>
			</a>	
		</div><!-- <div class="row-fluid subindustry1"> -->
<?php
    }
}

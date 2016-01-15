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

	public $containerType = 'record-320';

    public $containerOptions = null;

    public $link;

    public $image = [];

    public $imageHeader = null;

    public $name;

    public $primaryContextClass = null;

    public $secondaryContextClass = null;

    public $subhead = null;

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

		<div class="card_container <?= $this->containerType ?> grid-item fadeInUp animated" id="card_container" style="<?= $this->containerOptions ?>">
		<a href="<?= Url::to($this->link) ?>">
            <div class="media-area">
                <?php if($this->image) { ?>
				<div class="image">
					<?= Html::img('@web/images/cards/info/'.$this->image['source'], ['style'=>(!empty($this->image['style'])) ? $this->image['style'] : '']) ?>
					<?php if($this->imageHeader) { ?>
					<div class="image_header" style="<?= ($this->imageHeader['containerOptions']) ? $this->imageHeader['containerOptions'] : '' ?>">
						<?= Html::a(((strlen($this->name)<30) ? $this->name : substr($this->name, 0, 30).'...'), Url::to($this->link)) ?>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
            </div>
            <div class="primary-context <?= $this->primaryContextClass ?>">
                <div class="head"><?= Html::a(((strlen($this->name)<30) ? $this->name : substr($this->name, 0, 30).'...'), Url::to($this->link)) ?></div>
                <div class="subhead"><?= $this->subhead ?></div>
            </div>
            <div class="secondary-context <?= $this->secondaryContextClass ?>">
            	<span><i class="fa fa-globe"></i>&nbsp;<?= (!empty($this->stats['orders'])) ? $this->stats['orders'] : '' ?></span>
				<span>&nbsp;<i class="fa fa-users"></i>&nbsp;<?= (!empty($this->stats['providers'])) ? $this->stats['providers'] : '' ?></span>
				<span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;<?= (!empty($this->stats['promotions'])) ? $this->stats['promotions'] : ''  ?></span>
                <p><?= (($this->description) ? $this->description : '') ?></p>
            </div>
            <div class="action-area">
                <?php if($this->price) { ?>
				<div class="price left">
					<?= '<span class="label label-danger">'.$this->price['amount'].'&nbsp;'.$this->price['currencyCode'].'</span>/'.$this->price['unit'] ?> 
				</div>
				<?php } ?>
					

				<div class="button right">
					<?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to('/add-service/'.$this->serviceId), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;']); ?>
				</div>
            </div>
		</a>
        </div>
<?php
    }
}

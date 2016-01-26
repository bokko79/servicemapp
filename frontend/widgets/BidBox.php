<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\base\Arrayable;
use yii\i18n\Formatter;
use yii\base\InvalidConfigException;
use yii\base\Model;

/**
 * BidBox widget renders a list of related articles
 * @var $items [] list of items in ListView
 * @var $limit int number of items rendered
 * @var $internalOptions [] list of DB restrictions
 */
class BidBox extends \yii\bootstrap\Widget
{
	const TYPE_FULL = 'bid-full';
	const TYPE_COMPACT = 'bid-compact';

	const ORDER_STATUS_ACTIVE = 'active';

	const VIEWER_BIDDER = 'bidder';
	const VIEWER_SENDER = 'sender';
	const VIEWER_GUEST = 'guest';

	public $model;

	public $formatter;

	public $orderStatus;
	public $viewerRole;

    public $type = self::TYPE_FULL;
    public $bidOptions = [];

    /**
     * Initializes the detail view.
     * This method will initialize required property values.
     */
    public function init()
    {
        if ($this->model === null) {
            throw new InvalidConfigException('Please specify the "model" property.');
        }
        if ($this->formatter === null) {
            $this->formatter = Yii::$app->getFormatter();
        } elseif (is_array($this->formatter)) {
            $this->formatter = Yii::createObject($this->formatter);
        }
        if (!$this->formatter instanceof Formatter) {
            throw new InvalidConfigException('The "formatter" property must be either a Format object or a configuration array.');
        }
    }

    /**
     * Renders the widget
     */
    public function run()
    {
    	$model = $this->model;
    	$formatter = $this->formatter; 
    	$this->viewerRole = $model->userType;
        $this->orderStatus = $model->order->activity->status; ?>

            <div class="bid-wrap">
                <div class="header-context gray" style="height:64px;">              
                    <div class="avatar"><?= Html::img('@web/images/cards/'.$model->user->avatar->ime) ?></div>
                    <div class="title">
                        <div class="head second"><?= $model->user->username ?><span class="fs_11 margin-left-10 gray-color"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->time]) ?></span></div>
                        <div class="subhead"><?= $model->user->location->city ?></div>                                   
                    </div>
                    <div class="subaction right no-padding no-margin">
                    	<div class="btn-group btn-group-sm" role="group" aria-label="...">
		                    <?php if ($this->viewerRole == self::VIEWER_BIDDER && $this->orderStatus == self::ORDER_STATUS_ACTIVE && $this->type == self::TYPE_FULL): ?>
		                        <?= Html::a('<i class="fa fa-ban"></i>&nbsp;'.Yii::t('app', 'Reject'), Url::to(), ['class'=>'btn btn-default']); ?>
		                        <?= Html::a('<i class="fa fa-envelope-o"></i>&nbsp;'.Yii::t('app', 'Message'), Url::to(), ['class'=>'btn btn-default']); ?>
		                        <?= Html::a('<i class="fa fa-check"></i>&nbsp;'.Yii::t('app', 'Select'), Url::to(), ['class'=>'btn btn-success']); ?>
		                    <?php elseif ($this->viewerRole == self::VIEWER_SENDER && $this->orderStatus == self::ORDER_STATUS_ACTIVE && $this->type == self::TYPE_FULL): ?>
		                    	<?= Html::a('<i class="fa fa-pencil"></i>&nbsp;'.Yii::t('app', 'Update'), Url::to(), ['class'=>'btn btn-default']); ?>
		                        <?= Html::a('<i class="fa fa-times"></i>&nbsp;'.Yii::t('app', 'Delete'), Url::to(), ['class'=>'btn btn-danger']); ?> 
		                    <?php endif; ?>
                    	</div>
                    </div>
                </div>
			<?php if ($model->note): ?>
                <div class="secondary-context">
                	<p><?= $model->note ?></p>
                </div>
			<?php endif; ?>
                <div class="secondary-context">                    
                    <div class="row">
                        <div class="col-sm-4 center border-right">
                            <table>
                            	<tr><td class="gray-color fs_10 bold"><?= Yii::t('app', 'CENA') ?></td></tr>
                                <tr><td class="center">
                                        <div class="head major"><?= $formatter->asCurrency($model->price, $model->currency->code) ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr><td class="center gray-color bold">
                                        <?= $formatter->asCurrency($model->price_per, $model->currency->code) ?>/<?= $model->currency->code ?>
                                    </td>
                                </tr>
                            </table>
                        </div>                        
                        <div class="col-sm-4 center border-right">
                            <table>
                            	<tr><td class="gray-color fs_10 bold"><?= Yii::t('app', 'START') ?></td></tr>
                                <tr>
                                    <td class="center">
                                        <div class="head major"><?= $formatter->asDatetime($model->delivery_starts, 'php:j. M y @H:i') ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center gray-color bold">
                                        <?= Yii::t('app', 'za') ?> 
                                        <?= \russ666\widgets\Countdown::widget([
				                            'datetime' => $model->delivery_starts,
				                            'format' => '%-D<span class=\"fs_10\">d</span> %H<span class=\"fs_10\">h</span> %M<span class=\"fs_10\">m</span>',
				                            'events' => [
				                                'finish' => 'function(){$(this).closest("td").html("Due now!");}',
				                            ],
				                        ]) ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4 center">
                            <table>
                                <tr><td class="gray-color fs_10 bold"><?= Yii::t('app', 'TRAJANJE') ?></td></tr>
                                <tr>
                                    <td class="center">
                                        <div class="head major"><?= $model->period ?><?= $model->periodUnit->oznaka ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="center gray-color bold">
                                        <?= Yii::t('app', 'cca do') ?> <?= $model->delivery_starts ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                </div>                 
            </div>

    <?php
    }
}
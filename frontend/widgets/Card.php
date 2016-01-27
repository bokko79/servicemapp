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
 * Card widget renders a list of related articles
 * @var $items [] list of items in ListView
 * @var $limit int number of items rendered
 * @var $internalOptions [] list of DB restrictions
 */
class Card extends \yii\bootstrap\Widget
{
    // box views
	const VIEW_PROFILE = 'profile';
	const VIEW_COMPACT = 'compact';
    const VIEW_INDEX = 'index';

    public $view = self::VIEW_PROFILE;

    // card types
    const CARD_RECORD = 'record';
    const CARD_TEASER = 'teaser';
    const CARD_ALERT = 'alert';

    public $card = self::CARD_RECORD;

    // box type
    /*const TYPE_ACTIVITY = 'activity';
    const TYPE_PROVIDER = 'provider';
    const TYPE_BID = 'bidding';
    const TYPE_COMMENT = 'commentary';
    const TYPE_SERVICE = 'service';
    const TYPE_OBJECT = 'object';
    const TYPE_INDUSTRY = 'industry';
    const TYPE_USEROBJECT = 'userObject';
    const TYPE_USERLOCATION = 'userLocation';
    const TYPE_USERPAYMENT = 'userPayment';
    const TYPE_NOTIFICATION = 'notification';
    const TYPE_TRANSACTION = 'transaction';
    const TYPE_CARTITEM = 'cartItem';
    const TYPE_MESSAGE = 'message';
    const TYPE_ORDER = 'order';
    const TYPE_PROMOTION = 'promotion';
    const TYPE_PRESENTATION = 'presentation';
    const TYPE_HISTORY = 'history';
    const TYPE_POST = 'post';
    const TYPE_CUSTOM = 'custom';

    public $type = self::TYPE_ORDER;*/

    // box size
    const SIZE_FULL = 'full';
    const SIZE_XL = 'xl';
    const SIZE_MD = 'md';
    const SIZE_SM = 'sm';
    const SIZE_XS = 'xs';

    public $size = self::SIZE_FULL;

    // box status
	const STATUS_ACTIVE = 'active';
    const STATUS_EDITED = 'edited';
    const STATUS_EXPIRED = 'expired';
    const STATUS_SUCCESS = 'success';
    const STATUS_BANNED = 'banned';
    const STATUS_SUSPENDED = 'suspended';
    const STATUS_DELETED = 'deleted';
    const STATUS_REJECTED = 'rejected';

    public $status = self::STATUS_ACTIVE;

    // box viewer
	const VIEWER_BIDDER = 'bidder';
	const VIEWER_SENDER = 'sender';
    const VIEWER_COMMENTER = 'commenter';
    const VIEWER_MESSENGER = 'messenger';
    const VIEWER_USER = 'user';
	const VIEWER_GUEST = 'guest';

    public $viewer = self::VIEWER_GUEST;

    // box part
    const PART_HEAD = 'header';
    const PART_MEDIA = 'media';
    const PART_MAPS = 'maps';
    const PART_FORMS = 'forms';
    const PART_PRIMARY = 'primary';
    const PART_SECONDARY = 'secondary';
    const PART_ACTION = 'action';
    const PART_BODY = 'body';
    const PART_COMMENT = 'comment';
    const PART_BID = 'bid';

    public $part = null;
    public $head = [];
    public $primary = false;
    public $secondary = false;
    public $media = false;
    public $maps = false;
    public $forms = false;
    public $actions = false;
    public $body = false;
    public $bids = false;
    public $comments = false;

    // event
    const EVENT_CREATE = 'create';
    const EVENT_UPDATE = 'update';
    const EVENT_DELETE = 'delete';
    const EVENT_COMMENT = 'comment';

    public $event = self::EVENT_CREATE;

    // box animation
    const ANIMATION_DOWN = 'fadeInDown animated';
    const ANIMATION_UP = 'fadeInUp animated';
    const ANIMATION_NORMAL = 'fadeIn animated';

    public $animation = true;
    public $animationType = self::ANIMATION_NORMAL;

	public $model;

    public $sections;

    public $link = null;

    public $medias = null;
    public $location = null;
    public $comment = null;
    public $bid = null;    

	public $formatter;

    public $containerOptions = [];


    /**
     * Initializes the detail view.
     * This method will initialize required property values.
     */
    public function init()
    {
        /*if ($this->model === null) {
            throw new InvalidConfigException('Please specify the "model" property.');
        }*/
        if ($this->formatter === null) {
            $this->formatter = Yii::$app->getFormatter();
        } elseif (is_array($this->formatter)) {
            $this->formatter = Yii::createObject($this->formatter);
        }
        if (!$this->formatter instanceof Formatter) {
            throw new InvalidConfigException('The "formatter" property must be either a Format object or a configuration array.');
        }
        if ($this->media) {
            if ($this->medias === null) {
                throw new InvalidConfigException('Please specify the "media" property.');
            }
        }
        if ($this->maps) {
            if ($this->location === null) {
                throw new InvalidConfigException('Please specify the "location" property.');
            }
        }
        if ($this->comment) {
            if ($this->comment === null) {
                throw new InvalidConfigException('Please specify the "comment" property.');
            }
        }
        if ($this->bid) {
            if ($this->bid === null) {
                throw new InvalidConfigException('Please specify the "bid" property.');
            }
        }
    }

    /**
     * Renders the widget
     */
    public function run()
    {
        echo Html::beginTag('div', ['id'=>'card_container', 'class'=>'card_container '.$this->card . '-' . $this->size . ' ' . (($this->containerOptions) ? $this->containerOptions : null) . ' ' . (($this->animation) ? $this->animationType : null)]);            
        if($this->link)
            echo Html::beginTag('a', ['href'=>Url::to($this->link)]);
        foreach ($this->sections as $sectionId=>$sectionOptions) {
            $this->$sectionOptions['part']($sectionId);
        }
        if($this->link)
            echo Html::endTag('a');
        echo Html::endTag('div');
    }

    protected function header($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        $hr = (isset($this->sections[$id]['hr'])) ? $this->sections[$id]['hr'] : false;
        $upperContainer = (isset($this->sections[$id]['upperContainer'])) ? $this->sections[$id]['upperContainer'] : false;
        $lowerContainer = (isset($this->sections[$id]['lowerContainer'])) ? $this->sections[$id]['lowerContainer'] : false;
        echo $this->render('cardParts/header.php', [
                'model' => $this->model,
                'formatter' => $this->formatter,
                'avatar' => (isset($options['avatar'])) ? $options['avatar'] : null,
                'avatarIcon' => (isset($options['avatarIcon'])) ? $options['avatarIcon'] : null,
                'head' => (isset($options['head'])) ? $options['head'] : 'second',
                'headContent' => (isset($options['headContent'])) ? $options['headContent'] : null,
                'subhead' => (isset($options['subhead'])) ? $options['subhead'] : 'subhead',
                'subheadContent' => (isset($options['subheadContent'])) ? $options['subheadContent'] : null,
                'subaction' => (isset($options['subaction'])) ? $options['subaction'] : 'subaction',
                'subactionContent' => (isset($options['subactionContent'])) ? $options['subactionContent'] : null,                
                'class' => (isset($options['class'])) ? $options['class'] : null,
                'version' => $version,
                'hr' => $hr,
                'upperContainer' => $upperContainer,
                'lowerContainer' => $lowerContainer,
            ]);
    }

    /**
     */
    protected function media($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        echo $this->render('cardParts/media.php', [
                'medias' => $this->medias,
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
            ]);        
    }

    /**
     */
    protected function maps($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        echo $this->render('cardParts/maps.php', [
                'location' => $this->location,
                'size' => $this->size,
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
            ]);           
    }

    /**
     */
    protected function forms($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        echo $this->render('cardParts/forms.php', [
                //'medias' => $this->medias,
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
            ]);
    }

    /**
     */
    protected function primary($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        $hr = (isset($this->sections[$id]['hr'])) ? $this->sections[$id]['hr'] : false;
        $upperContainer = (isset($this->sections[$id]['upperContainer'])) ? $this->sections[$id]['upperContainer'] : false;
        $lowerContainer = (isset($this->sections[$id]['lowerContainer'])) ? $this->sections[$id]['lowerContainer'] : false;
        echo $this->render('cardParts/primary.php', [
                //'medias' => $this->medias,
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
                'hr' => $hr,
                'upperContainer' => $upperContainer,
                'lowerContainer' => $lowerContainer,
            ]);        
    }

    /**
     */
    protected function secondary($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        $hr = (isset($this->sections[$id]['hr'])) ? $this->sections[$id]['hr'] : false;
        $upperContainer = (isset($this->sections[$id]['upperContainer'])) ? $this->sections[$id]['upperContainer'] : false;
        $upperContainerContent = (isset($this->sections[$id]['upperContainerContent'])) ? $this->sections[$id]['upperContainerContent'] : false;
        $lowerContainer = (isset($this->sections[$id]['lowerContainer'])) ? $this->sections[$id]['lowerContainer'] : false;
        echo $this->render('cardParts/secondary.php', [
                //'medias' => $this->medias,
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
                'id' => (isset($options['id'])) ? $options['id'] : null,
                'style' => (isset($options['style'])) ? $options['style'] : null,
                'content' => (isset($options['content'])) ? $options['content'] : null,
                'avatarIcon' => (isset($options['avatarIcon'])) ? $options['avatarIcon'] : null,
                'subheadContent' => (isset($options['subheadContent'])) ? $options['subheadContent'] : null,
                'headContent' => (isset($options['headContent'])) ? $options['headContent'] : null,
                'strikethrough' => (isset($options['strikethrough'])) ? $options['strikethrough'] : null,
                'labeledContent' => (isset($options['labeledContent'])) ? $options['labeledContent'] : null,
                'strikethrough' => (isset($options['strikethrough'])) ? $options['strikethrough'] : null,
                'head' => (isset($options['head'])) ? $options['head'] : null,
                'subhead' => (isset($options['subhead'])) ? $options['subhead'] : null,
                'action' => (isset($options['action'])) ? $options['action'] : null,
                'actionContent' => (isset($options['actionContent'])) ? $options['actionContent'] : null,
                'hr' => $hr,
                'upperContainer' => $upperContainer,
                'lowerContainer' => $lowerContainer,
            ]);        
    }

    /**
     */
    protected function action($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        echo $this->render('cardParts/action.php', [
                //'medias' => $this->medias,
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
            ]);        
    }

    /**
     */
    protected function body()
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        echo $this->render('cardParts/body.php', [
                'model' => $this->model,
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
            ]);
    }

    /**
     */
    protected function comment($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        echo $this->render('cardParts/comment.php', [
                'comment' => $this->comment,                    
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
            ]);        
    }

    /**
     */
    protected function bid($id)
    {
        $options = $this->sections[$id]['options'];
        $version = (isset($this->sections[$id]['version'])) ? $this->sections[$id]['version'] : 1;
        echo $this->render('cardParts/bid.php', [
                'model' => $this->bid,
                'formatter' => $this->formatter,
                'viewer' => $this->viewer, 
                'view' => $this->view, 
                'status' => $this->status, 
                'version' => $version, 
                'class' => (isset($options['class'])) ? $options['class'] : null,
            ]);
    }
}
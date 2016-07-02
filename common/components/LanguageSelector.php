<?php

namespace common\components;

use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{
    public $supportedLanguages = [];

    public function bootstrap($app)
    {
        $preferredLanguage = $app->request->getPreferredLanguage($this->supportedLanguages);
        $app->language = $preferredLanguage;
    }
}
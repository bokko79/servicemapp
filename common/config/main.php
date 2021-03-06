<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            //'defaultRoles' => ['admin','editor','user'], // here define your roles
        ],
    ],
    'modules' => [
	    'user' => [
	        'class' => 'dektrium\user\Module',
	        // you will configure your module inside this file
	        // or if need different configuration for frontend and backend you may
	        // configure in needed configs
	        'enableUnconfirmedLogin' => true,
	        'confirmWithin' => 21600,
	        'cost' => 12,
	    ],
	],
    'language' => 'sr-Latn',
    //sourceLanguage' => 'sr',
];

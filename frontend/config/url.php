<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'baseUrl' => 'http://servicemapp/',
    'scriptUrl' => 'http://servicemapp/',
    'rules' => [
        '<module:user>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
        '<module:user>/<action:\w+>' => '<module>/<controller>/<action>',
        'intro' => 'intro/main',
        'index' => 'site/index',
        'about-us' => 'site/about', // :page
        'contact-us' => 'site/contact', // :page
        'invite-friends' => 'site/invite', // :page
        'membership' => 'site/membership', // :page
        'search' => 'site/search', // :page
        'blank' => 'site/blank', // :page
        //'register' => 'site/signup',
        'registerProvider' => 'site/signprovider',

        // 2. POSTS             
        'info' => 'posts/index', // :page
        'post/<id:\d+>' => 'posts/view', // :page  
        'how-it-works' => 'posts/how-it-works', // :page
        'faq' => 'posts/faq', // :page
        'blog' => 'posts/blog', // :page

        // 3. USER
        //'users' => 'user/index',
        '<username:\w+>/home' => 'users/view',
        '<username:\w+>/setup' => 'users/update',
        '<username:\w+>/account-setup' => 'users/account',
        '<username:\w+>/orders' => 'users/orders',
        '<username:\w+>/ready-orders' => 'users/saved-orders',
        '<username:\w+>/arrangements' => 'users/arrangements',
        '<username:\w+>/profile' => 'users/profile',
        '<username:\w+>/finances' => 'users/finances',        

        // 4 PROVIDER
        'providers' => 'provider/index', // :page
        'p/<username:\w+>' =>'provider/view', // :page
        'recommend/<id:\d+>' =>'provider/recommend',
        'review/<id:\d+>' =>'provider/review',
        'rate/<id:\d+>' =>'provider/rate',
        '<username:\w+>/portfolio-setup' => 'provider/update',
        '<username:\w+>/bids' => 'provider/bids',
        '<username:\w+>/presentations' => 'provider/presentations',
        '<username:\w+>/promotions' => 'provider/promotions',

        // 5 PRESENTATIONS
        'new-presentation' => 'presentations/create', // :page
        '<username:\w+>/my-services' => 'presentations/index', // :page
        'presentation-setup/<id:\d+>' => 'presentations/update', // :page
        'presentation/<id:\d+>' => 'presentations/view', // :page
        'comment-presentation/<id:\d+>' =>'presentations/comment',

        // 6 USERLOCATIONS
        'new-location' => 'user-locations/create', // S-16:page
        '<username:\w+>/locations' => 'user-locations/index', // S-16:page
        'location-setup/<id:\d+>' => 'user-locations/update', // S-16:page

        // 7 USEROBJECTS
        'new-object' => 'user-objects/create', // S-16:page
        '<username:\w+>/objects' => 'user-objects/index', // S-16:page
        'object-setup/<id:\d+>' => 'user-objects/update', // S-16:page

        // 8 USER NOTIFICATIONS
        '<username:\w+>/notifications-setup' => 'user-notifications/update', // S-16:page
        '<username:\w+>/notifications' => 'notifications/index', // S-16:page

        // 9 USER PAYMENTS
        'new-payment' => 'user-payments/create', // S-16:page
        'payment-setup/<id:\d+>' => 'user-payments/update', // S-16:page
        '<username:\w+>/payments' => 'user-payments/index', // S-16:page

        // 10 PROVIDER INDUSTRIES
        'new-industry' => 'provider-industries/create', // :page
        '<username:\w+>/industries' => 'provider-industries/index', // :page
        'industry-setup/<id:\d+>' => 'provider-industries/update', // :page

        // 11 PROVIDER TERMS
        '<username:\w+>/terms' => 'provider-terms/update', // :page

        // 12 PROVIDER SERVICES
        'new-service' => 'provider-services/create', // :page
        '<username:\w+>/services' => 'provider-services/index', // :page
        'my-service-setup/<id:\d+>' => 'provider-services/update', // :page
        'provider-industries' => 'provider-services/industries', // :page
        'provider-industry-skills' => 'provider-services/skills', // :page
        'provider-industry-services' => 'provider-services/services', // :page

        // 13 PROVIDER SKILLS
        'new-skill' => 'provider-industry-skills/create', // :page
        '<username:\w+>/skills' => 'provider-industry-skills/index', // :page

        // 14 TRANSACTIONS
        'new-transaction' => 'transactions/create', // S-16:page
        '<username:\w+>/transactions' => 'transactions/index', // S-16:page
        'transaction/<id:\d+>' => 'transactions/view', // S-16:page

        // 15 USERSERVICES
        '<username:\w+>/follow-services' => 'user-services/index', // S-16:page

        // 16 MESSAGE THREADS
        'new-message' => 'message-threads/create', // S-16:page
        '<username:\w+>/inbox' => 'message-threads/index', // S-16:page
        'message-thread/<id:\d+>' => 'message-threads/view', // S-16:page

        // 17 SERVICES
        'add-services' => 'services/add', // :page
        'services' => 'services/index', // :page
        's/<title>' => 'services/view', // :page

        // 18 OBJECTS
        'add-objects' => 'objects/add', // :page

        // 19 ACTIVITIES AND FEEDBACK
        'market' => 'activities/index', // E-31:page
        '' => 'activities/index', // E-31:page
        'new-feedback' => 'feedback/create', // :page
        'feedback/<id:\d+>' => 'feedback/view', // :page

        // 20 ORDERS
        'choose-service' => 'orders/choose', // :page
        'add/<title>' => 'orders/add', // :page
        'new-order' => 'orders/create', // :page
        'order/<id:\d+>' => 'orders/view', // :page
        'order-setup/<id:\d+>' => 'orders/update', // :page
        '<username:\w+>/saved-orders' => 'orders/saved', // :page

        // 21 BIDS
        'new-bid' => 'bids/create', // S-16:page
        'bid/<id:\d+>' => 'bids/view', // S-16:page
        'bid-setup/<id:\d+>' => 'bids/update', // S-16:page

        // 22 PROMOTIONS
        'new-promotion' => 'promotions/create', // S-16:page
        'promotion/<id:\d+>' => 'promotions/view', // S-16:page
        'promotion-setup/<id:\d+>' => 'promotions/update', // S-16:page

        // 23 AGREEMENTS
        'new-agreement' => 'agreements/create', // S-16:page
        'agreement/<id:\d+>' => 'agreements/view', // S-16:page
        'agreement-setup/<id:\d+>' => 'agreements/update', // S-16:page

        // 24 GLOBAL-NAV
        'glob-ind-ser' => 'global-nav/glob-ind-ser',
        'glob-nav-events-body' => 'global-nav/glob-nav-events-body',
        'glob-nav-events-head' => 'global-nav/glob-nav-events-head',
        'glob-nav-market-body' => 'global-nav/glob-nav-market-body',
        'glob-nav-market-head' => 'global-nav/glob-nav-market-head',
        'glob-nav-providers-body' => 'global-nav/glob-nav-providers-body',
        'glob-nav-providers-head' => 'global-nav/glob-nav-providers-head',
        'glob-nav-services-body' => 'global-nav/glob-nav-services-body',
        'glob-nav-services-head' => 'global-nav/glob-nav-services-head',
        'ind/<id:\d+>' => 'global-nav/ind',
        'getid' => 'global-nav/getid',
        //'list-act-services' => 'global-nav/list-act-services',
        //'list-ind-actions' => 'global-nav/list-ind-actions',
        'glob-nav-act-services' => 'global-nav/act-services',
        'glob-nav-ser-objects' => 'global-nav/service-objects',

        // 25 AUTOCOMPLETE
        'auto/list-act-services' => 'autocomplete/list-act-services',
        'auto/list-ind-actions' => 'autocomplete/list-ind-actions',
        'auto/list-services' => 'autocomplete/list-services',
        'auto/list-industries' => 'autocomplete/list-industries',
        'auto/list-actions' => 'autocomplete/list-actions',
        'auto/list-objects' => 'autocomplete/list-objects',
        'auto/list-providers' => 'autocomplete/list-providers',
        'auto/list-tags' => 'autocomplete/list-tags',
        'auto/list-services-tags' => 'autocomplete/list-services-tags',
        'auto/list-industries-tags' => 'autocomplete/list-industries-tags',
        'auto/list-actions-tags' => 'autocomplete/list-actions-tags',
        'auto/list-objects-tags' => 'autocomplete/list-objects-tags',
        'auto/index' => 'autocomplete/index',
    ],
];
<?php include_once('../../configs/icbac_db.php') ?>
<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'iCanBeACoder',

	// preloading 'log' component
	'preload'=>array('log','input'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'dJEFqtxMT',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

         'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'md5',

            # send activation email
            'sendActivationMail' => false,  // Need to changed

            # allow access for non-activated users
            'loginNotActiv' => false,

            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => true, // Need to be changed

            # automatically login from registration
            'autoLogin' => true,

            # registration path
            'registrationUrl' => array('/user/registration'),

            # recovery password path
            'recoveryUrl' => array('/user/recovery'),

            # login form path
            'loginUrl' => array('/user/login'),

            # page after login
            'returnUrl' => array('/user/profile'),

            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
	),
	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'autoRenewCookie' => true,
            'authTimeout' => 31557600,
		),
		// uncomment the following to enable URLs in path-format
		'input'=>array(
            'class'         => 'CmsInput',
            'cleanPost'     => true,
            'cleanGet'      => true,
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName' => false,
                        'caseSensitive'=>false,
                        //'urlSuffix'=>'.html',
			'rules'=>array(
				'' => 'thoughtcast',
				'login'=>'/user/login',
                'codes' => 'thoughtcast',
                'codes/<action:(index|snippets)>' => 'thoughtcast/<action>',
                'thoughtcast'=>'codes',
                'user' => 'user/user/index',
                'user/signup' => 'user/registration',
                'users/<id:([A-Za-z0-9-]+)>'=>'user/user/view',
                '<action:(explore|index|page|contact|login|logout)>'=>'site/<action>',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

			),
		),
		'assetManager' => array(
				'linkAssets' => true,
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/

		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=' . DATABASE_NAME,
			'emulatePrepare' => true,
			'username' => USERNAME,
			'password' => DB_PASSWORD,
			'charset' => 'utf8',
            'tablePrefix' => 'icbac_',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);

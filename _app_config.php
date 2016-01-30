<?php
/**
 * @package Imoveis
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		'phar://' . GlobalConfig::$APP_ROOT . '/libs/phreeze-3.3.9.carpanese.phar' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "Model/User.php";

/**
 * RENDER ENGINE
 * Haters be hatin' on Smarty? You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SmartyRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SmartyRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';
GlobalConfig::$TEMPLATE_CACHE_PATH = GlobalConfig::$APP_ROOT . '/templates_c/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),

	// example authentication routes
	'GET:loginform' => array('route' => 'Secure.LoginForm'),
	'POST:login' => array('route' => 'Secure.Login'),
	'GET:secureuser' => array('route' => 'Secure.UserPage'),
	'GET:secureadmin' => array('route' => 'Secure.AdminPage'),
	'GET:logout' => array('route' => 'Secure.Logout'),
	
	// Funcoes Autenticacao
	'GET:roles' => array('route' => 'Role.ListView'),
	'GET:role/(:num)' => array('route' => 'Role.SingleView', 'params' => array('id' => 1)),
	'GET:api/roles' => array('route' => 'Role.Query'),
	'POST:api/role' => array('route' => 'Role.Create'),
	'GET:api/role/(:num)' => array('route' => 'Role.Read', 'params' => array('id' => 2)),
	'PUT:api/role/(:num)' => array('route' => 'Role.Update', 'params' => array('id' => 2)),
	'DELETE:api/role/(:num)' => array('route' => 'Role.Delete', 'params' => array('id' => 2)),
		
	// Usuarios Autenticacao
	'GET:users' => array('route' => 'User.ListView'),
	'GET:user/(:num)' => array('route' => 'User.SingleView', 'params' => array('id' => 1)),
	'GET:api/users' => array('route' => 'User.Query'),
	'POST:api/user' => array('route' => 'User.Create'),
	'GET:api/user/(:num)' => array('route' => 'User.Read', 'params' => array('id' => 2)),
	'PUT:api/user/(:num)' => array('route' => 'User.Update', 'params' => array('id' => 2)),
	'DELETE:api/user/(:num)' => array('route' => 'User.Delete', 'params' => array('id' => 2)),
	
		
	// Imovel
	'GET:imoveis' => array('route' => 'Imovel.ListView'),
	'GET:imovel/(:num)' => array('route' => 'Imovel.SingleView', 'params' => array('id' => 1)),
	'GET:api/imoveis' => array('route' => 'Imovel.Query'),
	'POST:api/imovel' => array('route' => 'Imovel.Create'),
	'GET:api/imovel/(:num)' => array('route' => 'Imovel.Read', 'params' => array('id' => 2)),
	'PUT:api/imovel/(:num)' => array('route' => 'Imovel.Update', 'params' => array('id' => 2)),
	'DELETE:api/imovel/(:num)' => array('route' => 'Imovel.Delete', 'params' => array('id' => 2)),
		
	// TipoImovel
	'GET:tipoimoveis' => array('route' => 'TipoImovel.ListView'),
	'GET:tipoimovel/(:num)' => array('route' => 'TipoImovel.SingleView', 'params' => array('id' => 1)),
	'GET:api/tipoimoveis' => array('route' => 'TipoImovel.Query'),
	'POST:api/tipoimovel' => array('route' => 'TipoImovel.Create'),
	'GET:api/tipoimovel/(:num)' => array('route' => 'TipoImovel.Read', 'params' => array('id' => 2)),
	'PUT:api/tipoimovel/(:num)' => array('route' => 'TipoImovel.Update', 'params' => array('id' => 2)),
	'DELETE:api/tipoimovel/(:num)' => array('route' => 'TipoImovel.Delete', 'params' => array('id' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("Imovel","fk_imovel_tipo_imovel1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("User","fk_user_role",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>
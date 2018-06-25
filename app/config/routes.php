<?php
/**
 * Private Shop
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    privateshop
 * @subpackage Core
 * @author     Agriya <info@agriya.com>
 * @copyright  2018 Agriya Infoway Private Ltd
 * @license    http://www.agriya.com/ Agriya Infoway Licence
 * @link       http://www.agriya.com
 */
Router::parseExtensions('rss', 'csv', 'json', 'txt', 'xml');
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
//	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
//  pages/install as home page...
//echo 'ss';
$is_enable_landing_page = Cache::read('site.enable_landing_page', 'long');

// disabled the landing page

if($is_enable_landing_page){
	Router::connect('/', array(
		'controller' => 'landing_page_photos',
		'action' => 'index',
	));
} else{
	Router::connect('/', array(
		'controller' => 'products',
		'action' => 'index',
	));
}

Router::connect('/contactus', array(
	'controller' => 'contacts',
	'action' => 'add'
));
Router::connect('/admin', array(
	'controller' => 'users',
	'action' => 'stats',
	'prefix' => 'admin',
	'admin' => 1
));
Router::connect('/img/:size/*', array(
	'controller' => 'images',
	'action' => 'view'
) , array(
	'size' => '(?:[a-zA-Z_]*)*'
));
Router::connect('/pages/*', array(
	'controller' => 'pages',
	'action' => 'display'
));
Router::connect('/admin/pages/tools', array(
	'controller' => 'pages',
	'action' => 'display',
	'tools',
	'prefix' => 'admin',
	'admin' => true
));
Router::connect('/files/*', array(
	'controller' => 'images',
	'action' => 'view',
	'size' => 'original'
));
Router::connect('/img/*', array(
	'controller' => 'images',
	'action' => 'view',
	'size' => 'original'
));
Router::connect('/sitemap', array(
	'controller' => 'devs',
	'action' => 'sitemap'
));
Router::connect('/myproducts', array(
	'controller' => 'products',
	'action' => 'index',
	'type' => 'myproduct'
));
Router::connect('/manageorders', array(
	'controller' => 'orders',
	'action' => 'index',
	'type' => 'manageorders'
));
Router::connect('/mypurchases', array(
	'controller' => 'orders',
	'action' => 'index',
	'type' => 'mypurchases',
	'status_filter_id' => ConstOrderStatus::InProcess
));
Router::connect('/robots', array(
	'controller' => 'devs',
	'action' => 'robots'
));
Router::connect('/users/twitter/login', array(
	'controller' => 'users',
	'action' => 'login',
	'type' => 'twitter'
));
Router::connect('/users/facebook/login', array(
	'controller' => 'users',
	'action' => 'login',
	'type' => 'facebook'
));
Router::connect('/users/yahoo/login', array(
	'controller' => 'users',
	'action' => 'login',
	'type' => 'yahoo'
));
Router::connect('/users/gmail/login', array(
	'controller' => 'users',
	'action' => 'login',
	'type' => 'gmail'
));
Router::connect('/users/openid/login', array(
	'controller' => 'users',
	'action' => 'login',
	'type' => 'openid'
));
Router::connect('/cron/main/*', array(
	'controller' => 'crons',
	'action' => 'main'
));
Router::connect('/css/*', array(
	'controller' => 'devs',
	'action' => 'asset_css'
));
Router::connect('/js/*', array(
	'controller' => 'devs',
	'action' => 'asset_js'
));

Router::connect('/yadis', array(
    'controller' => 'devs',
    'action' => 'yadis'
));

?>
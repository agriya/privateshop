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
/* SVN: $Id: config.php 2735 2010-08-13 15:08:45Z siva_063at09 $ */
/**
 * Custom configurations
 */
if (!defined('DEBUG')) {
    define('DEBUG', 2);
    // permanent cache re1ated settings
    define('PERMANENT_CACHE_CHECK', (!empty($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR'] != '127.0.0.1') ? true : false);
    // site default language
    define('PERMANENT_CACHE_DEFAULT_LANGUAGE', 'en');
    // cookie variable name for site language
    define('PERMANENT_CACHE_COOKIE', 'user_language');
    // sub admin is available in site or not
    define('PERMANENT_CACHE_HAVE_SUB_ADMIN', false);
    define('IS_ENABLE_HASHBANG_URL', false);
    define('IS_ENABLE_HTML5_HISTORY_API', false);
    $_is_hashbang_supported_bot = (strpos($_SERVER['HTTP_USER_AGENT'], 'Googlebot') !== false);
    define('IS_HASHBANG_SUPPORTED_BOT', $_is_hashbang_supported_bot);
}
if (!defined('PERMANENT_CACHE_GZIP_SALT')) {
    define('PERMANENT_CACHE_GZIP_SALT', "e9a556134534545ab47c6c81c14f06c0b8sdfsdf");
}
$config['site']['is_admin_settings_enabled'] = true;
$config['site']['_hashSecuredActions'] = array(
    'edit',
    'delete',
    'update',
    'update_status',
    'download',
);
$config['avatar']['file'] = array(
    'allowedMime' => array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    ) ,
    'allowedExt' => array(
        'jpg',
        'jpeg',
        'gif',
        'png'
    ) ,
    'allowedSize' => '5',
    'allowedSizeUnits' => 'MB',
    'allowEmpty' => true
);
$config['product']['file'] = array(
    'allowedMime' => array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    ) ,
    'allowedExt' => array(
        'jpg',
        'jpeg',
        'gif',
        'png'
    ) ,
    'allowedSize' => '5',
    'allowedSizeUnits' => 'MB',
    'allowEmpty' => false
);
$config['productattribute']['file'] = array(
    'allowedMime' => array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    ) ,
    'allowedExt' => array(
        'jpg',
        'jpeg',
        'gif',
        'png'
    ) ,
    'allowedSize' => '5',
    'allowedSizeUnits' => 'MB',
    'allowEmpty' => true
);
$config['force_login']['file'] = array(
    'allowedMime' => array(
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    ) ,
    'allowedExt' => array(
        'jpg',
        'jpeg',
        'gif',
        'png'
    ) ,
    'allowedSize' => '5',
    'allowedSizeUnits' => 'MB',
    'allowEmpty' => false
);
// CDN...
$config['cdn']['images'] = null; // 'http://images.localhost/';
$config['cdn']['css'] = null; // 'http://static.localhost/';

$config['product']['max_upload_photo'] = 5; // maximum upload photo count
$config['category']['max_upload_photo'] = 5; // maximum upload photo count
$config['landing_page']['max_upload_photo'] = 5; // maximum upload photo count

// configure modules
$config['module']['seller'] = 0;
$config['module']['buy_as_gift'] = 1;
$config['module']['credits'] = 0;


/*
date_default_timezone_set('Asia/Calcutta');

Configure::write('Config.language', 'spa');
setlocale (LC_TIME, 'es');
*/
 $config['Product']['micro_thumb']['is_handle_aspect'] = 0;
 $config['Product']['micro_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['small_thumb']['is_handle_aspect'] = 0;
 $config['Product']['small_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['medium_thumb']['is_handle_aspect'] = 0;
 $config['Product']['medium_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['normal_thumb']['is_handle_aspect'] = 0;
 $config['Product']['normal_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['big_thumb']['is_handle_aspect'] = 0;
 $config['Product']['big_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['small_big_thumb']['is_handle_aspect'] = 0;
 $config['Product']['small_big_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['medium_big_thumb']['is_handle_aspect'] = 0;
 $config['Product']['medium_big_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['very_big_thumb']['is_handle_aspect'] = 0;
 $config['Product']['very_big_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['normal_big_thumb']['is_handle_aspect'] = 0;
 $config['Product']['normal_big_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['large_big_thumb']['is_handle_aspect'] = 0;
 $config['Product']['large_big_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['large_thumb']['is_handle_aspect'] = 0;
 $config['Product']['large_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['Product']['normal_medium_thumb']['is_handle_aspect'] = 0;
 $config['Product']['normal_medium_thumb']['is_not_allow_resize_beyond_original_size'] = 1;
 $config['site']['exception_array'] = array(
            'pages/view',
            'pages/display',
            'users/register',
            'users/login',
            'users/video',
            'users/logout',
            'users/reset',
            'users/forgot_password',
            'users/openid',
            'users/activation',
            'users/resend_activation',
            'users/view',
            'users/show_captcha',
            'users/captcha_play',
            'users/oauth_callback',
            'images/view',
            'devs/robots',
            'contacts/add',
            'users/admin_login',
            'users/admin_logout',
            'languages/change_language',
            'contacts/show_captcha',
            'contacts/captcha_play',
            'cities/autocomplete',
            'states/autocomplete',
            'cities/index',
            'devs/sitemap',
            'crons/main',
            'users/refer',
            'products/index',
            'products/view',
			'products/download',
            'carts/add',
            'carts/delete',
            'users/oauth_facebook',
            'mass_pay_paypals/process_masspay_ipn',
            'payments/order',
            'paypals/process_payment',
			'devs/asset_css',
            'devs/asset_js',
			'categories/index',
			'categories/view',
			'landing_page_photos/index',
			'devs/yadis'
        );
$config['site']['forcelogin_exception_array'] = array(
            'pages/view',
            'pages/display',
            'users/register',
            'users/login',
            'users/video',
            'users/logout',
            'users/reset',
            'users/forgot_password',
            'users/openid',
            'users/activation',
            'users/resend_activation',
            'users/view',
            'users/show_captcha',
            'users/captcha_play',
            'users/oauth_callback',
            'images/view',
            'devs/robots',
            'contacts/add',
            'users/admin_login',
            'users/admin_logout',
            'languages/change_language',
            'contacts/show_captcha',
            'contacts/captcha_play',
            'cities/autocomplete',
            'states/autocomplete',
            'cities/index',
            'devs/sitemap',
            'crons/main',
            'users/refer',            
            'users/oauth_facebook',
            'mass_pay_paypals/process_masspay_ipn',            
            'paypals/process_payment',
			'devs/asset_css',
            'devs/asset_js',
            'landing_page_photos/index',
			//'products/view',
			//'categories/index',
			//'products/download',
			//'products/index',
        );
?>

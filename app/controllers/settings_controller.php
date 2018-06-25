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
class SettingsController extends AppController
{
    public $components = array(
        'Cookie'
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'SiteLogo.filename',
            'Setting'
        );
        parent::beforeFilter();
    }
    public function admin_index()
    {
        $this->pageTitle = __l('Settings');
        $setting_categories = $this->Setting->SettingCategory->find('all', array(
            'conditions' => array(
                'SettingCategory.parent_id' => 0,
                "NOT" => array(
                    "SettingCategory.id" => array(
                        7, 28,14
                    )
                )
            ) , // Images category will not showed
            'recursive' => -1
        ));
        $this->set('setting_categories', $setting_categories);
        $this->set('pageTitle', $this->pageTitle);
    }
    public function admin_edit($category_id = 1)
    {
        $save_check_flag = 0;
        $ssl_enable = true;
        $this->disableCache();
        if (!empty($this->request->data)) {
            if (Configure::read('site.is_admin_settings_enabled')) {
                // Save settings
                $category_id = $this->request->data['Setting']['setting_category_id'];
                unset($this->request->data['Setting']['setting_category_id']);
                $validate['error'] = '';
                if (empty($validate['error'])) {
                    foreach($this->request->data['Setting'] as $id => $value) {
                        $settings['Setting']['id'] = $id;
                        if ($id == '230') { // Writing default city name in cache.
                            if (($default_city = Cache::read('site.default_city', 'long')) === false) {
                                Cache::write('site.default_city', $value['name'], 'long');
                            } else {
                                Cache::delete('site.default_city', 'long');
                                Cache::write('site.default_city', $value['name'], 'long');
                            }
                        }
                        if ($id == '232') { // Writing city routing url in cache
                            if (($city_url = Configure::read('site.is_enable_geo_location', 'long')) === false) {
                                Cache::write('site.is_enable_geo_location', $value['name'], 'long');
                            } else {
                                Cache::delete('site.is_enable_geo_location', 'long');
                                Cache::write('site.is_enable_geo_location', $value['name'], 'long');
                            }
                        }
                        if ($id == '370') { // Writing landing in cache.
							Cache::delete('site.enable_landing_page', 'long');
							Cache::write('site.enable_landing_page', $value['name'], 'long');                        						 
						}
                        if (count($value['name']) == 1) {
                            $settings['Setting']['value'] = $value['name'];
                            $this->Setting->save($settings['Setting']);
                            $save_check_flag = 1;
                        }
                    }
                    if (!empty($save_check_flag)) {
                        $this->Session->setFlash(__l('Settings updated successfully.') , 'default', null, 'success');
                    }
                } else {
                    $this->Session->setFlash($validate['error'], 'default', null, 'error');
                }
            } else {
                $this->Session->setFlash(__l('Sorry. You Cannot Update the Settings in Demo Mode') , 'default', null, 'error');
            }
            Cache::delete('setting_key_value_pairs');
        }
        $this->request->data['Setting']['setting_category_id'] = $category_id;
        $conditions = array();
        if ($category_id == 10) { //  module manager that
            $conditions['Setting.name'] = array(
                'attribute.is_enabled_attribute',
				'user.is_user_can_withdraw_amount',
			);
        } else {
            $conditions['Setting.setting_category_parent_id'] = $category_id;
        }
        $settings = $this->Setting->find('all', array(
            'conditions' => $conditions,
            'order' => array(
                'Setting.setting_category_id' => 'asc',
                'Setting.order' => 'asc'
            ) ,
            'recursive' => 0
        ));
        $is_module = false;
        $active_module = true;
        if (in_array($category_id, array(
           
        ))) {
            $is_module = true;
            foreach($settings as $setting) {
                if (in_array($setting['Setting']['id'], array(
           
                ))) {
                    $active_module = ($setting['Setting']['value']) ? true : false;
                }
            }
        }
        $this->set('active_module', $active_module);
        $this->set('is_module', $is_module);
        if ($category_id == 1) {
            $url = "https://" . $_SERVER['SERVER_NAME'];
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            if (curl_exec($ch) === false) {
                $ssl_enable = false;
            }
            // Close handle
            curl_close($ch);
        }
        $this->request->data['Setting']['setting_category_id'] = $category_id;
        $main_setting_categories = $this->Setting->SettingCategory->find('first', array(
            'conditions' => array(
                'SettingCategory.id = ' => $category_id
            ) ,
            'recursive' => 1
        ));
        $setting_categories = $this->Setting->SettingCategory->find('all', array(
            'conditions' => array(
                'SettingCategory.parent_id = ' => $category_id
            ) ,
            'recursive' => -1
        ));
        $this->set('setting_categories', $main_setting_categories);
        $this->set('setting_category_name', $main_setting_categories);
        $this->pageTitle = $main_setting_categories['SettingCategory']['name'] . __l(' Settings');
        $is_submodule = false;
        $active_submodule = true;
        foreach($setting_categories as $setting_category) {
            $this->set('is_submodule', $is_submodule);
            $this->set('active_submodule', $active_submodule);
           
            if (!empty($setting_category) && $setting_category['SettingCategory']['id'] == ConstSettingsSubCategory::Regional) {
                $languageOptions = array();
                $cityOptions = array();
                if (!empty($languages)) {
                    foreach($languages as $language) {
                        $languageOptions[$language['Language']['iso2']] = $language['Language']['name'];
                    }
                }
                if (!empty($cities)) {
                    foreach($cities as $city) {
                        $cityOptions[$city['City']['slug']] = $city['City']['name'];
                    }
                }
                $this->set(compact('languageOptions', 'cityOptions'));
            }
        }
        $beyondOriginals = array();
        $aspects = array();
        foreach($settings as $setting) {
            $field_name = explode('.', $setting['Setting']['name']);
            if (isset($field_name[2])) {
                if ($field_name[2] == 'is_not_allow_resize_beyond_original_size') {
                    $beyondOriginals[$setting['Setting']['id']] = Inflector::humanize(Inflector::underscore($field_name[1]));
                    $this->request->data['Setting']['not_allow_beyond_original'][] = ($setting['Setting']['value']) ? $setting['Setting']['id'] : '';
                } else if ($field_name[2] == 'is_handle_aspect') {
                    $aspects[$setting['Setting']['id']] = Inflector::humanize(Inflector::underscore($field_name[1]));
                    $this->request->data['Setting']['allow_handle_aspect'][] = ($setting['Setting']['value']) ? $setting['Setting']['id'] : '';
                }
            }
        }
        $this->set('ssl_enable', $ssl_enable);
        $this->set(compact('settings', 'beyondOriginals', 'aspects'));
        $this->set('pageTitle', $this->pageTitle);
    }
    public function admin_update_facebook()
    {
        $this->pageTitle = __l('Update Facebook');
        $fb_return_url = Router::url(array(
            'controller' => 'settings',
            'action' => 'fb_update',
            'admin' => false
        ) , true);
        $this->Session->write('fb_return_url', $fb_return_url);
        App::import('Vendor', 'facebook/facebook');
        $this->facebook = new Facebook(array(
            'appId' => Configure::read('facebook.app_id') ,
            'secret' => Configure::read('facebook.fb_secrect_key') ,
            'cookie' => true
        ));
        $fb_login_url = $this->facebook->getLoginUrl(array(
            'redirect_uri' => Router::url(array(
                'controller' => 'users',
                'action' => 'oauth_facebook',
                'admin' => false
            ) , true) ,
            'scope' => 'email,offline_access,publish_stream'
        ));
        $this->redirect($fb_login_url);
        $this->autoRender = false;
    }
    public function admin_update_twitter()
    {
        $this->pageTitle = __l('Update Twitter');
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'OauthConsumer');
        $this->OauthConsumer = new OauthConsumerComponent($collection);
        $twitter_return_url = Router::url(array(
            'controller' => 'users',
            'action' => 'oauth_callback',
            'admin' => false
        ) , true);
        $requestToken = $this->OauthConsumer->getRequestToken('Twitter', 'https://api.twitter.com/oauth/request_token', $twitter_return_url);
        $this->Session->write('requestToken', serialize($requestToken));
        $this->redirect('http://twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
        $this->autoRender = false;
    }
    public function _traverse_directory($dir, $dir_count)
    {
        $handle = opendir($dir);
        while (false !== ($readdir = readdir($handle))) {
            if ($readdir != '.' && $readdir != '..') {
                $path = $dir . '/' . $readdir;
                if (is_dir($path)) {
                    @chmod($path, 0777);
                    ++$dir_count;
                    $this->_traverse_directory($path, $dir_count);
                }
                if (is_file($path)) {
                    @chmod($path, 0777);
                    @unlink($path);
                    //so that page wouldn't hang
                    flush();
                }
            }
        }
        closedir($handle);
        @rmdir($dir);
        return true;
    }
    public function fb_update()
    {             
        if ($fb_session = $this->Session->read('fbuser')) {
            $settings = $this->Setting->find('all', array(
                'conditions' => array(
                    'Setting.name' => array(
                        'facebook.fb_access_token',
                        'facebook.fb_user_id'
                    )
                ) ,
                'fields' => array(
                    'Setting.id',
                    'Setting.name'
                ) ,
                'recursive' => -1
            ));
            foreach($settings as $setting) {
                $this->request->data['Setting']['id'] = $setting['Setting']['id'];
                if ($setting['Setting']['name'] == 'facebook.fb_user_id') {
                    $this->request->data['Setting']['value'] = $fb_session['id'];
                } elseif ($setting['Setting']['name'] == 'facebook.fb_access_token') {
                    $this->request->data['Setting']['value'] = $fb_session['access_token'];
                }
                if ($this->Setting->save($this->request->data)) {
                    $this->Session->setFlash(__l('Facebook credentials updated') , 'default', null, 'success');
                } else {
                    $this->Session->setFlash(__l('Facebook credentials could not be updated. Please, try again.') , 'default', null, 'error');
                }
            }
        }
        $this->redirect(array(
            'action' => 'index',
            'admin' => true
        ));
    }
    public function crush()
    {
        $this->autoRender = false;
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'cron');
        $this->Cron = new CronComponent($collection);
        $this->Cron->crushPng(APP . WEBROOT_DIR, 0);
        if (!empty($_GET['f'])) {
            $this->Session->setFlash(__l('PNG images crushed successfully') , 'default', null, 'success');
            $this->redirect(Router::url('/', true) . $_GET['f']);
        }
    }
}
?>
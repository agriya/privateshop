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
class AppController extends Controller
{
    public $components = array(
        'RequestHandler',
        'Session',
        'Security',
        'Auth',
        'XAjax',
        'DebugKit.Toolbar',
        'Cookie'
    );
    public $helpers = array(
        'Html',
        'Session',
        'Javascript',
        'AutoLoadPageSpecific',
        'Form',
        'Embed',
        'Text',
        'Asset',
        'Auth',
        'Time'
    );
    var $cookieTerm = '+4 weeks';
    //    var $view = 'Theme';
    var $theme = 'themes';
    function beforeRender()
    {
        $this->set('meta_for_layout', Configure::read('meta'));
        $this->set('js_vars_for_layout', (isset($this->js_vars)) ? $this->js_vars : '');
        parent::beforeRender();
    }
    function __construct($request = null)
    {
        parent::__construct($request);
		
        //Setting cache related code
        $setting_key_value_pairs = Cache::read('setting_key_value_pairs');
        if (empty($setting_key_value_pairs)) {
            // site settings are set in config
            App::import('Model', 'Setting');
            $setting_model_obj = new Setting();
            $setting_key_value_pairs = $setting_model_obj->getKeyValuePairs();
            Cache::write('setting_key_value_pairs', $setting_key_value_pairs);
        }
        Configure::write($setting_key_value_pairs);
		//landing page cache checking		
		if (!file_exists(APP.'tmp'.DS.'cache'.DS.'cake_site_enable_landing_page')) {
			Cache::write('site.enable_landing_page', Configure::read('site.enable_landing_page'), 'long'); 
		}
        $lang_code = Configure::read('site.language');
        if (!empty($_COOKIE['CakeCookie']['user_language'])) {
            $lang_code = $_COOKIE['CakeCookie']['user_language'];
        }
        Configure::write('lang_code', $lang_code);
        App::import('Model', 'Translation');
        $translation_model_obj = new Translation();
        Cache::set(array(
            'duration' => '+100 days'
        ));
        $translations = Cache::read($lang_code . '_translations');
        if (empty($translations) and $translations === false) {
            $translations = $translation_model_obj->find('all', array(
                'conditions' => array(
                    'Language.iso2' => $lang_code
                ) ,
                'fields' => array(
                    'Translation.key',
                    'Translation.lang_text'
                ) ,
                'contain' => array(
                    'Language' => array(
                        'fields' => array(
                            'Language.iso2'
                        )
                    )
                ) ,
                'recursive' => 0
            ));
            Cache::set(array(
                'duration' => '+100 days'
            ));
            Cache::write($lang_code . '_translations', $translations);
        }
        if (!empty($translations)) {
            foreach($translations as $translation) {
                $GLOBALS['_langs'][$translation['Language']['iso2']][$translation['Translation']['key']] = $translation['Translation']['lang_text'];
            }
        }
        $this->js_vars = array();
        if ($lang_code != 'en') {
            $js_trans_array = array(
                'Are you sure you want to' => __l('Are you sure you want to') ,
                'Are you sure you want to do this action?' => __l('Are you sure you want to do this action?') ,
                'No Date Set' => __l('No Date Set') ,
                'Select date' => __l('Select date') ,
                'No Time Set' => __l('No Time Set') ,
            );
            foreach($js_trans_array as $k => $v) {
                $this->js_vars['cfg']['lang'][$k] = $v;
            }
        }
    }
    function beforeFilter()
    {
        // check ip is banned or not. redirect it to 403 if ip is banned
        $this->loadModel('BannedIp');
        $bannedIp = $this->BannedIp->checkIsIpBanned($this->RequestHandler->getClientIP());
        if (empty($bannedIp)) {
            $bannedIp = $this->BannedIp->checkRefererBlocked(env('HTTP_REFERER'));
        }
        if (!empty($bannedIp)) {
            if (!empty($bannedIp['BannedIp']['redirect'])) {
                header('location: ' . $bannedIp['BannedIp']['redirect']);
            } else {
                throw new ForbiddenException(__l('Invalid request'));
            }
        }
        if (Configure::read('site.is_ssl_enabled')) {
            $secure_array = array(
                'users/login',
                'users/admin_login',
                'users/register',
                'payments/add_to_wallet',
                'payments/order',
            );
            $cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
            if (in_array($cur_page, $secure_array)) {
                $this->Security->blackHoleCallback = 'forceSSL';
                $this->Security->requireSecure($this->request->params['action']);
            } else if (env('HTTPS') && !$this->RequestHandler->isAjax()) {
                $this->_unforceSSL();
            }
        }
        if ($this->request->params['controller'] != 'images' && $this->request->params['action'] != 'flashupload') {
            if (Configure::read('site.force_login')) {
                $this->loadModel('Attachment');
                $background_attachment = $this->Attachment->find('first', array(
                    'conditions' => array(
						'Attachment.foreign_id' => 1,
                        'Attachment.class' => 'Login',
                        'Attachment.description' => 'force_login_logo',
                    ) ,
                    'recursive' => -1
                ));
                $this->set('background_attachment', $background_attachment);
            }
        }
        // Writing site name in cache, required for getting sitename retrieving in cron
        if (!(Cache::read('site_url_for_shell', 'long'))) {
            Cache::write('site_url_for_shell', Router::url('/', true) , 'long');
        }
        $cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
		$maintenance_exception_array = array(
            'devs/asset_js',
            'devs/asset_css',
            'devs/robots',
            'devs/sitemap',
			'cities/index',
        );
        // check site is under maintenance mode or not. admin can set in settings page and then we will display maintenance message, but admin side will work.
        if (Configure::read('site.maintenance_mode') && $this->Auth->user('user_type_id') != ConstUserTypes::Admin && empty($this->request->params['prefix']) && !in_array($cur_page, $maintenance_exception_array)) {
            throw new MaintenanceModeException(__l('Maintenance Mode'));
        }        
        //Fix to upload the file through the flash multiple uploader
        if ((isset($_SERVER['HTTP_USER_AGENT']) and ((strtolower($_SERVER['HTTP_USER_AGENT']) == 'shockwave flash') or (strpos(strtolower($_SERVER['HTTP_USER_AGENT']) , 'adobe flash player') !== false))) and isset($this->request->params['pass'][0]) and ($this->action == 'flashupload')) {
            $this->Session->id($this->request->params['pass'][0]);
        }
        if ($this->Auth->user('fb_user_id') || (!$this->Auth->user() && Configure::read('facebook.is_enabled_facebook_connect'))) {
            App::import('Vendor', 'facebook/facebook');
            // Prevent the 'Undefined index: facebook_config' notice from being thrown.
            $GLOBALS['facebook_config']['debug'] = NULL;
            // Create a Facebook client API object.
            $this->facebook = new Facebook(array(
                'appId' => Configure::read('facebook.app_id') ,
                'secret' => Configure::read('facebook.fb_secrect_key') ,
                'cookie' => true
            ));
        }
        if (strpos($this->here, '/view/') !== false) {
            trigger_error('*** dev1framework: Do not view page through /view/; use singular/slug', E_USER_ERROR);
        }
        // user avail balance
        if ($this->Auth->user('id')) {
            App::import('Model', 'User');
            $user_model_obj = new User();
            $this->set('user_available_balance', $user_model_obj->checkUserBalance($this->Auth->user('id')));
        }
        // check the method is exist or not in the controller
        $methods = array_flip($this->methods);
        if (!isset($methods[strtolower($this->request->params['action']) ])) {
            throw new NotFoundException('Invalid request');
        }
        $this->_checkAuth();
        $this->js_vars['cfg']['path_relative'] = Router::url('/');
        $this->js_vars['cfg']['path_absolute'] = Router::url('/', true);
        $this->js_vars['cfg']['date_format'] = 'M d, Y';
        $this->js_vars['cfg']['today_date'] = date('Y-m-d');
        $this->js_vars['cfg']['very_big_thumb.width'] = Configure::read('thumb_size.very_big_thumb.width');
        $this->js_vars['cfg']['very_big_thumb.height'] = Configure::read('thumb_size.very_big_thumb.height');		
        $forcelogin_exception_array = Configure::read('site.forcelogin_exception_array'); 		
		if (!$this->Auth->user('id') && Configure::read('site.force_login') && !in_array($cur_page, $forcelogin_exception_array)) {			
			if ($this->Auth->user('user_type_id') != ConstUserTypes::Admin && (isset($this->request->params['prefix']) && $this->request->params['prefix'] != 'admin') || !isset($this->request->params['prefix'])) {
				$this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login',
                    'admin' => false
                ));
            }
        }
		$controller = array('attributes','attribute_groups','attribute_group_types');
		if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin' && !Configure::read('attribute.is_enabled_attribute') && in_array($this->request->params['controller'], $controller)) {
			$this->Session->setFlash(__l('Variant module is currently disabled. You can enable it from setting.') , 'default', null, 'error');
			$this->redirect(array(
				'controller' => 'products',
				'action' => 'index',
				'admin' => true
            ));

		}
		// to check wallet disable/enable
        App::import('Model', 'PaymentGateway');
        $payment_gateway = new PaymentGateway();
        $is_wallet_enabled = $payment_gateway->find('count', array(
                                'conditions' => array(
                                    'PaymentGateway.id =' => ConstPaymentGateways::Wallet ,
                                    'PaymentGateway.is_active =' => 1 ,
                                ) ,
                                'recursive' => -1
                            ));
        $this->set('is_wallet_enabled', $is_wallet_enabled);
        parent::beforeFilter();
    }
    function _checkAuth()
    {
        $this->Auth->fields = array(
            'username' => Configure::read('user.using_to_login') ,
            'password' => 'password'
        );
		$exception_array = Configure::read('site.exception_array');        
        $cur_page = $this->request->params['controller'] . '/' . $this->request->params['action'];
        if (!in_array($cur_page, $exception_array) && $this->request->params['action'] != 'flashupload') {
            if (!$this->Auth->user('id')) {
                // check cookie is present and it will auto login to account when session expires
                $cookie_hash = $this->Cookie->read('User.cookie_hash');
                if (!empty($cookie_hash)) {
                    if (is_integer($this->cookieTerm) || is_numeric($this->cookieTerm)) {
                        $expires = time() +intval($this->cookieTerm);
                    } else {
                        $expires = strtotime($this->cookieTerm, time());
                    }
                    App::import('Model', 'User');
                    $user_model_obj = new User();
                    $this->request->data = $user_model_obj->find('first', array(
                        'conditions' => array(
                            'User.cookie_hash =' => md5($cookie_hash) ,
                            'User.cookie_time_modified <= ' => date('Y-m-d h:i:s', $expires) ,
                        ) ,
                        'fields' => array(
                            'User.' . Configure::read('user.using_to_login') ,
                            'User.password'
                        ) ,
                        'recursive' => -1
                    ));
                    // auto login if cookie is present
                    if ($this->Auth->login($this->request->data)) {
                        $user_model_obj->UserLogin->insertUserLogin($this->Auth->user('id'));
                        $this->redirect(Router::url('/', true) . $this->request->url);
                    }
                }
                $this->Session->setFlash(__l('Authorisation Required'));
                $is_admin = false;
                if (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin') {
                    $is_admin = true;
                }
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login',
                    'admin' => $is_admin,
                    '?f=' . $this->request->url
                ));
            }
            if (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin' and $this->Auth->user('user_type_id') != ConstUserTypes::Admin) {
                $this->redirect('/');
            }
        } else {
            $this->Auth->allow('*');
        }
        $this->Auth->autoRedirect = false;
        $this->Auth->userScope = array(
            'User.is_active' => 1,
            'User.is_email_confirmed' => 1
        );
        if (isset($this->Auth)) {
            $this->Auth->loginError = sprintf(__l('Sorry, login failed.  Either your %s or password are incorrect or admin deactivated your account.') , Configure::read('user.using_to_login'));
        }
        $this->layout = 'default';
		if (!$this->Auth->user() && Configure::read('site.force_login') && $this->request->params['controller'] == 'users' && $this->request->params['action'] == 'login' && empty($this->request->params['named']['type']) && empty($this->request->data['User']['type']) &&  ((isset($this->request->params['prefix']) && $this->request->params['prefix'] != 'admin') || !isset($this->request->params['prefix']))) {
            $this->layout = 'force_login';
        }
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin && (isset($this->request->params['prefix']) and $this->request->params['prefix'] == 'admin')) {
            $this->layout = 'admin';
        }
    }
    function autocomplete($param_encode = null, $param_hash = null)
    {
        $modelClass = Inflector::singularize($this->name);
        $conditions = false;
        if (isset($this->{$modelClass}->_schema['is_approved'])) {
            $conditions['is_approved = '] = '1';
        }
        $this->XAjax->autocomplete($param_encode, $param_hash, $conditions);
    }
    function _redirectGET2Named($whitelist_param_names = null)
    {
        $query_strings = array();
        if (is_array($whitelist_param_names)) {
            foreach($whitelist_param_names as $param_name) {
                if (!empty($this->request->query[$param_name])) { // querystring
                    $query_strings[$param_name] = $this->request->query[$param_name];
                }
            }
        } else {
            $query_strings = $this->request->query;
            unset($query_strings['url']); // Can't use ?url=foo

        }
        if (!empty($query_strings)) {
            $query_strings = array_merge($this->request->params['named'], $query_strings);
            $this->redirect($query_strings, null, true);
        }
    }
    function show_captcha()
    {
        include_once VENDORS . DS . 'securimage' . DS . 'securimage.php';
        $img = new securimage();
        $img->show(); // alternate use:  $img->show('/path/to/background.jpg');
        $this->autoRender = false;
    }
    function _uuid()
    {
        return sprintf('%07x%1x', mt_rand(0, 0xffff) , mt_rand(0, 0x000f));
    }
    function _unum()
    {
        $acceptedChars = '0123456789';
        $max = strlen($acceptedChars) -1;
        $unique_code = '';
        for ($i = 0; $i < 8; $i++) {
            $unique_code.= $acceptedChars{mt_rand(0, $max) };
        }
        return $unique_code;
    }
    function captcha_play($session_var = null)
    {
        include_once VENDORS . DS . 'securimage' . DS . 'securimage.php';
        $img = new Securimage();
        $img->session_var = $session_var;
        $this->disableCache();
        $this->RequestHandler->respondAs('mp3', array(
            'attachment' => 'captcha.mp3'
        ));
        $img->audio_format = 'mp3';
        echo $img->getAudibleCode('mp3');
    }
    function update_status($id = null, $type = null)
    {
        if (is_null($id) || is_null($type)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__l('Invalid request'));
		}
		if (!empty($this->request->data[$this->modelClass]['r'])) {
			$r = $this->request->data[$this->modelClass]['r'];
		} else {
			$r = $this->request->params['controller'];
		}
		switch ($type) {
			case 'primary':
				$this->{$this->modelClass}->updateAll(array(
					$this->modelClass . '.is_primary' => 0
				) , array(
					$this->modelClass . '.id !=' => $id,
				));
				$data[$this->modelClass]['id'] = $id;
				$data[$this->modelClass]['is_primary'] = 1;
				if ($this->{$this->modelClass}->save($data, false)) {
					$this->Session->setFlash(__l('Address has been marked as primary') , 'default', null, 'success');
				} else {
					$this->Session->setFlash(__l('Address could not be updated. Please try again.') , 'default', null, 'error');
				}
				break;

			case 'checkqr':
				$this->{$this->modelClass}->updateAll(array(
					$this->modelClass . '.order_status_id' => ConstOrderStatus::Completed
				) , array(
					$this->modelClass . '.id' => $id,
				));
				$this->{$this->modelClass}->Behaviors->attach('Aggregatable');
				$this->{$this->modelClass}->updateRealAggregators($this->modelClass);
				$this->{$this->modelClass}->Behaviors->detach('Aggregatable');
				$this->Session->setFlash(__l('Order completed successfully') , 'default', null, 'success');
				break;
		}
		$this->redirect(Router::url('/', true) . $r);
	}
	function admin_updatestatus($id = null, $type = null)
	{
		if (is_null($id) || is_null($type)) {
			throw new NotFoundException(__l('Invalid request'));
		}
		$this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__l('Invalid request'));
		}
		if (!empty($this->request->data[$this->modelClass]['r'])) {
			$r = $this->request->data[$this->modelClass]['r'];
		} else {
			$r = 'admin/' . $this->request->params['controller'];
		}
		$redirect = 1;
		switch ($type) {
			case 'primary':
				$this->{$this->modelClass}->updateAll(array(
					$this->modelClass . '.is_primary' => 0
				) , array(
					$this->modelClass . '.id !=' => $id,
				));
				$data[$this->modelClass]['id'] = $id;
				$data[$this->modelClass]['is_primary'] = 1;
				if ($this->{$this->modelClass}->save($data, false)) {
					$this->Session->setFlash(__l('Address has been marked as primary') , 'default', null, 'success');
				} else {
					$this->Session->setFlash(__l('Record set it as not primary') , 'default', null, 'error');
				}
				break;

			case 'suspend':
				$this->{$this->modelClass}->updateAll(array(
					$this->modelClass . '.admin_suspend' => 1
				) , array(
					$this->modelClass . '.id' => $id
				));
				$this->Session->setFlash(__l('Checked Products has been Suspended') , 'default', null, 'success');
				break;

			case 'unsuspend':
				$this->{$this->modelClass}->updateAll(array(
					$this->modelClass . '.admin_suspend' => 0
				) , array(
					$this->modelClass . '.id' => $id
				));
				$this->Session->setFlash(__l('Checked Products has been changed to Unsuspended') , 'default', null, 'success');
				break;

			case 'unflag':
				$this->{$this->modelClass}->updateAll(array(
					$this->modelClass . '.is_system_flagged' => 0
				) , array(
					$this->modelClass . '.id' => $id
				));
				$this->Session->setFlash(__l('Checked Products has been changed to Unflagged') , 'default', null, 'success');
				break;

			case 'flag':
				$this->{$this->modelClass}->updateAll(array(
					$this->modelClass . '.is_system_flagged' => 1
				) , array(
					$this->modelClass . '.id' => $id
				));
				$this->Session->setFlash(__l('Checked Products has been changed to flagged') , 'default', null, 'success');
				break;

			case 'open':
				$product = $this->Product->find('first', array(
					'conditions' => array(
						'Product.id' => $id,
					) ,
					'recursive' => -1
				));
				$start_date = $product['Product']['start_date'];
				if ($start_date > date('Y-m-d')) {
					$product_status = ConstProductStatus::Upcoming;
					$curr_status = __l('upcoming');
				} else {
					$product_status = ConstProductStatus::Open;
					$curr_status = __l('open');
				}
				$this->{$this->modelClass}->updateAll(array(
					$this->modelClass . '.product_status_id' => $product_status
				) , array(
					$this->modelClass . '.id' => $id
				));
				$this->{$this->modelClass}->Behaviors->attach('Aggregatable');
				$this->{$this->modelClass}->updateRealAggregators();
				$this->{$this->modelClass}->Behaviors->detach('Aggregatable');
				$this->Session->setFlash(__l('Checked Products has been moved to ') . $curr_status, 'default', null, 'success');
				break;

			case 'addresslabel':
				$this->pageTitle = __l('Address Label');
				$orders = $this->Order->find('all', array(
					'conditions' => array(
						'Order.id' => $id,
						'Order.is_shipped_order' => 1
					) ,
					'contain' => array(
						'User' => array(
				        'UserAddress',
							'fields' => array(
								'User.username'
							)
						) ,
						'OrderStatus'
					) ,
					'recursive' => 3
				));
				if (!empty($orders)) {
					$this->layout = 'print';
					$this->set('orders', $orders);
					$this->render('address');
					$redirect = 0;
				} else {
					$this->Session->setFlash(__l('Checked Products are not shipped orders. Please select any other records.') , 'default', null, 'error');
				}
				break;
				
                case 'completed':
					$this->{$this->modelClass}->updateAll(array(
						$this->modelClass . '.order_status_id' => ConstOrderStatus::Completed
					) , array(
						$this->modelClass . '.id' => $id,
						$this->modelClass . '.order_status_id' => ConstOrderStatus::Shipped
					));
					$this->{$this->modelClass}->Behaviors->attach('Aggregatable');
					$this->{$this->modelClass}->updateRealAggregators();
					$this->{$this->modelClass}->Behaviors->detach('Aggregatable');
					$this->Session->setFlash(__l('Order has been completed') , 'default', null, 'success');
				break;

		}
		if (!empty($redirect)) {
			$this->redirect(Router::url('/', true) . $r);
		}
	}
	function admin_update()
	{
		$redirect = 1;
		if (!empty($this->request->data[$this->modelClass])) {
			// Detach the model for message and message content, so to disable flagging for admin functions
			if ($this->modelClass == 'Message' || $this->modelClass == 'MessageContent') {
				$this->Message->MessageContent->Behaviors->detach('SuspiciousWordsDetector');
			}
			$r = $this->request->data[$this->modelClass]['r'];
			$actionid = $this->request->data[$this->modelClass]['more_action_id'];
			unset($this->request->data[$this->modelClass]['r']);
			unset($this->request->data[$this->modelClass]['more_action_id']);
			$ids = array();
			foreach($this->request->data[$this->modelClass] as $id => $is_checked) {
				if (!empty($is_checked['id'])) {
					$ids[] = $id;
				}
			}
			if ($actionid && !empty($ids)) {
				$human_word = Inflector::humanize(Inflector::tableize($this->modelClass));
				switch ($actionid) {
					case ConstMoreAction::Inactive:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.is_active' => 0
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been inactivated') , 'default', null, 'success');
						break;

					case ConstMoreAction::Active:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.is_active' => 1
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been activated') , 'default', null, 'success');
						break;

                   case ConstMoreAction::Upcoming:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.product_status_id' => ConstProductStatus::Upcoming
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been moved to upcoming') , 'default', null, 'success');
						break;

					case ConstMoreAction::Open:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.product_status_id' => ConstProductStatus::Open
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been Opened') , 'default', null, 'success');
						break;

                   case ConstMoreAction::Canceled:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.product_status_id' => ConstProductStatus::Canceled
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been Canceled') , 'default', null, 'success');
						break;
					case ConstMoreAction::Disapproved:
						if ($this->modelClass == 'Product') {
							$this->{$this->modelClass}->updateAll(array(
								$this->modelClass . '.product_status_id' => ConstProductStatus::Rejected,
							) , array(
								$this->modelClass . '.id' => $ids
							));
						$this->{$this->modelClass}->Behaviors->attach('Aggregatable');
						$this->{$this->modelClass}->updateRealAggregators();
						$this->{$this->modelClass}->Behaviors->detach('Aggregatable');
						} else {
							$this->{$this->modelClass}->updateAll(array(
								$this->modelClass . '.is_approved' => 0
							) , array(
								$this->modelClass . '.id' => $ids
							));
						}
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been disapproved') , 'default', null, 'success');
						break;

					case ConstMoreAction::Approved:
						if ($this->modelClass == 'Product') {
							$this->{$this->modelClass}->updateAll(array(
								$this->modelClass . '.product_status_id' => ConstProductStatus::Open,
							) , array(
								$this->modelClass . '.id' => $ids
							));
						$this->{$this->modelClass}->Behaviors->attach('Aggregatable');
						$this->{$this->modelClass}->updateRealAggregators();
						$this->{$this->modelClass}->Behaviors->detach('Aggregatable');
						} else {
							$this->{$this->modelClass}->updateAll(array(
								$this->modelClass . '.is_approved' => 1
							) , array(
								$this->modelClass . '.id' => $ids
							));
						}
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been approved') , 'default', null, 'success');
						break;

					case ConstMoreAction::Suspend:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.admin_suspend' => 1
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been Suspended') , 'default', null, 'success');
						break;

					case ConstMoreAction::Unsuspend:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.admin_suspend' => 0
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been changed to Unsuspended') , 'default', null, 'success');
						break;

					case ConstMoreAction::Unflagged:
						if ($this->modelClass == 'Message' || $this->modelClass == 'MessageContent') {
							foreach($ids as $id) {
								if (!empty($id)) {
									$messageUserId = $this->Message->find('first', array(
										'conditions' => array(
											'Message.id' => $id
										) ,
										'recursive' => -1
									));
									$saveMessage['id'] = $messageUserId['Message']['message_content_id'];
									if (Configure::read('messages.is_send_email_on_new_message')) {
										$this->_reSendMail($messageUserId['Message']['message_content_id']); // RESEND CLEARED MESSAGES //

									}
									$saveMessage['is_system_flagged'] = 0;
									$this->Message->MessageContent->save($saveMessage);
								}
							}
						} else {
							$this->{$this->modelClass}->updateAll(array(
								$this->modelClass . '.is_system_flagged' => 0
							) , array(
								$this->modelClass . '.id' => $ids
							));
						}
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been changed to Unflagged') , 'default', null, 'success');
						break;

					case ConstMoreAction::Flagged:
						if ($this->modelClass == 'Message' || $this->modelClass == 'MessageContent') {
							foreach($ids as $id) {
								if (!empty($id)) {
									$messageUserId = $this->{$this->modelClass}->Message->find('first', array(
										'conditions' => array(
											'Message.id' => $id
										) ,
										'recursive' => -1
									));
									$saveMessage['id'] = $messageUserId['Message']['message_content_id'];
									$saveMessage['is_system_flagged'] = 1;
									$this->{$this->modelClass}->Message->MessageContent->save($saveMessage);
								}
							}
						} else {
							$this->{$this->modelClass}->updateAll(array(
								$this->modelClass . '.is_system_flagged' => 1
							) , array(
								$this->modelClass . '.id' => $ids
							));
						}
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been changed to flagged') , 'default', null, 'success');
						break;

					case ConstMoreAction::Delete:
						foreach($ids as $id) {
							$this->{$this->modelClass}->delete($id);
						}
						if($this->modelClass == 'UserAddress'){
							$human_word = 'User Shipping Addresses';
						}
						$this->Session->setFlash(__l('Checked ' . $human_word . ' has been deleted') , 'default', null, 'success');
						break;

					case ConstMoreAction::GenerateAddress:
						$this->pageTitle = __l('Address Label');
						$orders = $this->Order->find('all', array(
							'conditions' => array(
								'Order.id' => $ids,
								'Order.is_shipped_order' => 1,
							) ,
							'contain' => array(
								'User' => array(
									'fields' => array(
										'User.username'
									)
								) ,
								'OrderStatus'
							) ,
							'recursive' => 3
						));
						if (!empty($orders)) {
							$this->layout = 'print';
							$this->set('orders', $orders);
							$this->render('address');
							$redirect = 0;
						} else {
							$this->Session->setFlash(__l('Checked orders are not shipped orders. Please select any other records.') , 'default', null, 'error');
						}
						break;
						
					case ConstMoreAction::Shipped:
						$orders = $this->Order->find('all', array(
							'conditions' => array(
								'Order.id' => $ids,
								'Order.is_shipped_order' => 1,
							) ,
							'fields' => array(
								'Order.id',
								'Order.order_status_id',
							) ,
							'recursive' => -1
						));
					    $shipped = true;
						foreach($orders as $order){
							if($order['Order']['order_status_id'] != ConstOrderStatus::InProcess){
								$shipped = false;
							}
						}
						if ($shipped) {
							$this->Session->write('shipped_list.data', $ids);
							$this->redirect(array(
								'controller' => 'orders',
								'action' => 'admin_shipped',
								'admin' => true
							));
						} else{
							$this->Session->setFlash(__l('One of the Checked orders are not valid orders. Please select any other records.') , 'default', null, 'error');
						}						
						break;

					case ConstMoreAction::Completed:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.order_status_id' => ConstOrderStatus::Completed
						) , array(
							$this->modelClass . '.id' => $ids,
							$this->modelClass . '.order_status_id' => ConstOrderStatus::Shipped
						));
						$this->{$this->modelClass}->Behaviors->attach('Aggregatable');
						$this->{$this->modelClass}->updateRealAggregators();
						$this->{$this->modelClass}->Behaviors->detach('Aggregatable');
						$this->Session->setFlash(__l('Checked orders has been marked as completed') , 'default', null, 'success');
						break;
					}
			}
		}
		if (!empty($redirect)) {
			$this->redirect(Router::url('/', true) . $r);
		}
	}
	function update()
	{
		if (!empty($this->request->data[$this->modelClass])) {
			// Detach the model for message and message content, so to disable flagging for admin functions
			if ($this->modelClass == 'Message' || $this->modelClass == 'MessageContent') {
				$this->Message->MessageContent->Behaviors->detach('SuspiciousWordsDetector');
			}
			$r = $this->request->data[$this->modelClass]['r'];
			$actionid = $this->request->data[$this->modelClass]['more_action_id'];
			unset($this->request->data[$this->modelClass]['r']);
			unset($this->request->data[$this->modelClass]['more_action_id']);
			$ids = array();
			foreach($this->request->data[$this->modelClass] as $id => $is_checked) {
				if (!empty($is_checked['id'])) {
					$ids[] = $id;
				}
			}
			if ($actionid && !empty($ids)) {
				switch ($actionid) {
					case ConstMoreAction::Inactive:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.is_active' => 0
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked Products has been disabled') , 'default', null, 'success');
						break;

					case ConstMoreAction::Active:
						$this->{$this->modelClass}->updateAll(array(
							$this->modelClass . '.is_active' => 1
						) , array(
							$this->modelClass . '.id' => $ids
						));
						$this->Session->setFlash(__l('Checked Products has been enabled') , 'default', null, 'success');
						break;
					
					case ConstMoreAction::Shipped:
						$this->Session->write('shipped_list.data', $ids);
						$this->redirect(array(
							'controller' => 'orders',
							'action' => 'shipped',
							'admin' => false
						));
						break;

					case ConstMoreAction::Delete:
						foreach($ids as $id) {
							$this->{$this->modelClass}->delete($id);
						}
						$this->Session->setFlash(__l('Checked Products has been deleted') , 'default', null, 'success');
						break;
				}
			}
		}
		$this->redirect(Router::url('/', true) . $r);
	}
	function forceSSL()
	{
		if (!env('HTTPS')) {
			$this->redirect('https://' . env('SERVER_NAME') . $this->here);
		}
	}
	function _unforceSSL()
	{
		if (empty($this->request->params['requested'])) {
			$this->redirect('http://' . $_SERVER['SERVER_NAME'] . $this->here);
		}
	}
	public function _sendAdminActionMail($user_id, $email_template)
    {
        App::import('Model', 'User');
        $this->User = new User();
		$user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ) ,
            'fields' => array(
                'User.username',
                'User.email'
            ) ,
            'recursive' => -1
        ));
        $emailFindReplace = array(
            '##USERNAME##' => $user['User']['username'],
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##SITE_LINK##' => Router::url('/', true) ,
        );
        $email = $this->EmailTemplate->selectTemplate($email_template);
        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
        $this->Email->to = $user['User']['email'];
        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
        $this->Email->send(strtr($email['email_content'], $emailFindReplace));
	}
	function _redirectPOST2Named($paramNames = array())
    {
        //redirect the URL with query string to namedArg like URL structure...
        $query_strings = array();
        foreach($paramNames as $paramName) {
            if (!empty($this->data[Inflector::camelize(Inflector::singularize($this->params->controller))][$paramName])) { //via GET query string
				 $query_strings[$paramName] = $this->data[Inflector::camelize(Inflector::singularize($this->params->controller))][$paramName];
            }
        }
        if (!empty($query_strings)) {
            // preserve other named params
            $query_strings = array_merge($this->request->params['named'], $query_strings);
            $this->redirect($query_strings, null, true);
        }
    }
}
?>
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
class UsersController extends AppController
{
    public $name = 'Users';
    public $components = array(
        'Email',
        'Openid',
        'OauthConsumer'
    );
    public $uses = array(
        'User',
        'EmailTemplate',
        'Transaction',
        'Payment',
		'Setting'
    );
    public $helpers = array(
        'Csv'
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'City.id',
            'City.name',
            'State.id',
            'State.name',
            'User.send_to_user_id',
            'UserProfile.country_id',
            'UserProfile.state_id',
            'UserProfile.city_id',
            'User.referred_by_user_id',
            'User.latitude',
            'User.longitude',
            'User.payment_type',
            'User.is_agree_terms_conditions',
            'User.country_iso_code',
            'User.payment_gateway_id',
        );
        parent::beforeFilter();
    }
    public function dashboard()
    {
        $this->pageTitle = __l('Dashboard');
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id') ,
            ) ,
            'recursive' => -1
        ));
        $this->set('user', $user);
		$chart_data = array();
        $chart_data[__l('Expired') ] = array(
            ConstOrderStatus::Expired,
            'bid-expired'
        );
        $chart_data[__l('Payment Pending') ] = array(
            ConstOrderStatus::PaymentPending,
            'waiting-esrow'
        );
        $chart_data[__l('Inprocess') ] = array(
            ConstOrderStatus::InProcess,
            'order-inprocess'
        );
        $chart_data[__l('Canceled') ] = array(
            ConstOrderStatus::CanceledAndRefunded,
            'cancelled'
        );
        $chart_data[__l('Shipped') ] = array(
            ConstOrderStatus::Shipped,
            'skipped'
        );
        $chart_data[__l('Completed') ] = array(
            ConstOrderStatus::Completed,
            'order-completed'
        );
       
        $this->set('chart_data', $chart_data);
    }
    public function view($username = null)
    {
        $this->pageTitle = __l('User');
        if (is_null($username)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.username' => $username
            ) ,
            'contain' => array(
                'UserProfile' => array(
                    'fields' => array(
                        'UserProfile.first_name',
                        'UserProfile.last_name',
                        'UserProfile.middle_name',
                        'UserProfile.about_me',
                        'UserProfile.dob',
                        'UserProfile.address',
                        'UserProfile.zip_code',
                        'UserProfile.paypal_account',
                    ) ,
                    'City' => array(
                        'fields' => array(
                            'City.name'
                        )
                    ) ,
                    'State' => array(
                        'fields' => array(
                            'State.name',
                            'State.code',
                        )
                    ) ,
                    'Country' => array(
                        'fields' => array(
                            'Country.name',
                            'Country.iso2'
                        )
                    )
                ) ,
                'UserAvatar' => array(
                    'fields' => array(
                        'UserAvatar.id',
                        'UserAvatar.dir',
                        'UserAvatar.filename',
                        'UserAvatar.width',
                        'UserAvatar.height'
                    )
                ) ,
            ) ,
            'recursive' => 2
        ));
		$referrel=$this->Setting->find('first',array(
				'conditions'=>array('Setting.setting_category_parent_id'=>26),
				'fields'=>array('value')
			)
		);
		
        if (empty($user)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->User->UserView->create();
        $this->request->data['UserView']['user_id'] = $user['User']['id'];
        $this->request->data['UserView']['viewing_user_id'] = $this->Auth->user('id');
        $this->request->data['UserView']['ip_id'] = $this->User->toSaveIp();
        $this->User->UserView->save($this->request->data);
        $this->pageTitle.= ' - ' . $username;
        $this->set('user', $user);
		$this->set('referrel',$referrel);
    }
    public function admin_view($username = null)
    {
        $this->setAction('view', $username);
    }
    public function register()
    {
        $this->pageTitle = __l('User Registration');
        $fbuser = $this->Session->read('fbuser');
        if (!empty($fbuser['fb_user_id'])) {
            $this->request->data['User']['username'] = $fbuser['username'];
            $this->request->data['User']['email'] = '';
            $this->request->data['User']['fb_user_id'] = $fbuser['fb_user_id'];
            $this->request->data['User']['is_facebook_register'] = 1;
            $this->Session->delete('fbuser');
        } else if (empty($this->request->data)) {
            $fbuser = $this->Session->read('fbuser');
            if (Configure::read('facebook.is_enabled_facebook_connect') && !$this->Auth->user() && !empty($fbuser)) {
                $this->_facebook_login();
            }
        }
        // Twitter modified registration: Comes for registration from oauth //
        $twuser = $this->Session->read('twuser');
        if (empty($this->request->data)) {
            if (!empty($twuser)) {
                $this->request->data['User']['username'] = $twuser['username'];
                $this->request->data['User']['email'] = '';
                $this->request->data['User']['is_twitter_register'] = 1;
                $this->request->data['User']['twitter_user_id'] = $twuser['twitter_user_id'];
                $this->request->data['User']['twitter_access_token'] = $twuser['twitter_access_token'];
                $this->request->data['User']['twitter_access_key'] = $twuser['twitter_access_key'];
                if (Configure::read('invite.is_referral_system_enabled')) {
                    $refer_id = $this->Cookie->read('refer_id');
                    if (!empty($refer_id)) {
                        $this->request->data['User']['referred_by_user_id'] = $refer_id;
                    }
                }
                $this->Session->delete('twuser');
            }
        }
        //open id component included
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Openid');
        $this->Openid = new OpenidComponent($collection);
        $openid = $this->Session->read('openid');
        if (!empty($openid['openid_url'])) {
            if (isset($openid['email'])) {
                $this->request->data['User']['email'] = $openid['email'];
                $this->request->data['User']['username'] = $openid['username'];
                $this->request->data['User']['openid_url'] = $openid['openid_url'];
                if (!empty($openid['is_gmail_register'])) {
                    $this->request->data['User']['is_gmail_register'] = $openid['is_gmail_register'];
                }
                if (!empty($openid['is_yahoo_register'])) {
                    $this->request->data['User']['is_yahoo_register'] = $openid['is_yahoo_register'];
                }
                $this->Session->delete('openid');
            }
        }
        // handle the fields return from openid
        if (count($_GET) > 1) {
            $returnTo = Router::url(array(
                'controller' => 'users',
                'action' => 'register'
            ) , true);
            $response = $this->Openid->getResponse($returnTo);
            if ($response->status == Auth_OpenID_SUCCESS) {
                // Required Fields
                if ($user = $this->User->UserOpenid->find('first', array(
                    'conditions' => array(
                        'UserOpenid.openid' => $response->identity_url
                    )
                ))) {
                    //Already existing user need to do auto login
                    $this->request->data['User']['email'] = $user['User']['email'];
                    $this->request->data['User']['username'] = $user['User']['username'];
                    $this->request->data['User']['password'] = $user['User']['password'];
                    if ($this->Auth->login($this->request->data)) {
                        $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                        $this->redirect('/');
                    } else {
                        $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                        $this->redirect(array(
                            'controller' => 'users',
                            'action' => 'login'
                        ));
                    }
                } else {
                    if (Configure::read('invite.is_referral_system_enabled')) {
                        $refer_id = $this->Cookie->read('refer_id');
                        if (!empty($refer_id)) {
                            $this->request->data['User']['referred_by_user_id'] = $refer_id;
                        }
                    }
                    $sregResponse = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
                    $sreg = $sregResponse->contents();
                    $this->request->data['User']['username'] = isset($sreg['nickname']) ? $sreg['nickname'] : '';
                    $this->request->data['User']['email'] = isset($sreg['email']) ? $sreg['email'] : '';
                    $this->request->data['User']['openid_url'] = $response->identity_url;
                }
            } else {
                $this->Session->setFlash(__l('Authenticated failed or you may not have profile in your OpenID account'));
            }
        }
        // send to openid public function with open id url and redirect page
        if (!empty($this->request->data['User']['openid']) && preg_match('/^http?:\/\/+[a-z]/', $this->request->data['User']['openid'])) {
            $this->User->set($this->request->data);
            unset($this->User->validate[Configure::read('user.using_to_login') ]);
            unset($this->User->validate['passwd']);
            unset($this->User->validate['email']);
            if ($this->User->validates()) {
                $this->request->data['User']['redirect_page'] = 'register';
                $this->_openid();
            } else {
                $this->Session->setFlash(__l('Your registration process is not completed. Please, try again.') , 'default', null, 'error');
            }
        } else {
            if (!empty($this->request->data)) {

                if (!empty($this->request->data['City']['name'])) {
                    $this->request->data['UserProfile']['city_id'] = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->User->UserProfile->City->findOrSaveAndGetId($this->request->data['City']['name']);
                }
                if (!empty($this->request->data['State']['name'])) {
                    $this->request->data['UserProfile']['state_id'] = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->User->UserProfile->State->findOrSaveAndGetId($this->request->data['State']['name']);
                }
                if (!empty($this->request->data['User']['country_iso_code'])) {
                    $this->request->data['UserProfile']['country_id'] = $this->User->UserProfile->Country->findCountryIdFromIso2($this->request->data['User']['country_iso_code']);
                    if (empty($this->request->data['UserProfile']['country_id'])) {
                        unset($this->request->data['UserProfile']['country_id']);
                    }
                }
                $this->User->UserProfile->set($this->request->data);
                $this->User->set($this->request->data);
                if ($this->User->validates() &$this->User->UserProfile->validates()) {
                    $this->User->create();
                    if (!empty($this->request->data['User']['openid_url']) or !empty($this->request->data['User']['fb_user_id'])) {
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['email'] . Configure::read('Security.salt'));
                        //For open id register no need for email confirm, this will override is_email_verification_for_register setting
                        $this->request->data['User']['is_agree_terms_conditions'] = 1;
                        $this->request->data['User']['is_email_confirmed'] = 1;
                        if (empty($this->request->data['User']['fb_user_id']) && empty($this->request->data['User']['is_gmail_register']) && empty($this->request->data['User']['is_yahoo_register'])) {
                            $this->request->data['User']['is_openid_register'] = 1;
                        }
                    } elseif (!empty($this->request->data['User']['twitter_user_id'])) { // Twitter modified registration: password  -> twitter user id and salt //
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['twitter_user_id'] . Configure::read('Security.salt'));
                        $this->request->data['User']['is_email_confirmed'] = 1;
                    } else {
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['passwd']);
                        $this->request->data['User']['is_email_confirmed'] = (Configure::read('user.is_email_verification_for_register')) ? 0 : 1;
                    }
                    $this->request->data['User']['is_active'] = (Configure::read('user.is_admin_activate_after_register')) ? 0 : 1;
                    $this->request->data['User']['user_type_id'] = ConstUserTypes::User;
                    $this->request->data['User']['ip_id'] = $this->User->toSaveIp();
                    $this->request->data['User']['host'] = gethostbyaddr($this->RequestHandler->getClientIP());
                    if ($this->User->save($this->request->data, false)) {
                        if (!empty($this->request->data['User']['referred_by_user_id'])) {
                            $this->User->_updateReferralCount($this->request->data['User']['referred_by_user_id']);
                        }
                        $user_id = $this->User->getLastInsertId();
                        $this->User->_cartMapping($user_id);
                        $this->request->data['UserProfile']['user_id'] = $user_id;
                        $this->User->UserProfile->create();
                        $this->User->UserProfile->save($this->request->data['UserProfile'], false);
                        $this->_postJoinedStatus($this->User->id);
                        // send to admin mail if is_admin_mail_after_register is true
                        if (Configure::read('user.is_admin_mail_after_register')) {
                            $emailFindReplace = array(
                                '##USERNAME##' => $this->request->data['User']['username'],
                                '##SITE_NAME##' => Configure::read('site.name') ,
                                '##SITE_URL##' => Router::url('/', true) ,
                                '##USEREMAIL##' => $this->request->data['User']['email'],
                                '##SIGNUPIP##' => $this->RequestHandler->getClientIP(),
                            );
                            $email = $this->EmailTemplate->selectTemplate('New User Join');
                            // Send e-mail to users
                            $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                            $this->Email->to = Configure::read('EmailTemplate.admin_email');
                            $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                            $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                        }
                        if (!empty($this->request->data['User']['openid_url'])) {
                            $this->request->data['UserOpenid']['openid'] = $this->request->data['User']['openid_url'];
                            $this->request->data['UserOpenid']['user_id'] = $this->User->id;
                            $this->User->UserOpenid->create();
                            $this->User->UserOpenid->save($this->request->data);
                        }
                        $this->Session->setFlash(__l('You have successfully registered with our site.') , 'default', null, 'success');
                        if (!empty($this->request->data['User']['openid_url']) || !empty($this->request->data['User']['fb_user_id']) || !empty($this->request->data['User']['twitter_user_id'])) {
                            // send welcome mail to user if is_welcome_mail_after_register is true
                            if (Configure::read('user.is_welcome_mail_after_register')) {
                                $this->User->_sendWelcomeMail($this->User->id, $this->request->data['User']['email'], $this->request->data['User']['username']);
                            }
                            if ($this->Auth->login($this->request->data)) {
                                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                                $this->redirect('/');
                            }
                        } else {
                            //For openid register no need to send the activation mail, so this code placed in the else
                            if (Configure::read('user.is_email_verification_for_register')) {
                                $this->Session->setFlash(__l('You have successfully registered with our site and your activation mail has been sent to your mail inbox.') , 'default', null, 'success');
                                $this->User->_sendActivationMail($this->request->data['User']['email'], $this->User->id, $this->User->getActivateHash($this->User->id));
                            }
                        }
                        // send welcome mail to user if is_welcome_mail_after_register is true
                        if (!Configure::read('user.is_email_verification_for_register') and !Configure::read('user.is_admin_activate_after_register') and Configure::read('user.is_welcome_mail_after_register')) {
                            $this->User->_sendWelcomeMail($this->User->id, $this->request->data['User']['email'], $this->request->data['User']['username']);
                        }
                        if (!Configure::read('user.is_email_verification_for_register') and Configure::read('user.is_auto_login_after_register')) {
                            $this->Session->setFlash(__l('You have successfully registered with our site.') , 'default', null, 'success');
                            if ($this->Auth->login($this->request->data)) {
                                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                                $this->redirect('/');
                            }
                        }
                        $this->redirect(array(
                            'controller' => 'users',
                            'action' => 'login'
                        ));
                    }
                } else {
                    if (empty($this->request->data['User']['openid_url'])) {
                        $this->Session->setFlash(__l('Your registration process is not completed. Please, try again.') , 'default', null, 'error');
                    } else {
                        if (!empty($this->request->data['User']['is_gmail_register'])) {
                            $flash_verfy = 'Gmail';
                        } elseif (!empty($this->request->data['User']['is_yahoo_register'])) {
                            $flash_verfy = 'Yahoo';
                        } else {
                            $flash_verfy = 'OpenID';
                        }
                        $this->Session->setFlash($flash_verfy . ' ' . __l('verification is completed successfully. But you have to fill the following required fields to complete our registration process.') , 'default', null, 'success');
                    }
                }
            }
        }
        if (empty($this->request->data) && Configure::read('invite.is_referral_system_enabled')) {
            $refer_id = $this->Cookie->read('refer_id');
            if (!empty($refer_id)) {
                $this->request->data['User']['referred_by_user_id'] = $refer_id;
            }
        }
        unset($this->request->data['User']['passwd']);
        // When already logged user trying to access the registration page we are redirecting to site home page
        if ($this->Auth->user()) {
            $this->redirect(Router::url('/', true));
        }
    }
    public function _openid()
    {
        //open id component included
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Openid');
        $this->Openid = new OpenidComponent($collection);
        $returnTo = Router::url(array(
            'controller' => 'users',
            'action' => $this->request->data['User']['redirect_page']
        ) , true);
        $siteURL = Router::url('/', true);
        // send openid url and fields return to our server from openid
        if (!empty($this->request->data)) {
            try {
                $this->Openid->authenticate($this->request->data['User']['openid'], $returnTo, $siteURL, array(
                    'sreg_required' => array(
                        'email',
                        'nickname'
                    )
                ) , array());
            }
            catch(InvalidArgumentException $e) {
                $this->Session->setFlash(__l('Invalid OpenID') , 'default', null, 'error');
            }
            catch(Exception $e) {
                $this->Session->setFlash(__l($e->getMessage()));
            }
        }
    }
    public function activation($user_id = null, $hash = null)
    {
        $this->pageTitle = __l('Activate your account');
        if (is_null($user_id) or is_null($hash)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
                'User.is_email_confirmed' => 0
            ) ,
            'recursive' => -1
        ));
        if (empty($user)) {
            $this->Session->setFlash(__l('Invalid activation request, please register again'));
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'register'
            ));
        }
        if (!$this->User->isValidActivateHash($user_id, $hash)) {
            $hash = $this->User->getActivateHash($user_id);
            $this->Session->setFlash(__l('Invalid activation request'));
            $this->set('show_resend', 1);
            $resend_url = Router::url(array(
                'controller' => 'users',
                'action' => 'resend_activation',
                $user_id,
                $hash
            ) , true);
            $this->set('resend_url', $resend_url);
        } else {
            $this->request->data['User']['id'] = $user_id;
            $this->request->data['User']['is_email_confirmed'] = 1;
            // admin will activate the user condition check
            $this->request->data['User']['is_active'] = (Configure::read('user.is_admin_activate_after_register')) ? 0 : 1;
            $this->User->save($this->request->data);
            // active is false means redirect to home page with message
            if (!$this->request->data['User']['is_active']) {
                $this->Session->setFlash(__l('You have successfully activated your account. But you can login after admin activate your account.') , 'default', null, 'success');
                $this->redirect(Router::url('/', true));
            }
            // send welcome mail to user if is_welcome_mail_after_register is true
            if (Configure::read('user.is_welcome_mail_after_register')) {
                $this->User->_sendWelcomeMail($user['User']['id'], $user['User']['email'], $user['User']['username']);
            }
            // after the user activation check script check the auto login value. it is true then automatically logged in
            if (Configure::read('user.is_auto_login_after_register')) {
                $this->Session->setFlash(__l('You have successfully activated and logged in to your account.') , 'default', null, 'success');
                $this->request->data['User']['email'] = $user['User']['email'];
                $this->request->data['User']['username'] = $user['User']['username'];
                $this->request->data['User']['password'] = $user['User']['password'];
                if ($this->Auth->login($this->request->data)) {
                    $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                    $this->redirect(array(
                        'controller' => 'user_profiles',
                        'action' => 'edit'
                    ));
                }
            }
            // user is active but auto login is false then the user will redirect to login page with message
            $this->Session->setFlash(sprintf(__l('You have successfully activated your account. Now you can login with your %s.') , Configure::read('user.using_to_login')) , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
    }
    public function resend_activation($user_id = null, $hash = null)
    {
        if (is_null($user_id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin || $this->User->isValidResendActivateHash($user_id, $hash)) {
            $hash = $this->User->getActivateHash($user_id);
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $user_id
                ) ,
                'recursive' => -1
            ));
            if ($this->User->_sendActivationMail($user['User']['email'], $user_id, $hash)) {
                if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
                    $this->Session->setFlash(__l('Activation mail has been resent.') , 'default', null, 'success');
                } else {
                    $this->Session->setFlash(__l('A Mail for activating your account has been sent.') , 'default', null, 'success');
                }
            } else {
                $this->Session->setFlash(__l('Try some time later as mail could not be dispatched due to some error in the server') , 'default', null, 'error');
            }
        } else {
            $this->Session->setFlash(__l('Invalid resend activation request, please register again'));
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'register'
            ));
        }
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'index',
                'admin' => true
            ));
        } else {
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
    }
    public function _facebook_login()
    {
        $me = $this->Session->read('fbuser');
        if (empty($me) || empty($me['id'])) {
            $this->Session->setFlash(__l('Problem in Facebook connect. Please try again') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.fb_user_id' => $me['id']
            ) ,
            'fields' => array(
                'User.id',
                'User.email',
                'User.username',
                'User.password',
                'User.fb_user_id',
                'User.is_active',
            ) ,
        ));
        $this->Auth->fields['username'] = 'username';
        //create new user
        if (empty($user)) {
            $checkFacebookEmail = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $me['email'],
                ) ,
                'fields' => array(
                    'User.id',
                    'User.email',
                    'User.username',
                    'User.password',
                    'User.fb_user_id',
                    'User.is_active',
                ) ,
                'recursive' => -1
            ));
            if (!empty($checkFacebookEmail)) {
                $this->Session->delete('fbuser');
                if (empty($checkFacebookEmail['User']['is_active'])) {
                    $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'login',
                        'admin' => false
                    ));
                }
                $_data['User']['username'] = $checkFacebookEmail['User']['username'];
                $_data['User']['email'] = $checkFacebookEmail['User']['email'];
                $_data['User']['password'] = $checkFacebookEmail['User']['password'];
                if ($this->Auth->login($_data)) {
                    $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                    if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
                        $this->Session->delete('Auth.redirectUrl');
                        $this->redirect(Router::url('/', true) . $redirectUrl);
                    } else {
                        $this->redirect('/');
                    }
                }
            }
            $this->User->create();
            $this->request->data['UserProfile']['first_name'] = !empty($me['first_name']) ? $me['first_name'] : '';
            $this->request->data['UserProfile']['middle_name'] = !empty($me['middle_name']) ? $me['middle_name'] : '';
            $this->request->data['UserProfile']['last_name'] = !empty($me['last_name']) ? $me['last_name'] : '';
            $this->request->data['UserProfile']['about_me'] = !empty($me['about_me']) ? $me['about_me'] : '';
            if (empty($this->request->data['User']['username']) && strlen($me['first_name']) > 2) {
                $this->request->data['User']['username'] = $this->User->checkUsernameAvailable(strtolower($me['first_name']));
            }
            if (empty($this->request->data['User']['username']) && strlen($me['first_name'] . $me['last_name']) > 2) {
                $this->request->data['User']['username'] = $this->User->checkUsernameAvailable(strtolower($me['first_name'] . $me['last_name']));
            }
            if (empty($this->request->data['User']['username']) && strlen($me['first_name'] . $me['middle_name'] . $me['last_name']) > 2) {
                $this->request->data['User']['username'] = $this->User->checkUsernameAvailable(strtolower($me['first_name'] . $me['middle_name'] . $me['last_name']));
            }
            $this->request->data['User']['username'] = str_replace(' ', '', $this->request->data['User']['username']);
            $this->request->data['User']['username'] = str_replace('.', '_', $this->request->data['User']['username']);
            // A condtion to avoid unavilability of user username in our sites
            if (strlen($this->request->data['User']['username']) <= 2) {
                $this->request->data['User']['username'] = !empty($me['first_name']) ? str_replace(' ', '', strtolower($me['first_name'])) : 'fbuser';
                $i = 1;
                $created_user_name = $this->request->data['User']['username'] . $i;
                while (!$this->User->checkUsernameAvailable($created_user_name)) {
                    $created_user_name = $this->request->data['User']['username'] . $i++;
                }
                $this->request->data['User']['username'] = $created_user_name;
            }
            $this->request->data['User']['email'] = !empty($me['email']) ? $me['email'] : '';
            if (!empty($this->request->data['User']['email'])) {
                $check_user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.email' => $this->request->data['User']['email']
                    ) ,
                    'recursive' => -1
                ));
                $this->request->data['User']['id'] = $check_user['User']['id'];
            }
            $this->request->data['User']['fb_user_id'] = $me['id'];
            $this->request->data['User']['fb_access_token'] = $me['access_token'];
            $this->request->data['User']['password'] = $this->Auth->password($me['id'] . Configure::read('Security.salt'));
            $this->request->data['User']['is_agree_terms_conditions'] = '1';
            $this->request->data['User']['is_email_confirmed'] = 1;
            $this->request->data['User']['is_facebook_register'] = 1;
            $this->request->data['User']['is_active'] = 1;
            $this->request->data['User']['user_type_id'] = ConstUserTypes::User;
            $this->request->data['User']['ip_id'] = $this->User->toSaveIp();
            $this->request->data['User']['host'] = gethostbyaddr($this->RequestHandler->getClientIP());
            // for user referral system
            if (Configure::read('invite.is_referral_system_enabled')) {
                $refer_id = $this->Cookie->read('refer_id');
                if (!empty($refer_id)) {
                    $this->request->data['User']['referred_by_user_id'] = $refer_id;
                }
            }
            //end
			$this->User->set($this->request->data);
			if(!$this->User->validates()){            
				$temp['first_name'] = $this->request->data['UserProfile']['first_name'];
                $temp['last_name'] = $this->request->data['UserProfile']['last_name'];
                $temp['username'] = $this->request->data['User']['username'];
                $temp['fb_user_id'] = $this->request->data['User']['fb_user_id'];
                $temp['fb_access_token'] = $this->request->data['User']['fb_access_token'];
                $this->Session->write('fbuser', $temp);
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'register',
                ));
			}
            $this->User->save($this->request->data, false);
            if (!empty($this->request->data['User']['referred_by_user_id'])) {
                $this->User->_updateReferralCount($this->request->data['User']['referred_by_user_id']);
            }
            $this->request->data['UserProfile']['user_id'] = $this->User->id;
            $this->User->UserProfile->save($this->request->data);
            if ($this->Auth->login($this->request->data)) {
                if (Configure::read('user.is_admin_mail_after_register') && empty($this->request->data['User']['id'])) {
                    $emailFindReplace = array(
                        '##USERNAME##' => $this->request->data['User']['username'],
                        '##SITE_NAME##' => Configure::read('site.name') ,
                        '##SITE_URL##' => Router::url('/', true) ,
                        '##USEREMAIL##' => $this->request->data['User']['email'],
                        '##SIGNUPIP##' => $this->RequestHandler->getClientIP(),
                    );
                    $email = $this->EmailTemplate->selectTemplate('New User Join');
                    // Send e-mail to users
                    $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                    $this->Email->to = Configure::read('EmailTemplate.admin_email');
                    $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                    $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                }
                $this->_postJoinedStatus($this->User->id);
                $this->Session->setFlash(__l('You have successfully registered with our site.') , 'default', null, 'success');
                if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
                    $this->Session->delete('Auth.redirectUrl');
                    $this->redirect(Router::url('/', true) . $redirectUrl);
                } else {
                    $this->redirect('/');
                }
            }
        } else {
            if (!$user['User']['is_active']) {
                $this->Session->setFlash(__l('Sorry, login failed.  Your account has been blocked') , 'default', null, 'error');
                unset($user);
                session_destroy();
                $this->redirect(Router::url('/', true));
            }
            $this->request->data['User']['fb_user_id'] = $me['id'];
            $this->User->updateAll(array(
                'User.fb_access_token' => '\'' . $me['access_token'] . '\'',
                'User.fb_user_id' => '\'' . $me['id'] . '\'',
            ) , array(
                'User.id' => $user['User']['id']
            ));
            $this->request->data['User']['email'] = $user['User']['email'];
            $this->request->data['User']['username'] = $user['User']['username'];
            $this->request->data['User']['password'] = $user['User']['password'];
            if ($this->Auth->login($this->request->data)) {
                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
                    $this->Session->delete('Auth.redirectUrl');
                    $this->redirect(Router::url('/', true) . $redirectUrl);
                } else {
                    $this->redirect('/');
                }
            }
        }
    }
    public function oauth_callback()
    {
        $this->autoRender = false;
        App::import('Xml');
        // Fix to avoid the mail validtion for  Twitter
        $this->Auth->fields['username'] = 'username';
        $requestToken = $this->Session->read('requestToken');
        $requestToken = unserialize($requestToken);
        $accessToken = $this->OauthConsumer->getAccessToken('Twitter', 'http://twitter.com/oauth/access_token', $requestToken);
        $this->Session->write('accessToken', $accessToken);
        if (empty($accessToken->key) && empty($accessToken->secret)) {
            $this->Session->setFlash(__l('Problem in Twitter connect. Please try again') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
        $xml = $this->OauthConsumer->get('Twitter', $accessToken->key, $accessToken->secret, 'https://twitter.com/account/verify_credentials.xml');
        $this->request->data['User']['twitter_access_token'] = (isset($accessToken->key)) ? $accessToken->key : '';
        $this->request->data['User']['twitter_access_key'] = (isset($accessToken->secret)) ? $accessToken->secret : '';
        // So this to check whether it is  admin login to get its twiiter acces tocken
        if ($this->Auth->user('id') and $this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
            App::import('Model', 'Setting');
            $setting = new Setting;
            $setting->updateAll(array(
                'Setting.value' => "'" . $this->request->data['User']['twitter_access_token'] . "'",
            ) , array(
                'Setting.name' => 'twitter.site_user_access_token'
            ));
            $setting->updateAll(array(
                'Setting.value' => "'" . $this->request->data['User']['twitter_access_key'] . "'"
            ) , array(
                'Setting.name' => 'twitter.site_user_access_key'
            ));
            $this->Session->setFlash(__l('Your Twitter credentials are updated') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'settings',
                'admin' => true
            ));
        }
        $data = Xml::toArray(Xml::build($xml['body']));
        $data['User'] = $data['user'];
        unset($data['user']);
        if (empty($data['User']['id'])) {
            $this->Session->setFlash(__l('Problem in Twitter connect. Please try again') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
        if ($this->Auth->user('id') && $this->Auth->user('user_type_id') != ConstUserTypes::Admin) {
            $user_id = $this->Session->read('auth_user_id');
            $this->request->data['User']['avatar_url'] = $data['User']['profile_image_url'];
            $this->request->data['twitter_access_token'] = (isset($accessToken->key)) ? $accessToken->key : '';
            $this->request->data['twitter_access_key'] = (isset($accessToken->secret)) ? $accessToken->secret : '';
            $this->request->data['User']['id'] = $this->Auth->user('id');
            $this->User->save($this->request->data, false);
            $this->Session->delete('auth_user_id');
            $this->Session->setFlash(__l('You have successfully connected with twitter.') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'connect',
                'admin' => false,
            ));
        }
        if (empty($data['User']['id'])) {
            $this->Session->setFlash(__l('Problem in Twitter connect. Please try again') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.twitter_user_id' => $data['User']['id']
            ) ,
            'fields' => array(
                'User.id',
                'UserProfile.id',
                'User.user_type_id',
                'User.username',
                'User.email',
            ) ,
            'recursive' => 0
        ));
        if (empty($user)) {
            $temp['first_name'] = empty($data['User']['name']) ? $data['User']['name'] : '';
            $temp['last_name'] = empty($data['User']['name']) ? $data['User']['name'] : '';
            if (empty($temp['username']) && strlen($data['User']['name']) > 2) {
                $temp['username'] = $this->User->checkUsernameAvailable(strtolower($data['User']['name']));
            }
            if (empty($temp['username']) && strlen($data['User']['name'] . $data['User']['screen_name']) < 2) {
                $temp['username'] = $this->User->checkUsernameAvailable(strtolower($data['User']['name'] . $data['User']['screen_name']));
            }
            $temp['twitter_user_id'] = !empty($data['User']['id']) ? $data['User']['id'] : '';
            $temp['twitter_access_token'] = (isset($accessToken->key)) ? $accessToken->key : '';
            $temp['twitter_access_key'] = (isset($accessToken->secret)) ? $accessToken->secret : '';
            $this->Session->write('twuser', $temp);
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'register'
            ));
        } else {
            $this->request->data['User']['id'] = $user['User']['id'];
            $this->request->data['User']['username'] = $user['User']['username'];
        }
        unset($this->User->validate['username']['rule2']);
        unset($this->User->validate['username']['rule3']);
        $this->request->data['User']['password'] = $this->Auth->password($data['User']['id'] . Configure::read('Security.salt'));
        $this->request->data['User']['avatar_url'] = $data['User']['profile_image_url'];
        $this->request->data['User']['twitter_url'] = (isset($data['User']['url'])) ? $data['User']['url'] : '';
        $this->request->data['User']['description'] = (isset($data['User']['description'])) ? $data['User']['description'] : '';
        $this->request->data['User']['location'] = (isset($data['User']['location'])) ? $data['User']['location'] : '';
        if (Configure::read('invite.is_referral_system_enabled')) {
            $refer_id = $this->Cookie->read('refer_id');
            if (!empty($refer_id)) {
                $this->request->data['User']['referred_by_user_id'] = $refer_id;
            }
        }
        if ($this->User->save($this->request->data, false)) {
            if (!empty($this->request->data['User']['referred_by_user_id'])) {
                $this->User->_updateReferralCount($this->request->data['User']['referred_by_user_id']);
            }
            $this->_postJoinedStatus($this->User->id);
            $this->Cookie->delete('refer_id');
            if ($this->Auth->login($this->request->data)) {
                $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                $this->redirect(Router::url('/', true));
            }
        }
        if (!empty($this->request->data['User']['f'])) {
            $this->redirect(Router::url('/', true) . $this->request->data['User']['f']);
        }
        $this->redirect(Router::url('/', true));
    }
    public function login()
    {
        $fbuser = $this->Session->read('fbuser');
        if (empty($this->request->data) and Configure::read('facebook.is_enabled_facebook_connect') && !$this->Auth->user() && !empty($fbuser) && !$this->Session->check('is_fab_session_cleared')) {
            $this->_facebook_login();
        }
        $this->pageTitle = __l('Login');
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'twitter' && Configure::read('twitter.is_enabled_twitter_connect')) {
            $twitter_return_url = Router::url(array(
                'controller' => 'users',
                'action' => 'oauth_callback',
                'admin' => false
            ) , true);
            $requestToken = $this->OauthConsumer->getRequestToken('Twitter', 'https://api.twitter.com/oauth/request_token', $twitter_return_url);
            $this->Session->write('requestToken', serialize($requestToken));
            if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
                $this->redirect('http://twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
            } else {
                $this->set('redirect_url', 'http://twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
                $this->set('authorize_name', 'twitter');
                $this->layout = 'redirect_page';
                $this->pageTitle.= ' - ' . __l('Twitter');
                $this->render('authorize');
            }
        }
        // Facebook Login //
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'facebook') {
            $fb_return_url = Router::url(array(
                'controller' => 'users',
                'action' => 'register',
                'admin' => false
            ) , true);
            $this->Session->write('fb_return_url', $fb_return_url);
            $redirect_url = $this->facebook->getLoginUrl(array(
                'redirect_uri' => Router::url(array(
                    'controller' => 'users',
                    'action' => 'oauth_facebook',
                    'admin' => false
                ) , true) ,
                'scope' => 'email,publish_stream,offline_access'
            ));
            $this->set('redirect_url', $redirect_url);
            $this->set('authorize_name', 'facebook');
            $this->layout = 'redirect_page';
            $this->pageTitle.= ' - ' . __l('Facebook');
            $this->render('authorize');
        }
        // yahoo Login //
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'yahoo') {
            $this->request->data['User']['email'] = '';
            $this->request->data['User']['password'] = '';
            $this->request->data['User']['redirect_page'] = 'login';
            $this->request->data['User']['openid'] = 'http://yahoo.com/';
            $this->_openid();
        }
        // gmail Login //
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'gmail') {
            $this->request->data['User']['email'] = '';
            $this->request->data['User']['password'] = '';
            $this->request->data['User']['redirect_page'] = 'login';
            $this->request->data['User']['openid'] = 'https://www.google.com/accounts/o8/id';
            $this->_openid();
        }
        //open id component included
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Openid');
        $this->Openid = new OpenidComponent($collection);
        // handle the fields return from openid
        if (!empty($_GET['openid_identity'])) {
            $returnTo = Router::url(array(
                'controller' => 'users',
                'action' => 'login'
            ) , true);
            $response = $this->Openid->getResponse($returnTo);
            if ($response->status == Auth_OpenID_SUCCESS) {
                // Required Fields
                if ($user = $this->User->UserOpenid->find('first', array(
                    'conditions' => array(
                        'UserOpenid.openid' => $response->identity_url
                    )
                ))) {
                    //Already existing user need to do auto login
                    $this->request->data['User']['email'] = $user['User']['email'];
                    $this->request->data['User']['username'] = $user['User']['username'];
                    $this->request->data['User']['password'] = $user['User']['password'];
                    if ($this->Auth->login($this->request->data)) {
                        $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                        if ($redirectUrl = $this->Session->read('Auth.redirectUrl')) {
                            $this->Session->delete('Auth.redirectUrl');
                            $this->redirect(Router::url('/', true) . $redirectUrl);
                        } else {
                            $this->redirect(array(
                                'controller' => 'users',
                                'action' => 'dashboard',
                                'admin' => false,
                            ));
                        }
                    } else {
                        $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                        $this->redirect(array(
                            'controller' => 'users',
                            'action' => 'login'
                        ));
                    }
                } else {
                    $sregResponse = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
                    $sreg = $sregResponse->contents();
                    $temp['username'] = isset($sreg['nickname']) ? $sreg['nickname'] : '';
                    $temp['email'] = isset($sreg['email']) ? $sreg['email'] : '';
                    $temp['openid_url'] = $response->identity_url;
                    $respone_url = $response->identity_url;
                    $respone_url = parse_url($respone_url);
                    if (!empty($respone_url['host']) && $respone_url['host'] == 'www.google.com') {
                        $temp['is_gmail_register'] = 1;
                    } elseif (!empty($respone_url['host']) && $respone_url['host'] == 'me.yahoo.com') {
                        $temp['is_yahoo_register'] = 1;
                    }
                    $this->Session->write('openid', $temp);
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'register'
                    ));
                }
            } else {
                $this->Session->setFlash(__l('Authenticated failed or you may not have profile in your OpenID account'));
            }
        }
        // check open id is given or not
        if (!empty($this->request->data['User']['openid']) && preg_match('/^http?:\/\/+[a-z]/', $this->request->data['User']['openid'])) {
            // Fix for given both email and openid url in login page....
            $this->Auth->logout();
            $this->request->data['User']['email'] = '';
            $this->request->data['User']['password'] = '';
            $this->request->data['User']['redirect_page'] = 'login';
            $this->_openid();
        } else {
            // remember me for user
            if (!empty($this->request->data)) {
                $this->request->data['User'][Configure::read('user.using_to_login') ] = !empty($this->request->data['User'][Configure::read('user.using_to_login') ]) ? trim($this->request->data['User'][Configure::read('user.using_to_login') ]) : '';
                //Important: For login unique username or email check validation not necessary. Also in login method authentication done before validation.
                unset($this->User->validate[Configure::read('user.using_to_login') ]['rule3']);
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['passwd']);
                    if ($this->Auth->login($this->request->data)) {
                        $this->User->UserLogin->insertUserLogin($this->Auth->user('id'));
                        if ($this->Auth->user()) {
                            if (!empty($this->request->data['User']['is_remember']) and $this->request->data['User']['is_remember'] == 1) {
                                $this->Cookie->delete('User');
                                $cookie = array();
                                $remember_hash = md5($this->request->data['User'][Configure::read('user.using_to_login') ] . $this->request->data['User']['password'] . Configure::read('Security.salt'));
                                $cookie['cookie_hash'] = $remember_hash;
                                $this->Cookie->write('User', $cookie, true, $this->cookieTerm);
                                $this->User->updateAll(array(
                                    'User.cookie_hash' => '\'' . md5($remember_hash) . '\'',
                                    'User.cookie_time_modified' => '\'' . date('Y-m-d h:i:s') . '\'',
                                ) , array(
                                    'User.id' => $this->Auth->user('id')
                                ));
                            } else {
                                $this->Cookie->delete('User');
                            }
                            if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
                                $this->redirect(array(
                                    'controller' => 'users',
                                    'action' => 'stats',
                                    'admin' => true
                                ));
                            } else if (!empty($this->request->data['User']['f'])) {
                                $this->redirect(Router::url('/', true) . $this->request->data['User']['f']);
                            } else {
                                $this->redirect(array(
                                    'controller' => 'users',
                                    'action' => 'dashboard',
                                    'admin' => false,
                                ));
                            }
                        }
                    } else {
                        if (!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
                            $this->Session->setFlash(sprintf(__l('Sorry, login failed.  Your %s or password are incorrect') , Configure::read('user.using_to_login')) , 'default', null, 'error');
                        } else {
                            $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                        }
                    }
                }
            }
        }
        //When already logged user trying to access the login page we are redirecting to site home page
        if ($this->Auth->user()) {
            $this->redirect(Router::url('/', true));
        }
        if (!empty($this->request->data['User']['type']) && $this->request->data['User']['type'] == 'openid') {
            $this->request->params['named']['type'] = 'openid';
        }
        if (!empty($this->request->params['named']['type']) and $this->request->params['named']['type'] == 'openid') {
            if (!empty($this->request->data) && (empty($this->request->data['User']['openid']) || $this->request->data['User']['openid'] == "Click to Sign In")) {
                $this->User->validationErrors['openid'] = __l('Required');
                $this->Session->setFlash(__l('Invalid OpenID entered. Please enter valid OpenID') , 'default', null, 'error');
            }
            $this->render('login_ajax_openid');
        }
        $this->request->data['User']['passwd'] = '';
    }
    public function logout()
    {
        if ($this->Auth->user('fb_user_id')) {
            //$this->facebook->setSession(); // Quick fix for facebook redirect loop issue.
            $this->Session->write('is_fab_session_cleared', 1); // Quick fix for facebook redirect loop issue.
            $this->Session->delete('fbuser'); // Quick fix for facebook redirect loop issue.

        }
        if ($this->Session->check('is_fab_session_conected')) {
            //$this->Session->delete('is_fab_session_conected');

        }
        $this->Auth->logout();
        $this->Cookie->delete('User');
        $this->Cookie->delete('user_language');
        $this->Session->setFlash(__l('You are now logged out of the site.') , 'default', null, 'success');
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'login'
        ));
    }
    public function forgot_password()
    {
        $this->pageTitle = __l('Forgot Password');
        if ($this->Auth->user('id')) {
            $this->redirect(Router::url('/', true));
        }
        if (!empty($this->request->data)) {
            $this->User->set($this->request->data);
            //Important: For forgot password unique email id check validation not necessary.
            unset($this->User->validate['email']['rule3']);
            if ($this->User->validates()) {
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.email =' => $this->request->data['User']['email'],
                        'User.is_active' => 1
                    ) ,
                    'fields' => array(
                        'User.id',
                        'User.email'
                    ) ,
                    'recursive' => -1
                ));
                if (!empty($user['User']['email'])) {
                    $user = $this->User->find('first', array(
                        'conditions' => array(
                            'User.email' => $user['User']['email']
                        ) ,
                        'recursive' => -1
                    ));
                    $emailFindReplace = array(
                        '##USERNAME##' => $user['User']['username'],
                        '##FIRST_NAME##' => (isset($user['User']['first_name'])) ? $user['User']['first_name'] : '',
                        '##LAST_NAME##' => (isset($user['User']['last_name'])) ? $user['User']['last_name'] : '',
                        '##SITE_NAME##' => Configure::read('site.name') ,
                        '##SITE_URL##' => Router::url('/', true) ,
                        '##CONTACT_MAIL##' => Configure::read('EmailTemplate.admin_email') ,
                        '##RESET_URL##' => Router::url(array(
                            'controller' => 'users',
                            'action' => 'reset',
                            $user['User']['id'],
                            $this->User->getResetPasswordHash($user['User']['id'])
                        ) , true)
                    );
                    $email = $this->EmailTemplate->selectTemplate('Forgot Password');
                    $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                    $this->Email->to = $user['User']['email'];
                    $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                    $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                    $this->Session->setFlash(__l('An email has been sent with a link where you can change your password') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'login'
                    ));
                } else {
                    $this->Session->setFlash(sprintf(__l('There is no user registered with the email %s or admin deactivated your account. If you spelled the address incorrectly or entered the wrong address, please try again.') , $this->request->data['User']['email']) , 'default', null, 'error');
                }
            } else {
                $this->Session->setFlash(__l('Please enter valid email id.') , 'default', null, 'error');
            }
        }
    }
    public function reset($user_id = null, $hash = null)
    {
        $this->pageTitle = __l('Reset Password');
        if (!empty($this->request->data)) {
            if ($this->User->isValidResetPasswordHash($this->request->data['User']['user_id'], $this->request->data['User']['hash'])) {
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    $this->User->updateAll(array(
                        'User.password' => '\'' . $this->Auth->password($this->request->data['User']['passwd']) . '\'',
                    ) , array(
                        'User.id' => $this->request->data['User']['user_id']
                    ));
                    $this->Session->setFlash(__l('Your password has been changed successfully, Please login now') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'login'
                    ));
                }
                $this->request->data['User']['passwd'] = '';
                $this->request->data['User']['confirm_password'] = '';
            } else {
                $this->Session->setFlash(__l('Invalid change password request'));
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login'
                ));
            }
        } else {
            if (is_null($user_id) or is_null($hash)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $user_id,
                    'User.is_active' => 1,
                ) ,
                'recursive' => -1
            ));
            if (empty($user)) {
                $this->Session->setFlash(__l('User cannot be found in server or admin deactivated your account, please register again'));
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'register'
                ));
            }
            if (!$this->User->isValidResetPasswordHash($user_id, $hash)) {
                $this->Session->setFlash(__l('Invalid change password request'));
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login'
                ));
            }
            $this->request->data['User']['user_id'] = $user_id;
            $this->request->data['User']['hash'] = $hash;
        }
    }
    public function change_password($user_id = null)
    {
        $this->pageTitle = __l('Change Password');
        // No change password for facebook, twitter or openid //
        if ($this->Auth->user('is_openid_register') || $this->Auth->user('fb_user_id') || $this->Auth->user('twitter_user_id')) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                if ($this->User->updateAll(array(
                    'User.password' => '\'' . $this->Auth->password($this->request->data['User']['passwd']) . '\'',
                ) , array(
                    'User.id' => $this->request->data['User']['user_id']
                ))) {
                    if ($this->Auth->user('user_type_id') != ConstUserTypes::Admin && Configure::read('user.is_logout_after_change_password')) {
                        $this->Auth->logout();
                        $this->Session->setFlash(__l('Your password has been changed successfully. Please login now') , 'default', null, 'success');
                        $this->redirect(array(
                            'action' => 'login'
                        ));
                    } elseif ($this->Auth->user('user_type_id') == ConstUserTypes::Admin && $this->Auth->user('id') != $this->request->data['User']['user_id']) {
                        $user = $this->User->find('first', array(
                            'conditions' => array(
                                'User.id' => $this->request->data['User']['user_id']
                            ) ,
                            'fields' => array(
                                'User.username',
                                'User.email'
                            ) ,
                            'recursive' => -1
                        ));
                        $emailFindReplace = array(
                            '##PASSWORD##' => $this->request->data['User']['passwd'],
                            '##USERNAME##' => $user['User']['username'],
                            '##SITE_NAME##' => Configure::read('site.name') ,
                            '##SITE_LINK##' => Router::url('/', true)
                        );
                        $email = $this->EmailTemplate->selectTemplate('Admin Change Password');
                        // Send e-mail to users
                        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                        $this->Email->to = $user['User']['email'];
                        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                        $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                    }
                    $this->Session->setFlash(__l('Password has been changed successfully') , 'default', null, 'success');
                } else {
                    $this->Session->setFlash(__l('Password could not be changed') , 'default', null, 'error');
                }
                unset($this->request->data['User']['old_password']);
                unset($this->request->data['User']['passwd']);
                unset($this->request->data['User']['confirm_password']);
                if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
                    $this->redirect(array(
                        'action' => 'index'
                    ));
                }
            } else {
                $this->Session->setFlash(__l('Password could not be changed') , 'default', null, 'error');
            }
        } else {
            if (empty($user_id)) {
                $user_id = $this->Auth->user('id');
            }
        }
        if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin) {
            $conditions = array();
            $conditions[] = array(
                'OR' => array(
                    'User.fb_user_id IS NULL',
                    'User.fb_user_id' => 0
                )
            );
            $conditions[] = array(
                'User.is_openid_register' => 0,
                'User.is_yahoo_register' => 0,
                'User.is_gmail_register' => 0
            );
            $conditions[] = array(
                'OR' => array(
                    'User.twitter_user_id IS NULL',
                    'User.twitter_user_id' => 0
                )
            );
            $users = $this->User->find('list', array(
                'conditions' => $conditions,
            ));
            $this->set(compact('users'));
        }
        $this->request->data['User']['user_id'] = (!empty($this->request->data['User']['user_id'])) ? $this->request->data['User']['user_id'] : $user_id;
    }
    public function process_order($data)
    {
        $this->autoRender = false;
        if (empty($data)) {
            throw new NotFoundException(__l('Invalid request'));
        } else {
            $return = $this->Payment->processUserOrder($data['User']);
            if (empty($return['error'])) {
                if (!empty($data['User']['user_paypal_connection_id'])) {
                    $this->Payment->processUserWalletPayment($return['add_to_wallet_id']);
                }
            }
            return $return;
        }
    }
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'user_type_id',
            'filter_id',
			'main_filter_id',
            'q'
        ));
        $this->pageTitle = __l('Users');
        $conditions = array();
        if (!empty($this->request->params['named']['filter_id'])) {
            $this->request->data['User']['filter_id'] = $this->request->params['named']['filter_id'];
        }
        if (!empty($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 0;
            $this->pageTitle.= __l(' - Registered today');
        }
        if (!empty($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 7;
            $this->pageTitle.= __l(' - Registered in this week');
        }
        if (!empty($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(User.created) <= '] = 30;
            $this->pageTitle.= __l(' - Registered in this month');
        }
		if (!empty($this->request->params['named']['main_filter_id']) && $this->request->params['named']['main_filter_id'] == ConstUserTypes::Admin) {
                $conditions['User.user_type_id'] = ConstUserTypes::Admin;
                $this->pageTitle.= __l(' - Admin ');
            }
        if (!empty($this->request->data['User']['filter_id'])) {
            if ($this->request->data['User']['filter_id'] == ConstMoreAction::OpenID) {
                $conditions['User.is_openid_register'] = 1;
                $this->pageTitle.= __l(' - Registered through OpenID ');
            } elseif ($this->request->data['User']['filter_id'] == ConstMoreAction::Gmail) {
                $conditions['User.is_gmail_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Gmail ');
            } elseif ($this->request->data['User']['filter_id'] == ConstMoreAction::Yahoo) {
                $conditions['User.is_yahoo_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Yahoo ');
            } elseif ($this->request->data['User']['filter_id'] == ConstMoreAction::Active) {
                $conditions['User.is_active'] = 1;
                $this->pageTitle.= __l(' - Active ');
            } elseif ($this->request->data['User']['filter_id'] == ConstMoreAction::Site) {
                $conditions['User.is_yahoo_register'] = 0;
                $conditions['User.is_gmail_register'] = 0;
                $conditions['User.is_openid_register'] = 0;
                $conditions['User.is_facebook_register'] = 0;
                $conditions['User.is_twitter_register'] = 0;
				$conditions['User.user_type_id !='] = ConstUserTypes::Admin;
				$this->pageTitle.= __l(' - Site ');
            } elseif ($this->request->data['User']['filter_id'] == ConstMoreAction::Inactive) {
                $conditions['User.is_active'] = 0;
                $this->pageTitle.= __l(' - Inactive ');
            }else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Admin) {
                $conditions['User.user_type_id'] = ConstUserTypes::Admin;
                $this->pageTitle.= __l(' - Admin ');
            }elseif ($this->request->data['User']['filter_id'] == ConstMoreAction::Twitter) {
                $conditions['User.is_twitter_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Twitter ');
            } elseif ($this->request->data['User']['filter_id'] == ConstMoreAction::Facebook) {
                $conditions['User.is_facebook_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Facebook ');
            }
            $this->request->params['named']['filter_id'] = $this->request->data['User']['filter_id'];
        }
        if (!empty($this->request->params['named']['q'])) {
            $this->request->data['User']['q'] = $this->request->params['named']['q'];
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $this->request->data['User']['user_type_id'] = empty($this->request->params['named']['user_type_id']) ? ConstUserTypes::User : $this->request->params['named']['user_type_id'];
        // condition to list users only
        $this->User->recursive = 1;
        $this->paginate = array(
            'conditions' => $conditions,
            'fields' => array(
                'User.id',
                'User.created',
                'User.username',
                'User.email',
                'User.user_type_id',
                'User.is_active',
                'User.is_openid_register',
                'User.is_email_confirmed',
                'User.user_openid_count',
                'User.user_login_count',
                'User.ip_id',
                'User.user_view_count',
				'User.is_gmail_register',
				'User.is_yahoo_register',
				'User.is_facebook_register',
				'User.is_twitter_register',
				'User.available_balance_amount',
				'User.buyer_order_count',
				'User.product_count',
			    'User.last_logged_in_time',
    			'User.last_login_ip_id',
			    'User.user_address_count',
            ) ,
			'contain' => array(
				'UserType'=> array(
						'fields' => array(
							'UserType.name',
						)
					),
			'UserAvatar' => array(
                        'fields' => array(
                            'UserAvatar.id',
                            'UserAvatar.filename',
                            'UserAvatar.dir',
                            'UserAvatar.width',
                            'UserAvatar.height'
                        )
                    ) ,
			'UserProfile' => array(
                        'Country' => array(
                            'fields' => array(
                                'Country.name',
                                'iso2',
                            )
                        ) ,
                        'City' => array(
                            'fields' => array(
                                'City.name'
                            )
                        ) ,
                        'State' => array(
                            'fields' => array(
                                'State.name'
                            )
                        ) ,
                        
                    ) ,
			'LastLoginIp' => array(
                        'City' => array(
                            'fields' => array(
                                'City.name',
                            )
                        ) ,
                        'State' => array(
                            'fields' => array(
                                'State.name',
                            )
                        ) ,
                        'Country' => array(
                            'fields' => array(
                                'Country.name',
                                'Country.iso2',
                            )
                        ) ,
                        'fields' => array(
                            'LastLoginIp.ip',
                            'LastLoginIp.latitude',
                            'LastLoginIp.longitude',
                             'LastLoginIp.host'
                        )
                    ) ,
                    'Ip' => array(
                        'City' => array(
                            'fields' => array(
                                'City.name',
                            )
                        ) ,
                        'State' => array(
                            'fields' => array(
                                'State.name',
                            )
                        ) ,
                        'Country' => array(
                            'fields' => array(
                                'Country.name',
                                'Country.iso2',
                            )
                        ) ,
                       
                        'fields' => array(
                            'Ip.ip',
                            'Ip.latitude',
                            'Ip.longitude',
                        )
                    ) ,

			),
            'limit' => 15,
            'order' => array(
                'User.id' => 'desc'
            )
        );
        if (!empty($this->request->data['User']['q'])) {
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['User']['q']
            ));
        }

        $this->set('users', $this->paginate());
        $filters = $this->User->isFilterOptions;
        $moreActions = $this->User->moreActions;
        $userTypes = $this->User->UserType->find('list');
        if (!!empty($this->request->data['User']['user_type_id'])) {
            $this->request->data['User']['user_type_id'] = ConstUserTypes::User;
        }
        $this->set(compact('filters', 'moreActions', 'userTypes'));
        $this->set('active', $this->User->find('count', array(
            'conditions' => array(
                'User.is_active = ' => 1,
            )
        )));
        $this->set('inactive', $this->User->find('count', array(
            'conditions' => array(
                'User.is_active = ' => 0,
                'User.user_type_id != ' => ConstUserTypes::Admin
            )
        )));
        $this->set('site', $this->User->find('count', array(
            'conditions' => array(
                'User.is_facebook_register' => 0,
                'User.is_twitter_register' => 0,
                'User.is_openid_register' => 0,
                'User.is_yahoo_register' => 0,
                'User.is_gmail_register' => 0,
                'User.user_type_id' => ConstUserTypes::User
            ) ,
            'recursive' => -1
        )));
		// total admin list
        $this->set('admin_count', $this->User->find('count', array(
            'conditions' => array(
                'User.user_type_id' => ConstUserTypes::Admin,
            ) ,
            'recursive' => -1
        )));
        $this->set('openid', $this->User->find('count', array(
            'conditions' => array(
                'User.is_openid_register = ' => 1,
                'User.user_type_id != ' => ConstUserTypes::Admin
            )
        )));
		
        $this->set('facebook', $this->User->find('count', array(
            'conditions' => array(
                'User.is_facebook_register !=' => 0,
                'User.user_type_id = ' => ConstUserTypes::User
            ) ,
            'recursive' => -1
        )));
        $this->set('twitter', $this->User->find('count', array(
            'conditions' => array(
                'User.is_twitter_register !=' => 0,
                'User.user_type_id = ' => ConstUserTypes::User
            ) ,
            'recursive' => -1
        )));
        $this->set('gmail', $this->User->find('count', array(
            'conditions' => array(
                'User.is_gmail_register !=' => 0,
                'User.user_type_id = ' => ConstUserTypes::User
            ) ,
            'recursive' => -1
        )));
        $this->set('yahoo', $this->User->find('count', array(
            'conditions' => array(
                'User.is_yahoo_register !=' => 0,
                'User.user_type_id = ' => ConstUserTypes::User
            ) ,
            'recursive' => -1
        )));
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add New User/Admin');
        if (!empty($this->request->data)) {
            $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['passwd']);
            $this->request->data['User']['is_agree_terms_conditions'] = '1';
            $this->request->data['User']['is_email_confirmed'] = 1;
            $this->request->data['User']['is_active'] = 1;
            $this->request->data['User']['ip_id'] = $this->User->toSaveIp();
            $this->request->data['User']['host'] = gethostbyaddr($this->RequestHandler->getClientIP());
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                // Send mail to user to activate the account and send account details
                $emailFindReplace = array(
                    '##USERNAME##' => $this->request->data['User']['username'],
                    '##LOGINLABEL##' => ucfirst(Configure::read('user.using_to_login')) ,
                    '##USEDTOLOGIN##' => $this->request->data['User'][Configure::read('user.using_to_login') ],
                    '##SITE_NAME##' => Configure::read('site.name') ,
                    '##PASSWORD##' => $this->request->data['User']['passwd'],
                    '##SITE_URL##' => Router::url('/', true)
                );
                $email = $this->EmailTemplate->selectTemplate('Admin User Add');
                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                $this->Email->to = $this->request->data['User']['email'];
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->send(strtr($email['email_content'], $emailFindReplace));
                $this->Session->setFlash(__l('User has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                unset($this->request->data['User']['passwd']);
                $this->Session->setFlash(__l('User could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $userTypes = $this->User->UserType->find('list');
        $this->set(compact('userTypes'));
        if (!isset($this->request->data['User']['user_type_id'])) {
            $this->request->data['User']['user_type_id'] = ConstUserTypes::User;
        }
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		else{
			$this->_sendAdminActionMail($id, 'Admin User Delete');
		}
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__l('User has been deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }    
    public function admin_stats()
    {
        $this->pageTitle = __l('Snapshot');
		$this->set('pending', $this->User->UserCashWithdrawal->find('count', array(
            'conditions' => array(
                'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Pending,
            ) ,
            'recursive' => -1
        )));
		$this->set('pageTitle', $this->pageTitle);
    }
    public function admin_recent_users()
    {
        //recently registered users
        $recentUsers = $this->User->find('all', array(
            'conditions' => array(
                'User.is_active' => 1,
                'User.user_type_id != ' => ConstUserTypes::Admin
            ) ,
            'fields' => array(
                'User.user_type_id',
                'User.username',
                'User.id',
            ) ,
            'recursive' => -1,
            'limit' => 10,
            'order' => array(
                'User.id' => 'desc'
            )
        ));
        $this->set(compact('recentUsers'));
    }
    public function admin_online_users()
    {
        //online users
        $onlineUsers = $this->User->find('all', array(
            'conditions' => array(
                'User.is_active' => 1,
                'CkSession.user_id != ' => 0,
                'User.user_type_id != ' => ConstUserTypes::Admin
            ) ,
            'contain' => array(
                'CkSession' => array(
                    'fields' => array(
                        'CkSession.user_id'
                    )
                )
            ) ,
            'fields' => array(
                'DISTINCT User.username',
                'User.user_type_id',
                'User.id',
            ) ,
            'recursive' => 0,
            'limit' => 10,
            'order' => array(
                'User.last_logged_in_time' => 'desc'
            )
        ));
        $this->set(compact('onlineUsers'));
    }
    public function admin_change_password($user_id = null)
    {
        $this->setAction('change_password', $user_id);
    }
    public function admin_send_mail()
    {
        $this->pageTitle = __l('Send Email to users');
        if (!empty($this->request->data)) {
			$this->request->data['User']['send_to'] = trim($this->request->data['User']['send_to'], " ,");
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $conditions = $emails = array();
                $notSendCount = $sendCount = 0;
                if (!empty($this->request->data['User']['send_to'])) {
                    $sendTo = explode(',', $this->request->data['User']['send_to']);
                    foreach($sendTo as $email) {
                        $email = trim($email);
                        if (!empty($email)) {
                            if ($this->User->find('count', array(
                                'conditions' => array(
                                    'User.email' => $email
                                )
                            ))) {
                                $emails[] = $email;
                                $sendCount++;
                            } else {
                                $notSendCount++;
                            }
                        }
                    }
                }
                if (!empty($this->request->data['User']['bulk_mail_option_id'])) {
                    if ($this->request->data['User']['bulk_mail_option_id'] == 2) {
                        $conditions['User.is_active'] = 0;
                    }
                    if ($this->request->data['User']['bulk_mail_option_id'] == 3) {
                        $conditions['User.is_active'] = 1;
                    }
                    $users = $this->User->find('all', array(
                        'conditions' => $conditions,
                        'fields' => array(
                            'User.email'
                        ) ,
                        'recursive' => -1
                    ));
                    if (!empty($users)) {
                        $sendCount++;
                        foreach($users as $user) {
                            $emails[] = $user['User']['email'];
                        }
                    }
                }
                if (!empty($emails)) {
                    foreach($emails as $email) {
                        if (!empty($email)) {
                            $this->Email->from = Configure::read('EmailTemplate.no_reply_email');
                            $this->Email->to = trim($email);
                            $this->Email->subject = $this->request->data['User']['subject'];
                            $this->Email->sendAs = 'text';
                            $this->Email->send($this->request->data['User']['message'] . "\n\nThanks \n" . Configure::read('site.name') . "\n" . Router::url('/', true));
                        }
                    }
                }
                if ($sendCount && !$notSendCount) {
                    $this->Session->setFlash(__l('Email sent successfully') , 'default', null, 'success');
                } elseif ($sendCount && $notSendCount) {
                    $this->Session->setFlash(__l('Email sent successfully. Some emails are not sent') , 'default', null, 'success');
                } else {
                    $this->Session->setFlash(__l('No email send') , 'default', null, 'error');
                }
            } else {
                $this->Session->setFlash(__l('Mail could not be sent. Please, try again') , 'default', null, 'error');
            }
        }
        $bulkMailOptions = $this->User->bulkMailOptions;
        $this->set(compact('bulkMailOptions'));
    }
    public function admin_login()
    {
        $this->setAction('login');
    }
    public function admin_logout()
    {
        $this->setAction('logout');
    }
    public function _postJoinedStatus($user_id)
    {
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id = ' => $user_id
            ) ,
            'recursive' => -1
        ));
        App::import('Vendor', 'facebook/facebook');
        $this->facebook = new Facebook(array(
            'appId' => Configure::read('facebook.app_id') ,
            'secret' => Configure::read('facebook.fb_secrect_key') ,
            'cookie' => true
        ));
        if (!empty($user['User']['fb_user_id']) && !empty($user['User']['fb_access_token'])) {
            $facebook_dest_user_id = $user['fb_user_id'];
            $facebook_dest_access_token = $user['fb_access_token'];
            $message = 'Just joined';
            $url = Router::url('/', true);
            $message = $message . ' ' . $url;
            $description = '';
            try {
                $this->facebook->api('/' . $facebook_dest_user_id . '/feed', 'POST', array(
                    'access_token' => $facebook_dest_access_token,
                    'message' => $message,
                    'link' => $url,
                    'description' => $description
                ));
            }
            catch(Exception $e) {
            }
        }
        if (!empty($user['User']['twitter_access_token']) && !empty($user['User']['twitter_access_key'])) {
            $twitter_access_token = $user['User']['twitter_access_token'];
            $twitter_access_key = $user['User']['twitter_access_key'];
            $message = 'Just joined @' . Configure::read('site.name');
            $url = Router::url('/', true);
            $message = $message . ' ' . $url;
            $xml = $this->OauthConsumer->post('Twitter', $twitter_access_token, $twitter_access_key, 'https://twitter.com/statuses/update.xml', array(
                'status' => $message
            ));
            $xml = $this->OauthConsumer->post('Twitter', $twitter_access_token, $twitter_access_key, 'https://twitter.com/friendships/create/' . Configure::read('twitter.username') . '.xml');
        }
    }
    public function refer()
    {
        $cookie_value = $this->Cookie->read('refer_id');
        if (!empty($this->request->params['named']['r'])) {
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.username' => $this->request->params['named']['r']
                ) ,
                'recursive' => -1
            ));
            if (empty($user)) {
                $this->Session->setFlash(__l('Referrer username does not exist.') , 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'register'
                ));
            }
        }
        if (!empty($user) && (empty($cookie_value) || (!empty($cookie_value) && (!empty($user)) && ($cookie_value['refer_id'] != $user['User']['id'])))) {
            $this->Cookie->delete('refer_id');
            $this->Cookie->write('refer_id', $user['User']['id'], false, sprintf('+%s hours', Configure::read('invite.referral_cookie_expire_time')));
        }
        $this->redirect(array(
            'controller' => 'users',
            'action' => 'register'
        ));
    }
    public function oauth_facebook()
    {
        App::import('Vendor', 'facebook/facebook');
        $this->facebook = new Facebook(array(
            'appId' => Configure::read('facebook.app_id') ,
            'secret' => Configure::read('facebook.fb_secrect_key') ,
            'cookie' => true
        ));
        $this->autoRender = false;
        if (!empty($_REQUEST['code'])) {
            $tokens = $this->facebook->setAccessToken(array(
                'redirect_uri' => Router::url(array(
                    'controller' => 'users',
                    'action' => 'oauth_facebook',
                    'admin' => false
                ) , true) ,
                'code' => $_REQUEST['code']
            ));
            $fbuser = $this->Session->read('fbuser');
            $fb_return_url = $this->Session->read('fb_return_url');
            $this->redirect($fb_return_url);
        } else {
            $this->Session->setFlash(__l('Invalid Facebook Connection.') , 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'users',
                'action' => 'login'
            ));
        }
    }
    function admin_customise_force_login() 
    {
        $this->pageTitle = __l('Customize PrivateShop Login ');
		$this->loadModel('Attachment');
		$this->Attachment->Behaviors->attach('ImageUpload', Configure::read('force_login.file'));
        if (!empty($this->request->data)) {
            $this->Attachment->set($this->request->data);
            if ($this->Attachment->validates()) {
                $this->uploadImages($this->request->data);
            }
        }        
        $logo = $this->Attachment->find('first', array(
            'conditions' => array(
                'Attachment.foreign_id' => 1,
                'Attachment.class' => 'Login',
                'Attachment.description' => 'force_login_logo'
            ) ,
            'fields' => array(
                'Attachment.id',
                'Attachment.dir',
                'Attachment.filename',
                'Attachment.width',
                'Attachment.height',
                'Attachment.description'
            ) ,
            'recursive' => -1
        ));
        $image_options = array(
            'dimension' => 'original',
            'class' => '',
            'alt' => $logo['Attachment']['filename'],
            'title' => $logo['Attachment']['filename'],
            'type' => 'jpg'
        );
        $this->set('logo', $logo);
        $this->set('pageTitle', $this->pageTitle);
    }
    function uploadImages($data) 
    {
        $this->loadModel('Attachment');
        $is_success = 1;
		if(!empty($data['Attachment'])) {
			foreach($data['Attachment'] as $user_id => $is_checked) {
				if ($user_id != 'filename') {
					if ($is_checked['id']) {
						$this->Attachment->delete($user_id);
					}
					unset($data['Attachment'][$user_id]);
				}
			}
			$user = $this->Attachment->find('all', array(
				'conditions' => array(
					'Attachment.foreign_id' => 1,
					'Attachment.class' => 'Login'
				) ,
				'recursive' => -1
			));
		}
        if (!empty($data['Attachment']['filename'])) {
            $uploads = array(
                'force_login_logo' => $data['Attachment']['filename']
            );
            $this->Attachment->Behaviors->attach('ImageUpload', Configure::read('force_login.file'));
            foreach($uploads as $key => $upload) {
                if (!empty($upload['name'])) {
                    $attachment_id = $this->Attachment->find('first', array(
                        'conditions' => array(
                            'Attachment.foreign_id' => 1,
                            'Attachment.class' => 'Login',
                            'Attachment.description' => $key,
                        ) ,
                        'recursive' => -1
                    ));
                    if (!empty($upload['name'])) {
                        $upload['type'] = get_mime($upload['tmp_name']);
                    }
                    $ini_upload_error = 1;
                    if ($upload['error'] == 1) {
                        $ini_upload_error = 0;
                    }
                    $tmp['filename'] = $upload;
                    unset($upload);
                    if (!empty($attachment_id)) {
                        $tmp['id'] = $attachment_id['Attachment']['id'];
                    }
                    $upload['Attachment'] = $tmp;
					
                    if (!empty($upload['Attachment']['filename']['name']) || (!Configure::read('force_login.file.allowEmpty') && empty($upload['Attachment']['id']))) {
                        $this->Attachment->set($upload);
                    }
                    if ($this->Attachment->validates()) {
                        if (!empty($upload['Attachment']['filename']['name'])) {
                            $this->Attachment->create();
                            $upload['Attachment']['class'] = 'Login';
                            $upload['Attachment']['foreign_id'] = 1;
                            $upload['Attachment']['description'] = $key;
                            $this->Attachment->save($upload['Attachment']);
                            $this->Session->setFlash(__l('Force login background image uploaded.') , 'default', null, 'success');
                        }
                        unset($tmp);
                        $this->redirect(array(
                            'controller' => 'users',
                            'action' => 'customise_force_login/1',
                            'admin' => true
                        ));
                    } else {
                        $this->Attachment->validationErrors[$key] = __l('The submitted file extension is not permitted, only jpg,jpeg,gif,png permitted.');
                        $this->Session->setFlash(__l('Image not uploaded. Please try again ') , 'default', null, 'error');
                        return $is_success = 0;
                    }
                }
            }
            // End of foreach //
        }
    }
    public function admin_diagnostics()
    {
        $this->pageTitle = __l('Diagnostics');
        $this->set('pageTitle', $this->pageTitle);
    }
	 public function admin_export($hash = null)
    {
        Configure::write('debug', 0);
        $conditions = array();
       if (!empty($this->request->params['named']['filter_id'])) {
            if ($this->request->params['named']['filter_id'] == ConstMoreAction::OpenID) {
                $conditions['User.is_openid_register'] = 1;
                $this->pageTitle.= __l(' - Registered through OpenID ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Gmail) {
                $conditions['User.is_gmail_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Gmail ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Yahoo) {
                $conditions['User.is_yahoo_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Yahoo ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Active) {
                $conditions['User.is_active'] = 1;
                $this->pageTitle.= __l(' - Active ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Site) {
                $conditions['User.is_yahoo_register'] = 0;
                $conditions['User.is_gmail_register'] = 0;
                $conditions['User.is_openid_register'] = 0;
                $conditions['User.is_facebook_register'] = 0;
                $conditions['User.is_twitter_register'] = 0;
                $this->pageTitle.= __l(' - Site ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) {
                $conditions['User.is_active'] = 0;
                $this->pageTitle.= __l(' - Inactive ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Twitter) {
                $conditions['User.is_twitter_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Twitter ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Facebook) {
                $conditions['User.is_facebook_register'] = 1;
                $this->pageTitle.= __l(' - Registered through Facebook ');
            } else if ($this->request->params['named']['filter_id'] == ConstMoreAction::Admin) {
                $conditions['User.user_type_id'] = ConstUserTypes::Admin;
                $this->pageTitle.= __l(' - Admin ');
            } 
        }
		if (!empty($hash) && isset($_SESSION['user_export'][$hash])) {
            $user_ids = implode(',', $_SESSION['user_export'][$hash]);
            if ($this->User->isValidUserIdHash($user_ids, $hash)) {
                $conditions['User.id'] = $_SESSION['user_export'][$hash];
            } else {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        if (isset($this->request->params['named']['q']) && !empty($this->request->params['named']['q'])) {
            $conditions['User.username like'] = '%' . $this->request->params['named']['q'] . '%';
        }
        $users = $this->User->find('all', array(
            'conditions' => $conditions,
            'contain' => array(
                'RefferalUser',
                'Ip',
            ) ,
            'recursive' => 1
        ));
        if (!empty($users)) {
            foreach($users as $user) {
                $data[]['User'] = array(
                    __l('Username') => $user['User']['username'],
                    __l('Email') => $user['User']['email'],
                    __l('Login count') => $user['User']['user_login_count'],
                    __l('Email Confirmed') => !empty($user['User']['is_email_confirmed']) ? __l('Yes') : __l('No') ,
                    __l('Signup IP') => $user['Ip']['ip'],
                    __l('Created on') => $user['User']['created'],
                );
            }
        }
        $this->set('data', $data);
    }
	 public function admin_update()
    {
        if (!empty($this->request->data['User'])) {
            $r = $this->request->data[$this->modelClass]['r'];
            $actionid = $this->request->data[$this->modelClass]['more_action_id'];
            unset($this->request->data[$this->modelClass]['r']);
            unset($this->request->data[$this->modelClass]['more_action_id']);
            $userIds = array();
            foreach($this->request->data['User'] as $user_id => $is_checked) {
                if ($is_checked['id']) {
                    $userIds[] = $user_id;
                }
            }
            if ($actionid && !empty($userIds)) {
                if ($actionid == ConstMoreAction::Inactive) {
                    foreach($userIds as $key => $user_id) {
                        $update_data['User']['id'] = $user_id;
                        $update_data['User']['is_active'] = 0;
                        $this->User->set($update_data);
                        $this->User->save($update_data);
                        $this->_sendAdminActionMail($user_id, 'Admin User Deactivate');
                    }
                    $this->Session->setFlash(__l('Checked users has been inactivated') , 'default', null, 'success');
                } else if ($actionid == ConstMoreAction::Active) {
                    foreach($userIds as $key => $user_id) {
                        $update_data['User']['id'] = $user_id;
                        $update_data['User']['is_active'] = 1;
                        $this->User->set($update_data);
                        $this->User->save($update_data);
                        $this->_sendAdminActionMail($user_id, 'Admin User Active');
                    }
                    $this->Session->setFlash(__l('Checked users has been activated') , 'default', null, 'success');
                } else if ($actionid == ConstMoreAction::Delete) {
                    foreach($userIds as $key => $user_id) {
                        $this->_sendAdminActionMail($user_id, 'Admin User Delete');
                    }
                    $this->User->deleteAll(array(
                        'User.id' => $userIds
                    ));
                    $this->Session->setFlash(__l('Checked users has been deleted') , 'default', null, 'success');
                } else if ($actionid == ConstMoreAction::Export) {
                    $user_ids = implode(',', $userIds);
                    $hash = $this->User->getUserIdHash($user_ids);
                    $_SESSION['user_export'][$hash] = $userIds;
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'export',
                        'ext' => 'csv',
                        $hash,
                        'admin' => true
                    ));
                }
            }
        }
        $this->redirect(Router::url('/', true) . $r);
    }
	public function whois($ip = null)
    {
        if (!empty($ip)) {
            $this->redirect(Configure::read('site.look_up_url') . $ip);
        }
    }
}
?>
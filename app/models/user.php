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
class User extends AppModel
{
    public $name = 'User';
    public $displayField = 'username';
    var $aggregatingFields = array(
        'product_draft_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Product',
            'function' => 'COUNT(Product.user_id)',
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Draft,
            )
        ) ,
        'product_upcoming_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Product',
            'function' => 'COUNT(Product.user_id)',
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Upcoming,
            )
        ) ,
        'product_open_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Product',
            'function' => 'COUNT(Product.user_id)',
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Open,
            )
        ) ,
        'product_closed_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Product',
            'function' => 'COUNT(Product.user_id)',
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Closed,
            )
        ) ,
        'product_canceled_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Product',
            'function' => 'COUNT(Product.user_id)',
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Canceled,
            )
        ) ,
        'seller_order_count' => array(
            'mode' => 'real',
            'key' => 'owner_user_id',
            'foreignKey' => 'owner_user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.owner_user_id)',
        ) ,
        'seller_order_payment_pending_count' => array(
            'mode' => 'real',
            'key' => 'owner_user_id',
            'foreignKey' => 'owner_user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.owner_user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::PaymentPending,
            )
        ) ,
        'seller_order_inprocess_count' => array(
            'mode' => 'real',
            'key' => 'owner_user_id',
            'foreignKey' => 'owner_user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.owner_user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::InProcess,
            )
        ) ,
        'seller_order_expired_count' => array(
            'mode' => 'real',
            'key' => 'owner_user_id',
            'foreignKey' => 'owner_user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.owner_user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::Expired,
            )
        ) ,
        'seller_order_canceled_count' => array(
            'mode' => 'real',
            'key' => 'owner_user_id',
            'foreignKey' => 'owner_user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.owner_user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::CanceledAndRefunded,
            )
        ) ,
        'seller_order_shipped_count' => array(
            'mode' => 'real',
            'key' => 'owner_user_id',
            'foreignKey' => 'owner_user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.owner_user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::Shipped,
            )
        ) ,
        'seller_order_completed_count' => array(
            'mode' => 'real',
            'key' => 'owner_user_id',
            'foreignKey' => 'owner_user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.owner_user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::Completed,
            )
        ) ,
        'buyer_order_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.user_id)',
        ) ,
        'buyer_order_payment_pending_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::PaymentPending,
            )
        ) ,
        'buyer_order_inprocess_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::InProcess,
            )
        ) ,
        'buyer_order_expired_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::Expired,
            )
        ) ,
        'buyer_order_canceled_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::CanceledAndRefunded,
            )
        ) ,
        'buyer_order_shipped_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::Shipped,
            )
        ) ,
        'buyer_order_completed_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Order',
            'function' => 'COUNT(Order.user_id)',
            'conditions' => array(
                'Order.order_status_id' => ConstOrderStatus::Completed,
            )
        ) ,
    );
    public $belongsTo = array(
        'UserType' => array(
            'className' => 'UserType',
            'foreignKey' => 'user_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
			'Ip' => array(
            'className' => 'Ip',
            'foreignKey' => 'ip_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'LastLoginIp' => array(
            'className' => 'Ip',
            'foreignKey' => 'last_login_ip_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $hasMany = array(
        'UserOpenid' => array(
            'className' => 'UserOpenid',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'Transaction' => array(
            'className' => 'Transaction',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'UserLogin' => array(
            'className' => 'UserLogin',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'UserView' => array(
            'className' => 'UserView',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'MessageFilter' => array(
            'className' => 'MessageFilter',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'UserCashWithdrawal' => array(
            'className' => 'UserCashWithdrawal',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'CkSession' => array(
            'className' => 'CkSession',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'UserAddress' => array(
            'className' => 'UserAddress',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'Cart' => array(
            'className' => 'Cart',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
		'MoneyTransferAccount' => array(
            'className' => 'MoneyTransferAccount',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
        )
    );
    public $hasOne = array(
        'UserProfile' => array(
            'className' => 'UserProfile',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'UserAvatar' => array(
            'className' => 'UserAvatar',
            'foreignKey' => 'foreign_id',
            'dependent' => true,
            'conditions' => array(
                'UserAvatar.class' => 'UserAvatar',
            ) ,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'CkSession' => array(
            'className' => 'CkSession',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        // [seller] seller module count update
        if (Configure::read('module.seller')) {
            App::import('Model', 'Seller');
            $this->Seller = new Seller();
            $this->aggregatingFields = array_merge($this->aggregatingFields, $this->Seller->aggregatingFields);
        }
        $this->validate = array(
            'user_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'message' => __l('Required')
                )
            ) ,
            'username' => array(
                'rule5' => array(
                    'rule' => array(
                        'between',
                        4,
                        30
                    ) ,
                    'message' => __l('Must be between of 4 to 30 characters')
                ) ,
                'rule4' => array(
                    'rule' => 'alphaNumeric',
                    'message' => __l('Must be a valid character')
                ) ,
                'rule3' => array(
                    'rule' => 'isUnique',
                    'message' => __l('Username is already exist')
                ) ,
                'rule2' => array(
                    'rule' => array(
                        'custom',
                        '/^[a-zA-Z]/'
                    ) ,
                    'message' => __l('Must be start with an alphabets')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'email' => array(
                'rule3' => array(
                    'rule' => 'isUnique',
                    'on' => 'create',
                    'message' => __l('Email address is already exist')
                ) ,
                'rule2' => array(
                    'rule' => 'email',
                    'message' => __l('Must be a valid email')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'passwd' => array(
                'rule2' => array(
                    'rule' => array(
                        'minLength',
                        6
                    ) ,
                    'message' => __l('Must be at least 6 characters')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'old_password' => array(
                'rule3' => array(
                    'rule' => array(
                        '_checkOldPassword',
                        'old_password'
                    ) ,
                    'message' => __l('Your old password is incorrect, please try again')
                ) ,
                'rule2' => array(
                    'rule' => array(
                        'minLength',
                        6
                    ) ,
                    'message' => __l('Must be at least 6 characters')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'confirm_password' => array(
                'rule3' => array(
                    'rule' => array(
                        '_isPasswordSame',
                        'passwd',
                        'confirm_password'
                    ) ,
                    'message' => __l('New and confirm password field must match, please try again')
                ) ,
                'rule2' => array(
                    'rule' => array(
                        'minLength',
                        6
                    ) ,
                    'message' => __l('Must be at least 6 characters')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'captcha' => array(
                'rule2' => array(
                    'rule' => '_isValidCaptcha',
                    'message' => __l('Please enter valid captcha')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'is_agree_terms_conditions' => array(
                'rule' => array(
                    'equalTo',
                    '1'
                ) ,
                'message' => __l('You must agree to the terms and policies')
            ) ,
            'message' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
            'subject' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
            'send_to' => array(
                'rule1' => array(
                    'rule' => 'checkMultipleEmail',
                    'message' => __l('Must be a valid email') ,
                    'allowEmpty' => true
                )
            ) ,
            'amount' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
            'remarks' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
			'openid' => array(
				'rule2' => array(
                    'rule' => 'url',
                    'message' => __l('Please enter a vaild openID URL')
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )				
			)
        );
        // filter options in admin index
        $this->isFilterOptions = array(
            ConstMoreAction::Inactive => __l('Inactive') ,
            ConstMoreAction::Active => __l('Active') ,
            ConstMoreAction::OpenID => __l('OpenID') ,
            ConstMoreAction::Facebook => __l('Facebook') ,
            ConstMoreAction::Twitter => __l('Twitter')
        );
        $this->moreActions = array(
            ConstMoreAction::Inactive => __l('Inactive') ,
            ConstMoreAction::Active => __l('Active') ,
            ConstMoreAction::Delete => __l('Delete') ,
            ConstMoreAction::Export => __l('Export')
        );
        $this->bulkMailOptions = array(
            1 => __l('All Users') ,
            2 => __l('Inactive Users') ,
            3 => __l('Active Users')
        );
    }
    // check the new and confirm password
    public function _isPasswordSame($field1 = array() , $field2 = null, $field3 = null)
    {
        if ($this->data[$this->name][$field2] == $this->data[$this->name][$field3]) {
            return true;
        }
        return false;
    }
    // check the old password field with database
    public function _checkOldPassword($field1 = array() , $field2 = null)
    {
        $user = $this->find('first', array(
            'conditions' => array(
                'User.id' => $_SESSION['Auth']['User']['id']
            ) ,
            'recursive' => -1
        ));
        if (AuthComponent::password($this->data[$this->name][$field2]) == $user['User']['password']) {
            return true;
        }
        return false;
    }
    // hash for forgot password mail
    public function getResetPasswordHash($user_id = null)
    {
        return md5($user_id . '-' . date('y-m-d') . Configure::read('Security.salt'));
    }
    // check the forgot password hash
    public function isValidResetPasswordHash($user_id = null, $hash = null)
    {
        return (md5($user_id . '-' . date('y-m-d') . Configure::read('Security.salt')) == $hash);
    }
    // hash for activate mail
    public function getActivateHash($user_id = null)
    {
        return md5($user_id . '-' . Configure::read('Security.salt'));
    }
    // check the activate mail
    public function isValidActivateHash($user_id = null, $hash = null)
    {
        return (md5($user_id . '-' . Configure::read('Security.salt')) == $hash);
    }
    public function checkMultipleEmail()
    {
        $multipleEmails = explode(',', $this->data['User']['send_to']);
        foreach($multipleEmails as $key => $singleEmail) {
            if (!Validation::email(trim($singleEmail))) {
                return false;
            }
        }
        return true;
    }
    public function getUserIdHash($user_ids = null)
    {
        return md5($user_ids . Configure::read('Security.salt'));
    }
    public function isValidUserIdHash($user_ids = null, $hash = null)
    {
        return (md5($user_ids . Configure::read('Security.salt')) == $hash);
    }
    // hash for resend activate mail
    public function getResendActivateHash($user_id = null)
    {
        return md5(Configure::read('Security.salt') . '-' . $user_id);
    }
    // check the resend activate hash
    public function isValidResendActivateHash($user_id = null, $hash = null)
    {
        return (md5(Configure::read('Security.salt') . '-' . $user_id) == $hash);
    }
    public function checkUserBalance($user_id = null)
    {
        $user = $this->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ) ,
            'fields' => array(
                'User.available_balance_amount',
            ) ,
            'recursive' => -1
        ));
        if ($user['User']['available_balance_amount']) {
            return $user['User']['available_balance_amount'];
        }
        return false;
    }
    public function checkUsernameAvailable($username)
    {
        $user = $this->find('count', array(
            'conditions' => array(
                'User.username' => $username
            ) ,
            'recursive' => -1
        ));
        if (!empty($user)) {
            return false;
        }
        return $username;
    }
    public function _sendActivationMail($user_email, $user_id, $hash)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        $user = $this->find('first', array(
            'conditions' => array(
                'User.email' => $user_email
            ) ,
            'recursive' => -1
        ));
        $emailFindReplace = array(
            '##USERNAME##' => $user['User']['username'],
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##SITE_LINK##' => Router::url('/', true) ,
            '##ACTIVATION_URL##' => Router::url(array(
                'controller' => 'users',
                'action' => 'activation',
                $user_id,
                $hash
            ) , true) ,
        );
        $email = $this->EmailTemplate->selectTemplate('Activation Request');
        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
        $this->Email->to = $user_email;
        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
        if ($this->Email->send(strtr($email['email_content'], $emailFindReplace))) {
            return true;
        }
    }
    public function _sendWelcomeMail($user_id, $user_email, $username)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        $emailFindReplace = array(
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##USERNAME##' => $username,
            '##CONTACT_MAIL##' => Configure::read('EmailTemplate.admin_email') ,
            '##SITE_URL##' => Router::url('/', true) ,
        );
        $email = $this->EmailTemplate->selectTemplate('Welcome Email');
        $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
        $this->Email->to = $user_email;
        $this->Email->subject = strtr($email['subject'], $emailFindReplace);
        $this->Email->send(strtr($email['email_content'], $emailFindReplace));
    }
    public function _cartMapping($user_id)
    {
        $this->Cart->updateAll(array(
            'Cart.user_id' => $user_id
        ) , array(
            'Cart.session_id' => session_id() ,
            'Cart.user_id' => 0
        ));
    }
    public function _checkAmount($amount)
    {
        if (empty($amount)) {
            $this->validationErrors['amount'] = __l('Required');
        } elseif (!empty($amount) && !is_numeric($amount)) {
            $this->validationErrors['amount'] = __l('Amount should be numeric');
        } elseif (!empty($amount) && $amount < Configure::read('wallet.min_wallet_amount')) {
            $this->validationErrors['amount'] = __l('Amount should be greater than minimum amount');
        } elseif (Configure::read('wallet.max_wallet_amount') && !empty($amount) && $amount > Configure::read('wallet.max_wallet_amount')) {
            $this->validationErrors['amount'] = sprintf(__l('Given amount should lies from  %s%s to %s%s') , Configure::read('site.currency') , Configure::read('wallet.min_wallet_amount') , Configure::read('site.currency') , Configure::read('wallet.max_wallet_amount'));
        } else {
            return true;
        }
        return false;
    }
    public function _updateReferralAmount($user_id, $paid_date)
    {
        if (!empty($user_id)) {
            $user = $this->find('first', array(
                'conditions' => array(
                    'User.id' => $user_id
                ) ,
                'recursive' => -1
            ));			
            if (!empty($user) && !empty($user['User']['referred_by_user_id']) && empty($user['User']['is_referral_amount_given']) && ((strtotime($paid_date) -strtotime($user['User']['created'])) /(60*60)) <= Configure::read('invite.referral_purchase_time')) {
                $this->updateAll(array(
                    'User.available_balance_amount' => 'User.available_balance_amount + ' . Configure::read('invite.referral_amount') ,
                    'User.referred_amount' => 'User.referred_amount + ' . Configure::read('invite.referral_amount')
                ) , array(
                    'User.id' => $user['User']['referred_by_user_id']
                ));
                $data = array();
                $data['Transaction']['user_id'] = $user['User']['referred_by_user_id'];
                $data['Transaction']['foreign_id'] = ConstUserIds::Admin;
                $data['Transaction']['class'] = 'SecondUser';
                $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::ReferralAmount;
                $data['Transaction']['amount'] = Configure::read('invite.referral_amount');
                $data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::Wallet;
                $this->Transaction->create();
                $this->Transaction->save($data);
                $data = array();
                $data['User']['id'] = $user_id;
                $data['User']['is_referral_amount_given'] = 1;
                $this->save($data);
            }
        }
    }
    public function _updateReferralCount($referred_by_user_id)
    {
        $this->updateAll(array(
            'User.referred_by_user_count' => 'User.referred_by_user_count + 1'
        ) , array(
            'User.id' => $referred_by_user_id
        ));
    }
    public function _updateUserSaleFields($user_id)
    {
        $order_sale_arr = array(
            'cleared' => array(
                'Order.order_status_id' => array(
                    ConstOrderStatus::Completed,
                    ConstOrderStatus::Shipped,
                )
            ) ,
            'pending' => array(
                'Order.order_status_id' => array(
                    ConstOrderStatus::InProcess
                )
            ) ,
            'lost' => array(
                'Order.order_status_id' => array(
                    ConstOrderStatus::CanceledAndRefunded
                )
            )
        );
        foreach($order_sale_arr as $key => $conditions) {
            $conditions = array_merge($conditions, array(
                'OrderItem.user_id' => $user_id
            ));
            $order = $this->Order->OrderItem->find('all', array(
                'conditions' => $conditions,
                'fields' => array(
                    'SUM(OrderItem.price) as total_sales_amount',
                    'COUNT(OrderItem.id) as total_sales',
                    'OrderItem.id',
                    'OrderItem.user_id',
                    'OrderItem.price',
                    'Order.id',
                    'Order.order_status_id',
                ) ,
                'group' => 'Order.order_status_id, OrderItem.product_id',
                'recursive' => 0
            ));
            if (!empty($order['0'])) {
                $this->updateAll(array(
                    'User.sales_' . $key . '_amount' => "'" . $order['0']['0']['total_sales_amount'] . "'",
                    'User.sales_' . $key . '_count' => "'" . $order['0']['0']['total_sales'] . "'"
                ) , array(
                    'User.id' => $user_id
                ));
            }
        }
    }
}

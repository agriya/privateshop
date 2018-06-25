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
class Seller extends AppModel
{
    var $useTable = false;
    var $aggregatingFields = array(
        'product_awaiting_approval_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Product',
            'function' => 'COUNT(Product.user_id)',
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::AwaitingApproval,
            )
        ) ,
        'product_rejected_count' => array(
            'mode' => 'real',
            'key' => 'user_id',
            'foreignKey' => 'user_id',
            'model' => 'Product',
            'function' => 'COUNT(Product.user_id)',
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Rejected,
            )
        ) ,
    );
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'commission_percentage' => array(
                'rule2' => array(
                    'rule' => array(
                        'range',
                        -1,
                        101
                    ) ,
                    'allowEmpty' => false,
                    'message' => __l('Must be between of 0 to 100')
                ) ,
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Should be a number')
                ) ,
            ) ,
            'bonus_amount' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => true,
                    'message' => __l('Should be a number')
                ) ,
            ) ,
        );
        $this->moreActions = array(
            ConstMoreAction::Approved => __l('Approve') ,
            ConstMoreAction::Disapproved => __l('Unapprove') ,
        );
    }
    public function paidToSeller($order)
    {
        App::import('Model', 'User');
        $this->User = new User();
        $seller_amount = $order['Order']['amount']-$order['Order']['total_commission_amount'];
        $this->User->updateAll(array(
            'User.available_balance_amount' => 'User.available_balance_amount + ' . $seller_amount
        ) , array(
            'User.id' => $order['Order']['owner_user_id']
        ));
        $data = array();
        $data['Order']['id'] = $order['Order']['id'];
        $data['Order']['order_status_id'] = ConstOrderStatus::PaidToSeller;
        $this->save($data, false);
        $data = array();
        $data['Transaction']['user_id'] = $order['Order']['owner_user_id'];
        $data['Transaction']['foreign_id'] = $order['Order']['id'];
        $data['Transaction']['class'] = 'Order';
        $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::PaidToSeller;
        $data['Transaction']['amount'] = $seller_amount;
        $data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::Wallet;
        $this->User->Transaction->create();
        $this->User->Transaction->save($data);
    }
    //send buyers list to company user
    function _sendBuyersListToSeller($orderItems)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        if (!empty($orderItems)) {
            $userslist = '';
            $userslist.= '<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" border="0"  style="color:#666; font-size:11px;">';
            $userslist.= '<tr><th align="left" bgcolor="#BEE27B" style="color:#ffffff; font-size:14px;" rowspan="2">' . __l('Username') . '</th><th align="center" bgcolor="#BEE27B" style="color:#ffffff; font-size:14px;" colspan="2">' . __l('Coupon code') . '</th><th bgcolor="#BEE27B" style="color:#ffffff; font-size:14px;" rowspan="2">' . __l('Quantity') . '</th></tr><tr><th bgcolor="#BEE27B" style="color:#ffffff; font-size:14px;">' . __l('Top code') . '</th><th bgcolor="#BEE27B" style="color:#ffffff; font-size:14px;">' . __l('Bottom code') . '</th></tr>';
            foreach($orderItems as $orderItem) {
                if (!empty($orderItem['User'])) {
                    //form users list array
                    $userslist.= '<tr><td bgcolor="#FFFFFF" align="left">' . $orderItem['User']['username'] . '</td><td bgcolor="#FFFFFF" align="left">' . $orderItem['Order']['top_code'] . '</td><td bgcolor="#FFFFFF" align="left">' . $orderItem['Order']['bottom_code'] . '</td><td bgcolor="#FFFFFF" align="center">' . $orderItem['OrderItem']['quantity'] . '</td></tr>';
                }
                $userslist.= '</table>';
                App::import('Model', 'User');
                $this->User = new User();
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.id' => $orderItem['Product']['user_id'],
                    ) ,
                    'fields' => array(
                        'User.username',
                        'User.email',
                    ) ,
                    'recursive' => -1
                ));
                //send mail to company user
                $template = $this->EmailTemplate->selectTemplate('Buyers list for a product');
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true) ,
                    '##SITE_NAME##' => Configure::read('site.name') ,
                    '##USERNAME##' => $user['User']['username'],
                    '##PRODUCT_NAME##' => $orderItem['Product']['title'],
                    '##PRODUCT_URL##' => Router::url(array(
                        'controller' => 'products',
                        'action' => 'view',
                        $orderItem['Product']['slug'],
                        'admin' => false
                    ) , true) ,
                    '##CONTACT_URL##' => Router::url(array(
                        'controller' => 'contacts',
                        'action' => 'add',
                        'admin' => false
                    ) , true) ,
                    '##TABLE##' => $userslist,
                    '##FROM_EMAIL##' => ($template['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $template['from'],
                    '##SITE_LOGO##' => Router::url(array(
                        'controller' => 'img',
                        'action' => 'view',
                        'logo.gif',
                        'admin' => false
                    ) , false) ,
                );
                $message = strtr($template['email_content'], $emailFindReplace);
                $subject = strtr($template['subject'], $emailFindReplace);
                $this->Email->from = ($template['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
                $this->Email->to = $friend_email;
                $this->Email->subject = strtr($template['subject'], $emailFindReplace);
                $this->Email->send(strtr($template['email_content'], $emailFindReplace));
            }
        }
    }
    public function updateCommissionDetails($order)
    {
        App::import('Model', 'OrderItem');
        $this->OrderItem = new OrderItem();
        if (!empty($order['OrderItem'])) {
            foreach($order['OrderItem'] as $orderItem) {
                $condition = array();
                $condition['OrderItem.product_id'] = $orderItem['Product']['id'];
                $condition['Order.order_status_id'] = ConstOrderStatus::Completed;
                $orderReport = $this->OrderItem->find('all', array(
                    'conditions' => $condition,
                    'fields' => array(
                        'SUM(OrderItem.commission_amount) as total_commission_amount',
                        'OrderItem.id',
                        'OrderItem.product_id',
                        'OrderItem.price',
                        'Order.id',
                        'Order.order_status_id',
                    ) ,
                    'group' => 'Order.order_status_id, OrderItem.product_id',
                    'recursive' => 0
                ));
                $data = array();
                $data['Product']['id'] = $orderItem['Product']['id'];
                $data['Product']['total_commission_amount'] = $orderReport['0']['0']['total_commission_amount'];
                $this->OrderItem->Product->save($data, false);
            }
        }
    }
}

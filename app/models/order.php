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
class Order extends AppModel
{
    public $name = 'Order';
    public $actsAs = array(
        'Aggregatable',
    );
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ) ,
        'SecondUser' => array(
            'className' => 'SecondUser',
            'foreignKey' => 'owner_user_id	',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ) ,
        'PaymentGateway' => array(
            'className' => 'PaymentGateway',
            'foreignKey' => 'payment_gateway_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ) ,
        'OrderStatus' => array(
            'className' => 'OrderStatus',
            'foreignKey' => 'order_status_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
    );
    public $hasMany = array(
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'order_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'OrderItem' => array(
            'className' => 'OrderItem',
            'foreignKey' => 'order_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'user_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'payment_gateway_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            )
        );
        // [seller] seller more actions
        if (Configure::read('module.seller')) {
            $this->moreActions = array(
                ConstMoreAction::Shipped => __l('Shipped') ,
                ConstMoreAction::Completed => __l('Completed') ,
            );
        }
    }
    public function isQuantityPurchased($product_id, $is_gift = null)
    {
		if (!empty($is_gift)) {
            $conditions['OrderItem.is_send_as_gift'] = 1;
        }
        $conditions['OrderItem.product_id'] = $product_id;
        $conditions['Order.user_id'] = $_SESSION['Auth']['User']['id'];
        $conditions['Order.order_status_id'] = array(
            ConstOrderStatus::InProcess,
            ConstOrderStatus::Shipped,
            ConstOrderStatus::Completed,
            ConstOrderStatus::PaidToSeller,
        );
        $purchasedCount = $this->OrderItem->find('all', array(
            'conditions' => $conditions,
            'fields' => array(
                'SUM(OrderItem.quantity) as total_own_quantity'
            ) ,
            'group' => 'Order.order_status_id, OrderItem.product_id',
            'recursive' => 0
        ));
        if (!empty($purchasedCount[0][0]['total_own_quantity'])) {
            return $purchasedCount[0][0]['total_own_quantity'];
        } else {
            return 0;
        }
    }
    public function sendOrderNotification($mail_template, $order_id, $notificatoin_check)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Model', 'Message');
        $this->Message = new Message();
        App::import('Model', 'MessageContent');
        $this->MessageContent = new MessageContent();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        $order = $this->find('first', array(
            'conditions' => array(
                'Order.id' => $order_id,
            ) ,
            'contain' => array(
                'OrderItem' => array(
					 'ProductAttribute' => array(						
						'AttributesProductAttribute'
					),
                    'Product',
                ) ,
                'User',
                'OrderStatus',
            ) ,
            'recursive' => 3
        ));		
        /* Items table prepartion */
        $items = '';
        if (!empty($order['OrderItem'])) {
            $i = 1;
            foreach($order['OrderItem'] as $oitem) {
                $product = !empty($oitem['Product']['title'])?$oitem['Product']['title']:'';
                $site_currency = Configure::read('site.currency');
                $items.= "--------------------------------\n";
                $items.= 'Item No: ' . $i . "\n";
                $items.= 'Item: ' . $product . "\n";
				if(!empty($oitem['ProductAttribute']['AttributesProductAttribute'])){
					foreach ($oitem['ProductAttribute']['AttributesProductAttribute'] as $attribute){ 
						$attribute_detail = $this->getAttributeGroupDetails($attribute['attribute_id']);
						$items.= $attribute_detail['AttributeGroup']['display_name'].': ' . $attribute_detail['Attribute']['name'] . "\n";
					} 
				}
                $items.= 'Quantity: ' . $oitem['quantity'] . "\n";
                $items.= "Amount: $site_currency" . $oitem['total_price'] . "\n";
                $items.= '--------------------------------' . "\n";
                $i++;
            }
        }
        if (!empty($mail_template)) {
            $order_id = $order['Order']['id'];
            $template = $this->EmailTemplate->selectTemplate($mail_template);
            $message = '';
            $emailFindReplace = array(
                '##USERNAME##' => $order['User']['username'],
                '##TO_USER##' => $order['User']['username'],
                '##FROM_USER##' => $_SESSION['Auth']['User']['username'],
                '##ORDER##' => $order_id,
                '##ORDER_NO##' => $order_id,
                '##STATUS##' => !empty($order['OrderStatus']['name']) ? $order['OrderStatus']['name'] : '',
                '##ITEMS##' => $items,
                '##REMARKS##' => !empty($order['Order']['shipping_remarks']) ? $order['Order']['shipping_remarks'] : 'NIL',
                '##MESSAGE##' => $message,
                '##SITE_NAME##' => configure::read('site.name')
            );
            $message = strtr($template['email_content'], $emailFindReplace);
            $subject = strtr($template['subject'], $emailFindReplace);
            $to = array();
            $to[] = $order['User']['id'];
            $message_id = $this->Message->sendNotifications($to, $subject, $message, $order_id);
            if (Configure::read('messages.is_send_email_on_new_message')) {
                $content['subject'] = $subject;
                $content['message'] = $message;
                if (!empty($order['User']['email'])) {
                    if ($this->_checkUserNotifications($order['User']['id'], $notificatoin_check, 0)) {
                        $this->_sendAlertOnNewMessage($order['User']['email'], $content, $message_id, 'Order Alert Mail');
                    }
                }
            }
        }
    }
    public function sendOrderInvoice($order_id)
    {
		App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Model', 'Message');
        $this->Message = new Message();
        App::import('Model', 'MessageContent');
        $this->MessageContent = new MessageContent();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        $order = $this->find('first', array(
            'conditions' => array(
                'Order.id' => $order_id,
            ) ,
            'contain' => array(
                'OrderItem' => array(
                    'Product',
                ) ,
                'User',
                'SecondUser',
                'PaymentGateway',
                'OrderStatus',
            ) ,
            'recursive' => 2
        ));
        $order_id = $order['Order']['id'];
        $template = $this->EmailTemplate->selectTemplate('Invoice');
        $message = '';
        if ($order['Order']['is_shipped_order']) {
            if ($order['Order']['order_status_id'] == ConstOrderStatus::Shipped) {
                $shipping_status = __l('Shipped');
            } else {
                $shipping_status = __l('Unshipped');
            }
        } else {
            $shipping_status = __l('No Shipping');
        }
        $second_user = Router::url(array(
            'controller' => 'users',
            'action' => 'view',
            $order['SecondUser']['username'],
            'admin' => false
        ) , true);
        $buyer_link = Router::url(array(
            'controller' => 'users',
            'action' => 'view',
            $order['User']['username'],
            'admin' => false
        ) , true);
        if ($order['Order']['order_status_id'] == ConstOrderStatus::Shipped || $order['Order']['order_status_id'] == ConstOrderStatus::Completed || $order['Order']['order_status_id'] == ConstOrderStatus::InProcess) {
            if (Configure::read('barcode.is_barcode_enabled') == 1) {
                $barcode_width = Configure::read('barcode.width');
                $barcode_height = Configure::read('barcode.height');
                if (Configure::read('barcode.symbology') == 'qr') {
                    $qr_site_url = Router::url(array(
                        'controller' => 'orders',
                        'action' => 'check_qr',
                        $order['Order']['top_code'],
                        $order['Order']['bottom_code'],
                        'admin' => false
                    ) , true);
                    $QR = '<img src="http://chart.apis.google.com/chart?cht=qr&chs=' . $barcode_width . 'x' . $barcode_height . '&chl=' . $qr_site_url . '" alt = "[Image: Order qr code]"/>';
                }
            }
        }
        $ship_to = '';
        $ship_to.= '<p>' . $order['User']['username'] . '</p>';
        $ship_to.= '<p>' . $order['Order']['address'] . '</p>';
        $ship_to.= '<p>' . $order['Order']['zipcode'] . '</p>';
        $item_price = 0;
        $ship_price = 0;
        $order_item = '';
        $email = $order['User']['email'];
		$print_url=Router::url(array('controller'=> 'orders', 'action' => 'view', $order['Order']['id'], 'type' => 'print', 'admin' => false),true);
        foreach($order['OrderItem'] as $orderItem) {
            if ($orderItem['is_send_as_gift']) {
                $email = $orderItem['gift_friend_email'];
            }
            $item_price = $item_price+($orderItem['price']*$orderItem['quantity']);
            $ship_price = $ship_price+$orderItem['shipping_price'];
            $order_item.= '<tr><td style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 12px; padding:10px; border-bottom:1px solid #CDCDCD;">' . $orderItem['Product']['title'] . '</td><td style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 12px; padding:10px; border-bottom:1px solid #CDCDCD;"><span title="five" class="c">' . $orderItem['quantity'] . '</span></td><td style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 12px; padding:10px; border-bottom:1px solid #CDCDCD;"><span title="one thousand five hundred dollars" class="c cr">' . $orderItem['price'] . '</span></td>';
            $order_item.= '<td style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 12px; padding:10px; border-bottom:1px solid #CDCDCD;">';
            if (Configure::read('module.credits') && $orderItem['credits']) {
                $order_item.= $orderItem['credits'];
            }
            $order_item.= '</td>';
            $order_item.= '<td style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 12px; padding:10px; border-bottom:1px solid #CDCDCD;"><span title="seven thousand five hundred dollars" class="c cr">' . $orderItem['total_price'] . '</td></tr>';
        }
        $colspan = 5;
        if (Configure::read('module.credits')) {
            $colspan = $colspan+1;
        }
        $order_item.= '<tr><td align="right" class="borderright invoiceTotal" colspan="'.$colspan.'" style=" border-bottom:1px solid #CDCDCD;"><table border="0" cellspacing="0" cellpadding="0" summary="Invoive"><tr><td width="150" align="right" style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 15px; padding:15px 10px 10px;">' . __l('Item total:') . '</td><td width="120" style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 15px; font-weight:bold; padding:15px 10px 10px; ">' . configure::read('site.currency') . $item_price . '</td></tr><tr><td align="right" style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 15px; padding:10px 10px 15px;">'. __l('Grand Total') . '</td><td width="120" style="font-family:Arial, Helvetica, sans-serif; color: #333; font-size: 15px; font-weight:bold; padding:10px 10px 15px;">'. configure::read('site.currency') . $order['Order']['amount'] . '</td></tr></table></td></tr>';
        $emailFindReplace = array(
            '##ORDER##' => $order_id,
            '##ORDER_DATE##' => date('M d, Y', strtotime($order['Order']['created'])) ,
            '##TOP_CODE##' => $order['Order']['top_code'],
            '##BOTTOM_CODE##' => $order['Order']['bottom_code'],
            '##PAYMENT_METHOD##' => $order['PaymentGateway']['name'],
            '##PAYMENT_STATUS##' => ($order['Order']['order_status_id'] == ConstOrderStatus::PaymentPending) ? __l('Payment Pending') : __l('Payment Made') ,
            '##SHIPPING_STATUS##' => $shipping_status,
            '##SELLER##' => ($order['SecondUser']['user_type_id'] == ConstUserTypes::Admin) ? Configure::read('site.name') : '<a href="' . $second_user . '">' . $order['SecondUser']['username'] . '</a>',
            '##BUYER##' => '<a href="' . $buyer_link . '">' . $order['User']['username'] . '</a>',
			'##PRINT_ICON##' => '<a href="'.$print_url.'" title="Print" target="_blank" style="color:##2E6AB1; font-size:10px; text-decoration:none;"><img src="'.Router::url('/',true).'img/icon-print.png" width="16" height="16" alt="[image: Print]" style="vertical-align:middle" border="0" />'.__l('Print').'</a>',
            '##QR_CODE##' => $QR,
            '##SHIPPING_TO##' => $ship_to,
            '##ORDER_ITEMS##' => $order_item,
            '##SITE_NAME##' => configure::read('site.name')
        );
		if(!empty($template)){
        $message = strtr($template['email_content'], $emailFindReplace);
        $subject = strtr($template['subject'], $emailFindReplace);
        $to = array();
        $to[] = $order['User']['id'];
        $message_id = $this->Message->sendNotifications($to, $subject, $message, $order_id);
        if (Configure::read('messages.is_send_email_on_new_message')) {
            $content['subject'] = $subject;
            $content['message'] = $message;
            if (!empty($order['User']['email'])) {
                $this->_sendAlertOnNewMessage($order['User']['email'], $content, $message_id, 'Order Alert Mail');
            }
        }
	}
    }

	public function sendDownloadAlert($orderItem,$user_id,$friend_email)
    {
		App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Model', 'Message');
        $this->Message = new Message();
        App::import('Model', 'MessageContent');
        $this->MessageContent = new MessageContent();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Email');
        $this->Email = new EmailComponent($collection);
        $user = $this->OrderItem->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
            ) ,
            'recursive' => -1
        ));
        $template = $this->EmailTemplate->selectTemplate('Send to friend for download alert');
		$download_url=Router::url(array('controller'=>'products','action'=>'download',$orderItem['id']),true);
        $emailFindReplace = array(
            '##MESSAGE##' => $orderItem['gift_wrap_note'],
			'##USERNAME##' => $user['User']['username'],
            '##URL##' => $download_url,
            '##SITE_URL##' => Router::url('/', true) ,
            '##SITE_NAME##' => configure::read('site.name')
        );
      if(!empty($template)){
        $message = strtr($template['email_content'], $emailFindReplace);
        $subject = strtr($template['subject'], $emailFindReplace);
        $this->Email->from = ($template['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
        $this->Email->to = $friend_email;
        $this->Email->subject = strtr($template['subject'], $emailFindReplace);
        $this->Email->send(strtr($template['email_content'], $emailFindReplace));
      }
    }
    public function order_completed_status()
    {
		$conditions = array();
        $conditions['Order.order_status_id'] = ConstOrderStatus::Shipped;
        $conditions['TO_DAYS(NOW()) - TO_DAYS(created) >= '] = Configure::read('order.auto_complete_threshold_limit');
        $orders = $this->find('all', array(
            'conditions' => $conditions,
            'contain' => array(
                'OrderItem' => array(
                    'Product'
                ) ,
            ) ,
            'recursive' => 2
        ));
        // [seller] import seller model
        if (Configure::read('module.seller')) {
            App::import('Model', 'Seller');
            $this->Seller = new Seller();
        }
        if (!empty($orders)) {
            foreach($orders as $order) {
                //update state as complete
                $data = array();
                $data['Order']['id'] = $order['Order']['id'];
                $data['Order']['order_status_id'] = ConstOrderStatus::Completed;
				$data['Order']['paid_date'] = $order['Order']['paid_date'];
                $this->save($data, false);
                // [seller] commission_amount update in products & paid to seller
                if (Configure::read('module.seller')) {
                    $this->Seller->updateCommissionDetails($order);
                    $this->Seller->paidToSeller($order);
               }
			   if (Configure::read('invite.is_referral_system_enabled') && $data['Order']['order_status_id'] == ConstOrderStatus::Completed) {
                $this->User->_updateReferralAmount($order['Order']['user_id'], $data['Order']['paid_date']);
            }
            }
        }
    }
    public function updateOrder($order)
    {
        $this->log('order details in order model');
        $this->log($order);
		if (!empty($order)) {
            $data['Order']['id'] = $order['Order']['id'];
            if (!empty($order['Order']['is_shipped_order'])) {
                $data['Order']['order_status_id'] = ConstOrderStatus::InProcess;
            } else {
                $data['Order']['order_status_id'] = ConstOrderStatus::Completed;
            }
            $data['Order']['top_code'] = $this->_uuid();
            $data['Order']['bottom_code'] = $this->_unum();
            $data['Order']['paid_date'] = date('Y-m-d H:i:s');
            $this->log('Data');
            $this->log($data);
            if ($this->save($data)) {
                if (!empty($order['OrderItem'])) {
                    foreach($order['OrderItem'] as $orderItem) {
						if(!empty($orderItem['product_attribute_id'])){
							$this->OrderItem->ProductAttribute->updateAll(array(
								'ProductAttribute.sold_quantity' => 'ProductAttribute.sold_quantity + ' . $orderItem['quantity'],
							) , array(
								'ProductAttribute.id' => $orderItem['product_attribute_id']
							));
						}
                        $product_status['id'] = $orderItem['id'];
						if($orderItem['Product']['is_having_file_to_download'])
						{
                          $product_status['status_id'] = ConstOrderStatus::Completed;
                        }
                        else
                        {
                           if (!empty($order['Order']['is_shipped_order'])) {
                             $product_status['status_id'] = ConstOrderStatus::InProcess;
                           } else {
                             $product_status['status_id'] = ConstOrderStatus::Completed;
                           }
                        }
                        $this->OrderItem->Save($product_status);
                        $this->OrderItem->Product->updateAll(array(
                            'Product.sold_quantity' => 'Product.sold_quantity + ' . $orderItem['quantity'],
                        ) , array(
                            'Product.id' => $orderItem['product_id']
                        ));
                        $this->OrderItem->Product->_updateProductSaleFields($orderItem['product_id']);
                        $this->User->_updateUserSaleFields($orderItem['user_id']);
						if (!empty($orderItem['Product']['is_having_file_to_download']) && !$orderItem['is_downloaded'] && $orderItem['is_send_as_gift']) {
                            $order_data['id'] = $order['Order']['id'];
                            $order_data['order_status_id'] = ConstOrderStatus::Completed;
                            $this->save($order_data);
                            $this->sendDownloadAlert($orderItem,$orderItem['user_id'],$orderItem['gift_friend_email']);
						}

                    }
                }
            }
            if (Configure::read('invite.is_referral_system_enabled') && $data['Order']['order_status_id'] == ConstOrderStatus::Completed) {
                $this->User->_updateReferralAmount($order['Order']['user_id'], $data['Order']['paid_date']);
            }
            $this->sendOrderNotification('New order notification', $order['Order']['id'],	ConstUserNotification::PurchasedItem);
            $this->sendOrderInvoice($order['Order']['id']);
        }
    }
    public function updateCancelOrder($order)
    {
		if (!empty($order)) {
            $data['Order']['id'] = $order['Order']['id'];
            $data['Order']['order_status_id'] = ConstOrderStatus::CanceledAndRefunded;
            $data['Order']['canceled_date'] = date('Y-m-d H:i:s');
            if ($this->save($data)) {
                if (!empty($order['OrderItem'])) {
                    foreach($order['OrderItem'] as $orderItem) {
						if(empty($orderItem['Product']['is_having_file_to_download'])){
							if(!empty($orderItem['product_attribute_id'])){
								$this->OrderItem->ProductAttribute->updateAll(array(
									'ProductAttribute.sold_quantity' => 'ProductAttribute.sold_quantity - ' . $orderItem['quantity'],
								) , array(
									'ProductAttribute.id' => $orderItem['product_attribute_id']
								));
							}
							$this->OrderItem->Product->updateAll(array(
								'Product.sold_quantity' => 'Product.sold_quantity - ' . $orderItem['quantity'],
							) , array(
								'Product.id' => $orderItem['product_id']
							));
						}
                        $this->OrderItem->Product->_updateProductSaleFields($orderItem['product_id']);
                        $this->User->_updateUserSaleFields($orderItem['user_id']);
                    }
                }
                // [seller] commission_amount update in products
                if (Configure::read('module.seller')) {
                    $this->Seller->updateCommissionDetails($order);
                }
            }
            $this->sendOrderNotification('Canceled and Refunded', $order['Order']['id'], ConstUserNotification::RefundedItem);
        }
    }
}

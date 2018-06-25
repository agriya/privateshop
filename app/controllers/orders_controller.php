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
class OrdersController extends AppController
{
    public $name = 'Orders';

    public function index()
    {
        $this->pageTitle = __l('My Purchases');
		$count_condition = $conditions = array();
		// [seller] My order listing
        if ((!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'manageorders') && $this->Auth->user('user_type_id') != ConstUserTypes::Admin && !Configure::read('module.seller')) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->Order->recursive = 2;
        if (!empty($this->request->params['named']['status_filter_id'])) {
            if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::PaymentPending) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::PaymentPending;
                $this->pageTitle.= __l(' - Payment Pending ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::InProcess) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::InProcess;
                $this->pageTitle.= __l(' - In Process ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::Expired) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::Expired;
                $this->pageTitle.= __l(' - Expired ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::CanceledAndRefunded) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::CanceledAndRefunded;
                $this->pageTitle.= __l(' - Canceled ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::Shipped) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::Shipped;
                $this->pageTitle.= __l(' - Shipped ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::Completed) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::Completed;
                $this->pageTitle.= __l(' - Completed ');
            } 
        }
		if(empty($this->request->params['named']['product_id']) && $this->Auth->user('user_type_id') != ConstUserTypes::Admin){
			if ((!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'manageorders')) {
				$this->pageTitle = __l('Manage Orders');
				$count_condition['Order.owner_user_id'] = $conditions['Order.owner_user_id'] = $this->Auth->user('id');
			} else {
				$count_condition['Order.user_id'] = $conditions['Order.user_id'] = $this->Auth->user('id');
			}
		}
		if(!empty($this->request->params['named']['product_id']) && $this->Auth->user('user_type_id') == ConstUserTypes::Admin){
			$orderIds = $this->Order->OrderItem->find('list', array(
				'conditions' => array(
					'OrderItem.product_id' => $this->request->params['named']['product_id']
				),
				'fields' => array(
					'OrderItem.order_id'
				)
			));
			
			$orderIds = array_values($orderIds);			
			$conditions['Order.id'] = $orderIds;
			$count_condition['Order.id'] = $orderIds;
		}		
		
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.username',
                        'User.user_type_id',
                    ) ,
                ) ,
                'OrderStatus',
                'OrderItem' => array(
                    'ProductAttribute' => array(						
						'AttributesProductAttribute'
					),
					'Product' => array(
                        'fields' => array(
                            'Product.id',
                            'Product.title',
                            'Product.slug',
                            'Product.is_having_file_to_download',
                            'Product.is_credit_product',
                        ) ,
                    ) ,
                ) ,
            ) ,			
			'order' => array(
				'Order.id' => 'desc'
			)
        );
			$this->set('expired_count', $this->Order->find('count', array(
                'conditions' => array(
                    'Order.order_status_id' => ConstOrderStatus::Expired ,
     				$count_condition
                ) ,
                'recursive' => -1
            )));
		$this->set('payment_pending_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::PaymentPending ,
			$count_condition
		) ,
		'recursive' => -1
    	)));
		$this->set('in_process_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::InProcess ,
			$count_condition
		) ,
		'recursive' => -1
    	)));
		$this->set('canceled_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::CanceledAndRefunded ,
			$count_condition
		) ,
		'recursive' => -1
    	)));
		$this->set('shipped_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::Shipped ,
			$count_condition
		) ,
		'recursive' => -1
    	)));
		$this->set('completed_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::Completed ,
			$count_condition
		) ,
		'recursive' => -1
    	)));
        $moreActions = $this->Order->moreActions;
        unset($moreActions[25]); // removed the completed status
		if (!empty($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id'] == ConstOrderStatus::Shipped) {
		$moreActions = array(
		ConstMoreAction::Completed => __l('Completed')
		);
		} elseif (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::PaymentPending || $this->request->params['named']['status_filter_id'] == ConstOrderStatus::Expired)) {
		$moreActions = array(
		ConstMoreAction::Delete => __l('Delete')
		);
		} elseif (empty($this->request->params['named']['status_filter_id']) || (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::InProcess))) {
		$moreActions = array(
		ConstMoreAction::GenerateAddress => __l('Generate Address Label') ,
		ConstMoreAction::Shipped => __l('Shipped')
		);
		}
        $orderStatuses = $this->Order->OrderStatus->find('list');
        foreach($orderStatuses as $order_status_id => $order_status_name) {
			$count_condition['Order.order_status_id'] = $order_status_id;
            $this->set('order_status_' . $order_status_id, $this->Order->find('count', array(
                'conditions' => $count_condition,
                'recursive' => -1
            )));
        }
		
        $this->set(compact('moreActions', 'orderStatuses'));
        $this->set('orders', $this->paginate());
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'manageorders') {
            $this->autoRender = false;
            $this->render('manage_orders');
        }
    }
    public function view($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle = __l('Invoice - #') . $id;
        $conditions['Order.id'] = $id;
		if($this->Auth->user('user_type_id') != ConstUserTypes::Admin){
			$conditions['Order.user_id'] = $this->Auth->user('id');
		}
        $order = $this->Order->find('first', array(
            'conditions' => $conditions,
            'contain' => array(
                'User' => array(
			    	'UserAddress',
			        'fields' => array(
                        'User.id',
                        'User.username',
                        'User.user_type_id',
                    ) ,
                ) ,
                'SecondUser' => array(
                    'fields' => array(
                        'SecondUser.id',
                        'SecondUser.user_type_id',
                        'SecondUser.username'
                    )
                ) ,
                'PaymentGateway' => array(
                    'fields' => array(
                        'PaymentGateway.id',
                        'PaymentGateway.name',
                    ) ,
                ) ,
                'OrderStatus',
                'OrderItem' => array(
					'ProductAttribute' => array(						
						'AttributesProductAttribute'
					),
                    'Product' => array(
                        'fields' => array(
                            'Product.id',
                            'Product.title',
                            'Product.slug',
                        ) ,
                    ) ,
                ) ,
            )
        ));
        if (empty($order)) {
            throw new NotFoundException(__l('Invalid request'));
        }
		if ($this->Auth->user('user_type_id') != ConstUserTypes::Admin && ($order['Order']['order_status_id'] == ConstOrderStatus::Expired || $order['Order']['order_status_id'] == ConstOrderStatus::PaymentPending)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'print') {
            $this->layout = 'print';
        }
        $this->set('order', $order);
    }
	//[Seller] Shipped from inprocess
    public function shipped($orders_list = null)
    {
        if (empty($orders_list)) {
            $orders_list = $this->Session->read('shipped_list.data');
        }
        if (!empty($orders_list)) {
            $orders = $this->Order->find('all', array(
                'conditions' => array(
                    'Order.id' => $orders_list
                ) ,
                'recursive' => -1
            ));
            $this->set('orders', $orders);
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($orders)) {
            foreach($orders as $order) {
                $order_id = $order['Order']['id'];
                if (!empty($order_id)) {
                    $data = array();
                    $data['Order']['id'] = $order_id;
                    $data['Order']['shipping_remarks'] = $order['Order']['shipping_remarks'];
                    $data['Order']['shipped_date'] = date('Y-m-d h:i:s');
                    $data['Order']['order_status_id'] = ConstOrderStatus::Shipped;
                    $this->Order->save($data, false);
                    if (Configure::read('invite.is_referral_system_enabled')) {
                        $this->Order->User->_updateReferralAmount($order['Order']['user_id'], $order['Order']['paid_date']);
                    }
                    $this->Order->sendOrderNotification('Order status', $order_id, ConstUserNotification::ShippedItem);
                    $orderItem = $this->Order->find('first', array(
                        'conditions' => array(
                            'Order.id' => $order_id,
                        ) ,
                        'contain' => array(
                            'OrderItem'
                        ) ,
                        'recursive' => 2
                    ));
                    if (!empty($order['OrderItem'])) {
                        foreach($order['OrderItem'] as $orderItem) {
                            $this->Order->OrderItem->Product->_updateProductSaleFields($orderItem['product_id']);
                            $this->Order->User->_updateUserSaleFields($orderItem['user_id']);
                        }
                    }
                }
            }
            $this->Session->delete('shipped_list');
            $this->Session->setFlash(__l('Order status changed into shipped') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'orders',
                'action' => 'index',
                'type' => 'manageorders',
                'admin' => false
            ));
        }
    }
    public function check_qr()
    {
        $top_code = $this->request->params['pass'][0];
        $bottum_code = $this->request->params['pass'][1];
        if (is_null($top_code) || is_null($bottum_code)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle = __l('Order invoice');
        $conditions['Order.top_code'] = $top_code;
        $conditions['Order.bottom_code'] = $bottum_code;
        $order = $this->Order->find('first', array(
            'conditions' => $conditions,
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.username',
                        'User.user_type_id',
                    ) ,
                ) ,
                'SecondUser' => array(
                    'fields' => array(
                        'SecondUser.id',
                        'SecondUser.user_type_id',
                        'SecondUser.username'
                    )
                ) ,
                'PaymentGateway' => array(
                    'fields' => array(
                        'PaymentGateway.id',
                        'PaymentGateway.name',
                    ) ,
                ) ,
                'OrderStatus',
                'OrderItem' => array(
                    'Product' => array(
                        'fields' => array(
                            'Product.id',
                            'Product.title',
                            'Product.slug',
                        ) ,
                    ) ,
                ) ,
            ) ,
            'recursive' => 3
        ));
        if (empty($order)) {
            $this->Session->setFlash(__l('Invalid invoice') , 'default', null, 'error');
            $this->redirect(Router::url('/', true));
        }
        if ($this->Auth->user('id') != $order['Order']['owner_user_id']) {
            $this->Session->setFlash(__l('You have no authorized to view this page') , 'default', null, 'error');
            $this->redirect(Router::url('/', true));
        }
        $this->set('order', $order);
    }
    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $order = $this->Order->find('count', array(
            'conditions' => array(
                'Order.order_status_id' => array(
                    ConstOrderStatus::PaymentPending,
                    ConstOrderStatus::Expired,
                )
            ) ,
            'recursive' => -1
        ));
        if (empty($order)) {
            $this->Session->setFlash(__l('You cannot able to delete in process/shipped/completed order.') , 'default', null, 'error');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            if ($this->Order->delete($id)) {
                $this->Session->setFlash(__l('Order deleted') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->setAction('delete', $id);
    }
    public function admin_shipped($orders_list = null)
    {
        if (empty($orders_list)) {
            $orders_list = $this->Session->read('shipped_list.data');
        }
        if (!empty($orders_list)) {
            $orders = $this->Order->find('all', array(
                'conditions' => array(
                    'Order.id' => $orders_list,
					'Order.is_shipped_order' => 1,
                ) ,
                'recursive' => -1
            ));
			if(empty($orders)){
				$this->Session->setFlash(__l('One of the Checked order is not valid order. Please select any other records.') , 'default', null, 'error');
				$this->redirect(array(
                    'action' => 'index'
                ));
			}
            $this->set('orders', $orders);
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            foreach($this->request->data['Order'] as $order_id => $order) {
                if (!empty($order_id)) {
                    $data = array();
                    $data['Order']['id'] = $order_id;
                    $data['Order']['shipping_remarks'] = $order['shipping_remarks'];
                    $data['Order']['shipped_date'] = date('Y-m-d h:i:s');
                    $data['Order']['order_status_id'] = ConstOrderStatus::Shipped;
                    $this->Order->save($data, false);
                    if (Configure::read('invite.is_referral_system_enabled')) {
                        $this->Order->User->_updateReferralAmount($order['user_id'], $order['paid_date']);
                    }
                    $this->Order->sendOrderNotification('Order status', $order_id, ConstUserNotification::ShippedItem);
                    $orderItem = $this->Order->find('first', array(
                        'conditions' => array(
                            'Order.id' => $order_id,
                        ) ,
                        'contain' => array(
                            'OrderItem'
                        ) ,
                        'recursive' => 2
                    ));
                    if (!empty($order['OrderItem'])) {
                        foreach($order['OrderItem'] as $orderItem) {
                            $this->Order->OrderItem->Product->_updateProductSaleFields($orderItem['product_id']);
                            $this->Order->User->_updateUserSaleFields($orderItem['user_id']);
                        }
                    }
                }
            }
			if(Configure::read('order.auto_complete_threshold_limit') == 0){
				$this->Order->order_completed_status();
			}
            $this->Session->delete('shipped_list');
            $this->Session->setFlash(__l('Order status changed into shipped') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'orders',
                'action' => 'index',
				'type' => 'mypurchases',
                'admin' => true
            ));
        }
	 $this->pageTitle = __l('Shipping Details');
    }
    public function admin_index()
    {
        $this->pageTitle = __l('Orders');
        $this->Order->recursive = 2;
        $count_condition = $conditions = array();		
		if (isset($this->request->data['Order']['from_date']) and isset($this->request->data['Order']['to_date'])) {
            $display_from = $from_date = $this->request->data['Order']['from_date']['year'] . '-' . $this->request->data['Order']['from_date']['month'] . '-' . $this->request->data['Order']['from_date']['day'] . ' 00:00:00';
            $display_to = $to_date = $this->request->data['Order']['to_date']['year'] . '-' . $this->request->data['Order']['to_date']['month'] . '-' . $this->request->data['Order']['to_date']['day'] . ' 23:59:59';
        }
		if (!empty($this->request->data)) {			
            if ($this->request->data['Order']['from_date']['year'] == '' || $this->request->data['Order']['to_date']['year'] == '') {				
				 $this->Session->setFlash(__l('From, To date should not be empty. Please, try again.') , 'default', null, 'error');
			} elseif ($from_date > $to_date) {
				$this->Session->setFlash(__l('To date should be greater than From date. Please, try again.') , 'default', null, 'error');
			} else{
				$this->request->params['named']['from_date'] = $from_date;
				$this->request->params['named']['to_date'] = $to_date;				
                
            } 
        }

		if (!empty($this->request->params['named']['from_date']) && !empty($this->request->params['named']['to_date'])) {
			if ($this->request->params['named']['from_date'] < $this->request->params['named']['to_date']) {				
				$conditions['Order.created >='] = $this->request->params['named']['from_date'];
				$conditions['Order.created <='] = $this->request->params['named']['to_date'];
				$this->request->data['Order']['to_date'] = $this->request->params['named']['to_date'];
				$this->request->data['Order']['from_date'] = $this->request->params['named']['from_date'];
			} else {
				$this->Session->setFlash(__l('To date should be greater than From date. Please, try again.') , 'default', null, 'error');
			}
		}        
        if (!empty($this->request->params['named']['status_filter_id'])) 
		{
			$this->request->params['named']['status_filter_id'] = $this->request->params['named']['status_filter_id'];
        }
		else if(!empty($this->request->data['Order']['status_filter_id']))	
		{
			$this->request->params['named']['status_filter_id'] = $this->request->data['Order']['status_filter_id'];
		}			
		if(!empty($this->request->params['named']['status_filter_id']) || !empty($this->request->data['Order']['status_filter_id']))
		{
			 if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::PaymentPending) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::PaymentPending;
                $this->pageTitle.= __l(' - Payment Pending ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::InProcess) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::InProcess;
                $this->pageTitle.= __l(' - In Process ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::Expired) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::Expired;
                $this->pageTitle.= __l(' - Expired ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::CanceledAndRefunded) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::CanceledAndRefunded;
                $this->pageTitle.= __l(' - Canceled ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::Shipped) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::Shipped;
                $this->pageTitle.= __l(' - Shipped ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::Completed) {
                $conditions['Order.order_status_id'] = ConstOrderStatus::Completed;
                $this->pageTitle.= __l(' - Completed ');
            } 
		}	
		if (!empty($this->request->params['named']['user_id'])) {
            $user_name = $this->Order->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->request->params['named']['user_id'],
                ) ,
                'fields' => array(
                    'User.username',
                ) ,
                'recursive' => -1,
            ));
            $this->pageTitle.= sprintf(__l(' - %s') , $user_name['User']['username']);
        }
		if (!empty($this->request->params['named']['user_id'])) {
            $conditions['Order.user_id'] = $this->request->params['named']['user_id'];
        }		
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.username',
                        'User.user_type_id',
                    ) ,
                ) ,
                'OrderStatus',
                'OrderItem' => array(
                    'OrderStatus' => array(
                       'fields' => array('OrderStatus.id','OrderStatus.name')
                    ),
					'ProductAttribute' => array(
						'AttributesProductAttribute'
					),
                    'Product' => array(
                        'fields' => array(
                            'Product.id',
                            'Product.title',
                            'Product.slug',
                        ) ,
                    ) ,
                ) ,
            ),
			      'order' => array(
     				'Order.id' => 'desc'
	    		)
        );
		if (!empty($this->request->params['named']['user_id'])) {
            $count_condition['Order.user_id'] = $conditions['Order.user_id'] = $this->request->params['named']['user_id'];
        }
		$this->set('expired_count', $this->Order->find('count', array(
                'conditions' => array(
                    'Order.order_status_id' => ConstOrderStatus::Expired ,
        			$count_condition,
                ) ,
                'recursive' => -1
            )));
		$this->set('payment_pending_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::PaymentPending ,
			$count_condition,
		) ,
		'recursive' => -1
    	)));
		$this->set('in_process_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::InProcess ,
			$count_condition,
		) ,
		'recursive' => -1
    	)));
		$this->set('canceled_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::CanceledAndRefunded ,
			$count_condition,
		) ,
		'recursive' => -1
    	)));
		$this->set('shipped_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::Shipped ,
			$count_condition,
		) ,
		'recursive' => -1
    	)));
		$this->set('completed_count', $this->Order->find('count', array(
		'conditions' => array(
			'Order.order_status_id' => ConstOrderStatus::Completed ,
			$count_condition,
		) ,
		'recursive' => -1
    	)));
        if (!empty($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id'] == ConstOrderStatus::Shipped) {
            $moreActions = array(
                ConstMoreAction::Completed => __l('Completed')
            );
        } elseif (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::PaymentPending || $this->request->params['named']['status_filter_id'] == ConstOrderStatus::Expired)) {
            $moreActions = array(
                ConstMoreAction::Delete => __l('Delete')
            );
        } elseif (empty($this->request->params['named']['status_filter_id']) || (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::InProcess))) {
            $moreActions = array(
                ConstMoreAction::GenerateAddress => __l('Generate Address Label') ,
                ConstMoreAction::Shipped => __l('Shipped')
            );
        }
        $orderStatuses = $this->Order->OrderStatus->find('list');
        foreach($orderStatuses as $order_status_id => $order_status_name) {
            $this->set('order_status_' . $order_status_id, $this->Order->find('count', array(
                'conditions' => array(
                    'Order.order_status_id' => $order_status_id
                ) ,
                'recursive' => -1
            )));
        }
        $this->set(compact('moreActions', 'orderStatuses'));
        $this->set('orders', $this->paginate());
    }
}

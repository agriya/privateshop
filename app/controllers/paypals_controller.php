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
class PaypalsController extends AppController
{
    public $name = null;
    var $components = array(
        'Paypal',
        'Email'
    );
    var $helpers = array(
        'Gateway'
    );
    public $uses = array(
        'Order'
    );
    public function do_payment($ids, $total_amount, $type = ConstPaymentTypes::Order)
    {
        $this->pageTitle = __l('Payment Processing');
        if (is_null($ids) || is_null($total_amount)) {
            throw new NotFoundException('Invalid request');
        }
        if ($type == ConstPaymentTypes::Order) {
			$order_id_arr = explode(',', $ids);
			$user_id = $this->Order->find('first', array(
                'conditions' => array(
                    'Order.id' => $order_id_arr,
                 ) ,
				'fields' => array(
       				'Order.user_id',
				 ),
				'recursive' => -1
            ));
            $order = $this->Order->find('count', array(
                'conditions' => array(
                    'Order.id' => $order_id_arr,
                    'Order.user_id' => $user_id['Order']['user_id'] ,
                    'Order.order_status_id' => ConstOrderStatus::PaymentPending
                ) ,
                'recursive' => -1
            ));
            if (empty($order)) {
                $this->Session->setFlash(__l('You cannot able to purchase other users or paid orders. Please try again.') , 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'payments',
                    'action' => 'order'
                ));
            }
            $item_name = __l('Product purchase in') . ' ' . Configure::read('site.name');
        } elseif ($type == ConstPaymentTypes::Wallet) {
            $item_name = __l('Add amount to wallet in') . ' ' . Configure::read('site.name');
        }
        $paymentGateway = $this->Order->getPaymentGatewaySettings(ConstPaymentGateways::PayPal);
        Configure::write('paypal.is_testmode', $paymentGateway['PaymentGateway']['is_test_mode']);
        Configure::write('paypal.account', $paymentGateway['PaymentGatewaySetting']['payee_account']);
        $this->Paypal->paypal_receiver_emails = $paymentGateway['PaymentGatewaySetting']['receiver_emails'];
		$user_defined_arr = array(
			'user_id' => $user_id['Order']['user_id'] ,
			'ip' => $this->RequestHandler->getClientIP(),
			'ids' => $ids,
			'type' => $type
		);
        $gateway_options = array(
            'cmd' => '_xclick',
            'notify_url' => array(
                'controller' => 'paypals',
                'action' => 'process_payment'
            ) ,
            'cancel_return' => array(
                'controller' => 'payments',
                'action' => 'payment_cancel',
            ) ,
            'return' => array(
                'controller' => 'payments',
                'action' => 'payment_success',
                $type
            ) ,
            'item_name' => $item_name,
            'currency_code' => Configure::read('site.currency_code') ,
            'amount' => $total_amount,
            'user_defined' => $user_defined_arr
        );
        $this->set('gateway_options', $gateway_options);
    }
    public function process_payment()
    {
        $paymentGateway = $this->Order->getPaymentGatewaySettings(ConstPaymentGateways::PayPal);
        $this->Paypal->initialize($this);
        $this->Paypal->payee_account = $paymentGateway['PaymentGatewaySetting']['payee_account'];
        $this->Paypal->paypal_receiver_emails = $paymentGateway['PaymentGatewaySetting']['receiver_emails'];
        $this->Paypal->sanitizeServerVars($_POST);
        $this->Paypal->is_test_mode = $paymentGateway['PaymentGateway']['is_test_mode'];
        $this->Paypal->amount_for_item = !empty($this->Paypal->paypal_post_arr['amount']) ? $this->Paypal->paypal_post_arr['amount'] : 0;
        $this->log('Response');
        $this->log($this->Paypal->paypal_post_arr);
        $type = $this->Paypal->paypal_post_arr['type'];
        if ($type == ConstPaymentTypes::Order) {
            $order_ids = $this->Paypal->paypal_post_arr['ids'];
            if (!empty($order_ids)) {
                $order_id_arr = explode(',', $order_ids);
                $total_order_count = count($order_id_arr);
                $order = $this->Order->find('all', array(
                    'conditions' => array(
                        'Order.id' => $order_id_arr,
                        'Order.order_status_id' => ConstOrderStatus::PaymentPending
                    ) ,
                    'fields' => array(
                        'SUM(Order.amount) as total_order_amount'
                    ) ,
                    'recursive' => -1
                ));
                $this->log('Order detail');
                $this->log($order);
				$total_order_amount = $order[0][0]['total_order_amount'];
                if (!empty($order) && $total_order_amount == $this->Paypal->paypal_post_arr['mc_gross']) {
                   $this->log($this->Paypal->paypal_post_arr);
                    if ($this->Paypal->process()) {
                        if ($this->Paypal->paypal_post_arr['payment_status'] == 'Completed') {
                            foreach($order_id_arr as $order_id) {
                                $order = $this->Order->find('first', array(
                                    'conditions' => array(
                                        'Order.id' => $order_id,
                                        'Order.order_status_id' => ConstOrderStatus::PaymentPending
                                    ) ,
                                    'contain' => array(
                                        'OrderItem' => array(
											'Product',
									  ),
                                    ) ,
                                    'recursive' => 2
                                ));
                                if (!empty($order)) {
                                    $data = array();
                                    $data['Transaction']['user_id'] = $this->Paypal->paypal_post_arr['user_id'];
                                    $data['Transaction']['foreign_id'] = $order_id;
                                    $data['Transaction']['class'] = 'Order';
                                    $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::Purchase;
                                    $data['Transaction']['amount'] = $order['Order']['amount'];
                                    $data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::PayPal;
                                    $data['Transaction']['gateway_fees'] = $this->Paypal->paypal_post_arr['mc_fee']/$total_order_count;
                                    $this->Order->User->Transaction->create();
                                    $this->log('Data');
                                    $this->log($data);
                                    $this->Order->User->Transaction->save($data);
                                    $this->Order->updateOrder($order);
                                }
                            }
						}
                    }
                }
            }
        }
        if ($type == ConstPaymentTypes::Wallet) {
            if ($this->Paypal->process()) {
                if ($this->Paypal->paypal_post_arr['payment_status'] == 'Completed') {
                    $this->Order->User->updateAll(array(
                        'User.available_balance_amount' => 'User.available_balance_amount + ' . $this->Paypal->paypal_post_arr['mc_gross']
                    ) , array(
                        'User.id' => $this->Paypal->paypal_post_arr['user_id']
                    ));
                    $data = array();
                    $data['Transaction']['user_id'] = $this->Paypal->paypal_post_arr['user_id'];
                    $data['Transaction']['foreign_id'] = ConstUserIds::Admin;
                    $data['Transaction']['class'] = 'User';
                    $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::AddedToWallet;
                    $data['Transaction']['amount'] = $this->Paypal->paypal_post_arr['mc_gross'];
                    $data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::PayPal;
                    $data['Transaction']['gateway_fees'] = $this->Paypal->paypal_post_arr['mc_fee'];
                    $this->Order->User->Transaction->create();
                    $this->Order->User->Transaction->save($data);
                }
            }
        }
        $this->Paypal->logPaypalTransactions();
        $this->autoRender = false;
    }
}

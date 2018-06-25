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
class WalletsController extends AppController
{
    public $name = null;
    public $uses = array(
        'Order'
    );
    public function process_payment($ids, $total_amount, $type = ConstPaymentTypes::Order)
    {
        if (is_null($ids) || is_null($total_amount)) {
            throw new NotFoundException('Invalid request');
        }
        if ($type == ConstPaymentTypes::Order) {
			$user_id = $this->Order->find('first', array(
                'conditions' => array(
                    'Order.id' => $ids,
                 ) ,
				'fields' => array(
       				'Order.user_id',
				 ),
				'recursive' => -1
            ));
            $order_id_arr = explode(',', $ids);
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
            foreach($order_id_arr as $order_id) {
                $order = $this->Order->find('first', array(
                    'conditions' => array(
                        'Order.id' => $order_id,
                        'Order.user_id' => $user_id['Order']['user_id'] ,
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
                    $this->Order->User->updateAll(array(
                        'User.available_balance_amount' => 'User.available_balance_amount - ' . $order['Order']['amount']
                    ) , array(
                        'User.id' => $user_id['Order']['user_id']
                    ));
                    $data = array();
                    $data['Transaction']['user_id'] = $this->Auth->user('id');
                    $data['Transaction']['foreign_id'] = $order_id;
                    $data['Transaction']['class'] = 'Order';
                    $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::Purchase;
                    $data['Transaction']['amount'] = $order['Order']['amount'];
                    $data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::Wallet;
                    $this->Order->User->Transaction->create();
                    $this->Order->User->Transaction->save($data);
                    $this->Order->updateOrder($order);
                }
            }
        }
		if (!empty($type)) {
			$this->redirect(array(
                'controller' => 'payments',
                'action' => 'payment_success',
                $type
            ));
		}
        $this->autoRender = false;
    }
}

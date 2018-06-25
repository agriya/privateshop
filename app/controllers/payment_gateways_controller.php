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
class PaymentGatewaysController extends AppController
{
    public $name = 'PaymentGateways';
    public function admin_index()
    {
        $this->pageTitle = __l('Payment Gateways');
        $this->paginate = array(
            'order' => array(
                'PaymentGateway.id' => 'desc'
            ) ,
			'contain' => array(
				 'PaymentGatewaySetting'
			),
            
        );
        $this->set('paymentGateways', $this->paginate());
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Payment Gateway');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
		$this->request->data['PaymentGateway']['is_test_mode'] = empty($this->request->data['PaymentGateway']['is_test_mode']) ? 1 : 0;
            if ($this->PaymentGateway->save($this->request->data)) {
                if (!empty($this->request->data['PaymentGatewaySetting'])) {
                    foreach($this->request->data['PaymentGatewaySetting'] as $key => $value) {
                        $this->PaymentGateway->PaymentGatewaySetting->updateAll(array(
                            'PaymentGatewaySetting.test_mode_value' => '\'' . trim($value['test_mode_value']) . '\'',
                            'PaymentGatewaySetting.live_mode_value' => '\'' . trim($value['live_mode_value']) . '\''
                        ) , array(
                            'PaymentGatewaySetting.id' => $key
                        ));
                    }
                }
                $this->Session->setFlash(__l('Payment Gateway has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Payment Gateway could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $payment_gateway = $this->PaymentGateway->read(null, $id);
			$live_mode_value = ($this->request->data['PaymentGateway']['is_test_mode'] == 0) ? 1:0; 
			$this->request->data['PaymentGateway']['is_test_mode']= $live_mode_value;
			$payment_gateway['PaymentGateway']['is_test_mode']= $live_mode_value;
            unset($this->request->data['PaymentGatewaySetting']);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $paymentGatewaySettings = $this->PaymentGateway->PaymentGatewaySetting->find('all', array(
            'conditions' => array(
                'PaymentGatewaySetting.payment_gateway_id' => $id
            ) ,
            'order' => array(
                'PaymentGatewaySetting.id' => 'asc'
            )
        ));
        if (!empty($this->request->data['PaymentGatewaySetting'])) {
            foreach($paymentGatewaySettings as $key => $paymentGatewaySetting) {
                $paymentGatewaySettings[$key]['PaymentGatewaySetting']['value'] = $this->request->data['PaymentGatewaySetting'][$paymentGatewaySetting['PaymentGatewaySetting']['id']]['value'];
            }
        }
        $this->set(compact('paymentGatewaySettings'));
		$this->set('payment_gateway', $payment_gateway);
        $this->pageTitle.= ' - ' . $this->request->data['PaymentGateway']['name'];
    }
	public function admin_update($id, $actionId) 
    {
        if (is_null($id) || is_null($actionId)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $toggle = empty($this->request->params['named']['toggle']) ? 0 : 1;
        switch ($actionId) {
            case ConstMoreAction::Active:
                $this->PaymentGateway->updateAll(array(
                    'PaymentGateway.is_active' => $toggle
                ) , array(
                    'PaymentGateway.id' => $id
                ));
                break;

            case ConstMoreAction::TestMode: 
                $this->PaymentGateway->updateAll(array(
                    'PaymentGateway.is_test_mode' => $toggle
                ) , array(
                    'PaymentGateway.id' => $id
                ));
                break;

            case ConstMoreAction::Wallet:
                $this->PaymentGateway->PaymentGatewaySetting->updateAll(array(
                    'PaymentGatewaySetting.test_mode_value' => $toggle
                ) , array(
                    'PaymentGatewaySetting.payment_gateway_id' => $id,
                    'PaymentGatewaySetting.key' => 'is_enable_for_add_to_wallet'
                ));
                break;
			case ConstMoreAction::MassPay: 
                $this->PaymentGateway->updateAll(array(
                    'PaymentGateway.is_mass_pay_enabled' => $toggle
                ) , array(
                    'PaymentGateway.id' => $id
                ));
                break;
			case ConstMoreAction::Purchase:
                $this->PaymentGateway->PaymentGatewaySetting->updateAll(array(
                    'PaymentGatewaySetting.test_mode_value' => $toggle
                ) , array(
                    'PaymentGatewaySetting.payment_gateway_id' => $id,
                    'PaymentGatewaySetting.key' => 'is_enable_for_purchase'
                ));
                break;
        }
        echo Router::url(array(
            'controller' => 'payment_gateways',
            'action' => 'update',
            $id,
            $actionId,
            'toggle' => empty($toggle) ? 1 : 0,
            'admin' => true,
        ) , true);
        $this->autoRender = false;
    }
}
?>
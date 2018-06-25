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
class MassPayPaypal extends AppModel
{
    public $name = 'MassPayPaypal';
    public $useTable = false;
    public function _transferAmount($userCashWithdrawalsIds, $withdrawalType, $user_type_id = '')
    {
        $this->log('Entered into Model');
        App::import('Model', 'PaypalTransactionLog');
        $this->PaypalTransactionLog = new PaypalTransactionLog();
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'Paypal');
        $this->Paypal = new PaypalComponent($collection);
        $flash_message = '';
        APP::Import('Model', $withdrawalType);
        $objWithdrawalType = new $withdrawalType();
        $withdrawalsData = $objWithdrawalType->_getWithdrawalRequest($userCashWithdrawalsIds, $user_type_id, ConstPaymentGateways::PayPal);
        if (!empty($withdrawalsData['error'])) {
            return $withdrawalsData;
        }
        $withdrawalTypeId = Inflector::underscore($withdrawalType) . '_id'; // table id
        switch ($withdrawalType) {
            case 'UserCashWithdrawal':
                $this->log('User Cash widthdrawal');
                $reletedRequestClass = 'User';
                $reletedTransferAccountClass = 'MoneyTransferAccount';
                $unique_id = 'user';
                $user_id = 'user_id';
                break;
        }
        $this->log('Withdrawal data');
        $this->log($withdrawalsData['data']);
        if (!empty($withdrawalsData['data'])) {
            $paymentGateway = $this->PaypalTransactionLog->User->Transaction->PaymentGateway->find('first', array(
                'conditions' => array(
                    'PaymentGateway.id ' => ConstPaymentGateways::PayPal
                ) ,
                'contain' => array(
                    'PaymentGatewaySetting' => array(
                        'fields' => array(
                            'PaymentGatewaySetting.key',
                            'PaymentGatewaySetting.test_mode_value',
                            'PaymentGatewaySetting.live_mode_value',
                        ) ,
                    ) ,
                ) ,
                'recursive' => 1
            ));
            $this->log('Payment Gateway');
            $this->log($paymentGateway);
            foreach($withdrawalsData['data'] as $cashWithdrawalRequest) {
                $this->data['PaypalTransactionLog']['auth_amount'] = $cashWithdrawalRequest[$withdrawalType]['amount'];
                $this->data['PaypalTransactionLog']['user_id'] = $cashWithdrawalRequest[$withdrawalType][$user_id];
                $this->data['PaypalTransactionLog']['currency_type'] = Configure::read('paypal.currency_code');
                $this->data['PaypalTransactionLog']['is_mass_pay'] = 1;
                $this->data['PaypalTransactionLog']['mass_pay_status'] = 'PENDING';
                if (!empty($paymentGateway['PaymentGatewaySetting'])) {
                    foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
                        if ($paymentGatewaySetting['key'] == 'payee_account') {
                            $this->data['PaypalTransactionLog']['payer_email'] = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                            break;
                        }
                    }
                }
                $this->data['PaypalTransactionLog']['receiver_email'] = $cashWithdrawalRequest[$reletedRequestClass][$reletedTransferAccountClass][0]['account'];
                $this->data['PaypalTransactionLog'][$withdrawalTypeId] = $cashWithdrawalRequest[$withdrawalType]['id'];
                $this->data['PaypalTransactionLog']['ip'] = $_SERVER['REMOTE_ADDR'];
                $this->PaypalTransactionLog->create();
                $this->PaypalTransactionLog->save($this->data, false);
                $paypal_log_list[$cashWithdrawalRequest[$withdrawalType]['id']] = $paypal_transaction_list[] = $paypal_transaction_id = $this->PaypalTransactionLog->getLastInsertId();
                $CashWithdrawal_list[] = $cashWithdrawalRequest[$withdrawalType]['id'];
                $this->log('Before receiver info');
                $reciever_info[] = array(
                    'receiverEmail' => $cashWithdrawalRequest[$reletedRequestClass][$reletedTransferAccountClass][0]['account'],
                    'amount' => $cashWithdrawalRequest[$withdrawalType]['amount'],
                    'uniqueID' => $unique_id . '-' . $cashWithdrawalRequest[$withdrawalType]['id'],
                    'transaction_log' => $paypal_transaction_id,
                    'note' => 'Amount Received from ' . Configure::read('site.name') ,
                );
                $this->log('After Receiver info');
                $this->log($receiver_info);
            }
            $this->log('List');
            $this->log($CashWithdrawal_list);
            if (!empty($CashWithdrawal_list)) {
                if (!empty($paymentGateway['PaymentGatewaySetting'])) {
                    foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
                        if ($paymentGatewaySetting['key'] == 'masspay_API_UserName') {
                            $sender_info['API_UserName'] = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                        }
                        if ($paymentGatewaySetting['key'] == 'masspay_API_Password') {
                            $sender_info['API_Password'] = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                        }
                        if ($paymentGatewaySetting['key'] == 'masspay_API_Signature') {
                            $sender_info['API_Signature'] = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
                        }
                    }
                }
                $notify_url = Router::url(array(
                    'controller' => 'mass_pay_paypals',
                    'action' => 'process_masspay_ipn',
                    'admin' => false
                ) , true);
                $paypal_response = $this->Paypal->massPay($sender_info, $reciever_info, $notify_url, 'Your Payment Has been Sent', $paymentGateway['PaymentGateway']['is_test_mode'], Configure::read('site.currency_code'));
                $this->log('Paypal response');
                $this->log($paypal_response);
                $this->PaypalTransactionLog->updateAll(array(
                    'PaypalTransactionLog.masspay_response' => '\'' . serialize($paypal_response) . '\'',
                ) , array(
                    'PaypalTransactionLog.id' => $paypal_transaction_list
                ));
                if (strtoupper($paypal_response['ACK']) != 'SUCCESS') {
                    $return['error'] = 1;
                    $user_count = count($paypal_log_list);
                    $flash_message = '';
                    for ($i = 0; $i < $user_count; $i++) {
                        if (!empty($paypal_response['L_LONGMESSAGE' . $i])) {
                            $flash_message.= urldecode($paypal_response['L_LONGMESSAGE' . $i]) . ' , ';
                        }
                    }
                    $returns['message'] = $flash_message . __l(' Masspay not completed. Please try again');
                }
                $return['log_list'] = $paypal_log_list;
                $return['response'] = $paypal_response;
                return $return;
            }
        }
    }
}
?>
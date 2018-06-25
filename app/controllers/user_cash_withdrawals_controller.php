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
class UserCashWithdrawalsController extends AppController
{
    public $name = 'UserCashWithdrawals';
    public $components = array(
        'Paypal'
    );
    public function beforeFilter()
    {
        $this->disableCache();
        parent::beforeFilter();
    }
    public function index()
    {
        if (!Configure::read('user.is_user_can_withdraw_amount')) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $cache_file = APP.'tmp'.DS.'cache'.DS.'views'.DS.'user'.DS.str_replace('.', '_', env('HTTP_HOST')).DS.$this->Auth->user('id').DS.'_user_cash_withdrawals_en.gz';
        if (!file_exists($cache_file)) {
			@unlink($cache_file_name);
		}
        $this->pageTitle = __l('Withdraw Fund Request');
        $this->paginate = array(
            'conditions' => array(
                'UserCashWithdrawal.user_id' => $this->Auth->user('id') ,
            ) ,
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.user_type_id',
                        'User.username',
                        'User.id',
                    )
                ) ,
                'WithdrawalStatus' => array(
                    'fields' => array(
                        'WithdrawalStatus.name',
                        'WithdrawalStatus.id'
                    )
                )
            ) ,
            'order' => array(
                'UserCashWithdrawal.id' => 'desc'
            ) ,
            'recursive' => 0
        );
        $moneyTransferAccounts = $this->UserCashWithdrawal->User->MoneyTransferAccount->find('count', array(
            'conditions' => array(
                'MoneyTransferAccount.user_id' => $this->Auth->User('id') ,
            ) ,
            'recursive' => 0
        ));
		$massPayEnabledCount = $this->UserCashWithdrawal->User->MoneyTransferAccount->PaymentGateway->find('count', array(
            'conditions' => array(               
                'PaymentGateway.is_mass_pay_enabled' => 1
            ) ,
            'recursive' => -1
        ));
        $userProfile = $this->UserCashWithdrawal->User->UserProfile->find('first', array(
            'conditions' => array(
                'UserProfile.user_id' => $this->Auth->User('id')
            ) ,
            'recursive' => -1
        ));
		$this->set('massPayEnabledCount', $massPayEnabledCount);
        $this->set('moneyTransferAccounts', $moneyTransferAccounts);
        $this->set('userProfile', $userProfile);
        $this->request->data['UserCashWithdrawal']['user_id'] = $this->Auth->user('id');
        $this->set('userCashWithdrawals', $this->paginate());
        $breadCrumbs = array();
        $breadCrumbs[__l('Withdraw Fund Request') ] = Router::url(array(
            'controller' => 'user_cash_withdrawals',
            'action' => 'index'
        ) , true);
        $this->set('breadCrumbs', $breadCrumbs);
    }
    public function add()
    {
        $this->pageTitle = __l('Add Fund Withdraw');
        if (!empty($this->request->data)) {
            $this->UserCashWithdrawal->set($this->request->data);
            $this->UserCashWithdrawal->_checkAmount($this->request->data['UserCashWithdrawal']['amount']);
            if ($this->UserCashWithdrawal->validates()) {
                $this->request->data['UserCashWithdrawal']['withdrawal_status_id'] = ConstWithdrawalStatus::Pending;
                $this->UserCashWithdrawal->create();
                if ($this->UserCashWithdrawal->save($this->request->data)) {
                    // Updating transaction during intital withdraw request by user.
                    $data['Transaction']['user_id'] = $this->request->data['UserCashWithdrawal']['user_id'];
                    $data['Transaction']['foreign_id'] = ConstUserIds::Admin;
                    $data['Transaction']['class'] = 'SecondUser';
                    $data['Transaction']['amount'] = $this->request->data['UserCashWithdrawal']['amount'];
                    $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::UserWithdrawalRequest;					
					$this->UserCashWithdrawal->User->Transaction->create();
                    $this->UserCashWithdrawal->User->Transaction->save($data);
                    $this->UserCashWithdrawal->User->updateAll(array(
                        'User.available_balance_amount' => 'User.available_balance_amount -' . $this->request->data['UserCashWithdrawal']['amount']
                    ) , array(
                        'User.id' => $this->request->data['UserCashWithdrawal']['user_id']
                    ));
                    $this->UserCashWithdrawal->User->updateAll(array(
                        'User.blocked_amount' => 'User.blocked_amount +' . $this->request->data['UserCashWithdrawal']['amount']
                    ) , array(
                        'User.id' => $this->request->data['UserCashWithdrawal']['user_id']
                    ));
                    $this->Session->setFlash('Withdraw fund request has been added', 'default', null, 'success');
                    if ($this->RequestHandler->isAjax()) {
                        $this->autoRender = false;
                    } else {
                        $this->redirect(array(
                            'action' => 'index'
                        ));
                    }
                } else {
                    $this->Session->setFlash('Withdraw fund request could not be added. Please, try again.', 'default', null, 'error');
                }
            } else {
                $this->Session->setFlash('Withdraw fund request could not be added. Please, try again.', 'default', null, 'error');
            }
        }
        $moneyTransferAccounts = $this->UserCashWithdrawal->User->MoneyTransferAccount->find('count', array(
            'conditions' => array(
                'MoneyTransferAccount.user_id' => $this->Auth->User('id') ,
                'PaymentGateway.is_mass_pay_enabled' => 1,
            ) ,
            'recursive' => 0
        ));
		$massPayEnabledCount = $this->UserCashWithdrawal->User->MoneyTransferAccount->PaymentGateway->find('count', array(
            'conditions' => array(               
                'PaymentGateway.is_mass_pay_enabled' => 1
            ) ,
            'recursive' => -1
        ));
		$this->set('massPayEnabledCount', $massPayEnabledCount);
        if (empty($moneyTransferAccounts) && !empty($massPayEnabledCount)) {        
            $this->Session->setFlash('Your money transfer account is empty, you have to update your money transfer account.', 'default', null, 'error');
            $this->redirect(array(
                'controller' => 'money_transfer_accounts',
                'action' => 'index'
            ));
        }
        $this->request->data['UserCashWithdrawal']['user_id'] = $this->Auth->user('id');
        $breadCrumbs = array();
        $breadCrumbs[__l('Withdraw Fund Request') ] = Router::url(array(
            'controller' => 'user_cash_withdrawals',
            'action' => 'index'
        ) , true);
        $breadCrumbs[__l('Add') ] = Router::url(array(
            'controller' => 'user_cash_withdrawals',
            'action' => 'add'
        ) , true);
        $this->set('breadCrumbs', $breadCrumbs);
    }
    public function admin_index()
    {
        $title = '';
        $conditions = array();
        $this->_redirectGET2Named(array(
            'filter_id',
            'q',
            'account_id'
        ));
        $this->pageTitle = __l('Withdraw Fund Requests');
        if (isset($this->request->params['named']['filter_id'])) {
            $this->request->data['UserCashWithdrawal']['filter_id'] = $this->request->params['named']['filter_id'];
        }
        if (!isset($this->request->params['named']['filter_id']) && !isset($this->request->data['UserCashWithdrawal']['filter_id'])) {
            $this->request->data['UserCashWithdrawal']['filter_id'] = $this->request->params['named']['filter_id'] = 'all';
        }
        if (!empty($this->request->data['UserCashWithdrawal']['filter_id']) && $this->request->data['UserCashWithdrawal']['filter_id'] != 'all') {
            $conditions['UserCashWithdrawal.withdrawal_status_id'] = $this->request->data['UserCashWithdrawal']['filter_id'];
            $status = $this->UserCashWithdrawal->WithdrawalStatus->find('first', array(
                'conditions' => array(
                    'WithdrawalStatus.id' => $this->request->data['UserCashWithdrawal']['filter_id'],
                ) ,
                'fields' => array(
                    'WithdrawalStatus.name'
                ) ,
                'recursive' => -1
            ));
            $this->pageTitle.= ' - ' . $status['WithdrawalStatus']['name'];
        }
        if (isset($this->request->params['named']['account_id'])) {
            $this->request->data['UserCashWithdrawal']['account_id'] = $this->request->params['named']['account_id'];
        }
        if (!empty($this->request->data['UserCashWithdrawal']['account_id']) && $this->request->data['UserCashWithdrawal']['account_id'] != 'all') {
            if (ConstPaymentGateways::PayPal == $this->request->data['UserCashWithdrawal']['account_id']) {
                $this->pageTitle.= ' - ' . ConstPaymentGatewaysName::PayPal;
            } elseif (ConstPaymentGateways::MoneyBooker == $this->request->data['UserCashWithdrawal']['account_id']) {
                $this->pageTitle.= ' - ' . ConstPaymentGatewaysName::MoneyBooker;
            }
			if ($this->request->data['UserCashWithdrawal']['filter_id'] != 'all') {
                $withdrawal_conditions['UserCashWithdrawal.withdrawal_status_id'] = $this->request->data['UserCashWithdrawal']['filter_id'];
            } else {
                $withdrawal_conditions = array();
            }
            $userCashWithdrawals = $this->UserCashWithdrawal->find('all', array(
                'conditions' => $withdrawal_conditions ,
                'contain' => array(
                    'User' => array(
                        'MoneyTransferAccount' => array(
                            'fields' => array(
                                'MoneyTransferAccount.id',
                                'MoneyTransferAccount.payment_gateway_id'
                            )
                        )
                    )
                ) ,
                'recursive' => 2
            ));
            $user_cash_withdrawal_ids = array();
            if (!empty($userCashWithdrawals)) {
                foreach($userCashWithdrawals as $userCashWithdrawal) {
                    if (!empty($userCashWithdrawal['User']['MoneyTransferAccount'])) {
                        foreach($userCashWithdrawal['User']['MoneyTransferAccount'] as $moneyTransferAccount) {
                            if ($moneyTransferAccount['payment_gateway_id'] == $this->request->data['UserCashWithdrawal']['account_id']) {
                                $user_cash_withdrawal_ids[$userCashWithdrawal['UserCashWithdrawal']['id']] = $userCashWithdrawal['UserCashWithdrawal']['id'];
                                break;
                            }
                        }
                    }
                }
            }
            $conditions['UserCashWithdrawal.id'] = $user_cash_withdrawal_ids;
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(UserCashWithdrawal.created) <= '] = 0;
            $this->pageTitle.= __l(' - Requested today');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(UserCashWithdrawal.created) <= '] = 7;
            $this->pageTitle.= __l(' - Requested in this week');
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(UserCashWithdrawal.created) <= '] = 30;
            $this->pageTitle.= __l(' - Requested in this month');
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'User' => array(
                    'UserAvatar',
                    'fields' => array(
                        'User.user_type_id',
                        'User.username',
                        'User.id',
                        'User.fb_user_id',
                    ) ,
                    'MoneyTransferAccount' => array(
                        'fields' => array(
                            'MoneyTransferAccount.id',
                            'MoneyTransferAccount.payment_gateway_id'
                        ) ,
                        'PaymentGateway' => array(
                            'conditions' => array(
                                'PaymentGateway.is_mass_pay_enabled' => 1,
                            ) ,
                            'fields' => array(
                                'PaymentGateway.display_name',
                                'PaymentGateway.name'
                            )
                        )
                    )
                ) ,
                'WithdrawalStatus' => array(
                    'fields' => array(
                        'WithdrawalStatus.name',
                        'WithdrawalStatus.id',
                    )
                )
            ) ,
            'order' => array(
                'UserCashWithdrawal.id' => 'desc'
            ) ,
            'recursive' => 3,
        );
        $withdrawalStatuses = $this->UserCashWithdrawal->WithdrawalStatus->find('all', array(
            'recursive' => -1
        ));
        $this->set('withdrawalStatuses', $withdrawalStatuses);
        $paymentGateways = $this->UserCashWithdrawal->User->MoneyTransferAccount->PaymentGateway->find('all', array(
            'conditions' => array(
                'PaymentGateway.is_mass_pay_enabled' => 1
            ) ,
            'recursive' => -1
        ));
        $this->set('paymentGateways', $paymentGateways);
        $moreActions = $this->UserCashWithdrawal->moreActions;
        if (!empty($this->request->params['named']['filter_id']) && ($this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending)) {
            unset($moreActions[ConstWithdrawalStatus::Pending]);
        }
        $this->set(compact('moreActions'));
        $this->set('userCashWithdrawals', $this->paginate());
        $this->set('approved', $this->UserCashWithdrawal->find('count', array(
            'conditions' => array(
                'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Approved,
            ) ,
            'recursive' => -1
        )));
        $this->set('success', $this->UserCashWithdrawal->find('count', array(
            'conditions' => array(
                'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Success,
            ) ,
            'recursive' => -1
        )));
        $this->set('failed', $this->UserCashWithdrawal->find('count', array(
            'conditions' => array(
                'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Failed,
            ) ,
            'recursive' => -1
        )));
        $this->set('pending', $this->UserCashWithdrawal->find('count', array(
            'conditions' => array(
                'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Pending,
            ) ,
            'recursive' => -1
        )));
        $this->set('rejected', $this->UserCashWithdrawal->find('count', array(
            'conditions' => array(
                'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Rejected,
            ) ,
            'recursive' => -1
        )));
        $this->set('pageTitle', $this->pageTitle);
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->UserCashWithdrawal->delete($id)) {
            $this->Session->setFlash(__l('Withdraw fund request deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_update()
    {
        $this->loadModel('PaypalTransactionLog');
        if (!empty($this->request->data['UserCashWithdrawal'])) {
            $r = $this->request->data[$this->modelClass]['r'];
            $actionid = $this->request->data[$this->modelClass]['more_action_id'];
            unset($this->request->data[$this->modelClass]['r']);
            unset($this->request->data[$this->modelClass]['more_action_id']);
            $userCashWithdrawalIds = array();
            foreach($this->request->data['UserCashWithdrawal'] as $userCashWithdrawal_id => $is_checked) {
                if ($is_checked['id']) {
                    $userCashWithdrawalIds[] = $userCashWithdrawal_id;
                }
            }
            if ($actionid && !empty($userCashWithdrawalIds)) {
                if ($actionid == ConstWithdrawalStatus::Pending) {
                    $this->UserCashWithdrawal->updateAll(array(
                        'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Pending
                    ) , array(
                        'UserCashWithdrawal.id' => $userCashWithdrawalIds
                    ));
                    $this->Session->setFlash(__l('Checked requests have been moved to pending status') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'user_cash_withdrawals',
                        'action' => 'index'
                    ));
                } else if ($actionid == ConstWithdrawalStatus::Rejected) {
                    // Need to Refund the Money to User
                    $canceled_withdraw_requests = $this->UserCashWithdrawal->find('all', array(
                        'conditions' => array(
                            'UserCashWithdrawal.id' => $userCashWithdrawalIds
                        ) ,
                        'fields' => array(
                            'UserCashWithdrawal.id',
                            'UserCashWithdrawal.user_id',
                            'UserCashWithdrawal.amount',
                        ) ,
                        'recursive' => 1
                    ));
                    // Updating user balance
                    foreach($canceled_withdraw_requests as $canceled_withdraw_request) {
                        // Updating transactions
                        if (!empty($canceled_withdraw_request)) {
                            $data['Transaction']['user_id'] = ConstUserIds::Admin;
                            $data['Transaction']['foreign_id'] = $canceled_withdraw_request['UserCashWithdrawal']['user_id'];
                            $data['Transaction']['class'] = 'SecondUser';
                            $data['Transaction']['amount'] = $canceled_withdraw_request['UserCashWithdrawal']['amount'];
                            $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::AdminRejecetedWithdrawalRequest;
							$this->UserCashWithdrawal->User->Transaction->create();
                            $this->UserCashWithdrawal->User->Transaction->save($data);
                            $data = array();
                            $data['Transaction']['user_id'] = $canceled_withdraw_request['UserCashWithdrawal']['user_id'];
                            $data['Transaction']['foreign_id'] = ConstUserIds::Admin;
                            $data['Transaction']['class'] = 'SecondUser';
                            $data['Transaction']['amount'] = $canceled_withdraw_request['UserCashWithdrawal']['amount'];
                            $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::AmountRefundedForRejectedWithdrawalRequest;
                            $this->UserCashWithdrawal->User->Transaction->create();
							$this->UserCashWithdrawal->User->Transaction->save($data);
                        }
                        // Addding to user's Available Balance
                        $this->UserCashWithdrawal->User->updateAll(array(
                            'User.available_balance_amount' => 'User.available_balance_amount +' . $canceled_withdraw_request['UserCashWithdrawal']['amount']
                        ) , array(
                            'User.id' => $canceled_withdraw_request['UserCashWithdrawal']['user_id']
                        ));
                        // Deducting user's Available Balance
                        $this->UserCashWithdrawal->User->updateAll(array(
                            'User.blocked_amount' => 'User.blocked_amount -' . $canceled_withdraw_request['UserCashWithdrawal']['amount']
                        ) , array(
                            'User.id' => $canceled_withdraw_request['UserCashWithdrawal']['user_id']
                        ));
                        $this->UserCashWithdrawal->updateAll(array(
                            'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Rejected
                        ) , array(
                            'UserCashWithdrawal.id' => $canceled_withdraw_request['UserCashWithdrawal']['id']
                        ));
                    }
                    //
                    $this->Session->setFlash(__l('Checked requests have been moved to rejected status, Refunded  Money to Wallet') , 'default', null, 'success');
                    $this->redirect(array(
                        'controller' => 'user_cash_withdrawals',
                        'action' => 'index'
                    ));
                } else if ($actionid == ConstWithdrawalStatus::Approved) {
                    $paymentGateways = $this->UserCashWithdrawal->User->MoneyTransferAccount->PaymentGateway->find('list', array(
                        'conditions' => array(
                            'PaymentGateway.is_mass_pay_enabled' => 1
                        ) ,
                        'fields' => array(
                            'PaymentGateway.id',
                            'PaymentGateway.name',
                        ) ,
                        'recursive' => -1
                    ));
                    $conditions['UserCashWithdrawal.id'] = $userCashWithdrawalIds;
                    $this->paginate = array(
                        'conditions' => $conditions,
                        'contain' => array(
                            'User' => array(
                                'UserAvatar',
                                'fields' => array(
                                    'User.user_type_id',
                                    'User.username',
                                    'User.total_amount_withdrawn',
                                    'User.id',
                                    'User.fb_user_id',
                                ) ,
                                'MoneyTransferAccount' => array(
                                    'fields' => array(
                                        'MoneyTransferAccount.id',
                                        'MoneyTransferAccount.payment_gateway_id',
                                        'MoneyTransferAccount.account',
                                        'MoneyTransferAccount.is_default',
                                    ) ,
                                    'PaymentGateway' => array(
                                        'conditions' => array(
                                            'PaymentGateway.is_mass_pay_enabled' => 1,
                                        ) ,
                                        'fields' => array(
                                            'PaymentGateway.display_name',
                                            'PaymentGateway.name'
                                        )
                                    )
                                )
                            ) ,
                            'WithdrawalStatus' => array(
                                'fields' => array(
                                    'WithdrawalStatus.name',
                                    'WithdrawalStatus.id',
                                )
                            )
                        ) ,
                        'order' => array(
                            'UserCashWithdrawal.id' => 'desc'
                        ) ,
                        'recursive' => 3,
                    );
                    $userCashWithdrawals = $this->paginate();
                    foreach($userCashWithdrawals as $key => $userCashWithdrawal) {
                        $payment_gates = array();
                        $payment_gates[ConstPaymentGateways::ManualPay] = __('Mark as paid/manual');
                        if (!empty($userCashWithdrawal['User']['MoneyTransferAccount'])) {
                            foreach($userCashWithdrawal['User']['MoneyTransferAccount'] as $gateway) {
                                $payment_gates[$gateway['payment_gateway_id']] = __l('Pay via ') . $gateway['PaymentGateway']['display_name'] . ' ' . __l('API') . ' (' . substr($gateway['account'], 0, 10) . '...)';
                                if ($gateway['is_default'] == 1) {
                                    $this->request->data['UserCashWithdrawal'][$key]['gateways'] = $gateway['payment_gateway_id'];
                                }
                            }
                        }
                        foreach($payment_gates as $id => $name) {
                            if (ConstPaymentGateways::ManualPay != $id && empty($paymentGateways[$id])) {
                                unset($payment_gates[$id]);
                            }
                        }
                        $userCashWithdrawals[$key]['paymentways'] = $payment_gates;
                    }
                    $this->pageTitle = __l('Withdraw Fund Requests - Approved');
                    $this->set('userCashWithdrawals', $userCashWithdrawals);
                    $this->render('admin_pay_to_user');
                }
            } else {
                $this->redirect(array(
                    'controller' => 'user_cash_withdrawals',
                    'action' => 'index',
                    'filter_id' => ConstWithdrawalStatus::Pending
                ));
            }
        } else {
            $this->redirect(array(
                'controller' => 'user_cash_withdrawals',
                'action' => 'index',
                'filter_id' => ConstWithdrawalStatus::Pending
            ));
        }
    }
    public function admin_pay_to_user()
    {
        $this->pageTitle = __l('Withdraw Fund Requests - Approved');
        if (!empty($this->request->data)) {
            $approve_list = $approve_list_id = array();
            if (!empty($this->request->data['UserCashWithdrawal'])) {
                foreach($this->request->data['UserCashWithdrawal'] as $list) {
                    $approve_list[$list['gateways']][$list['id']] = $list;
                    $approve_list_id[$list['gateways']][] = $list['id'];
                }
                if (!empty($approve_list)) {
                    foreach($approve_list_id as $gateway => $list_id) {
                        if ($gateway == ConstPaymentGateways::ManualPay) { // manual pay
                            $userCashWithdrawals = $this->UserCashWithdrawal->find('all', array(
                                'conditions' => array(
                                    'UserCashWithdrawal.id' => $list_id,
                                    'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Pending,
                                ) ,
                                'recursive' => -1
                            ));
                            foreach($userCashWithdrawals as $userCashWithdrawal) {
                                $logTableData['amount'] = $userCashWithdrawal['UserCashWithdrawal']['amount'];
                                $userCashWithdrawal_response['mc_fee'] = 0;
                                $userCashWithdrawal_response['mc_gross'] = $userCashWithdrawal['UserCashWithdrawal']['amount'];
                                $userCashWithdrawal['UserCashWithdrawal']['description'] = $approve_list[$gateway][$userCashWithdrawal['UserCashWithdrawal']['id']]['info'];
                                $this->UserCashWithdrawal->onSuccessProcess($userCashWithdrawal, $userCashWithdrawal_response, $logTableData);
                                $this->Session->setFlash(__l('Manual payment process has been completed.') , 'default', null, 'success');
                            }
                        } else { // other payment gateways
                            $paymentGateway = $this->UserCashWithdrawal->User->MoneyTransferAccount->PaymentGateway->find('first', array(
                                'conditions' => array(
                                    'PaymentGateway.id' => $gateway
                                ) ,
                                'recursive' => -1
                            ));
                            $modelName = inflector::camelize('mass_pay_' . strtolower($paymentGateway['PaymentGateway']['name']));
                            APP::Import('Model', $modelName);
                            $this->obj = new $modelName();
                            $status = $this->obj->_transferAmount($list_id, 'UserCashWithdrawal');
                            if (!empty($status['error'])) {
                                $this->Session->setFlash($status['message'], 'default', null, 'error');
                            } else {
                                $this->UserCashWithdrawal->onApprovedProcess($list_id, $status);
                                $this->Session->setFlash(__l('Mass payment request is submitted in') .' ' . strtolower($paymentGateway['PaymentGateway']['name']) . __l(', user will be paid once process completed.') , 'default', null, 'success'); 
                            }
                        }
                    }
                }
            }
        }
        $this->redirect(array(
            'controller' => 'user_cash_withdrawals',
            'action' => 'index',
            'filter_id' => ConstWithdrawalStatus::Pending
        ));
    }
    public function admin_move_to($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $massPaylogTables = array(
            ConstPaymentGateways::PayPal => 'PaypalTransactionLog'
        );
        $userCashWithdrawal = $this->UserCashWithdrawal->find('first', array(
            'conditions' => array(
                'UserCashWithdrawal.id' => $id,
                'UserCashWithdrawal.withdrawal_status_id' => ConstWithdrawalStatus::Approved,
            ) ,
            'contain' => array_values($massPaylogTables) ,
            'recursive' => 1
        ));
        if (empty($userCashWithdrawal)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->request->params['named']['type'] == 'success') {
            foreach($massPaylogTables as $key => $massPaylogTable) {
                if (!empty($userCashWithdrawal[$massPaylogTable])) {
                    $logTable = $massPaylogTable;
                    $gateway_id = $key;
                    break;
                }
            }
            $logTableData = array();            
            $userCashWithdrawal_response['mc_fee'] = 0;
            $userCashWithdrawal_response['mc_gross'] = 0;
            $this->UserCashWithdrawal->onSuccessProcess($userCashWithdrawal, $userCashWithdrawal_response, $logTableData, $gateway_id);
        } elseif ($this->request->params['named']['type'] == 'failed') {
            $this->UserCashWithdrawal->onFailedProcess($userCashWithdrawal);
        }
        $this->Session->setFlash(__l('Withdrawal has been successfully moved to ') . $this->request->params['named']['type'], 'default', null, 'success');
        $this->redirect(array(
            'controller' => 'user_cash_withdrawals',
            'action' => 'index',
            'filter_id' => ConstWithdrawalStatus::Approved
        ));
    }   
}
?>

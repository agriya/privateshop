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
class TransactionsController extends AppController
{
    public $name = 'Transactions';
    public $uses = array(
        'Transaction',
        'Product',
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Transaction.from_date',
            'Transaction.to_date',
            'Transaction.user_id',
            'Transaction.product_id',
            'User.username',
            'Product.title',
            'Product.id',
        );
        parent::beforeFilter();
    }
    public function index()
    {
        $this->pageTitle = __l('Transactions');
        $conditions['Transaction.user_id'] = $this->Auth->user('id');
        $blocked_conditions['UserCashWithdrawal.user_id'] = $this->Auth->user('id');
        if (isset($this->request->data['Transaction']['from_date']) and isset($this->request->data['Transaction']['to_date'])) {
            $display_from = $from_date = $this->request->data['Transaction']['from_date']['year'] . '-' . $this->request->data['Transaction']['from_date']['month'] . '-' . $this->request->data['Transaction']['from_date']['day'] . ' 00:00:00';
            $display_to = $to_date = $this->request->data['Transaction']['to_date']['year'] . '-' . $this->request->data['Transaction']['to_date']['month'] . '-' . $this->request->data['Transaction']['to_date']['day'] . ' 23:59:59';
        }		
        if (!empty($this->request->data)) {			
            if ($this->request->data['Transaction']['from_date']['year'] == '' || $this->request->data['Transaction']['to_date']['year'] == '') {				
				 $this->Session->setFlash(__l('From, To date should not be empty. Please, try again.') , 'default', null, 'error');
			} elseif ($from_date > $to_date) {
				$this->Session->setFlash(__l('To date should be greater than From date. Please, try again.') , 'default', null, 'error');
			} else{
				$this->request->params['named']['from_date'] = $from_date;
				$this->request->params['named']['to_date'] = $to_date;
				$this->request->params['named']['stat'] = $this->request->data['Transaction']['filter'];
                $blocked_conditions['UserCashWithdrawal.created >='] = $conditions['Transaction.created >='] = $from_date;
                $blocked_conditions['UserCashWithdrawal.created <='] = $conditions['Transaction.created <='] = $to_date;
            } 
        }
		if (!empty($this->request->params['named']['from_date']) && !empty($this->request->params['named']['to_date'])) {
			if ($this->request->params['named']['from_date'] < $this->request->params['named']['to_date']) {
				$display_from = $from_date = $this->request->params['named']['from_date'];
				$display_to = $to_date = $this->request->params['named']['to_date'];
				$blocked_conditions['UserCashWithdrawal.created >='] = $conditions['Transaction.created >='] = $this->request->params['named']['from_date'];
				$blocked_conditions['UserCashWithdrawal.created <='] = $conditions['Transaction.created <='] = $this->request->params['named']['to_date'];
				$this->request->data['Transaction']['to_date'] = $this->request->params['named']['to_date'];
				$this->request->data['Transaction']['from_date'] = $this->request->params['named']['from_date'];
			} else {
				$this->Session->setFlash(__l('To date should be greater than From date. Please, try again.') , 'default', null, 'error');
			}
		}
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(Transaction.created) <= '] = 0;
            $blocked_conditions['TO_DAYS(NOW()) - TO_DAYS(UserCashWithdrawal.created) <= '] = 0;
            $this->pageTitle.= __l(' - Amount Earned today');
            $this->request->data['Transaction']['from_date'] = array(
                'year' => date('Y', strtotime('today')) ,
                'month' => date('m', strtotime('today')) ,
                'day' => date('d', strtotime('today'))
            );
            $this->request->data['Transaction']['to_date'] = array(
                'year' => date('Y', strtotime('today')) ,
                'month' => date('m', strtotime('today')) ,
                'day' => date('d', strtotime('today'))
            );
            $display_from = date('Y-m-d H:i:s', strtotime('now'));
            $display_to = '';
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(Transaction.created) <= '] = 7;
            $blocked_conditions['TO_DAYS(NOW()) - TO_DAYS(UserCashWithdrawal.created) <= '] = 7;
            $this->pageTitle.= __l(' - Amount Earned in this week');
            $this->request->data['Transaction']['from_date'] = array(
                'year' => date('Y', strtotime('last week')) ,
                'month' => date('m', strtotime('last week')) ,
                'day' => date('d', strtotime('last week'))
            );
            $this->request->data['Transaction']['to_date'] = array(
                'year' => date('Y', strtotime('this week')) ,
                'month' => date('m', strtotime('this week')) ,
                'day' => date('d', strtotime('this week'))
            );
            $display_from = date('Y', strtotime('last week')) . '-' . date('m', strtotime('last week')) . '-' . date('d', strtotime('last week')) . ' 00:00:00';
            $display_to = date('Y-m-d H:i:s', strtotime('now'));
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(Transaction.created) <= '] = 30;
            $blocked_conditions['TO_DAYS(NOW()) - TO_DAYS(UserCashWithdrawal.created) <= '] = 30;
            $this->pageTitle.= __l(' - Amount Earned in this month');
            $this->request->data['Transaction']['from_date'] = array(
                'year' => date('Y', (strtotime('last month', strtotime(date('m/01/y'))))) ,
                'month' => date('m', (strtotime('last month', strtotime(date('m/01/y'))))) ,
                'day' => date('d', (strtotime('last month', strtotime(date('m/01/y')))))
            );
            $this->request->data['Transaction']['to_date'] = array(
                'year' => date('Y', (strtotime('this month', strtotime(date('m/01/y'))))) ,
                'month' => date('m', (strtotime('this month', strtotime(date('m/01/y'))))) ,
                'day' => date('d', (strtotime('this month', strtotime(date('m/01/y')))))
            );
            $display_from = date('Y-m-d', strtotime('last month')) . ' 00:00:00';
            $display_to = date('Y-m-d H:i:s', strtotime('now'));
        }
        if (isset($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'all') {
            $display_from = '';
            $display_to = '';
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'TransactionType',
                'User',
				'SecondUser',
    			'Order'
            ) ,
            'order' => array(
                'Transaction.id' => 'desc'
            ) ,
            'recursive' => 2
        );
        $transactions = $this->paginate();
        $this->set('transactions', $transactions);
        // To get commission percentage
        $credit = $this->Transaction->find('first', array(
            'conditions' => array(
                $conditions,
                'TransactionType.is_credit' => 1
            ) ,
            'fields' => array(
                'SUM(Transaction.amount) as total_amount'
            ) ,
            'group' => array(
                'Transaction.user_id'
            ) ,
            'recursive' => 0
        ));
        $this->set('total_credit_amount', !empty($credit[0]['total_amount']) ? $credit[0]['total_amount'] : 0);
        $debit = $this->Transaction->find('first', array(
            'conditions' => array(
                $conditions,
                'TransactionType.is_credit' => 0
            ) ,
            'fields' => array(
                'SUM(Transaction.amount) as total_amount'
            ) ,
            'group' => array(
                'Transaction.user_id'
            ) ,
            'recursive' => 0
        ));
        $from = $this->Transaction->find('first', array(
            'conditions' => $conditions,
            'fields' => array(
                'Transaction.created'
            ) ,
            'limit' => 1,
            'order' => array(
                'Transaction.id desc'
            ) ,
            'recursive' => -1
        ));
        $to = $this->Transaction->find('first', array(
            'conditions' => $conditions,
            'fields' => array(
                'Transaction.created'
            ) ,
            'limit' => 1,
            'recursive' => -1
        ));
		if (!empty($this->request->data)) {
            $this->set('duration_from', $display_from);
            $this->set('duration_to', $display_to);
        }
		if(empty($this->request->data['Transaction']['to_date'])){
			$this->request->data['Transaction']['to_date'] = _formatDate('Y-m-d H:i:s', date('Y-m-d'), true);
			$this->request->data['Transaction']['from_date'] = _formatDate('Y-m-d H:i:s', date('Y-m-d'), true);
		}
		if(isset($this->request->params['named']['stat'])){
			$this->request->data['Transaction']['filter'] = $this->request->params['named']['stat'];
		}		
        $this->set('total_debit_amount', !empty($debit[0]['total_amount']) ? $debit[0]['total_amount'] : 0);
        $blocked_amount = $this->Transaction->User->UserCashWithdrawal->find('first', array(
            'conditions' => $blocked_conditions,
            'fields' => array(
                'SUM(UserCashWithdrawal.amount) as total_amount'
            ) ,
            'group' => array(
                'UserCashWithdrawal.user_id'
            ) ,
            'recursive' => 0
        ));
        $filter = array(
            'all' => __l('All') ,
            'day' => __l('Today') ,
            'week' => __l('This Week') ,
            'month' => __l('This Month') ,
            'custom' => __l('Custom') ,
        );
        if ($this->RequestHandler->isAjax()) {
            $this->set('isAjax', true);
        } else {
            $this->set('isAjax', false);
        }
        $this->set('filter', $filter);
        $breadCrumbs = array();
        $breadCrumbs[__l('Transactions') ] = Router::url(array(
            'controller' => 'transactions',
            'action' => 'dashboard'
        ) , true);
        $this->set('breadCrumbs', $breadCrumbs);
        $this->set('blocked_amount', !empty($blocked_amount[0]['total_amount']) ? $blocked_amount[0]['total_amount'] : 0);
    }
    public function admin_index()
    {
        if ($this->RequestHandler->prefers('csv')) {
            Configure::write('debug', 0);
            $conditions = array();
            if (!empty($this->request->params['named']['hash'])) {
                $hash = $this->request->params['named']['hash'];
            }
            if (!empty($hash) && isset($_SESSION['transaction_export'][$hash])) {
                $ids = implode(',', $_SESSION['transaction_export'][$hash]);
                if ($this->Transaction->isValidIdHash($ids, $hash)) {
                    $conditions['Transaction.id'] = $_SESSION['transaction_export'][$hash];
                } else {
                    throw new NotFoundException(__l('Invalid request'));
                }
            }
            $this->set('TransactionObj', $this);
            $this->set('conditions', $conditions);
        } else {
            $this->pageTitle = __l('Transactions');
            if (!empty($this->request->params['named']['filter'])) $this->pageTitle.= ' - ' . __l(ucwords($this->request->params['named']['filter']));
            elseif (!empty($this->request->data['Transaction']['filter'])) $this->pageTitle.= ' - ' . __l(ucwords($this->request->data['Transaction']['filter']));
            else $this->pageTitle.= ' - ' . __l('Admin');
            if (!empty($this->request->params['named']['user_id'])) {
                $this->request->data['Transaction']['user_id'] = $this->request->params['named']['user_id'];
            }
            if (!empty($this->request->params['named']['product_id'])) {
                $this->request->data['Transaction']['product_id'] = $this->request->params['named']['product_id'];
            }
            $conditions = array();
            if (empty($this->request->data['Transaction']['user_id']) && !empty($this->request->data['User']['username'])) {
                $user = $this->Transaction->User->find('first', array(
                    'conditions' => array(
                        'User.username' => $this->request->data['User']['username']
                    ) ,
                    'fields' => array(
                        'User.id'
                    ) ,
                    'recursive' => -1
                ));
                if (!empty($user)) {
                    $this->request->data['Transaction']['user_id'] = $user['User']['id'];
                } else {
                    $this->request->data['Transaction']['user_id'] = null;
                }
            }
            if (!empty($this->request->data['Transaction']['user_id'])) {
                $this->request->params['named']['user_id'] = $this->request->data['Transaction']['user_id'];
                $users_info = $this->Transaction->User->find('first', array(
                    'conditions' => array(
                        'User.id' => $this->request->data['Transaction']['user_id']
                    ) ,
                    'fields' => array(
                        'User.username'
                    ) ,
                    'recursive' => -1
                ));
                $this->request->data['Transaction']['user_id'] = $this->request->data['Transaction']['user_id'];				
				$this->pageTitle.= sprintf(__l(' - Search %s') , !empty($users_info['User']['username']) ? ' - ' . $users_info['User']['username'] : '');
				$this->request->data['User']['username'] = !empty($users_info['User']['username']) ? $users_info['User']['username']: '';
            }
            if (empty($this->request->data['Transaction']['product_id']) && !empty($this->request->data['Product']['title'])) {
                $product = $this->Transaction->Product->find('first', array(
                    'conditions' => array(
                        'Product.title' => $this->request->data['Product']['title']
                    ) ,
                    'fields' => array(
                        'Product.id'
                    ) ,
                    'recursive' => -1
                ));
                if (!empty($product)) {
                    $this->request->data['Transaction']['product_id'] = $product['Product']['id'];
                } else {
                    $this->request->data['Transaction']['product_id'] = null;
                }
            }
            if (!empty($this->request->data['Transaction']['product_id'])) {
                $this->request->params['named']['product_id'] = $this->request->data['Transaction']['product_id'];
                $conditions['Transaction.product_id'] = $this->request->data['Transaction']['product_id'];
            }
            if (!empty($this->request->data['Transaction']['from_date']['year']) && !empty($this->request->data['Transaction']['from_date']['month']) && !empty($this->request->data['Transaction']['from_date']['day'])) {
                $this->request->params['named']['from_date'] = $this->request->data['Transaction']['from_date']['year'] . '-' . $this->request->data['Transaction']['from_date']['month'] . '-' . $this->request->data['Transaction']['from_date']['day'] . ' 00:00:00';
            }
            if (!empty($this->request->data['Transaction']['to_date']['year']) && !empty($this->request->data['Transaction']['to_date']['month']) && !empty($this->request->data['Transaction']['to_date']['day'])) {
                $this->request->params['named']['to_date'] = $this->request->data['Transaction']['to_date']['year'] . '-' . $this->request->data['Transaction']['to_date']['month'] . '-' . $this->request->data['Transaction']['to_date']['day'] . ' 23:59:59';
            }
            if (empty($this->request->data['Transaction']['filter']) && (empty($this->request->params['named']['filter']) || $this->request->params['named']['filter'] != 'all') || (!empty($this->request->data['Transaction']['filter']) && $this->request->data['Transaction']['filter'] != 'all')) {
                $conditions['Transaction.user_id'] = ConstUserIds::Admin;
            }
            if (!empty($this->request->data['Transaction']['filter'])) {
                $this->request->params['named']['filter'] = $this->request->data['Transaction']['filter'];
            }
            if (!empty($this->request->params['named']['filter'])) {
                $this->request->data['Transaction']['filter'] = $this->request->params['named']['filter'];
            }
            $param_string = '';
            $param_string.= !empty($this->request->params['named']['product_id']) ? '/product_id:' . $this->request->params['named']['product_id'] : $param_string;
            $param_string.= !empty($this->request->params['named']['user_id']) ? '/user_id:' . $this->request->params['named']['user_id'] : $param_string;
            $param_string.= !empty($this->request->params['named']['from_date']) ? '/from_date:' . $this->request->params['named']['from_date'] : $param_string;
            $param_string.= !empty($this->request->params['named']['to_date']) ? '/to_date:' . $this->request->params['named']['to_date'] : $param_string;
            if (!empty($this->request->params['named']['user_id'])) {
                $conditions['Transaction.user_id'] = $this->request->params['named']['user_id'];
                $this->request->data['Transaction']['user_id'] = $this->request->params['named']['user_id'];
            }
            if (!empty($this->request->params['named']['type'])) {
                $conditions['Transaction.transaction_type_id'] = $this->request->params['named']['type'];
                $transaction_type = $this->Transaction->TransactionType->find('first', array(
                    'conditions' => array(
                        'TransactionType.id' => $this->request->params['named']['type']
                    ) ,
                    'fields' => array(
                        'TransactionType.name'
                    ) ,
                    'recursive' => -1
                ));
                $this->pageTitle.= ' - ' . $transaction_type['TransactionType']['name'];
            }
            if (!empty($this->request->params['named']['stat'])) {
                if (!empty($this->request->params['named']['stat'])) {
                    if ($this->request->params['named']['stat'] == 'day') {
                        $conditions['TO_DAYS(NOW()) - TO_DAYS(Transaction.created) <='] = 0;
                        $this->pageTitle.= __l(' - Today');
                        $this->set('transaction_filter', __l('- Today'));
                        $days = 0;
                    } else if ($this->request->params['named']['stat'] == 'week') {
                        $conditions['TO_DAYS(NOW()) - TO_DAYS(Transaction.created) <='] = 7;
                        $this->pageTitle.= __l(' - This Week');
                        $this->set('transaction_filter', __l('- This Week'));
                        $days = 7;
                    } else if ($this->request->params['named']['stat'] == 'month') {
                        $conditions['TO_DAYS(NOW()) - TO_DAYS(Transaction.created) <='] = 30;
                        $this->pageTitle.= __l(' - This Month');
                        $this->set('transaction_filter', __l('- This Month'));
                        $days = 30;
                    } else {
                        $this->pageTitle.= __l(' - Total');
                        $this->set('transaction_filter', __l('- Total'));
                    }
                }
            }
            if (!empty($this->request->params['named']['from_date']) && !empty($this->request->params['named']['to_date'])) {
                if ($this->request->params['named']['from_date'] < $this->request->params['named']['to_date']) {
                    $conditions['Transaction.created >='] = $this->request->params['named']['from_date'];
                    $conditions['Transaction.created <='] = $this->request->params['named']['to_date'];
                    $this->request->data['Transaction']['to_date'] = $this->request->params['named']['to_date'];
                    $this->request->data['Transaction']['from_date'] = $this->request->params['named']['from_date'];
                } else {
                    $this->Session->setFlash(__l('To date should be greater than From date. Please, try again.') , 'default', null, 'error');
                }
            }
            $this->paginate = array(
                'conditions' => $conditions,
                'contain' => array(
                    'TransactionType',
					'SecondUser',       
                    'User' => array(
                        'fields' => array(
                            'User.id',
                            'User.username',
                            'User.user_type_id'
                        )
                    ) ,
                    'Product' => array(
                        'User' => array(
                            'fields' => array(
                                'User.id',
                                'User.username',
                            ) ,
                        ) ,
                    ) ,
				 'Order'
                ) ,
                'order' => array(
                    'Transaction.id' => 'desc'
                ) ,
                'recursive' => 3
            );
            $users = $this->Transaction->User->find('list', array(
                'conditions' => array(
                    'User.user_type_id !=' => ConstUserTypes::Admin
                ) ,
                'order' => array(
                    'User.username' => 'asc'
                ) ,
            ));
            $export_transactions = $this->Transaction->find('all', array(
                'conditions' => $conditions,
                'fields' => array(
                    'Transaction.id'
                ) ,
                'recursive' => -1
            ));			
            $this->set('users', $this->paginate());
            if (!empty($export_transactions)) {
                $ids = array();
                foreach($export_transactions as $transactions) {
                    $ids[] = $transactions['Transaction']['id'];
                }
                $hash = $this->Transaction->getIdHash(implode(',', $ids));
                $_SESSION['transaction_export'][$hash] = $ids;
                $this->set('export_hash', $hash);
            }
            if (!empty($this->request->data)) {
                if (isset($hash)) {
                    $_SESSION['transaction_export_filter'][$hash] = $this->request->data;
                }
            }
            $filter = array(
                'all' => __l('All') ,
                'day' => __l('Today') ,
                'week' => __l('This Week') ,
                'month' => __l('This Month') ,
                'custom' => __l('Custom') ,
            );
            if ($this->RequestHandler->isAjax()) {
                $this->set('isAjax', true);
            } else {
                $this->set('isAjax', false);
            }
            $this->set('filter', $filter);
            $this->Transaction->validate = array();
            $this->Product->validate = array();
            $this->Transaction->User->validate = array();
            $this->set('users', $users);
            $this->set('transactions', $this->paginate());
            $this->set('param_string', $param_string);
        }
    }
    public function admin_export_filtered($hash = null)
    {
        $conditions = array();
        if (!empty($hash) && isset($_SESSION['transaction_export_filter'][$hash]) && $this->request->params['named']['csv'] == 'all') {
            $filter_array = $_SESSION['transaction_export_filter'][$hash];
            if (!empty($filter_array['Transaction']['user_id'])) {
                $this->request->params['named']['user_id'] = $filter_array['Transaction']['user_id'];
            }
            if (!empty($filter_array['Transaction']['from_date']['year']) && !empty($filter_array['Transaction']['from_date']['month']) && !empty($filter_array['Transaction']['from_date']['day'])) {
                $this->request->params['named']['from_date'] = $filter_array['Transaction']['from_date']['year'] . '-' . $filter_array['Transaction']['from_date']['month'] . '-' . $filter_array['Transaction']['from_date']['day'] . ' 00:00:00';
            }
            if (!empty($filter_array['Transaction']['to_date']['year']) && !empty($filter_array['Transaction']['to_date']['month']) && !empty($filter_array['Transaction']['to_date']['day'])) {
                $this->request->params['named']['to_date'] = $filter_array['Transaction']['to_date']['year'] . '-' . $filter_array['Transaction']['to_date']['month'] . '-' . $filter_array['Transaction']['to_date']['day'] . ' 23:59:59';
            }
            $param_string = "";
            $param_string.= !empty($this->request->params['named']['user_id']) ? '/user_id:' . $this->request->params['named']['user_id'] : $param_string;
            if (!empty($this->request->params['named']['user_id'])) {
                $conditions['Transaction.user_id'] = $this->request->params['named']['user_id'];
            }
            if (!empty($filter_array['User']['username'])) {
                $get_user_id = $this->Transaction->User->find('list', array(
                    'conditions' => array(
                        'User.username' => $filter_array['username'],
                    ) ,
                    'fields' => array(
                        'User.id',
                    ) ,
                    'recursive' => -1
                ));
                if (!empty($get_user_id)) {
                    $conditions['Transaction.user_id'] = $get_user_id;
                }
            }
            if (!empty($filter_array['ProductUser']['Id'])) {
                $conditions['Transaction.foreign_id'] = $filter_array['ProductUser']['Id'];
                $conditions['Transaction.class'] = 'ProductUser';
            }
            if (!empty($filter_array['Product']['title'])) {
                $orders = $this->Product->ProductUser->find('list', array(
                    'conditions' => array(
                        'ProductUser.property_id' => $filter_array['Product']['id'],
                    ) ,
                    'fields' => array(
                        'ProductUser.id',
                    ) ,
                    'recursive' => -1
                ));
            }
            if (!empty($orders) || !empty($filter_array['ProductUser']['Id'])) {
                $conditions['Transaction.foreign_id'] = !empty($filter_array['ProductUser']['Id']) ? $filter_array['ProductUser']['Id'] : $orders;
                $conditions['Transaction.class'] = 'ProductUser';
            }
            if (!empty($this->request->params['named']['from_date']) && !empty($this->request->params['named']['to_date'])) {
                if ($this->request->params['named']['from_date'] < $this->request->params['named']['to_date']) {
                    $conditions['Transaction.created >='] = $this->request->params['named']['from_date'];
                    $conditions['Transaction.created <='] = $this->request->params['named']['to_date'];
                }
            }
        } else if (!empty($hash) && isset($_SESSION['transaction_export'][$hash])) {
            $ids = implode(',', $_SESSION['transaction_export'][$hash]);
            if ($this->Transaction->isValidIdHash($ids, $hash)) {
                $conditions['Transaction.id'] = $_SESSION['transaction_export'][$hash];
            } else {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $transactions = $this->Transaction->find('all', array(
            'conditions' => $conditions,
            'contain' => array(
                'User',
                'TransactionType'
            ) ,
            'recursive' => 2,
        ));
        Configure::write('debug', 0);
        if (!empty($transactions)) {
            foreach($transactions as $transaction) {
                if ($transaction['TransactionType']['is_credit']) {
                    $credit = $transaction['Transaction']['amount'];
                    $debit = '--';
                } else {
                    $credit = '--';
                    $debit = $transaction['Transaction']['amount'];
                }
                $data[]['Transaction'] = array(
                    'Date' => $transaction['Transaction']['created'],
                    'User' => $transaction['User']['username'],
                    'Description' => $transaction['TransactionType']['name'],
                    'Credit (' . Configure::read('site.currency') . ')' => $credit,
                    'Debit (' . Configure::read('site.currency') . ')' => $debit,
                    'Gateway Fees (' . Configure::read('site.currency') . ')' => $transaction['Transaction']['gateway_fees'],
                );
            }
        }
        $this->set('data', $data);
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Transaction->delete($id)) {
            $this->Session->setFlash(__l('Transaction deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_export()
    {
        Configure::write('debug', 0);
        $conditions = array();
        if (!empty($this->request->params['named']['user_id'])) {
            $conditions['Transaction.user_id'] = $this->request->params['named']['user_id'];
        }
        $transactions = $this->Transaction->find('all', array(
            'conditions' => $conditions,
            'order' => array(
                'Transaction.id' => 'desc'
            ) ,
            'recursive' => 2
        ));
        if ($transactions) {
            foreach($transactions as $transaction) {
                if ($transaction['TransactionType']['is_credit']) {
                    $credit = $transaction['Transaction']['amount'];
                    $debit = '--';
                } else {
                    $credit = '--';
                    $debit = $transaction['Transaction']['amount'];
                }
                $data[]['Transaction'] = array(
                    'Date' => $transaction['Transaction']['created'],
                    'User' => $transaction['User']['username'],
                    'Description' => $transaction['TransactionType']['name'],
                    'Credit (' . Configure::read('site.currency') . ')' => $credit,
                    'Debit (' . Configure::read('site.currency') . ')' => $debit,
                    'Gateway Fees (' . Configure::read('site.currency') . ')' => $transaction['Transaction']['gateway_fees'],
                );
            }
        }
        $this->set('data', $data);
    }
}
?>

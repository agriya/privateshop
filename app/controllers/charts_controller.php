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
class ChartsController extends AppController
{
    public $name = 'Charts';
    public $lastDays;
    public $lastMonths;
    public $lastYears;
    public $lastWeeks;
    public $selectRanges;
    public $lastDaysStartDate;
    public $lastMonthsStartDate;
    public $lastYearsStartDate;
    public $lastWeeksStartDate;
    public function initChart()
    {
        //# last days date settings
        $days = 6;
        $this->lastDaysStartDate = date('Y-m-d', strtotime("-$days days"));
        for ($i = $days; $i > 0; $i--) {
            $this->lastDays[] = array(
                'display' => date('D, M d', strtotime("-$i days")) ,
                'conditions' => array(
                    "DATE_FORMAT(#MODEL#.created, '%Y-%m-%d')" => _formatDate('Y-m-d', date('Y-m-d', strtotime("-$i days")) , true) ,
                )
            );
        }
        $this->lastDays[] = array(
            'display' => date('D, M d') ,
            'conditions' => array(
                "DATE_FORMAT(#MODEL#.created, '%Y-%m-%d')" => _formatDate('Y-m-d', date('Y-m-d') , true)
            )
        );
        //# last weeks date settings
        $timestamp_end = strtotime('last Saturday');
        $weeks = 3;
        $this->lastWeeksStartDate = date('Y-m-d', $timestamp_end-((($weeks*7) -1) *24*3600));
        for ($i = $weeks; $i > 0; $i--) {
            $start = $timestamp_end-((($i*7) -1) *24*3600);
            $end = $start+(6*24*3600);
            $this->lastWeeks[] = array(
                'display' => date('M d', $start) . ' - ' . date('M d', $end) ,
                'conditions' => array(
                    '#MODEL#.created >=' => _formatDate('Y-m-d', date('Y-m-d', $start) , true) ,
                    '#MODEL#.created <=' => _formatDate('Y-m-d', date('Y-m-d', $end) , true) ,
                )
            );
        }
        $this->lastWeeks[] = array(
            'display' => date('M d', $timestamp_end+24*3600) . ' - ' . date('M d') ,
            'conditions' => array(
                '#MODEL#.created >=' => _formatDate('Y-m-d', date('Y-m-d', $timestamp_end+24*3600) , true) ,
                '#MODEL#.created <=' => _formatDate('Y-m-d', date('Y-m-d') , true)
            )
        );
        //# last months date settings
        $months = 2;		
        $this->lastMonthsStartDate = date('Y-m-01', strtotime("-$i months", strtotime(date("F") . "1")));
        for ($i = $months; $i > 0; $i--) {
            $this->lastMonths[] = array(
                'display' => date('M, Y', strtotime("-$i months", strtotime(date("F") . "1"))) ,
                'conditions' => array(
                    "DATE_FORMAT(#MODEL#.created, '%Y-%m')" => _formatDate('Y-m', date('Y-m-d', strtotime("-$i months")) , true)
                )
            );
        }
        $this->lastMonths[] = array(
            'display' => date('M, Y') ,
            'conditions' => array(
                "DATE_FORMAT(#MODEL#.created, '%Y-%m')" => _formatDate('Y-m', date('Y-m-d') , true)
            )
        );		
        //# last years date settings
        $years = 2;
        $this->lastYearsStartDate = date('Y-01-01', strtotime("-$years years"));
        for ($i = $years; $i > 0; $i--) {
            $this->lastYears[] = array(
                'display' => date('Y', strtotime("-$i years")) ,
                'conditions' => array(
                    "DATE_FORMAT(#MODEL#.created, '%Y')" => _formatDate('Y', date('Y-m-d', strtotime("-$i years")) , true)
                )
            );
        }
        $this->lastYears[] = array(
            'display' => date('Y') ,
            'conditions' => array(
                "DATE_FORMAT(#MODEL#.created, '%Y')" => _formatDate('Y', date('Y-m-d') , true)
            )
        );
        $this->selectRanges = array(
            'lastDays' => __l('Last 7 days') ,
            'lastWeeks' => __l('Last 4 weeks') ,
            'lastMonths' => __l('Last 3 months') ,
            'lastYears' => __l('Last 3 years')
        );
    }
    public function admin_chart_users()
    {
        if (isset($this->request->data['Chart']['is_ajax_load'])) {
            $this->request->params['named']['is_ajax_load'] = $this->request->data['Chart']['is_ajax_load'];
        }
        if (isset($this->request->params['named']['user_type_id'])) {
            $this->request->data['Chart']['user_type_id'] = $this->request->params['named']['user_type_id'];
        } else {
            $user_type_id = '';
        }
        if (isset($this->request->params['named']['is_ajax_load'])) {
            $this->initChart();
            $this->loadModel('User');
            if (isset($this->request->params['named']['select_range_id'])) {
                $this->request->data['Chart']['select_range_id'] = $this->request->params['named']['select_range_id'];
            }
            if (isset($this->request->data['Chart']['select_range_id'])) {
                $select_var = $this->request->data['Chart']['select_range_id'];
            } else {
                $select_var = 'lastDays';
            }
            if (!empty($user_type_id)) {
                $this->request->data['Chart']['user_type_id'] = $user_type_id;
            }
            $this->request->data['Chart']['select_range_id'] = $select_var;
            $model_datas['Normal'] = array(
                'display' => __l('Normal') ,
                'conditions' => array(
                    'User.is_facebook_register' => 0,
                    'User.is_twitter_register' => 0,
                    'User.is_openid_register' => 0,
                    'User.is_gmail_register' => 0,
                    'User.is_yahoo_register' => 0,
                )
            );
            $model_datas['Twitter'] = array(
                'display' => __l('Twitter') ,
                'conditions' => array(
                    'User.is_twitter_register' => 1,
                ) ,
            );
            if (Configure::read('facebook.is_enabled_facebook_connect')) {
                $model_datas['Facebook'] = array(
                    'display' => __l('Facebook') ,
                    'conditions' => array(
                        'User.is_facebook_register' => 1,
                    )
                );
            }
            if (Configure::read('user.is_enable_openid') || Configure::read('user.is_enable_gmail_openid') || Configure::read('user.is_enable_yahoo_openid')) {
                $model_datas['OpenID'] = array(
                    'display' => __l('OpenID') ,
                    'conditions' => array(
                        'User.is_openid_register' => 1,
                    )
                );
            }
            $model_datas['Gmail'] = array(
                'display' => __l('Gmail') ,
                'conditions' => array(
                    'User.is_gmail_register' => 1,
                )
            );
            $model_datas['Yahoo'] = array(
                'display' => __l('Yahoo') ,
                'conditions' => array(
                    'User.is_yahoo_register' => 1,
                )
            );
            $model_datas['All'] = array(
                'display' => __l('All') ,
                'conditions' => array()
            );
            if (empty($user_type_id)) {
                $common_conditions = array(
                    'User.user_type_id !=' => ConstUserTypes::Admin
                );
            } else {
                $common_conditions = array(
                    'User.user_type_id' => $user_type_id
                );
            }
            $_data = $this->_setLineData($select_var, $model_datas, 'User', 'User', $common_conditions);
            $this->set('chart_data', $_data);
            $this->set('chart_periods', $model_datas);
            $this->set('selectRanges', $this->selectRanges);
            // overall pie chart
            $select_var.= 'StartDate';
            $startDate = $this->$select_var;
            $endDate = date('Y-m-d');
            if (empty($user_type_id)) {
                $total_users = $this->User->find('count', array(
                    'conditions' => array(
                        'User.user_type_id !=' => ConstUserTypes::Admin,
                        'created >=' => _formatDate('Y-m-d H:i:s', $startDate, true) ,
                        'created <=' => _formatDate('Y-m-d H:i:s', $endDate, true)
                    ) ,
                    'recursive' => -1
                ));
            } else {
                $total_users = $this->User->find('count', array(
                    'conditions' => array(
                        'User.user_type_id' => $user_type_id,
                        'created >=' => _formatDate('Y-m-d H:i:s', $startDate, true) ,
                        'created <=' => _formatDate('Y-m-d H:i:s', $endDate, true)
                    ) ,
                    'recursive' => -1
                ));
            }
            unset($model_datas['All']);            
            $_pie_data = $chart_pie_relationship_data = $chart_pie_education_data = $chart_pie_employment_data = $chart_pie_income_data = $chart_pie_gender_data = $chart_pie_age_data = array();
            if (!empty($total_users)) {
                foreach($model_datas as $_period) {
                    $new_conditions = array();
                    $new_conditions = array_merge($_period['conditions'], array(
                        'created >=' => _formatDate('Y-m-d H:i:s', $startDate, true) ,
                        'created <=' => _formatDate('Y-m-d H:i:s', $endDate, true)
                    ));
                    if (empty($user_type_id)) {
                        $new_conditions['User.user_type_id !='] = ConstUserTypes::Admin;
                    } else {
                        $new_conditions['User.user_type_id'] = $user_type_id;
                    }
                    $sub_total = $this->User->find('count', array(
                        'conditions' => $new_conditions,
                        'recursive' => -1
                    ));
                    $_pie_data[$_period['display']] = number_format(($sub_total/$total_users) *100, 2);
                }
                // demographics
                if (empty($user_type_id)) {
                    $conditions = array(
                        'User.created >=' => _formatDate('Y-m-d H:i:s', $startDate, true) ,
                        'User.created <=' => _formatDate('Y-m-d H:i:s', $endDate, true) ,
                        'User.user_type_id !=' => ConstUserTypes::Admin
                    );
                } else {
                    $conditions = array(
                        'User.created >=' => _formatDate('Y-m-d H:i:s', $startDate, true) ,
                        'User.created <=' => _formatDate('Y-m-d H:i:s', $endDate, true) ,
                        'User.user_type_id' => $user_type_id
                    );
                }
                $this->_setDemographics($total_users, $conditions);
            }
            $this->set('chart_pie_data', $_pie_data);
        }
    }
    public function admin_chart_user_logins()
    {
        if (isset($this->request->data['Chart']['is_ajax_load'])) {
            $this->request->params['named']['is_ajax_load'] = $this->request->data['Chart']['is_ajax_load'];
        }
        if (isset($this->request->params['named']['user_type_id'])) {
            $this->request->data['Chart']['user_type_id'] = $this->request->params['named']['user_type_id'];
        } else {
            $user_type_id = '';
        }
        if (isset($this->request->params['named']['is_ajax_load'])) {
            $this->initChart();
            $this->loadModel('UserLogin');
            if (isset($this->request->params['named']['select_range_id'])) {
                $this->request->data['Chart']['select_range_id'] = $this->request->params['named']['select_range_id'];
            }
            if (isset($this->request->data['Chart']['select_range_id'])) {
                $select_var = $this->request->data['Chart']['select_range_id'];
            } else {
                $select_var = 'lastDays';
            }
            if (!empty($user_type_id)) {
                $this->request->data['Chart']['user_type_id'] = $user_type_id;
            }
            $this->request->data['Chart']['select_range_id'] = $select_var;
            $model_datas['Normal'] = array(
                'display' => __l('Normal') ,
                'conditions' => array(
                    'User.is_facebook_register' => 0,
                    'User.is_twitter_register' => 0,
                    'User.is_openid_register' => 0,
                    'User.is_gmail_register' => 0,
                    'User.is_yahoo_register' => 0,
                )
            );
            $model_datas['Twitter'] = array(
                'display' => __l('Twitter') ,
                'conditions' => array(
                    'User.is_twitter_register' => 1,
                ) ,
            );
            if (Configure::read('facebook.is_enabled_facebook_connect')) {
                $model_datas['Facebook'] = array(
                    'display' => __l('Facebook') ,
                    'conditions' => array(
                        'User.is_facebook_register' => 1,
                    )
                );
            }
            if (Configure::read('user.is_enable_openid') || Configure::read('user.is_enable_gmail_openid') || Configure::read('user.is_enable_yahoo_openid')) {
                $model_datas['OpenID'] = array(
                    'display' => __l('OpenID') ,
                    'conditions' => array(
                        'User.is_openid_register' => 1,
                    )
                );
            }
            $model_datas['Gmail'] = array(
                'display' => __l('Gmail') ,
                'conditions' => array(
                    'User.is_gmail_register' => 1,
                )
            );
            $model_datas['Yahoo'] = array(
                'display' => __l('Yahoo') ,
                'conditions' => array(
                    'User.is_yahoo_register' => 1,
                )
            );
            $model_datas['All'] = array(
                'display' => __l('All') ,
                'conditions' => array()
            );
            if (empty($user_type_id)) {
                $common_conditions = array(
                    'User.user_type_id !=' => ConstUserTypes::Admin
                );
            } else {
                $common_conditions = array(
                    'User.user_type_id' => $user_type_id
                );
            }
            $_data = $this->_setLineData($select_var, $model_datas, 'UserLogin', 'UserLogin', $common_conditions);
            $this->set('chart_data', $_data);
            $this->set('chart_periods', $model_datas);
            $this->set('selectRanges', $this->selectRanges);
            // overall pie chart
            $select_var.= 'StartDate';
            $startDate = $this->$select_var;
            $endDate = date('Y-m-d H:i:s');
            if (empty($user_type_id)) {
                $total_users = $this->UserLogin->find('count', array(
                    'conditions' => array(
                        'User.user_type_id !=' => ConstUserTypes::Admin,
                        'UserLogin.created >=' => _formatDate('Y-m-d H:i:s', $startDate, true) ,
                        'UserLogin.created <=' => _formatDate('Y-m-d H:i:s', $endDate, true) ,
                    ) ,
                    'recursive' => 0
                ));
            } else {
                $total_users = $this->UserLogin->find('count', array(
                    'conditions' => array(
                        'User.user_type_id' => $user_type_id,
                        'UserLogin.created >=' => _formatDate('Y-m-d H:i:s', $startDate, true) ,
                        'UserLogin.created <=' => _formatDate('Y-m-d H:i:s', $endDate, true) ,
                    ) ,
                    'recursive' => 0
                ));
            }
            unset($model_datas['All']);            
            $_pie_data = array();
            if (!empty($total_users)) {
                foreach($model_datas as $_period) {
                    $new_conditions = array();
                    $new_conditions = array_merge($_period['conditions'], array(
                        'UserLogin.created >=' => _formatDate('Y-m-d H:i:s', $startDate, true) ,
                        'UserLogin.created <=' => _formatDate('Y-m-d H:i:s', $endDate, true)
                    ));
                    if (empty($user_type_id)) {
                        $new_conditions['User.user_type_id !='] = ConstUserTypes::Admin;
                    } else {
                        $new_conditions['User.user_type_id'] = $user_type_id;
                    }
                    $sub_total = $this->UserLogin->find('count', array(
                        'conditions' => $new_conditions,
                        'recursive' => 0
                    ));
                    $_pie_data[$_period['display']] = number_format(($sub_total/$total_users) *100, 2);
                }
            }
            $this->set('chart_pie_data', $_pie_data);
        }
    }
    protected function _setDemographics($total_users, $conditions = array())
    {
        $this->loadModel('User');
        $chart_pie_gender_data = $chart_pie_age_data = array();
        if (!empty($total_users)) {
            $not_mentioned = array(
                '0' => __l('Not Mentioned')
            );
			//# genders
            $genders = array(
                '1' => __l('Male') ,
                '2' => __l('Female') ,
            );
            $genders = array_merge($not_mentioned, $genders);
            foreach($genders As $gen_key => $gender) {
                $new_conditions = $conditions;
                if ($gen_key == 0) {
                    $new_conditions['UserProfile.gender_id'] = array(NULL, 0);
                } else {
                    $new_conditions['UserProfile.gender_id'] = $gen_key;
                }					
                $gender_count = $this->User->UserProfile->find('count', array(
                    'conditions' => $new_conditions,
                    'recursive' => 0
                ));
				//print_r($new_conditions);
                $chart_pie_gender_data[$gender] = number_format(($gender_count/$total_users) *100, 2);
            }
            //# age calculation
            $user_ages = array(
                '1' => __l('18 - 34 Yrs') ,
                '2' => __l('35 - 44 Yrs') ,
                '3' => __l('45 - 54 Yrs') ,
                '4' => __l('55+ Yrs')
            );
            $user_ages = array_merge($not_mentioned, $user_ages);
            foreach($user_ages As $age_key => $user_ages) {
                $new_conditions = $conditions;
                if ($age_key == 1) {
                    $new_conditions['Year(Now()) - Year(UserProfile.dob) >= '] = 18;
                    $new_conditions['Year(Now()) - Year(UserProfile.dob) <= '] = 34;
                } elseif ($age_key == 2) {
                    $new_conditions['Year(Now()) - Year(UserProfile.dob) >= '] = 35;
                    $new_conditions['Year(Now()) - Year(UserProfile.dob) <= '] = 44;
                } elseif ($age_key == 3) {
                    $new_conditions['Year(Now()) - Year(UserProfile.dob) >= '] = 45;
                    $new_conditions['Year(Now()) - Year(UserProfile.dob) <= '] = 54;
                } elseif ($age_key == 4) {
                    $new_conditions['Year(Now()) - Year(UserProfile.dob) >= '] = 55;
                } elseif ($age_key == 0) {
                    $new_conditions['UserProfile.dob'] = NULL;
                }
                $age_count = $this->User->UserProfile->find('count', array(
                    'conditions' => $new_conditions,
                    'recursive' => 0
                ));
                $chart_pie_age_data[$user_ages] = number_format(($age_count/$total_users) *100, 2);
            }
        }
		$this->set('chart_pie_gender_data', $chart_pie_gender_data);
        $this->set('chart_pie_age_data', $chart_pie_age_data);
    }
    public function admin_chart_overview()
    {
        $this->initChart();
        if (isset($this->request->params['named']['select_range_id'])) {
            $this->request->data['Chart']['select_range_id'] = $this->request->params['named']['select_range_id'];
        }
        if (isset($this->request->data['Chart']['select_range_id'])) {
            $select_var = $this->request->data['Chart']['select_range_id'];
        } else {
            $select_var = 'lastDays';
        }
        $this->request->data['Chart']['select_range_id'] = $select_var;
        $conditions = array();
        //Transaction block
        $transaction_model_datas = array();
        $transaction_model_datas['Cleared'] = array(
            'display' => __l('Cleared') . ' (' . Configure::read('site.currency') . ')',
            'model' => 'Order',
			'display_field' => 'Transaction',
			'conditions' => array(
				'Order.order_status_id' => array(
					ConstOrderStatus::Shipped,
					ConstOrderStatus::Completed,
				)
			) ,
        );
        $transaction_model_datas['Pipeline'] = array(
            'display' => __l('Pipeline') . ' (' . Configure::read('site.currency') . ')',
            'model' => 'Order',
			'display_field' => 'Transaction',
			'conditions' => array(
				'Order.order_status_id' => ConstOrderStatus::InProcess,
			) ,
        );
        $transaction_model_datas['Lost'] = array(
            'display' => __l('Lost') . ' (' . Configure::read('site.currency') . ')',
            'model' => 'Order',
			'display_field' => 'Transaction',
			'conditions' => array(
				'Order.order_status_id' => ConstOrderStatus::CanceledAndRefunded,
			) ,
        );
        $chart_transactions_data = $this->_admin_chart_amounts($transaction_model_datas, $select_var);
        $this->set('chart_transactions_periods', $transaction_model_datas);
        $this->set('chart_transactions_data', $chart_transactions_data);
        //Order block
		$this->loadModel('OrderStatus');
		$orderStatus = $this->OrderStatus->find('list');
        foreach($orderStatus as $id => $val) {
            $order_model_data[$val] = array(
				'display' => $val,
				'model' => 'Order',
				'conditions' => array(
					'Order.order_status_id' => $id
				) ,
            );
        }
		$_data = $this->_setLineData($select_var, $order_model_data, 'Order', 'Order');
        $this->set('chart_order_periods', $order_model_data);
        $this->set('chart_order_data', $_data);
        $this->set('selectRanges', $this->selectRanges);
    }
    public function _admin_chart_amounts($model_datas, $select_var)
    {
        $chart_model_data = array();
        $this->loadModel('Transaction');
        $this->loadModel('Order');
        foreach($this->$select_var as $val) {
            foreach($model_datas as $model_data) {
                $new_conditions = array();
                if (isset($model_data['model'])) {
                    $modelClass = $model_data['model'];
                } else {
                    $modelClass = 'Transaction';
                }
                foreach($val['conditions'] as $key => $v) {
                    $key = str_replace('#MODEL#', $modelClass, $key);
                    $new_conditions[$key] = $v;
                }
                $new_conditions = array_merge($new_conditions, $model_data['conditions']);
                if ($modelClass == 'Transaction') {
                    $value_count = $this->{$modelClass}->find('all', array(
                        'conditions' => $new_conditions,
                        'fields' => array(
                            'SUM(Transaction.amount) as total_amount'
                        ) ,
                        'recursive' => -1
                    ));
                    $value_count = is_null($value_count[0][0]['total_amount']) ? 0 : $value_count[0][0]['total_amount'];
                } else if ($modelClass == 'Order' && $model_data['display_field'] == 'Transaction') {
                    $value_count = $this->Order->find('all', array(
                        'conditions' => $new_conditions,
                        'fields' => array(
                            'SUM(Order.amount) as total_amount'
                        ) ,
                        'recursive' => -1
                    ));
                    $value_count = is_null($value_count[0][0]['total_amount']) ? 0 : $value_count[0][0]['total_amount'];
                } else {
                    $value_count = $this->{$modelClass}->find('count', array(
                        'conditions' => $new_conditions,
                        'recursive' => 0
                    ));
                }
                $chart_model_data[$val['display']][] = $value_count;
            }
        }
        return $chart_model_data;
    }
    public function admin_chart_products()
    {
        $this->initChart();
		$this->loadModel('Product');
        if (isset($this->request->data['Chart']['is_ajax_load'])) {
            $this->request->params['named']['is_ajax_load'] = $this->request->data['Chart']['is_ajax_load'];
        }
        if (isset($this->request->params['named']['select_range_id'])) {
            $this->request->data['Chart']['select_range_id'] = $this->request->params['named']['select_range_id'];
        }
        if (isset($this->request->data['Chart']['select_range_id'])) {
            $select_var = $this->request->data['Chart']['select_range_id'];
        } else {
            $select_var = 'lastDays';
        }
        $this->request->data['Chart']['select_range_id'] = $select_var;
        $conditions = array();
        //Product block
        $product_model_datas = array();
		$productStatus = $this->Product->ProductStatus->find('list');
        foreach($productStatus as $id => $val) {
            $product_model_datas[$val] = array(
				'display' => $val,
				'model' => 'Product',
				'conditions' => array(
					'Product.product_status_id' => $id
				)
            );
        }
        $_data = $this->_setLineData($select_var, $product_model_datas, 'Product', 'Product');
        $this->set('chart_product_periods', $product_model_datas);
        $this->set('chart_product_data', $_data);
		//Product view block
        $product_view_model_datas['Product View'] = array(
            'display' => __l('Product View') ,
            'conditions' => array() ,
        );
        $product_view_model_datas = $this->_setLineData($select_var, $product_view_model_datas, 'ProductView', 'ProductView');
        $this->set('chart_product_view_data', $product_view_model_datas);
		
		//Product download block
        $product_download_model_datas['Product Download'] = array(
            'display' => __l('Product Download') ,
            'conditions' => array() ,
        );
        $product_download_model_datas = $this->_setLineData($select_var, $product_download_model_datas, 'ProductDownload', 'ProductDownload');
        $this->set('chart_product_download_data', $product_download_model_datas);
		
		$this->set('selectRanges', $this->selectRanges);
    }
	public function admin_chart_user_activities()
    {
        $message_model_data = array();
        $this->initChart();
        $this->loadModel('Message');
        if (isset($this->request->data['Chart']['is_ajax_load'])) {
            $this->request->params['named']['is_ajax_load'] = $this->request->data['Chart']['is_ajax_load'];
        }
        if (isset($this->request->params['named']['select_range_id'])) {
            $this->request->data['Chart']['select_range_id'] = $this->request->params['named']['select_range_id'];
        }
        if (isset($this->request->data['Chart']['select_range_id'])) {
            $select_var = $this->request->data['Chart']['select_range_id'];
        } else {
            $select_var = 'lastDays';
        }
        $this->request->data['Chart']['select_range_id'] = $select_var;
        //User view block
        $user_view_model_datas['User View'] = array(
            'display' => __l('User View') ,
            'conditions' => array() ,
        );
        $user_view_model_datas = $this->_setLineData($select_var, $user_view_model_datas, 'UserView', 'UserView');
        $this->set('user_view_model_data', $user_view_model_datas);
        //User message block
        $message_model_data['Suspended'] = array(
            'display' => __l('Suspended') ,
            'conditions' => array(
                'Message.is_sender' => 1,
                'MessageContent.admin_suspend' => 1,
            ) ,
        );
        $message_model_data['Flagged'] = array(
            'display' => __l('Flagged') ,
            'conditions' => array(
                'Message.is_sender' => 1,
                'MessageContent.is_system_flagged' => 1,
            )
        );
        $message_model_data['All'] = array(
            'display' => __l('All') ,
            'conditions' => array(
                'Message.is_sender' => 1,
            )
        );
        $_data = $this->_setLineData($select_var, $message_model_data, 'Message', 'Message');
        $this->set('chart_user_message_data', $_data);
        $this->set('chart_user_message_periods', $message_model_data);
        $this->set('selectRanges', $this->selectRanges);
    }

    protected function _setLineData($select_var, $model_datas, $models, $model = '', $common_conditions = array())
    {
        if (is_array($models)) {
            foreach($models as $m) {
                $this->loadModel($m);
            }
        } else {
            $this->loadModel($models);
            $model = $models;
        }
        $_data = array();
        foreach($this->$select_var as $val) {
            foreach($model_datas as $model_data) {
                $new_conditions = array();
                foreach($val['conditions'] as $key => $v) {
                    $key = str_replace('#MODEL#', $model, $key);
                    $new_conditions[$key] = $v;
                }
                $new_conditions = array_merge($new_conditions, $model_data['conditions']);
                $new_conditions = array_merge($new_conditions, $common_conditions);
                if (isset($model_data['model'])) {
                    $modelClass = $model_data['model'];
                } else {
                    $modelClass = $model;
                }
                $_data[$val['display']][] = $this->{$modelClass}->find('count', array(
                    'conditions' => $new_conditions,
                    'recursive' => 0
                ));
            }
        }
        return $_data;
    }
    public function admin_chart_stats()
    {
    }
}
?>

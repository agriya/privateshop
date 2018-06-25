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
class PaymentsController extends AppController
{
    public $name = 'Payments';
    public $uses = array(
        'Payment',
        'PaymentGateway',
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Payment.remove',
            'Payment.update',
            'Payment.checkout',
            'Payment.confirm',
            'UserAddress.country_id',
            'City.name',
            'State.name',
        );
        parent::beforeFilter();
    }
    public function order()
    {
        $this->pageTitle = __l('Cart');
        $this->loadModel('Cart');
		if ($this->Auth->user('id')) {
            $user = $this->Cart->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->Auth->user('id')
                ) ,
                'recursive' => -1
            ));
            $this->set('user', $user);
        }
        if (!empty($this->request->data)) {
            if (!$this->Auth->user('id') && !empty($this->request->data['Payment']['checkout'])) {
                if ($this->Cart->User->validates()) {
                    $this->request->data['User']['is_active'] = 1;
                    $this->request->data['User']['is_email_confirmed'] = 1;
                    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['passwd']);
                    $this->request->data['User']['user_type_id'] = ConstUserTypes::User;
                    $this->request->data['User']['ip_id'] = $this->Payment->toSaveIp();
                    if ($this->Cart->User->save($this->request->data['User'], false)) {
                        $user_id = $this->Cart->User->getLastInsertId();
                        $this->Cart->User->_sendWelcomeMail($user_id, $this->request->data['User']['email'], $this->request->data['User']['username']);
                        $this->Auth->login($this->request->data['User']);
                    }
                } else {
                    $this->Session->setFlash(__l('Oops, problems in registration, please try again or later.') , 'default', null, 'error');
                }
            }
            if (!empty($this->request->data['Payment']['checkout']) && isset($this->request->data['Payment']['user_address_id']) && empty($this->request->data['Payment']['user_address_id'])) {
                if (!empty($this->request->data['City']['name'])) {
                    $this->request->data['UserAddress']['city_id'] = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->Cart->User->UserAddress->City->findOrSaveAndGetId($this->request->data['City']['name']);
                }
                if (!empty($this->request->data['UserAddress']['country_id'])) {
                    $this->request->data['UserAddress']['country_id'] = $this->Cart->User->UserAddress->Country->findCountryId($this->request->data['UserAddress']['country_id']);
                }
                if (!empty($this->request->data['State']['name'])) {
                    $this->request->data['UserAddress']['state_id'] = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->Cart->User->UserAddress->State->findOrSaveAndGetId($this->request->data['State']['name']);
                }
                $this->request->data['UserAddress']['user_id'] = $this->Auth->user('id');
                $this->request->data['UserAddress']['is_active'] = 1;
                if ($this->Cart->User->UserAddress->checkShippingAddress($this->request->data['UserAddress']['address'],$this->Auth->user('id'))) {
                    $this->Session->setFlash(__l('Address you have entered is already exist. Please, try again.') , 'default', null, 'error');
                    $this->redirect(array(
                        'controller' => 'payments',
                        'action' => 'order'
                    ));
                }
                $this->Cart->User->UserAddress->create();
                if ($this->Cart->User->UserAddress->save($this->request->data)) {
                    $user_address_id = $this->Cart->User->UserAddress->getLastInsertId();
                    $this->request->data['Payment']['user_address_id'] = $user_address_id;
                } else {
                    $this->Session->setFlash(__l('Please enter shipping address for this order. Please, try again.') , 'default', null, 'error');
                    $this->redirect(array(
                        'controller' => 'payments',
                        'action' => 'order'
                    ));
                }
            }
            if (!empty($this->request->data['Payment']['user_address_id'])) {
                $userAddress = $this->Cart->User->UserAddress->find('first', array(
                    'conditions' => array(
                        'UserAddress.id' => $this->request->data['Payment']['user_address_id']
                    ) ,
                    'recursive' => -1
                ));
            }
            if (!empty($this->request->data['Payment']['remove'])) {
                foreach($this->request->data['Cart'] as $cart_id => $is_checked) {
                    if (!empty($is_checked['id'])) {
                        $this->Cart->delete($cart_id);
                        $is_product_deleted = 1;
                    }
                }
                if (!empty($is_product_deleted)) {
                    $this->Session->setFlash(__l('Checked product(s) removed from cart successfully') , 'default', null, 'success');
                } else {
                    $this->Session->setFlash(__l('Please select atlest one product to remove') , 'default', null, 'error');
                }
            } elseif (!empty($this->request->data['Payment']['update']) || !empty($this->request->data['Payment']['checkout'])) {
                if ($this->Cart->validateQuantity($this->request->data)) {
                    if (!empty($this->request->data['Payment']['user_address_id']) && empty($this->request->data['Payment']['is_multiple_address'])) {
                        foreach($this->request->data['Cart'] as $cart_id => $is_checked) {
                            if (is_array($is_checked) && !empty($is_checked['is_requires_shipping'])) {
                                $product_ids[] = $is_checked['product_id'];
                            }
                        }
                        if (!empty($product_ids)) {
                            $productShipmentCosts = $this->Cart->Product->getProductShipmentCost($product_ids);
                        }
                    }
					$error = 0;
                    foreach($this->request->data['Cart'] as $cart_id => $is_checked) {
                        if (is_array($is_checked) && !empty($is_checked['quantity'])) {
                            $_data = array();
                            $_data['Cart']['id'] = $cart_id;
                            if ($this->Auth->user('id')) {
                                $_data['Cart']['user_id'] = $this->Auth->user('id');
                            }
                            $_data['Cart']['quantity'] = $is_checked['quantity'];
                            $_data['Cart']['price'] = $is_checked['quantity']*$is_checked['price'];
                            $_data['Cart']['shipping_price'] = 0;
							// [buy_as_gift] store values in cart
							if (Configure::read('module.buy_as_gift')) {
								$_data['Cart']['is_send_as_gift'] = $is_checked['is_send_as_gift'];
								$_data['Cart']['gift_wrap_note'] = $is_checked['gift_wrap_note'];
								if (!empty($is_checked['gift_friend_email'])) {
									$_data['Cart']['gift_friend_email'] = $is_checked['gift_friend_email'];
								}
								if (!empty($is_checked['user_address_id'])) {
									$_data['Cart']['user_address_id'] = $is_checked['user_address_id'];
								}
								if (isset($is_checked['is_gift_wrap'])) {
									$_data['Cart']['is_gift_wrap'] = $is_checked['is_gift_wrap'];
								}
							}
                            if (!empty($is_checked['is_requires_shipping']) && !empty($this->request->data['Payment']['user_address_id']) || !empty($is_checked['user_address_id'])) {
								// [buy_as_gift] multiple shipping address validation in cart
								$user_address_id = !empty($is_checked['user_address_id'])? $is_checked['user_address_id']:$this->request->data['Payment']['user_address_id'];
								if (!empty($user_address_id)) {
									$userAddress = $this->Cart->User->UserAddress->find('first', array(
										'conditions' => array(
											'UserAddress.id' => $user_address_id
										) ,
										'recursive' => -1
									));
									$productShipmentCosts = $this->Cart->Product->getProductShipmentCost($is_checked['product_id']);
								}
                                if (in_array($userAddress['UserAddress']['country_id'], $productShipmentCosts['Country'])) {
                                    if ($_data['Cart']['quantity'] > 1) {
                                        $_data['Cart']['shipping_price'] = $productShipmentCosts[$userAddress['UserAddress']['country_id']]['shipment_cost']+($productShipmentCosts[$userAddress['UserAddress']['country_id']]['additional_quantity_shipment_cost']*($_data['Cart']['quantity']-1));
                                    } else {
                                        $_data['Cart']['shipping_price'] = $productShipmentCosts[$userAddress['UserAddress']['country_id']]['shipment_cost'];
                                    }
                                    $is_shipping_allowed_arr[$cart_id] = 1;
                                } else {
                                    $is_shipping_allowed_arr[$cart_id] = 0;
									if (!empty($is_checked['user_address_id'])) {
										$this->Cart->validationErrors[$cart_id]['user_address_id'] = __l('This product does not ship to this address.');
									}
									$error = 1;
                                }
                            }
							if (!empty($is_checked['is_requires_shipping']) && empty($this->request->data['Payment']['user_address_id']) && empty($is_checked['user_address_id'])) {
								$this->Cart->validationErrors[$cart_id]['user_address_id'] = __l('Required');
								
							}
                            $_data['Cart']['total_price'] = $_data['Cart']['price']+$_data['Cart']['shipping_price'];
							if (Configure::read('module.credits') && !empty($is_checked['credits'])) {
								$_data['Cart']['credits'] = $is_checked['quantity'] * $is_checked['credits'];
							}
                            $this->Cart->save($_data, false);
                        }
                    }
                    if (!empty($is_shipping_allowed_arr)) {
                        $this->set('is_shipping_allowed_arr', $is_shipping_allowed_arr);
                    }
					if (empty($error)) {
						if (!empty($this->request->data['Payment']['update'])) {
							$this->Session->setFlash(__l('Product(s) quantity updated successfully') , 'default', null, 'success');
						} elseif (!empty($this->request->data['Payment']['checkout'])) {
							if (!empty($userAddress) && empty($this->request->data['Payment']['is_multiple_address'])) {
								$this->set('user_address_id', $userAddress['UserAddress']['id']);
								$this->set('address', $userAddress['UserAddress']['address'] . ', ' . $userAddress['UserAddress']['zipcode']);
							}
							$this->set('is_show_confirm_order', 1);
						}
					}
                } else {
                    $is_quantity_error = $error = 1;
					foreach($this->request->data['Cart'] as $key => $cart_data){
						$this->request->data['Cart'][$key]['gift_wrap_note'] = $cart_data['gift_wrap_note'];
					}
                }
				if (!empty($error) || !empty($is_quantity_error)) {
					if (!empty($this->request->data['Payment']['update'])) {
						if (!empty($is_quantity_error)) {
	                        $this->Session->setFlash(__l('Product(s) quantity not updated. Please try again.') , 'default', null, 'error');
						} else {
	                        $this->Session->setFlash(__l('Cart(s) updated. But please change your shipping address to proceed checkout. Please try again.') , 'default', null, 'error');
						}
                    } elseif (!empty($this->request->data['Payment']['checkout'])) {
                        $this->Session->setFlash(__l('Checkout process not completed. Please try again.') , 'default', null, 'error');
                    }
				}
            } elseif (!empty($this->request->data['Payment']['confirm'])) {
                $error = 0;
			
                // [payment] validate payment gateway
                if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::Wallet) {
                    if ($user['User']['available_balance_amount'] < $this->request->data['Payment']['amount']) {
                        $error = 1;
                        $this->Session->setFlash(__l('Your wallet has insufficient money') , 'default', null, 'error');
                        if (!empty($userAddress)) {
                            $this->set('user_address_id', $userAddress['UserAddress']['id']);
                            $this->set('address', $userAddress['UserAddress']['address'] . ', ' . $userAddress['UserAddress']['zipcode']);
                        } elseif (!empty($this->request->data['Payment']['address'])) {
                            $this->set('address', $this->request->data['Payment']['address']);
                        }
                        $this->set('is_show_confirm_order', 1);
                    }
                }
                if (empty($error)) {
                    if (!empty($this->request->data['Cart'])) {
                        foreach($this->request->data['Cart'] as $cart_id => $is_checked) {
							// [buy_as_gift] order id formation
							if (!empty($is_checked['is_send_as_gift']) && empty($this->request->data['Payment']['is_multiple_address'])) {
								$orderDetails['gift'][] = array(
									'owner_user_id' => $is_checked['owner_user_id'],
									'amount' => $is_checked['total_price'],
									'total_commission_amount' => (!empty($is_checked['commission_amount'])) ? $is_checked['commission_amount'] : 0,
									'user_address_id' => !empty($this->request->data['Payment']['user_address_id']) ? $this->request->data['Payment']['user_address_id'] : '',
									'product_ids' => $is_checked['product_id']
								);
							}
							if (empty($is_checked['is_send_as_gift']) && empty($this->request->data['Payment']['is_multiple_address'])) {
								if (!empty($orderDetails['own'])) {
									$key = $this->Payment->checkKeyExists($orderDetails['own'], $is_checked['owner_user_id']);
									if (is_int($key)) {
										$orderDetails['own'][$key]['amount'] += $is_checked['total_price'];
		                                $orderDetails['own'][$key]['total_commission_amount'] += (!empty($is_checked['commission_amount'])) ? $is_checked['commission_amount'] : 0;
		                                $orderDetails['own'][$key]['product_ids'] .= ',' . $is_checked['product_id'];
										$is_exists = 1;
									}
                                }
								if (empty($is_exists)) {
									$orderDetails['own'][] = array(
										'owner_user_id' => $is_checked['owner_user_id'],
										'amount' => $is_checked['total_price'],
										'total_commission_amount' => (!empty($is_checked['commission_amount'])) ? $is_checked['commission_amount'] : 0,
										'user_address_id' => !empty($this->request->data['Payment']['user_address_id']) ? $this->request->data['Payment']['user_address_id'] : '',
										'product_ids' => $is_checked['product_id']
									);
                                }
							}
							if (!empty($this->request->data['Payment']['is_multiple_address'])) {
								$orderDetails['multiple'][] = array(
									'owner_user_id' => $is_checked['owner_user_id'],
									'amount' => $is_checked['total_price'],
									'total_commission_amount' => (!empty($is_checked['commission_amount'])) ? $is_checked['commission_amount'] : 0,
									'user_address_id' => !empty($is_checked['user_address_id']) ? $is_checked['user_address_id'] : '',
									'product_ids' => $is_checked['product_id']
								);
							}
                        }
                    }
                    if (!empty($orderDetails) || !empty($this->request->data['Order']['id'])) {
                        if (!empty($orderDetails)) {
                            foreach($orderDetails as $type => $tmpOrderDetail) {
								foreach($tmpOrderDetail as $orderDetail) {
									$data = array();
									$data['Order']['user_id'] = $this->Auth->user('id');
									$data['Order']['owner_user_id'] = $orderDetail['owner_user_id'];
									$data['Order']['payment_gateway_id'] = $this->request->data['Payment']['payment_gateway_id'];
									$data['Order']['amount'] = $orderDetail['amount'];
									$data['Order']['order_status_id'] = ConstOrderStatus::PaymentPending;
									$data['Order']['is_shipped_order'] = 0;
									// [seller] store commission amount
									if (Configure::read('module.seller')) {
										$data['Order']['total_commission_amount'] = $orderDetail['total_commission_amount'];
									}
									if (!empty($orderDetail['user_address_id'])) {
										$userAddress = $this->Cart->User->UserAddress->find('first', array(
											'conditions' => array(
												'UserAddress.id' => $orderDetail['user_address_id']
											) ,
											'recursive' => -1
										));
										if (!empty($userAddress)) {
											$data['Order']['receiver_name'] = $userAddress['UserAddress']['full_name'];
											$data['Order']['address'] = $userAddress['UserAddress']['address'];
											$data['Order']['city_id'] = $userAddress['UserAddress']['city_id'];
											$data['Order']['state_id'] = $userAddress['UserAddress']['state_id'];
											$data['Order']['country_id'] = $userAddress['UserAddress']['country_id'];
											$data['Order']['zipcode'] = $userAddress['UserAddress']['zipcode'];
											$data['Order']['phone'] = $userAddress['UserAddress']['phone'];
											$data['Order']['is_shipped_order'] = 1;
										}
									}
									$this->Cart->User->Order->create();
									if ($this->Cart->User->Order->save($data)) {
										$order_ids[] = $order_id = $this->Cart->User->Order->getLastInsertId();
										$product_ids = explode(',', $orderDetail['product_ids']);
										foreach($product_ids as $product_id) {
											if ($type == 'own') {
												$multipleOrderList[$product_id] = $order_id;
											} else {
												$singleOrderList[$product_id] = $order_id;
											}
										}
									}
								}
                            }
                        } elseif (!empty($this->request->data['Order']['id'])) {
							$data = array();
							$data['Order']['id'] = $this->request->data['Order']['id'];
							$data['Order']['payment_gateway_id'] = $this->request->data['Payment']['payment_gateway_id'];
							$this->Cart->User->Order->save($data);
                            $order_ids[] = $this->request->data['Order']['id'];
                        }
                        if (!empty($order_ids)) {
                            $order_ids = implode(',', $order_ids);
                            if (!empty($this->request->data['Cart'])) {
                                foreach($this->request->data['Cart'] as $cart_id => $is_checked) {
                                    if (is_array($is_checked) && !empty($is_checked['product_id'])) {
                                        $cart_ids[] = $cart_id;
                                        $data = array();
                                        $data['OrderItem']['user_id'] = $this->Auth->user('id');
                                        $data['OrderItem']['product_id'] = $is_checked['product_id'];
										$data['OrderItem']['product_attribute_id'] = !empty($is_checked['product_attribute_id']) ? $is_checked['product_attribute_id'] : '';
										if (!empty($is_checked['is_send_as_gift']) || !empty($this->request->data['Payment']['is_multiple_address'])) {
	                                        $data['OrderItem']['order_id'] = $singleOrderList[$is_checked['product_id']];
										} else {
	                                        $data['OrderItem']['order_id'] = $multipleOrderList[$is_checked['product_id']];
										}
                                        $data['OrderItem']['quantity'] = $is_checked['quantity'];
										if (Configure::read('module.credits') && !empty($is_checked['credits'])) {
	                                        $data['OrderItem']['credits'] = $is_checked['quantity'] * $is_checked['credits'];
										}
                                        $data['OrderItem']['price'] = $is_checked['cart_price'];
                                        if (!empty($is_checked['shipping_price'])) {
                                            $data['OrderItem']['shipping_price'] = $is_checked['shipping_price'];
                                        }
										// [seller] store commission amount
										if (Configure::read('module.seller')) {
											$data['OrderItem']['commission_amount'] = $is_checked['commission_amount'];
										}
										// [buy_as_gift] store values in order_items
										if (Configure::read('module.buy_as_gift')) {
											$data['OrderItem']['is_send_as_gift'] = $is_checked['is_send_as_gift'];
											$data['OrderItem']['gift_wrap_note'] = $is_checked['gift_wrap_note'];
											if (!empty($is_checked['gift_friend_email'])) {
												$data['OrderItem']['gift_friend_email'] = $is_checked['gift_friend_email'];
											}
											if (isset($is_checked['is_gift_wrap'])) {
												$data['OrderItem']['is_gift_wrap'] = $is_checked['is_gift_wrap'];
												$data['OrderItem']['gift_wrap_fee'] = !empty($is_checked['gift_wrap_fee']) ? $is_checked['gift_wrap_fee'] : '';
											}
										}
                                        $data['OrderItem']['total_price'] = $is_checked['total_price'];										
										$this->Cart->User->Order->OrderItem->create();
                                        $this->Cart->User->Order->OrderItem->save($data);
                                    }
                                }
                                if (!empty($cart_ids)) {
                                    foreach($cart_ids as $cart_id) {
                                        $this->Cart->delete($cart_id);
                                    }
                                }
                            }
                            // [payment] payment process
                            if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::PayPal) {
                                $this->response->body($this->requestAction(array(
                                    'controller' => 'paypals',
                                    'action' => 'do_payment',
                                    $order_ids,
                                    $this->request->data['Payment']['amount'],
                                    ConstPaymentTypes::Order,
                                ) , array(
                                    'return',
                                    'bare' => false
                                )));
                            } elseif ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::Wallet) {
                                $this->response->body($this->requestAction(array(
                                    'controller' => 'wallets',
                                    'action' => 'process_payment',
                                    $order_ids,
                                    $this->request->data['Payment']['amount'],
                                    ConstPaymentTypes::Order,
                                ) , array(
                                    'return',
                                    'bare' => false
                                )));
                            }
                            $this->response->send();
                            $this->_stop();
                        }
                    }
                }
            }
        }
        if (!empty($this->request->params['named']['order_id'])) {
            if (!$this->Auth->user('id')) {
                $this->Session->setFlash($this->Auth->loginError, 'default', null, 'error');
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'login'
                ));
            }
			$user_id = $this->Cart->User->Order->find('first', array(
                'conditions' => array(
                    'Order.id' => $this->request->params['named']['order_id'],
                 ) ,
				'fields' => array(
       				'Order.user_id',
				 ),
				'recursive' => -1
            ));
            $order = $this->Cart->User->Order->find('first', array(
                'conditions' => array(
                    'Order.user_id' => $user_id['Order']['user_id'] ,
                    'Order.id' => $this->request->params['named']['order_id'],
                    'Order.order_status_id' => ConstOrderStatus::PaymentPending,
                ) ,
                'contain' => array(
                    'OrderItem' => array(
    				'ProductAttribute' => array(
						'Attachment',
						'AttributesProductAttribute'
	    				),
                        'Product' => array(
                            'Attachment'
                        ) ,
                    ) ,
                    'User'
                ) ,
                'recursive' => 3
            ));
            if (empty($order)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $this->set('order', $order);
            if (!empty($order['Order']['is_shipped_order'])) {
                $this->set('address', $order['Order']['address'] . ', ' . $order['Order']['zipcode']);
            }
            $this->set('is_show_confirm_order', 1);
            $this->pageTitle = __l('Order#') . $order['Order']['id'];
        } else {
            if ($this->Auth->user('id')) {
                $conditions['Cart.user_id'] = $this->Auth->user('id');
            } else {
                $conditions['Cart.session_id'] = session_id();
            }
            $carts = $this->Cart->find('all', array(
                'conditions' => $conditions,
                'contain' => array(
					'ProductAttribute' => array(
						'Attachment',
						'AttributesProductAttribute'
					),
                    'Product' => array(
                        'Attachment'
                    ) ,
                    'User',
                ) ,
                'recursive' => 2
            ));			
            $this->set('carts', $carts);
			$userAddresses = array();
            if ($this->Auth->user('id')) {
                $tmpUserAddresses = $this->Cart->User->UserAddress->find('all', array(
                    'conditions' => array(
                        'UserAddress.user_id' => $this->Auth->user('id') ,
                        'UserAddress.is_active' => 1
                    ) ,
                    'recursive' => -1
                ));
                if (!empty($tmpUserAddresses)) {
                    foreach($tmpUserAddresses as $tmpUserAddress) {
                        $userAddresses[$tmpUserAddress['UserAddress']['id']] = $tmpUserAddress['UserAddress']['address'] . ', ' . $tmpUserAddress['UserAddress']['zipcode'];
                        if (!empty($tmpUserAddress['UserAddress']['is_primary'])) {
                            $primary_address_id = $tmpUserAddress['UserAddress']['id'];
                        }
                    }
                }
            }
			if (empty($this->request->params['named']['type'])) {
	            $userAddresses['0'] = __l('Add new shipping address');
			}
            if (empty($primary_address_id)) {
                $primary_address_id = 0;
            }
            $this->set('primary_address_id', $primary_address_id);            
        }
        $paymentGateways = $this->Cart->getGatewayTypes('is_enable_for_purchase');
        // [payment] set default payment gateway
        if (empty($this->request->data['Payment']['payment_gateway_id'])) {
            if (!empty($paymentGateways[ConstPaymentGateways::PayPal])) {
                $this->request->data['Payment']['payment_gateway_id'] = ConstPaymentGateways::PayPal;
            } elseif (!empty($paymentGateways[ConstPaymentGateways::Wallet])) {
                $this->request->data['Payment']['payment_gateway_id'] = ConstPaymentGateways::Wallet;
            }
        }
        $this->set(compact('userAddresses', 'paymentGateways'));
    }
    public function admin_order_cancel($order_id)
    {
        $this->pageTitle = __l('Order Cancel');
        $this->loadModel('Order');
        if (is_null($order_id)) {
            throw new NotFoundException('Invalid request');
        }
        $order = $this->Order->find('first', array(
            'conditions' => array(
                'Order.id' => $order_id,
                'Order.order_status_id' => ConstOrderStatus::InProcess
            ) ,
            'contain' => array(
                'OrderItem' => array(                    
					'Product' => array(
                        'fields' => array(
                            'Product.id',
                            'Product.title',
                            'Product.slug',
                            'Product.is_having_file_to_download',
                            'Product.is_credit_product',
                        ) ,
                    ) ,
                    'User' => array(
                    ) ,
                ) ,
            ) ,
            'recursive' => 2
        ));
        $this->log($order);
		$refund_amount = 0;
		foreach($order['OrderItem'] as $orderItem){
			if(empty($orderItem['Product']['is_having_file_to_download'])){
				$refund_amount += $orderItem['total_price'];
			}
		}		
        if (!empty($order)) {
            $update_order['User']['id'] = $order['Order']['user_id'];
            $new_balance = $orderItem['User']['available_balance_amount'] + $refund_amount;
            $update_order['User']['available_balance_amount'] = $new_balance;
            $this->Order->User->save($update_order);
            
            $data = array();
            $data['Transaction']['user_id'] = $order['Order']['user_id'];
            $data['Transaction']['foreign_id'] = $order_id;
            $data['Transaction']['class'] = 'Order';
            $data['Transaction']['transaction_type_id'] = ConstTransactionTypes::Refund;
            $data['Transaction']['amount'] = $refund_amount;
            $data['Transaction']['payment_gateway_id'] = ConstPaymentGateways::Wallet;
            $this->Order->User->Transaction->create();
            $this->Order->User->Transaction->save($data);
            $this->Order->updateCancelOrder($order);
            $this->Session->setFlash(__l('Order canceled successfully.') , 'default', null, 'success');
        } else {
            $this->Session->setFlash(__l('You cannot able to cancel other users or completed orders. Please try again.') , 'default', null, 'error');
        }
        $this->redirect(array(
            'controller' => 'orders',
            'action' => 'index',
			'type' => 'mypurchases',
        ));
    }
    public function add_to_wallet()
    {
        $this->pageTitle = __l('Add Amount to Wallet');
        $this->Payment->create();
        $this->loadModel('User');
        if (!empty($this->request->data)) {
            if ($this->User->_checkAmount($this->request->data['Payment']['amount'])) {
                // [payment] payment process
                if ($this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::PayPal) {
                    $this->response->body($this->requestAction(array(
                        'controller' => 'paypals',
                        'action' => 'do_payment',
                        $this->Auth->user('id') ,
                        $this->request->data['Payment']['amount'],
                        ConstPaymentTypes::Wallet
                    ) , array(
                        'return',
                        'bare' => false
                    )));
                }
                $this->response->send();
                $this->_stop();
            } else {
				if(Configure::read('wallet.max_wallet_amount') == '')  {
					$this->Session->setFlash(__l('Amount should be '.Configure::read('wallet.min_wallet_amount').' and above.Please, try again.') , 'default', null, 'error');
				}
				else{
                $this->Session->setFlash(__l('Amount should be '.Configure::read('wallet.min_wallet_amount').' to '. Configure::read('wallet.max_wallet_amount').'. Please, try again.') , 'default', null, 'error');
				}
            }
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            ) ,
            'fields' => array(
                'User.id',
                'User.username',
                'User.available_balance_amount',
            ) ,
            'recursive' => -1
        ));
        $this->set('user', $user);
        $paymentGateways = $this->User->getGatewayTypes('is_enable_for_add_to_wallet');
        // [payment] set default payment gateway
        if (empty($this->request->data['Payment']['payment_gateway_id'])) {
            if (!empty($paymentGateways[ConstPaymentGateways::PayPal])) {
                $this->request->data['Payment']['payment_gateway_id'] = ConstPaymentGateways::PayPal;
            }
        }
        $this->set(compact('paymentGateways'));
    }
    public function payment_success($type)
    {        
        if ($type == ConstPaymentTypes::Order) {
			$this->Session->setFlash(__l('Your payment has been successfully completed.') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'orders',
                'action' => 'index',
				'type' => 'mypurchases',
            ));
        }
        if ($type == ConstPaymentTypes::Wallet) {
			$this->Session->setFlash(__l('Amount has been added to your wallet successfully.') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'payments',
                'action' => 'add_to_wallet'
            ));
        }
    }
    public function payment_cancel()
    {
        $this->Session->setFlash(__l('Your payment has been canceled.') , 'default', null, 'success');
        $this->redirect('/');
    }
    
}

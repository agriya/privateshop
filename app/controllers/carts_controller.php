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
class CartsController extends AppController
{
    public $name = 'Carts';
	public function beforeFilter()
    {
        $this->disableCache();
        $this->Security->disabledFields = array(            
			'ProductAttribute',
			'Cart.product_attribute_id',
			'Cart.quantity'
        );
        parent::beforeFilter();
    }
    public function add()
    {
        $this->pageTitle = __l('Add Cart');
        if ($this->request->is('post')) {					
            $product = $this->Cart->Product->find('first', array(
                'conditions' => array(
                    'Product.id = ' => $this->request->data['Cart']['product_id'],
                ) ,
                'recursive' => -1,
            ));
			if($this->request->data['Cart']['quantity']<=0){
				$this->Session->setFlash(__l('Quantity should be greater than 0. Please, try again.') , 'default', null, 'error');
				$this->redirect(array(
					'controller' => 'products',
					'action' => 'view',
					$product['Product']['slug']
				));
			}
			if(!empty($this->request->data['Cart']['product_attribute_id'])){
				$this->loadModel('ProductAttribute');
				$productAttribute = $this->ProductAttribute->find('first', array(
					'conditions' => array(
						'ProductAttribute.id' => $this->request->data['Cart']['product_attribute_id'],
          				'ProductAttribute.product_id' => $this->request->data['Cart']['product_id'],
                    ),					
					'recursive' => -1
				));		
				if(empty($productAttribute)){
					$this->Session->setFlash(__l('Unknown variant selection. Please, try again.') , 'default', null, 'error');
					$this->redirect(array(
						'controller' => 'products',
						'action' => 'view',
						$product['Product']['slug']
					));
				}
				if(!empty($productAttribute)){
					$product['Product']['quantity']  = $productAttribute['ProductAttribute']['quantity'];
					$product['Product']['sold_quantity']  = $productAttribute['ProductAttribute']['sold_quantity'];
					$product['Product']['original_price'] = $productAttribute['ProductAttribute']['original_price'];
					$product['Product']['discounted_price'] = $productAttribute['ProductAttribute']['discounted_price'];
				}
			}
            else
            {
             $this->request->data['Cart']['product_attribute_id'] = 0;
            }
            $product_id = $this->request->data['Cart']['product_id'];
            $data['Cart'][$product_id] = array(
                'quantity' => $this->request->data['Cart']['quantity'],
                'is_send_as_gift' => !empty($this->request->data['Cart']['is_send_as_gift']) ? $this->request->data['Cart']['is_send_as_gift'] : 0,
                'product_id' => $product['Product']['id'],
                'available_quantity' => $product['Product']['quantity']-$product['Product']['sold_quantity'],
                'maximum_quantity_to_send_as_gift' => $product['Product']['maximum_quantity_to_send_as_gift'],
                'maximum_quantity_to_buy_as_own' => $product['Product']['maximum_quantity_to_buy_as_own']
            );
            $this->Cart->create();
            if ($this->Cart->validateQuantity($data)) {
                $conditions['Cart.product_id'] = $this->request->data['Cart']['product_id'];
                if($this->request->data['Cart']['product_attribute_id'])
                {
                  $attr_id = $this->request->data['Cart']['product_attribute_id'];
                }
                else
                {
                  $attr_id = 0;
                }
				$conditions['Cart.product_attribute_id'] = $this->request->data['Cart']['product_attribute_id'];
                // [buy_as_gift] Condition check to add in cart
                if (Configure::read('module.buy_as_gift')) {
                    $conditions['Cart.is_send_as_gift'] = $this->request->data['Cart']['is_send_as_gift'];
                }
                if ($this->Auth->user('id')) {
                    $conditions['OR']['Cart.session_id'] = session_id();
                    $conditions['OR']['Cart.user_id'] = $this->Auth->user('id');
                } else {
                    $conditions['Cart.session_id'] = session_id();
                }
                $cart = $this->Cart->find('first', array(
                    'conditions' => $conditions,
                    'recursive' => -1
                ));
                if (empty($cart)) {
                    $this->request->data['Cart']['price'] = $product['Product']['original_price'];
                    if ($product['Product']['discounted_price'] > 0 || $product['Product']['discount_amount'] >=$product['Product']['original_price']) {
                        $this->request->data['Cart']['price'] = $product['Product']['discounted_price'];
                    }
                    $this->request->data['Cart']['total_price'] = $this->request->data['Cart']['price']*$this->request->data['Cart']['quantity'];
                    $this->request->data['Cart']['is_available'] = 1;
                    $this->request->data['Cart']['session_id'] = session_id();
                    if (Configure::read('module.credits') && !empty($product['Product']['is_credit_product'])) {
						$this->loadModel('Credit');
                        $this->request->data['Cart']['credits'] = $this->Credit->getCredits($this->request->data, $product);
                    }
                    if ($this->Auth->user('id')) {
                        $this->request->data['Cart']['user_id'] = $this->Auth->user('id');
                    }
                    //qunanity validation
                    if ($this->request->data['Cart']['quantity'] > ($product['Product']['quantity']-$product['Product']['sold_quantity'])) {
                        $this->Session->setFlash(__l('Oops, you have choosen more quantity') , 'default', null, 'error');
                        if (!empty($this->request->data['Cart']['type'])) {
                            if ($this->request->data['Cart']['type'] == 'home') {
                                $this->redirect(array(
                                    'controller' => 'products',
                                    'action' => 'index'
                                ));
                            } else {
                                $this->redirect(array(
                                    'controller' => 'products',
                                    'action' => 'view',
                                    $this->request->data['Cart']['slug']
                                ));
                            }
                        } else {
                            $this->redirect(array(
                                'action' => 'index'
                            ));
                        }
                    }
                    if ($this->Cart->save($this->request->data)) {
                        $this->Session->setFlash(__l('Product has been successfuly added in your shopping cart.') , 'default', null, 'success');
                    } else {
                        $this->Session->setFlash(__l('Cart could not be added. Please, try again.') , 'default', null, 'error');
						$this->redirect(array(
							'controller' => 'products',
							'action' => 'view',
							$product['Product']['slug']
						));
                    }
                } else {
                    $cart_id = $cart['Cart']['id'];
                    $data = array();
                    $data['Cart']['id'] = $cart_id;
                    $data['Cart']['quantity'] = $this->request->data['Cart']['quantity']+$cart['Cart']['quantity'];
                    $data['Cart']['price'] = ($product['Product']['discounted_price'] > 0) ? $product['Product']['discounted_price'] : $product['Product']['original_price'];
                    $data['Cart']['price'] = $product['Product']['original_price'];
                    if (Configure::read('module.buy_as_gift')) {
                      $data['Cart']['is_send_as_gift'] = !empty($this->request->data['Cart']['is_send_as_gift']) ? $this->request->data['Cart']['is_send_as_gift'] : 0;
                    }
                    if (Configure::read('module.credits') && !empty($product['Product']['is_credit_product'])) {
						$this->loadModel('Credit');
                        $data['Cart']['credits'] = $this->Credit->getCredits($data, $product);
                    }
                    if ($product['Product']['discounted_price'] > 0) {
                        $data['Cart']['price'] = $product['Product']['discounted_price'];
                    }

                    $new_conditions = array(
                                             'Cart.product_id' => $product['Product']['id'],
                                           );
                    if ($this->Auth->user('id')) {
                      $new_conditions['Cart.session_id'] = session_id();
                      $new_conditions['Cart.user_id'] = $this->Auth->user('id');
                     } else {
                      $new_conditions['Cart.session_id'] = session_id();
                     }
                    $total_product_count = $this->Cart->find('all', array(
                      'conditions' =>  $new_conditions,
                      'fields' => array('SUM(Cart.quantity) as total_product')));
                    //qunanity validation
                    $total_count = $total_product_count['0']['0']['total_product'] + $this->request->data['Cart']['quantity'];
                    if ($total_count > $product['Product']['maximum_quantity_to_buy_as_own']) {
                        $this->Session->setFlash(__l('Oops, you have choosen more quantity') , 'default', null, 'error');
                        if (!empty($this->request->data['Cart']['type'])) {
                            if ($this->request->data['Cart']['type'] == 'home') {
                                $this->redirect(array(
                                    'controller' => 'products',
                                    'action' => 'index'
                                ));
                            } else {
                                $this->redirect(array(
                                    'controller' => 'products',
                                    'action' => 'view',
                                    $this->request->data['Cart']['slug']
                                ));
                            }
                        } else {
                            $this->redirect(array(
                                'action' => 'index'
                            ));
                        }
                    }
                    if(!empty($this->request->data['Cart']['is_send_as_gift']))
                    {
                      if ($data['Cart']['quantity'] > $product['Product']['maximum_quantity_to_send_as_gift']) {
                        $this->Session->setFlash(__l('Oops, you have choosen more quantity') , 'default', null, 'error');
                        if (!empty($this->request->data['Cart']['type'])) {
                            if ($this->request->data['Cart']['type'] == 'home') {
                                $this->redirect(array(
                                    'controller' => 'products',
                                    'action' => 'index'
                                ));
                            } else {
                                $this->redirect(array(
                                    'controller' => 'products',
                                    'action' => 'view',
                                    $this->request->data['Cart']['slug']
                                ));
                            }
                        } else {
                            $this->redirect(array(
                                'action' => 'index'
                            ));
                        }
                     }
                    }
                    $data['Cart']['total_price'] = $data['Cart']['price']*$data['Cart']['quantity'];
                    $data['Cart']['product_attribute_id'] = $attr_id;
                    if ($this->Cart->save($data, false)) {
                        $this->Session->setFlash(__l('Product has been successfuly added in your shopping cart.') , 'default', null, 'success');
                    } else {
                        $this->Session->setFlash(__l('Cart could not be added. Please, try again.') , 'default', null, 'error');
						$this->redirect(array(
							'controller' => 'products',
							'action' => 'view',
							$product['Product']['slug']
						));
                    }
                }
            } else {
				if(isset($this->Cart->validationErrors[$product_id]['quantity'])){
					$this->Session->setFlash($this->Cart->validationErrors[$product_id]['quantity']. ' '. __l('Please, try again.') , 'default', null, 'error');
				} else{
					$this->Session->setFlash(__l('Oops, products no longer available') , 'default', null, 'error');
				}
				$this->redirect(array(
					'controller' => 'products',
					'action' => 'view',
					$product['Product']['slug']
				));
            }
            $this->redirect(array(
                'controller' => 'payments',
                'action' => 'order'
            ));
        }
    }
    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Cart->delete($id)) {
            $this->Session->setFlash(__l('Product has been successfuly removed from your shopping cart.') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'payments',
                'action' => 'order'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_index()
    {
        $this->pageTitle = __l('carts');
        $this->Cart->recursive = 0;
        $this->set('carts', $this->paginate());
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Cart->delete($id)) {
            $this->Session->setFlash(__l('Product has been successfuly removed from your shopping cart.') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'carts',
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}

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
class Cart extends AppModel
{
    public $name = 'Cart';
    public $displayField = 'id';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ) ,
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ),
		'ProductAttribute' => array(
            'className' => 'ProductAttribute',
            'foreignKey' => 'product_attribute_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => ''
        ),
    );
    function __construct($id = false, $table = null, $ds = null) 
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'product_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'quantity' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'price' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'total_price' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'gift_friend_email' => array(
				'rule2' => array(
                    'rule' => 'email',
                    'allowEmpty' => false,
                    'message' => __l('Must be a valid email') ,
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'user_address_id' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
        );
    }
	function validateQuantity($data)
	{
		$error = 0;
		foreach($data['Cart'] as $cart_id => $is_checked) {
			if (is_array($is_checked) && !empty($is_checked['quantity'])) {
				if (!isset($quantity_arr[$is_checked['product_id']])) {
					$quantity_arr[$is_checked['product_id']] = array(
						'cart_id' => $cart_id,
						'quantity' => $is_checked['quantity'],
						'available_quantity' => $is_checked['available_quantity']
					);
				} else {
					$quantity_arr[$is_checked['product_id']]['quantity'] += $is_checked['quantity'];
				}
				$quantity_purchased = $this->User->Order->isQuantityPurchased($is_checked['product_id']);
				if (Configure::read('module.buy_as_gift') && !empty($is_checked['is_send_as_gift']) && !empty($is_checked['maximum_quantity_to_send_as_gift'])) {
					$quantity_purchased = $this->User->Order->isQuantityPurchased($is_checked['product_id'], 1);
					if ((($is_checked['quantity']+$quantity_purchased) > $is_checked['maximum_quantity_to_send_as_gift'])) {
						$this->validationErrors[$cart_id]['quantity'] = __l('Quantity is more than maximum quantity purchase as gift.');
						$error = 1;
					}
				} elseif (!empty($is_checked['maximum_quantity_to_buy_as_own']) && (($is_checked['quantity']+$quantity_purchased) > $is_checked['maximum_quantity_to_buy_as_own'])) {
					$this->validationErrors[$cart_id]['quantity'] = __l('Quantity is more than maximum quantity purchase as own');
					$error = 1;
				}
			}
		}
		if (!empty($quantity_arr)) {
			foreach($quantity_arr as $product_id => $quantity_tmp_arr) {
				if ($quantity_tmp_arr['quantity'] > $quantity_tmp_arr['available_quantity']) {
					if (!isset($this->validationErrors[$quantity_tmp_arr['cart_id']['quantity']])) {
						$this->validationErrors[$quantity_tmp_arr['cart_id']]['quantity'] = __l('Should be less than available quantity');
					} else {
						$this->validationErrors[$quantity_tmp_arr['cart_id']]['quantity'] .= '<br/>' . __l('Should be less than available quantity');
					}
					$error = 1;
				}
			}
		}
		if (!empty($error)) {
			return false;
		}
		return true;
	}
}

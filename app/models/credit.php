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
class Credit extends AppModel
{
    var $useTable = false;
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
			'credit_price' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Must be in numeric') ,
                ) ,
				'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'credits' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Must be in numeric') ,
                ) ,
				'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'credit_expiry_date' => array(
                'rule2' => array(
                    'rule' => array(
                        '_isValidExpiryDate'
                    ) ,
                    'message' => __l('Credit expiry date should be greater than end date') ,
                    'allowEmpty' => false
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
        );
    }
    function getCredits($data, $product)
    {
		App::import('Model', 'Setting');
        $this->Product = new Product();
        if (!empty($_SESSION['Auth']['User']['id'])) {
            $user = $this->Product->User->find('first', array(
                'conditions' => array(
                    'User.id' => $_SESSION['Auth']['User']['id'],
                ) ,
                'recursive' => -1
            ));
            return $data['Cart']['quantity']*$product['Product']['credits'];
        } else {
            return $data['Cart']['quantity']*$product['Product']['credits'];
        }
    }
}

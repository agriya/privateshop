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
class Payment extends AppModel
{
    var $useTable = false;
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'amount' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
        );
    }
	public function checkKeyExists($orderDetails, $owner_user_id)
	{
		foreach($orderDetails as $key => $value) {
			if ($owner_user_id == $value['owner_user_id']) {
				return $key;
			}
		}
		return false;
	}
}
?>
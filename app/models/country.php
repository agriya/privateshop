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
class Country extends AppModel
{
    public $name = 'Country';
    public $displayField = 'name';
    public $actsAs = array(
        'Sluggable' => array(
            'label' => array(
                'name'
            )
        )
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $hasMany = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'country_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'country_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->moreActions = array(
            ConstMoreAction::Delete => __l('Delete')
        );
        $this->validate = array(
            'name' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
            'population' => array(
                'rule' => 'numeric',
                'message' => __l('Give numeric format') ,
                'allowEmpty' => true
            )
        );
    }
    function findCountryIdFromIso2($iso2)
    {
        $findExist = $this->find('first', array(
            'conditions' => array(
                'iso2' => $iso2
            ) ,
            'fields' => array(
                'id'
            ) ,
            'recursive' => - 1
        ));
        if (!empty($findExist)) {
            return $findExist[$this->name]['id'];
        }
    }
}
?>
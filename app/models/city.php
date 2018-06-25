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
class City extends AppModel
{
    public $name = 'City';
    public $displayField = 'name';
    public $actsAs = array(
        'Sluggable' => array(
            'label' => array(
                'name'
            )
        )
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->isFilterOptions = array(
            ConstMoreAction::Inactive => __l('Disapproved') ,
            ConstMoreAction::Active => __l('Approved')
        );
        $this->moreActions = array(
            ConstMoreAction::Disapproved => __l('Disapproved') ,
            ConstMoreAction::Approved => __l('Approved') ,
            ConstMoreAction::Delete => __l('Delete')
        );
        $this->validate = array(
            'name' => array(
                'rule' => 'notempty',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
            'state_id' => array(
                'rule' => 'numeric',
                'message' => __l('Required') ,
                'allowEmpty' => false
            ) ,
            'country_id' => array(
                'rule' => 'numeric',
                'message' => __l('Required') ,
                'allowEmpty' => false
            )
        );
    }
	function findOrSaveCityAndGetId($name, $state_id, $country_id, $latitude, $longitude)
    {
        $findExist = $this->find('first', array(
            'conditions' => array(
                'name' => $name
            ) ,
            'fields' => array(
                'id'
            ) ,
            'recursive' => -1
        ));
        if (!empty($findExist)) {
            return $findExist[$this->name]['id'];
        } else {
            $data['City']['name'] = $name;
            if (!empty($state_id)) $data['City']['state_id'] = $state_id;
            if (!empty($country_id)) $data['City']['country_id'] = $country_id;
            if (!empty($latitude)) $data['City']['latitude'] = $latitude;
            if (!empty($longitude)) $data['City']['longitude'] = $longitude;
            $this->create();
            $this->set($data['City']);
            $this->save($data['City']);
            return $this->getLastInsertId();;
        }
    }
}
?>
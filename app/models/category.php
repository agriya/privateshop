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
   class Category extends AppModel {  
   public $name = 'Category';
   public $actsAs = array(
   		'Tree',
        'Sluggable' => array(
            'label' => array(
                'name'
            )
        ) ,
   	);
    var $hasMany = array(
        'CategoryPhoto' => array(
            'className' => 'CategoryPhoto',
            'foreignKey' => 'category_id',
            'dependent' => false,
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
        $this->validate = array(
            'parent_id' => array(
                'rule' => 'numeric',
                'allowEmpty' => false,
                'message' => __l('Required')
            ),
            'name' => array(
                'rule' => 'notempty',
                'allowEmpty' => false,
                'message' => __l('Required')
            ),
            'description' => array(
                'rule' => 'notempty',
                'allowEmpty' => false,
                'message' => __l('Required')
            ),
        );
        $this->moreActions = array(
            ConstMoreAction::Delete => __l('Delete')
        );
    }
	function _get_parent($id)
	{
		$category = $this->find('first', array(
            'conditions' => array(
                'Category.id' => $id,
            ) ,
			'fields' => array(
				'Category.id',
				'Category.parent_id'
			),
            'recursive' => -1,
        ));
	    if(!empty($category['Category']['parent_id'])){
			return $this->_get_parent($category['Category']['parent_id']);
		} else{
			return $category['Category']['id'];
		}
	}
	function getParentCategory($category_id)
	{
		$category_id = $this->_get_parent($category_id);
		$category = $this->find('first', array(
            'conditions' => array(
                'Category.id' => $category_id,
            ) ,
            'contain' => array(
                'CategoryPhoto' => array(
                    'Attachment',
                ) ,
            ) ,
            'recursive' => 2,
        ));		
		return $category;
	}
	function getCategoeyBreadCrumb($id)
	{
		$categories = $this->_generate_bread_crumb($id); 
		krsort($categories);	
		return $categories;
	}
	function _generate_bread_crumb($id)
	{		
		static $breadcrumb = array();
		$category = $this->find('first', array(
            'conditions' => array(
                'Category.id' => $id,
            ) ,			
            'recursive' => -1,
        ));
		
		$breadcrumb[] = $category;		
	    if(!empty($category['Category']['parent_id'])){
			return $this->_generate_bread_crumb($category['Category']['parent_id']);
		} else{			
			return $breadcrumb;
		}
	}
}
?>
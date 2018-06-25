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
class GroupedCountry extends AppModel
{
    var $name = 'GroupedCountry';
    var $displayField = 'name';
    var $actsAs = array(
        'Polymorphic' => array(
            'classField' => 'related_class',
            'foreignKey' => 'related_condition',
        )
    );
    var $belongsTo = array(
        'Union' => array(
            'className' => 'Union',
            'foreignKey' => 'related_condition',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'Continent' => array(
            'className' => 'Continent',
            'foreignKey' => 'related_condition',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
?>
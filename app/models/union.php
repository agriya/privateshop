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
class Union extends AppModel
{
    var $name = 'Union';
    var $displayField = 'name';
    var $hasAndBelongsToMany = array(
        'Country' => array(
            'className' => 'Country',
            'joinTable' => 'countries_unions',
            'foreignKey' => 'union_id',
            'associationForeignKey' => 'country_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );
    var $hasOne = array(
        'GroupedCountry' => array(
            'className' => 'GroupedCountry',
            'foreignKey' => 'related_condition',
            'dependent' => true,
            'conditions' => array(
                'GroupedCountry.related_class' => 'Union',
            ) ,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}
?>
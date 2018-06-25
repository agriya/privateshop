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
class PolymorphicBehavior extends ModelBehavior
{
    /**
     * defaultSettings property
     *
     * @var array
     * @access protected
     */
    var $_defaultSettings = array(
        'classField' => 'class',
        'foreignKey' => 'foreign_id'
    );
    /**
     * setup method
     *
     * @param mixed $model
     * @param array $config
     * @return void
     * @access public
     */
    function setup(&$model, $config = array())
    {
        $this->settings[$model->alias] = am($this->_defaultSettings, $config);
    }
    /**
     * afterFind method
     *
     * @param mixed $model
     * @param mixed $results
     * @param bool $primary
     * @access public
     * @return void
     */
    function afterFind(&$model, $results, $primary = false)
    {
        extract($this->settings[$model->alias]);
        if ($primary && isset($results[0][$model->alias][$classField]) && $model->recursive > 0) {
            foreach($results as $key => $result) {
                $associated = array();
                $class = Inflector::classify($result[$model->alias][$classField]);
                $foreignId = $result[$model->alias][$foreignKey];
                if ($class && $foreignId) {
                    $associated = !empty($result[$class]) ? $result[$class] : array();
                    $result = $result[$model->alias];
                    if (!isset($model->$class)) {
                        $model->bindModel(array(
                            'belongsTo' => array(
                                $class => array(
                                    'conditions' => array(
                                        $model->alias . '.' . $classField => $class
                                    ) ,
                                    'foreignKey' => $foreignKey
                                )
                            )
                        ));
                    }
                    $conditions = array(
                        $class . '.id' => $foreignId
                    );
                    $recursive = $model->recursive - 1;
                    $name = $model->$class->find('list', compact('conditions'));
                    if (!empty($name[$foreignId])) // fix to Skip the 'list,count... ' etc from polymorphic Fix by Subin
                    {
                        $associated[$class]['display_field'] = $name[$foreignId];
                        // Added to include the Recurisve level of polymorphic parant
                        // This simply appedning all the susbarrys to polymorphic parant
                        // Fix by Subin
                        foreach($associated as $sub_module => $sub_associated) {
                            if ($sub_module != $class) {
                                $associated[$class][$sub_module] = $sub_associated;
                            }
                        }
                        $results[$key][$class] = $associated[$class];
                    }
                }
            }
        } elseif (isset($results[$model->alias][$classField])) {
            $associated = array();
            $class = $results[$model->alias][$classField];
            $foreignId = $results[$model->alias][$foreignKey];
            if ($class && $foreignId) {
                $result = $results[$model->alias];
                if (!isset($model->$class)) {
                    $model->bindModel(array(
                        'belongsTo' => array(
                            $class => array(
                                'conditions' => array(
                                    $model->alias . '.' . $classField => $class
                                ) ,
                                'foreignKey' => $foreignKey
                            )
                        )
                    ));
                }
                $associated = $model->$class->find(array(
                    $class . '.id' => $foreignId
                ) , array(
                    'recursive' => - 1
                ));
                $associated[$class]['display_field'] = $associated[$class][$model->$class->displayField];
                $results[$class] = $associated[$class];
            }
        }
        return $results;
    }
}
?>
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
class SuspiciousWordsDetectorBehavior extends ModelBehavior
{
    /**
     * Contain settings indexed by model name.
     *
     * @var array
     * @access private
     */
    var $__settings = array();
    var $__detected_suspicious_words = array();
    /**
     * Array containing all bad words to be replaced
     *
     * @var array
     * @access private
     */
    public $__badWords = array();
    /**
     * Initiate behavior for the model using specified settings. Available settings:
     *
     * - fields: array of fields to search and replace in
     *
     * - type: determines when replace happens
     *                 - 'find' runs afterFind (non-destructive)
     *                 - 'save' runs beforeSave (destructive)
     *                 - 'both' runs after find and before save (obviously!)
     *
     * @param object $Model Model using the behaviour
     * @param array $settings Settings to override for model.
     * @access public
     */
    function setup(&$Model, $settings = array())
    {
        // To over ride the censored words
        $bad_words = Configure::read('suspicious_detector.suspiciouswords');
        $this->__badWords = explode("\n", $bad_words);
        //$this->__badWords = trim($this->__badWords);
        //$censoredwords = $modelObjone->find('all', array('fields' => array('CensorWord.word')));
        $default = array(
            'fields' => array(
                'name'
            )
        );
        if (!isset($this->__settings[$Model->alias])) {
            $this->__settings[$Model->alias] = $default;
        }
        $this->__settings[$Model->alias] = am($this->__settings[$Model->alias], (is_array($settings) ? $settings : array()));
    }
    /**
     * Runs before a save() operation.
     *
     * @param object $Model    Model using the behaviour
     * @param array $results Results of the find operation.
     * @access public
     */
    function beforeSave(&$Model)
    {
        // check field has content
        if (!empty($this->__settings[$Model->alias]['fields']) && $this->__badWords) {
            $is_system_flagged = 0;
            // loop through results
            foreach($Model->data as $row) {
                // loop through fields
                foreach($this->__settings[$Model->alias]['fields'] as $field) {
                    // check field exists
                    if (isset($row[$field])) {
                        // replace isntances of each bad word
                        foreach($this->__badWords as $word) {
                            if (!empty($word)) { // Fix for empty values during explode
                                if (preg_match_all('/' . $word . '/i', $row[$field], $filtered_words, PREG_OFFSET_CAPTURE)) {
                                    $is_system_flagged = 1;
                                    foreach($filtered_words as $filtered_word_subs) {
                                        foreach($filtered_word_subs as $filtered_word_sub) {
                                            $this->__detected_suspicious_words[] = $filtered_word_sub['0'];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $suspend_array = array(
                'Product' => Configure::read('Product.auto_suspend_product_on_system_flag') ,
            );
            if (!empty($is_system_flagged)) {
                $Model->data[$Model->alias]['is_system_flagged'] = 1;
                if ($suspend_array[$Model->alias]) { // During auto suspend turned on by admin
                    $Model->data[$Model->alias]['admin_suspend'] = 1;
                }
                $Model->data[$Model->alias]['detected_suspicious_words'] = serialize(array_unique($this->__detected_suspicious_words));
            } else { // During Edit
                $Model->data[$Model->alias]['detected_suspicious_words'] = '';
                $Model->data[$Model->alias]['is_system_flagged'] = 0;
            }
        }
        return true;
    }
}
?>
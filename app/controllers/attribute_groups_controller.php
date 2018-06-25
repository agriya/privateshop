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
class AttributeGroupsController extends AppController
{
    public $name = 'AttributeGroups';
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'AttributeGroup.attribute_group_type_id',
			'AttributeGroup.add',
			'AttributeGroup.order',
			'AttributeGroup.name',
			'AttributeGroup.display_name',
        );
        parent::beforeFilter();
    }    
    public function admin_add() 
    {
        $this->pageTitle = __l('Add Variant Group');
        if (!empty($this->request->data['AttributeGroup']['add'])) {
			if ($this->request->params['isAjax'] == 1 || !empty($this->request->params['form']['is_iframe_submit'])) {
				$this->layout = 'ajax';
			 }
            $this->AttributeGroup->create();
            if ($this->AttributeGroup->save($this->request->data)) {
				$this->Session->setFlash(__l('Variant group has been added') , 'default', null, 'success');
				if (!$this->RequestHandler->isAjax()) {
					$this->redirect(array(
						'action' => 'index'
					));
                } else {
					$ajax_url = Router::url(array('controller' => 'attributes','action' => 'index'));
					if ($this->request->params['isAjax'] == 1 || !empty($this->request->params['form']['is_iframe_submit'])) {
						$success_msg = 'redirect*' . $ajax_url;
						echo $success_msg;
						exit;			
					}
				    // Ajax: return added answer
                    //$this->setAction('view', $this->AttributeGroup->getLastInsertId() , 'view_ajax');
                }				
            } else {
                $this->Session->setFlash(__l('Variant group could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $attributeGroupTypes = $this->AttributeGroup->AttributeGroupType->find('list');
        $this->set(compact('attributeGroupTypes'));
    }    
    public function admin_delete($id = null,$from_attribute=null) 
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->AttributeGroup->id = $id;
        if (!$this->AttributeGroup->exists()) {
            throw new NotFoundException(__l('Invalid attribute group'));
        }
        $this->AttributeGroup->deleteAll(array(
                        'AttributeGroup.id' => $id,
                    ));
		$this->Session->setFlash(__l('Variant group deleted') , 'default', null, 'success');
		if($from_attribute) {
			$this->redirect(array(
				'controller' => 'attributes',
				'action' => 'index'
			));
		} else {
			$this->redirect(array(
				'action' => 'index'
			));
		}	
    }
}

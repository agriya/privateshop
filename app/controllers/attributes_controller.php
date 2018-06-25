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
class AttributesController extends AppController
{
    public $name = 'Attributes';
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attribute',
            'AttributeGroup',
        );
        parent::beforeFilter();
    }    
    public function admin_index() 
    {
        $this->pageTitle = __l('Variants');
		$data['ValidateAttributeGroup'] = array();
        if (!empty($this->request->data['Attribute']['add'])) {
			$is_form_valid = true;
			if ($this->request->params['isAjax'] == 1 || !empty($this->request->params['form']['is_iframe_submit'])) {
				$this->layout = 'ajax';
			 }
			if(!empty($this->request->data['AttributeGroup'])) {
				foreach($this->request->data['AttributeGroup'] as $key => $AttributeGroups) {
					foreach($AttributeGroups as $key1 => $AttributeGroup) {
						$data['AttributeGroup'] = $AttributeGroup;
						$this->Attribute->AttributeGroup->set($data);
						if (!$this->Attribute->AttributeGroup->validates()) {
							$AttributeGroupValidationError[$key][$key1] = $this->Attribute->AttributeGroup->validationErrors;
							$data['ValidateAttributeGroup'][$key][] = 'show';
							$is_form_valid = false;
						}
					}
                }
                if (!empty($AttributeGroupValidationError)) {
                    $this->Attribute->AttributeGroup->validationErrors = array();
                    foreach($AttributeGroupValidationError as $key => $error) {
                        $this->Attribute->AttributeGroup->validationErrors[$key] = $error;
                    }
                }
				if ($is_form_valid) {
					foreach($this->request->data['AttributeGroup'] as $key => $AttributeGroups) {
						foreach($AttributeGroups as $key => $AttributeGroup) {
							$data = array();
							$data['AttributeGroup'] = $AttributeGroup;
							if(empty($data['AttributeGroup']['id'])) {
								$this->Attribute->AttributeGroup->create();
							}	
							if (!empty($data['AttributeGroup']['name'])) {
								$this->Attribute->AttributeGroup->save($data);
							}
						}
					}
				}	
			}
			if ($is_form_valid) {
				foreach($this->request->data['Attribute'] as $key => $Attributes) {
					if($key != 'add') {
						foreach($Attributes as $key => $Attribute) {
							$data = array();
							$data['Attribute'] = $Attribute;
							$data['Attribute']['attribute_group_id'] = $Attributes['attribute_group_id'];
							if(empty($data['Attribute']['id'])) {
								$this->Attribute->create();
							}	
							if (!empty($data['Attribute']['name'])) {
								$this->Attribute->save($data);
							}
						}
					}
				}
				$this->Session->setFlash(__l('Variant has been updated successfully') , 'default', null, 'success');
				$ajax_url = Router::url(array('controller' => 'attributes','action' => 'index'));
				if ($this->request->params['isAjax'] == 1 || !empty($this->request->params['form']['is_iframe_submit'])) {
					$success_msg = 'redirect*' . $ajax_url;
					echo $success_msg;
					exit;			
				} else {
					$this->redirect(array(
						'action' => 'index'
					));
				}
			} else {
				$this->Session->setFlash(__l('Variant and group couldn\'t be added') , 'default', null, 'error');
			}	
		}
		$this->loadModel('AttributeGroupType');
		$attributeGroupTypes = $this->AttributeGroupType->find('list');
        $this->set('attributeGroupTypes', $attributeGroupTypes);
		$attributeGroups = $this->Attribute->AttributeGroup->find('all', array(
			'contain' => array(
				'AttributeGroupType',
				'Attribute' => array(
					'order' => array(
						'Attribute.order' => 'asc'
					)
				),
			),
			'order' => array(
				'AttributeGroup.order' => 'asc'
			)
		));
		$this->set('attributeGroups', $attributeGroups);
		$this->set('ValidateAttributeGroup', $data['ValidateAttributeGroup']);
		$this->set('pageTitle', $this->pageTitle);
    }    	
    public function admin_delete($id = null) 
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->Attribute->id = $id;
        if (!$this->Attribute->exists()) {
            throw new NotFoundException(__l('Invalid attribute'));
        }
        if ($this->Attribute->delete()) {
            $this->Session->setFlash(__l('Variant deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Variant was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
}

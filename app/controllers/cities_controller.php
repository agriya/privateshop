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
class CitiesController extends AppController
{
    public $name = 'Cities';
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'filter_id',
            'q'
        ));
        $this->disableCache();
        $this->pageTitle = __l('Cities');
        $conditions = array();
        $this->City->validate = array();
        if (isset($this->request->params['named']['filter_id'])) {
            $this->request->data[$this->modelClass]['filter_id'] = $this->request->params['named']['filter_id'];
        }
        if (!empty($this->request->data[$this->modelClass]['filter_id'])) {
            if ($this->request->data[$this->modelClass]['filter_id'] == ConstMoreAction::Active) {
                $this->pageTitle.= __l(' - Approved');
                $conditions[$this->modelClass . '.is_approved'] = 1;
            } else if ($this->request->data[$this->modelClass]['filter_id'] == ConstMoreAction::Inactive) {
                $this->pageTitle.= __l(' - Unapproved');
                $conditions[$this->modelClass . '.is_approved'] = 0;
            }
            $this->request->params['named']['filter_id'] = $this->request->data[$this->modelClass]['filter_id'];
        }
        if (isset($this->request->params['named']['q'])) {
            $this->request->data['City']['q'] = $this->request->params['named']['q'];
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $this->City->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'fields' => array(
                'City.id',
                'City.name',
                'City.latitude',
                'City.longitude',
                'City.county',
                'City.code',
                'City.is_approved',
                'State.name',
                'Country.name',
            ) ,
            'order' => array(
                'City.name' => 'asc'
            ) ,
            'limit' => 15
        );
         if (!empty($this->request->data['City']['q'])) {
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['City']['q']
            ));
        }
        $this->set('cities', $this->paginate());
        $this->set('pending', $this->City->find('count', array(
            'conditions' => array(
                'City.is_approved = ' => 0
            )
        )));
        $this->set('approved', $this->City->find('count', array(
            'conditions' => array(
                'City.is_approved = ' => 1
            )
        )));
        $filters = $this->City->isFilterOptions;
        $moreActions = $this->City->moreActions;
        $this->set(compact('filters', 'moreActions'));
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit City');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $defaultCity = $this->City->find('first', array(
            'conditions' => array(
                'City.slug' => Configure::read('site.city')
            ) ,
            'fields' => array(
                'City.id'
            ) ,
            'recursive' => -1
        ));
        if (!empty($defaultCity) && $id == $defaultCity['City']['id']) {
            $this->set('id_default_city', true);
        }
        if (!empty($this->request->data)) {
            if ($this->City->save($this->request->data)) {
                $this->Session->setFlash(__l('City has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('City could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->City->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['City']['name'];
        $countries = $this->City->Country->find('list');
        $states = $this->City->State->find('list', array(
            'conditions' => array(
                'State.is_approved' => 1
            )
        ));
        $this->set(compact('countries', 'states'));
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add City');
        if (!empty($this->request->data)) {
            $this->City->create();
            if ($this->City->save($this->request->data)) {
                $this->Session->setFlash(__l(' City has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l(' City could not be added. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data['City']['is_approved'] = 1;
        }
        $countries = $this->City->Country->find('list');
        $states = $this->City->State->find('list', array(
            'conditions' => array(
                'State.is_approved =' => 1
            ) ,
            'order' => array(
                'State.name'
            )
        ));
        $this->set(compact('countries', 'states'));
    }
    // To change approve/disapprove status by admin
    public function admin_update_status($id = null, $status = null)
    {
        if (is_null($id) || is_null($status)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->request->data['City']['id'] = $id;
        if ($status == 'disapprove') {
            $this->request->data['City']['is_approved'] = 0;
			$this->Session->setFlash(__l('City has been disapproved') , 'default', null, 'success');
        }
        if ($status == 'approve') {
            $this->request->data['City']['is_approved'] = 1;
			$this->Session->setFlash(__l('City has been approved') , 'default', null, 'success');
        }
        $this->City->save($this->request->data);
        $this->redirect(array(
            'action' => 'index'
        ));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->City->delete($id)) {
            $this->Session->setFlash(__l('City deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
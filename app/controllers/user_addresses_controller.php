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
class UserAddressesController extends AppController
{
    public $name = 'UserAddresses';
    public function beforeFilter()
    {
        $this->disableCache();
        $this->Security->disabledFields = array(
            'UserAddress.address',
            'UserAddress.country_id',
            'City.name',
            'State.name',
            'City.id',
            'State.id',
        );
        parent::beforeFilter();
    }
    public function index()
    {
		$this->pageTitle = __l('My Shipping Addresses');
        $this->UserAddress->recursive = -1;
        $this->paginate = array(
            'conditions' => array(
                'UserAddress.user_id' => $this->Auth->user('id') ,
            ) ,
			'order' => array(
				'UserAddress.id' => 'desc'
			)
        );
        $this->set('userAddresses', $this->paginate());
        $moreActions = $this->UserAddress->moreActions;
        $this->set(compact('moreActions'));
    }
    public function add()
    {
        $this->pageTitle = __l('Add Shipping Address');
        if ($this->request->is('post')) {
            //state and country looking
            if (!empty($this->request->data['City']['name'])) {
                $this->request->data['UserAddress']['city_id'] = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->UserAddress->City->findOrSaveAndGetId($this->request->data['City']['name']);
            }
            if (!empty($this->request->data['UserAddress']['country_id'])) {
                $this->request->data['UserAddress']['country_id'] = $this->UserAddress->Country->findCountryId($this->request->data['UserAddress']['country_id']);
            }
            if (!empty($this->request->data['State']['name'])) {
                $this->request->data['UserAddress']['state_id'] = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->UserAddress->State->findOrSaveAndGetId($this->request->data['State']['name']);
            }
            $this->request->data['UserAddress']['user_id'] = $this->Auth->user('id');
            if ($this->UserAddress->checkShippingAddress($this->request->data['UserAddress']['address'],$this->Auth->user('id'))) {
                $this->Session->setFlash(__l('Address you have entered is already exist. Please, try again.') , 'default', null, 'error');
                $this->redirect(array(
                    'action' => 'index'
                ));
            }
            //set primary
            $records = $this->UserAddress->find('count', array(
                'conditions' => array(
                    'UserAddress.user_id' => $this->Auth->user('id') ,
                ) ,
                'recursive' => -1
            ));
            if (!$records) {
                $this->request->data['UserAddress']['is_primary'] = 1;
            }
            $this->UserAddress->create();
            if ($this->UserAddress->save($this->request->data)) {
                //reset primary of old one
                if (!empty($this->request->data['UserAddress']['is_primary']) && $this->request->data['UserAddress']['is_primary']) {
                    $this->UserAddress->updateAll(array(
                        'UserAddress.is_primary' => 0
                    ) , array(
                        'UserAddress.id !=' => $this->UserAddress->getLastInsertId() ,
                    ));
                }
                $this->Session->setFlash(__l('Address has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Address could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        if (empty($this->request->data['UserAddress']['is_active'])) {
            $this->request->data['UserAddress']['is_active'] = 1;
        }
        $users = $this->UserAddress->User->find('list');
        $cities = $this->UserAddress->City->find('list');
        $states = $this->UserAddress->State->find('list');
        $countries = $this->UserAddress->Country->find('list');
        $this->set(compact('users', 'cities', 'states', 'countries'));
    }
    public function edit($id = null)
    {
        $this->pageTitle = __l('Edit Shipping Address');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->UserAddress->id = $id;
        if (!$this->UserAddress->exists()) {
            throw new NotFoundException(__l('Invalid user address'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            //state and country looking
            if (!empty($this->request->data['City']['name'])) {
                $this->request->data['UserAddress']['city_id'] = !empty($this->request->data['City']['id']) ? $this->request->data['City']['id'] : $this->UserAddress->City->findOrSaveAndGetId($this->request->data['City']['name']);
            }
            if (!empty($this->request->data['UserAddress']['country_id'])) {
                $this->request->data['UserAddress']['country_id'] = $this->UserAddress->Country->findCountryId($this->request->data['UserAddress']['country_id']);
            }
            if (!empty($this->request->data['UserAddress']['is_primary']) && $this->request->data['UserAddress']['is_primary']) {
                    $this->request->data['UserAddress']['is_primary'] = 0;
            }
            if (!empty($this->request->data['State']['name'])) {
                $this->request->data['UserAddress']['state_id'] = !empty($this->request->data['State']['id']) ? $this->request->data['State']['id'] : $this->UserAddress->State->findOrSaveAndGetId($this->request->data['State']['name']);
            }
            $this->request->data['UserAddress']['user_id'] = $this->Auth->user('id');
            if ($this->UserAddress->save($this->request->data)) {
                //reset primary of old one
                /*if (!empty($this->request->data['UserAddress']['is_primary']) && $this->request->data['UserAddress']['is_primary']) {
                    $this->UserAddress->updateAll(array(
                        'UserAddress.is_primary' => 0
                    ) , array(
                        'UserAddress.id !=' => $this->request->data['UserAddress']['id'],
                    ));
                }*/
                $this->Session->setFlash(__l('Address has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Address could not be added. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->UserAddress->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['UserAddress']['id'];
        $users = $this->UserAddress->User->find('list');
        $cities = $this->UserAddress->City->find('list');
        $states = $this->UserAddress->State->find('list');
        $countries = $this->UserAddress->Country->find('list');
        $this->set(compact('users', 'cities', 'states', 'countries'));
    }
    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->UserAddress->delete($id)) {
            $this->Session->setFlash(__l('User shipping address deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'user_id',
            'q'
        ));
        $this->pageTitle = __l('User Shipping Addresses');
        $conditions = array();
        if (!empty($this->request->params['named']['username']) || !empty($this->request->params['named']['user_id'])) {
            $userConditions = !empty($this->request->params['named']['username']) ? array(
                'User.username' => $this->request->params['named']['username']
            ) : array(
                'User.id' => $this->request->params['named']['user_id']
            );
            $user = $this->{$this->modelClass}->User->find('first', array(
                'conditions' => $userConditions,
                'fields' => array(
                    'User.id',
                    'User.username'
                ) ,
                'recursive' => -1
            ));
            if (empty($user)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $conditions['User.id'] = $this->request->data[$this->modelClass]['user_id'] = $user['User']['id'];
            $this->pageTitle.= ' - ' . $user['User']['username'];
        }
        if (isset($this->request->params['named']['q'])) {
            $this->request->data['UserAddress']['q'] = $this->request->params['named']['q'];
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $this->UserAddress->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'order' => array(
                'UserAddress.id' => 'desc'
            ) ,
        );
        if (isset($this->request->data['UserAddress']['q'])) {
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['UserAddress']['q']
            ));
        }
        $this->set('userAddresses', $this->paginate());
        $moreActions = $this->UserAddress->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_add()
    {
        $this->setAction('add');
    }
    public function admin_edit($id = null)
    {
        $this->setAction('edit');
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->UserAddress->delete($id)) {
            $this->Session->setFlash(__l('User shipping address deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}

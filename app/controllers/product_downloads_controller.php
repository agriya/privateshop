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
class ProductDownloadsController extends AppController
{
    public $name = 'ProductDownloads';
    public function index()
    {
        $this->_redirectPOST2Named(array(
            'user_id',
            'q'
        ));
		if(empty($this->request->params['named']['product_id']))
		{  
			throw new NotFoundException(__l('Invalid request'));
		}
        $conditions = array();
        $this->pageTitle = __l('Product Downloads');
        $this->ProductDownload->recursive = 0;
        if (!empty($this->request->params['named']['stat'])) {
            if ($this->request->params['named']['stat'] == 'day') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(ProductDownload.created) <= '] = 0;
                $this->pageTitle.= __l(' - Added today');
            }
            if ($this->request->params['named']['stat'] == 'week') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(ProductDownload.created) <= '] = 7;
                $this->pageTitle.= __l(' - Added in this week');
            }
            if ($this->request->params['named']['stat'] == 'month') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(ProductDownload.created) <= '] = 30;
                $this->pageTitle.= __l(' - Added in this month');
            }
            if ($this->request->params['named']['stat'] == 'total') {
                $conditions = array();
            }
        }
        if (!empty($this->request->params['named']['username']) || !empty($this->request->params['named']['user_id'])) {
            $userConditions = !empty($this->request->params['named']['username']) ? array(
                'User.username' => $this->request->params['named']['username']
            ) : array(
                'User.id' => $this->request->params['named']['user_id']
            );
            $user = $this->ProductDownload->User->find('first', array(
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
            $conditions['User.id'] = $this->request->data['ProductDownload']['user_id'] = $user['User']['id'];
            $this->pageTitle.= ' - ' . $user['User']['username'];
        }
		if(!empty($this->request->params['named']['product_id']))
		{
			$product_condition=array();
			$product_condition['Product.id']=$this->request->params['named']['product_id'];
			$product_condition['Product.user_id']=$this->Auth->user('id');
			$product = $this->ProductDownload->Product->find('count', array(
                'conditions' => $product_condition,
                'recursive' => -1
            ));
			if($product)
			{
				$conditions['ProductDownload.product_id'] = $this->request->params['named']['product_id'];
			}
			else
			{
                throw new NotFoundException(__l('Invalid request'));
			}
		}        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
                'User' => array(
                    'fields' => array(
                        'User.username'
                    )
                ) ,
                'Product' => array(
                    'fields' => array(
                        'Product.title',
                        'Product.slug',
                    )
                )
            ) ,
            'fields' => array(
                'ProductDownload.id',
                'ProductDownload.created',
            ) ,
            'order' => array(
                'ProductDownload.id' => 'desc'
            )
        );
        if (!empty($this->request->params['named']['q'])) {
            $this->request->data['ProductDownload']['q'] = $this->request->params['named']['q'];
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['ProductDownload']['q']
            ));
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $this->set('productDownloads', $this->paginate());
    }
    public function admin_index()
    {
		$this->_redirectPOST2Named(array(
            'user_id',
            'q'
        ));
        $conditions = array();
        $this->pageTitle = __l('Product Downloads');
        $this->ProductDownload->recursive = 0;
        if (!empty($this->request->params['named']['stat'])) {
            if ($this->request->params['named']['stat'] == 'day') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(ProductDownload.created) <= '] = 0;
                $this->pageTitle.= __l(' - Added today');
            }
            if ($this->request->params['named']['stat'] == 'week') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(ProductDownload.created) <= '] = 7;
                $this->pageTitle.= __l(' - Added in this week');
            }
            if ($this->request->params['named']['stat'] == 'month') {
                $conditions['TO_DAYS(NOW()) - TO_DAYS(ProductDownload.created) <= '] = 30;
                $this->pageTitle.= __l(' - Added in this month');
            }
            if ($this->request->params['named']['stat'] == 'total') {
                $conditions = array();
            }
        }
		if (!empty($this->request->params['named']['product_id'])) {
            $product_name = $this->ProductDownload->Product->find('first', array(
                'conditions' => array(
                    'Product.id' => $this->request->params['named']['product_id'],
                ) ,
                'fields' => array(
                    'Product.title',
                ) ,
                'recursive' => -1,
            ));
            $this->pageTitle.= sprintf(__l(' - %s') , $product_name['Product']['title']);
        }
		        if (!empty($this->request->params['named']['product_id'])) {
            $conditions['ProductDownload.product_id'] = $this->request->params['named']['product_id'];
        }
        if (!empty($this->request->params['named']['username']) || !empty($this->request->params['named']['user_id'])) {
            $userConditions = !empty($this->request->params['named']['username']) ? array(
                'User.username' => $this->request->params['named']['username']
            ) : array(
                'User.id' => $this->request->params['named']['user_id']
            );
            $user = $this->ProductDownload->User->find('first', array(
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
            $conditions['User.id'] = $this->request->data['ProductDownload']['user_id'] = $user['User']['id'];
            $this->pageTitle.= ' - ' . $user['User']['username'];
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array(
                'Ip' => array(
                    'City',
                    'State',
                    'Country'
                ) ,
                'User' => array(
                    'fields' => array(
                        'User.username'
                    )
                ) ,
                'Product' => array(
                    'fields' => array(
                        'Product.title',
                        'Product.slug',
                    )
                )
            ) ,
            'order' => array(
                'ProductDownload.id' => 'desc'
            )
        );
        if (!empty($this->request->params['named']['q'])) {
            $this->request->data['ProductDownload']['q'] = $this->request->params['named']['q'];
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['ProductDownload']['q']
            ));
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $this->set('productDownloads', $this->paginate());
		$moreActions = $this->ProductDownload->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->ProductDownload->id = $id;
        if (!$this->ProductDownload->exists()) {
            throw new NotFoundException(__l('Invalid product download'));
        }
        if ($this->ProductDownload->delete()) {
            $this->Session->setFlash(__l('Product download deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__l('Product download was not deleted') , 'default', null, 'error');
        $this->redirect(array(
            'action' => 'index'
        ));
    }
}

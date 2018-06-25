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
class IpsController extends AppController
{
    public $name = 'Ips';
    public function admin_index()
    {
        $this->_redirectGET2Named(array(
            'q'
        ));
        $this->pageTitle = __l('IPs');
        $conditions = array();
        if (isset($this->request->params['named']['q'])) {            
            $this->request->data['Ip']['q'] = $this->request->params['named']['q'];
			$this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        $this->Ip->recursive = 0;
        $order = array(
            'Ip.id' => 'DESC'
        );
        $this->paginate = array(
            'conditions' => $conditions,
            'order' => $order
        );
		if (!empty($this->request->data['Ip']['q'])) {
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->params['named']['q']
            ));
        }
        $moreActions = $this->Ip->moreActions;
        $this->set(compact('moreActions'));
        $this->set('ips', $this->paginate());
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Ip->delete($id)) {
            $this->Session->setFlash(__l('IP deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>
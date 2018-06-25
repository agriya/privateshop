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
class OrderStatusesController extends AppController
{
    public $name = 'OrderStatuses';
    public function admin_index()
    {
        $this->pageTitle = __l('Order Statuses');
        $this->OrderStatus->recursive = 0;
        $this->set('orderStatuses', $this->paginate());
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Order Status');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->OrderStatus->id = $id;
        if (!$this->OrderStatus->exists()) {
            throw new NotFoundException(__l('Invalid order status'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->OrderStatus->save($this->request->data)) {
                $this->Session->setFlash(__l('Order status has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Order status could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->OrderStatus->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['OrderStatus']['name'];
    }
}

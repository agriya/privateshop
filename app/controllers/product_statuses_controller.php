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
class ProductStatusesController extends AppController
{
    public $name = 'ProductStatuses';
    public function admin_index()
    {
        $this->pageTitle = __l('Product Statuses');
        $this->ProductStatus->recursive = 0;
        $this->set('productStatuses', $this->paginate());
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Product Status');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->ProductStatus->id = $id;
        if (!$this->ProductStatus->exists()) {
            throw new NotFoundException(__l('Invalid product status'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->ProductStatus->save($this->request->data)) {
                $this->Session->setFlash(__l('product status has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('product status could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->data = $this->ProductStatus->read(null, $id);
            if (empty($this->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->data['ProductStatus']['name'];
    }
}

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
class TransactionTypesController extends AppController
{
    public $name = 'TransactionTypes';
    public function admin_index()
    {
        $this->pageTitle = __l('Transaction Types');
        $this->TransactionType->recursive = 0;
        $this->set('transactionTypes', $this->paginate());
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Transaction Type');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->TransactionType->save($this->request->data)) {
                $this->Session->setFlash(__l('Transaction Type has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Transaction Type could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->TransactionType->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['TransactionType']['name'];
    }
}
?>
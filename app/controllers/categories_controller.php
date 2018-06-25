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
class CategoriesController extends AppController
{
    var $name = 'Categories';
    public $helpers = array(
        'Tree'
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
            'CategoryPhoto.id',
        );
        parent::beforeFilter();
    }
    function admin_index()
    {
        $this->pageTitle = __l('Categories');
        $categoriesForTree = $this->Category->find('threaded');
        $this->set(compact('categoriesForTree'));
    }
    function admin_add()
    {
        $this->pageTitle = __l('Add Category');
        $this->loadModel('Attachment');
        $this->Attachment->Behaviors->attach('ImageUpload', Configure::read('product.file'));
        $this->Category->create();
        if (!empty($this->request->data)) {
            if ($this->Category->validates()) {
                $this->Category->save($this->request->data);
                $category_id = $this->Category->getLastInsertId();
                foreach($this->request->data['Attachment'] as $key => $attachment_data) {
                    if (!empty($attachment_data['filename'])) {
                        $attachment = array();
                        $data = array();
                        $file_id = $attachment_data['filename'];
                        $this->Category->CategoryPhoto->create();
                        $data['CategoryPhoto']['url'] = !empty($attachment_data['url']) ? $attachment_data['url'] : '';
                        $data['CategoryPhoto']['title'] = !empty($attachment_data['title']) ? $attachment_data['title'] : '';
                        $data['CategoryPhoto']['category_id'] = $category_id;
                        $this->Category->CategoryPhoto->save($data['CategoryPhoto']);
                        $category_photo_id = $this->Category->CategoryPhoto->getLastInsertId();
                        $this->Attachment->create();
                        $attachment['Attachment']['foreign_id'] = $category_photo_id;
                        $attachment['Attachment']['class'] = 'CategoryPhoto';
                        $this->Attachment->Behaviors->attach('ImageUpload');
                        $this->Attachment->enableUpload(false); //don't trigger upload behavior on save
                        $attachment['Attachment']['mimetype'] = $_SESSION['product_file_info'][$file_id]['type'];
                        $attachment['Attachment']['dir'] = 'CategoryPhoto/' . $category_photo_id;
                        $upload_path = APP . DS . 'media' . DS . 'CategoryPhoto' . DS . $category_photo_id;
                        new Folder($upload_path, true);
                        $file_name = $_SESSION['product_file_info'][$file_id]['filename'];
                        $attachment['Attachment']['filename'] = $file_name;
                        $fp = fopen($upload_path . DS . $file_name, 'w');
                        fwrite($fp, base64_decode($_SESSION['product_file_info'][$file_id]['original']));
                        fclose($fp);
                        $this->Attachment->create();
                        $this->Attachment->save($attachment);
                        $this->Attachment->Behaviors->detach('ImageUpload');
                        unset($_SESSION['product_file_info'][$file_id]);
                    }
                }
                $this->Session->setFlash(__l('Category has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Category could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $parents[0] = "[ Top ]";
        $categories = $this->Category->generateTreeList(null, null, null, " - ", 1);
        if ($categories) {
            foreach($categories as $key => $value) $parents[$key] = $value;
        }
        $this->set(compact('parents'));
        $this->set('pageTitle', $this->pageTitle);
    }
    function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Category');
        $this->loadModel('Attachment');
        $this->Attachment->Behaviors->attach('ImageUpload', Configure::read('product.file'));
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->Category->validates()) {
                $this->request->data['Category']['parent_id'] = empty($this->request->data['Category']['parent_id']) ? '0' : $this->request->data['Category']['parent_id'];
                $this->Category->save($this->request->data);
                for ($i = 0; $i < count($this->request->data['CategoryPhoto']); $i++) {
                    $is_deleted = 0;
                    if (!empty($this->request->data['CategoryPhoto'][$i]['OldAttachment']['id']) && $this->request->data['CategoryPhoto'][$i]['OldAttachment']['id'] == 1) {
                        $this->Attachment->delete($this->request->data['CategoryPhoto'][$i]['Attachment']['id']);
                        $this->Category->CategoryPhoto->delete($this->request->data['CategoryPhoto'][$i]['id']);
                        $is_deleted = 1;
                    }
                    if (!empty($this->request->data['Attachment'][$i])) {
                        $attachment = array();
                        $data = array();
                        $file_id = $this->request->data['Attachment'][$i]['filename'];
                        if (empty($this->request->data['CategoryPhoto'][$i]['id'])) {
                            $this->Category->CategoryPhoto->create();
                        } else {
                            $data['CategoryPhoto']['id'] = $this->request->data['CategoryPhoto'][$i]['id'];
                        }
                        if (((!empty($this->request->data['Attachment'][$i]['url']) || !empty($this->request->data['Attachment'][$i]['title']) || !empty($this->request->data['Attachment'][$i]['filename'])) && !$is_deleted) || ($is_deleted && !empty($this->request->data['Attachment'][$i]['filename']))) {
                            $data['CategoryPhoto']['url'] = $this->request->data['Attachment'][$i]['url'];
                            $data['CategoryPhoto']['title'] = $this->request->data['Attachment'][$i]['title'];
                            $data['CategoryPhoto']['category_id'] = $id;
                            $this->Category->CategoryPhoto->save($data['CategoryPhoto']);
                        }
                        if (empty($this->request->data['CategoryPhoto'][$i]['id'])) {
                            $category_photo_id = $this->Category->CategoryPhoto->getLastInsertId();
                        } else {
                            $category_photo_id = $this->request->data['CategoryPhoto'][$i]['id'];
                        }
                        if (!empty($this->request->data['Attachment'][$i]['filename'])) {
                            $this->Attachment->create();
                            $attachment['Attachment']['foreign_id'] = $category_photo_id;
                            $attachment['Attachment']['class'] = 'CategoryPhoto';
                            $this->Attachment->Behaviors->attach('ImageUpload');
                            $this->Attachment->enableUpload(false); //don't trigger upload behavior on save
                            $attachment['Attachment']['mimetype'] = $_SESSION['product_file_info'][$file_id]['type'];
                            $attachment['Attachment']['dir'] = 'CategoryPhoto/' . $category_photo_id;
                            $upload_path = APP . DS . 'media' . DS . 'CategoryPhoto' . DS . $category_photo_id;
                            new Folder($upload_path, true);
                            $file_name = $_SESSION['product_file_info'][$file_id]['filename'];
                            $attachment['Attachment']['filename'] = $file_name;
                            $fp = fopen($upload_path . DS . $file_name, 'w');
                            fwrite($fp, base64_decode($_SESSION['product_file_info'][$file_id]['original']));
                            fclose($fp);
                            $this->Attachment->create();
                            $this->Attachment->save($attachment);
                            $this->Attachment->Behaviors->detach('ImageUpload');
                            unset($_SESSION['product_file_info'][$file_id]);
                        }
                    }
                }
                $this->Session->setFlash(__l('Category has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Category could not be updated. Please, try again.') , 'default', null, 'error');
            }
        }
        $this->request->data = $this->Category->find('first', array(
            'conditions' => array(
                'Category.id' => $id
            ) ,
            'contain' => array(
                'CategoryPhoto' => array(
                    'Attachment'
                )
            ) ,
            'recursive' => 2
        ));
        if (empty($this->request->data)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $parents[0] = "[ Top ]";
        $categories = $this->Category->generateTreeList(null, null, null, " - ", 1);
        if ($categories) foreach($categories as $key => $value) $parents[$key] = $value;
        $this->set(compact('parents'));
        $this->pageTitle.= ' - ' . $this->request->data['Category']['name'];
        $this->set('pageTitle', $this->pageTitle);
    }
    function admin_delete($id = null)
    {
        if ($id == null) die("No ID received");
        $this->Category->CategoryPhoto->deleteAll(array(
            'CategoryPhoto.category_id' => $id
        ) , false);
        $this->Category->id = $id;
        if ($this->Category->removeFromTree($id, true) == false) {
            $this->Session->setFlash(__l('Category could not be deleted.') , 'default', null, 'error');
        } else {
            $this->Session->setFlash(__l('Category has been deleted') , 'default', null, 'success');
        }
        $this->redirect(array(
            'action' => 'index'
        ));
    }
    function index()
    {
        $categories = $this->Category->find('threaded', array(
            'order' => array(
                'Category.id' => 'asc'
            ) ,
            'recursive' => -1
        ));
        $this->set(compact('categories'));
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'menu') {
            $this->render('menu');
        }
    }
    public function flashupload()
    {
        $this->loadModel('Attachment');
        $this->Attachment->Behaviors->attach('ImageUpload', Configure::read('product.file'));
        $this->XAjax->previewImage();
    }
    function thumbnail()
    {
        $file_id = $this->params['pass'][1]; // show preview uploaded category image, session unique id
        $this->XAjax->thumbnail($file_id);
    }
    public function view($slug = null)
    {
        $conditions = array();
        if (is_numeric($slug)) {
            $conditions['Category.id'] = $slug;
        } else {
            $conditions['Category.slug'] = $slug;
        }
        $category = $this->Category->find('first', array(
            'conditions' => $conditions,
            'recursive' => -1,
        ));
        if (empty($category)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->RequestHandler->prefers('json')) {
            $childCategories = $this->Category->find('list', array(
                'conditions' => array(
                    'Category.parent_id' => $category['Category']['id'],
                ) ,
                'recursive' => -1,
            ));
            $this->view = 'Json';
            $this->set('json', ($childCategories));
        } else {
            $childCategories = $this->Category->find('all', array(
                'conditions' => array(
                    'Category.parent_id' => $category['Category']['id'],
                ) ,
                'contain' => array(
                    'CategoryPhoto' => array(
                        'Attachment',
                    ) ,
                ) ,
                'recursive' => 2,
            ));
            $sub_parent = $this->Category->find('first', array(
                'conditions' => array(
                    'Category.id' => $childCategories[0]['Category']['parent_id'],
                ) ,
                'recursive' => -1,
            ));
            $this->set('sub_parent', $sub_parent);
            $parent = $this->Category->getParentCategory($category['Category']['id']);
            $this->set('parent', $parent);
            $this->pageTitle = __l('Category - ' . $category['Category']['name']);
            $this->set('pageTitle', $this->pageTitle);
            $this->set('childCategories', $childCategories);
        }
    }
}
?>
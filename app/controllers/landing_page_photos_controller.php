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
class LandingPagePhotosController extends AppController
{
    var $name = 'LandingPagePhotos';
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
            'LandingPagePhoto.id',
        );
        parent::beforeFilter();
    }
    function admin_index()
    {
        $this->pageTitle = __l('Customize New Landing Page');
        $this->loadModel('Attachment');
        $this->Attachment->Behaviors->attach('ImageUpload', Configure::read('product.file'));
        if (!empty($this->request->data)) {
            for ($i = 0; $i < count($this->request->data['LandingPagePhoto']); $i++) {
                $is_deleted = 0;
                if (!empty($this->request->data['LandingPagePhoto'][$i]['OldAttachment']['id']) && $this->request->data['LandingPagePhoto'][$i]['OldAttachment']['id'] == 1) {
                    $this->Attachment->delete($this->request->data['LandingPagePhoto'][$i]['Attachment']['id']);
                    $this->LandingPagePhoto->delete($this->request->data['LandingPagePhoto'][$i]['id']);
                    $is_deleted = 1;
                }
                if (!empty($this->request->data['Attachment'][$i])) {
                    $attachment = array();
                    $data = array();
                    $file_id = $this->request->data['Attachment'][$i]['filename'];
                    if (empty($this->request->data['LandingPagePhoto'][$i]['id'])) {
                        $this->LandingPagePhoto->create();
                    } else {
                        $data['LandingPagePhoto']['id'] = $this->request->data['LandingPagePhoto'][$i]['id'];
                    }
                    if (((!empty($this->request->data['Attachment'][$i]['url']) || !empty($this->request->data['Attachment'][$i]['title']) || !empty($this->request->data['Attachment'][$i]['filename'])) && !$is_deleted) || ($is_deleted && !empty($this->request->data['Attachment'][$i]['filename']))) {
                        $data['LandingPagePhoto']['url'] = $this->request->data['Attachment'][$i]['url'];
                        $data['LandingPagePhoto']['title'] = $this->request->data['Attachment'][$i]['title'];
                        $this->LandingPagePhoto->save($data['LandingPagePhoto']);
                    }
                    if (empty($this->request->data['LandingPagePhoto'][$i]['id'])) {
                        $photo_id = $this->LandingPagePhoto->getLastInsertId();
                    } else {
                        $photo_id = $this->request->data['LandingPagePhoto'][$i]['id'];
                    }
                    if (!empty($this->request->data['Attachment'][$i]['filename'])) {
                        $this->Attachment->create();
                        $attachment['Attachment']['foreign_id'] = $photo_id;
                        $attachment['Attachment']['class'] = 'LandingPagePhoto';
                        $this->Attachment->Behaviors->attach('ImageUpload');
                        $this->Attachment->enableUpload(false); //don't trigger upload behavior on save
                        $attachment['Attachment']['mimetype'] = $_SESSION['product_file_info'][$file_id]['type'];
                        $attachment['Attachment']['dir'] = 'LandingPagePhoto/' . $photo_id;
                        $upload_path = APP . DS . 'media' . DS . 'LandingPagePhoto' . DS . $photo_id;
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
            $this->Session->setFlash(__l('Landing Page photos has been updated') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->request->data = $this->LandingPagePhoto->find('all', array(
            'contain' => array(
                'Attachment'
            ) ,
            'recursive' => 0
        ));
    }
    public function flashupload()
    {
        $this->loadModel('Attachment');
        $this->Attachment->Behaviors->attach('ImageUpload', Configure::read('product.file'));
        $this->XAjax->previewImage();
    }
    function thumbnail()
    {
        $file_id = $this->params['pass'][1]; // show preview uploaded Landing Page image, session unique id
        $this->XAjax->thumbnail($file_id);
    }
    public function index()
    {
        $this->pageTitle = __l('Home');
		$landingPagePhotos = $this->LandingPagePhoto->find('all', array(
            'contain' => array(
                'Attachment'
            ) ,
            'recursive' => 0
        ));
        $this->set('landingPagePhotos', $landingPagePhotos);
    }
}
?>
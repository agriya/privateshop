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
class ContactsController extends AppController
{
    public $name = 'Contacts';
    public $components = array(
        'Email',
        'RequestHandler'
    );
    public $uses = array(
        'Contact',
        'EmailTemplate',
        'User'
    );
    public function add()
    {
		$this->Contact->Create();
        if (!empty($this->request->data)) {
            $this->Contact->set($this->request->data);
            if ($this->Contact->validates()) {
                $ip = $this->RequestHandler->getClientIP();
				$hostbyaddr = gethostbyaddr($ip);
                $this->request->data['Contact']['ip'] = $ip;
                $this->request->data['Contact']['host'] = gethostbyaddr($this->request->data['Contact']['ip']);
                $this->request->data['Contact']['user_id'] = $this->Auth->user('id');
                $this->Contact->save($this->request->data, false);
                $emailFindReplace = array(
                    '##SITE_NAME##' => Configure::read('site.name') ,
                    '##FIRST_NAME##' => $this->request->data['Contact']['first_name'],
                    '##LAST_NAME##' => !empty($this->request->data['Contact']['last_name']) ? ' ' . $this->request->data['Contact']['last_name'] : '',
                    '##FROM_EMAIL##' => $this->request->data['Contact']['email'],
                    '##FROM_URL##' => Router::url(array(
                        'controller' => 'contacts',
                        'action' => 'add'
                    ) , true) ,
                    '##SITE_ADDR##' => ($hostbyaddr!= $ip)? $hostbyaddr : '',
                    '##IP##' => $ip,
                    '##TELEPHONE##' => $this->request->data['Contact']['telephone'],
                    '##MESSAGE##' => $this->request->data['Contact']['message'],
                    '##SUBJECT##' => $this->request->data['Contact']['subject'],
                    '##POST_DATE##' => date('F j, Y g:i:s A (l) T (\G\M\TP)') ,
                    '##CONTACT_URL##' => Router::url(array(
                        'controller' => 'contacts',
                        'action' => 'add'
                    ) , true) ,
                    '##SITE_URL##' => Router::url('/', true) ,
                    '##NO_REPLY_EMAIL##' => Configure::read('EmailTemplate.no_reply_email')
                );
                // send to contact email
                $email = $this->EmailTemplate->selectTemplate('Contact Us');
                $this->Email->from = strtr($email['from'], $emailFindReplace);
                $this->Email->to = Configure::read('EmailTemplate.admin_email');
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->send(trim(strtr($email['email_content'], $emailFindReplace)));
                // reply email
                $email = $this->EmailTemplate->selectTemplate('Contact Us Auto Reply');
                $this->Email->from = strtr($email['from'], $emailFindReplace);
                $this->Email->to = $this->request->data['Contact']['email'];
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->send(trim(strtr($email['email_content'], $emailFindReplace)));
				$this->Session->setFlash(__l('Thank you, we received your message and will get back to you as soon as possible.') , 'default', null, 'success');
	            $this->redirect(array(
	                'controller' => 'contacts',
	                'action' => 'add'
	            ));
            }
        } else if ($this->Auth->user('id')) {
            $SignedInUserDetail = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $this->Auth->user('id')
                ) ,
                'contain' => array(
                    'UserProfile' => array(
                        'fields' => array(
                            'UserProfile.first_name',
                            'UserProfile.last_name'
                        )
                    )
                ) ,
                'recursive' => 0
            ));
            $this->request->data['Contact']['first_name'] = !empty($SignedInUserDetail['UserProfile']['first_name']) ? $SignedInUserDetail['UserProfile']['first_name'] : '';
            $this->request->data['Contact']['last_name'] = !empty($SignedInUserDetail['UserProfile']['last_name']) ? $SignedInUserDetail['UserProfile']['last_name'] : '';
            $this->request->data['Contact']['email'] = !empty($SignedInUserDetail['User']['email']) ? $SignedInUserDetail['User']['email'] : '';
        }
        $this->pageTitle = __l('Contact Us');
    }
}
?>
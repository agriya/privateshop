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
class PagesController extends AppController
{
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Page.id',
            'Page.Update',
            'Page.Add',
            'Page.content',
            'Page.description_meta_tag',
            'Page.parent_id',
            'Page.slug',
            'Page.status_option_id',
            'Page.title',
            'Page.Preview',
        );
        parent::beforeFilter();
    }
    public function admin_add()
    {
		$this->pageTitle = __l('Add Page');
        if (!empty($this->request->data)) {
            $this->Page->set($this->request->data);
            if ($this->Page->validates()) {
                $this->Page->save($this->request->data);
                $this->Session->setFlash(__l('Page has been created') , 'default', null, 'success');
                $page_id = $this->Page->getLastInsertId();
                if (!empty($this->request->data['Page']['Preview'])) {
                    $page_slug = $this->Page->find('first', array(
                        'conditions' => array(
                            'Page.id' => $page_id
                        ) ,
                        'fields' => array(
                            'Page.slug'
                        ) ,
                        'recursive' => 1
                    ));
                    $this->redirect(array(
                        'controller' => 'pages',
                        'action' => 'view',
                        'type' => 'preview',
                        $page_slug['Page']['slug']
                    ));
                } else $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Page could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
    }
    public function admin_edit($id = null)
    {
		$this->pageTitle = __l('Edit Page');
        if (!empty($this->request->data)) {
            $this->Page->set($this->request->data);
            if ($this->Page->validates()) {
                $this->Page->save($this->request->data);
                $this->Session->setFlash(__l('Page has been Updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Page could not be Updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->Page->read(null, $id);
        }
    }
    public function admin_index()
    {
        $this->pageTitle = __l('Manage Static Pages');
        $this->Page->recursive = -1;
        $this->paginate = array(
            'order' => array(
                'id' => 'DESC'
            )
        );
        $this->set('pages', $this->paginate());
    }
    public function admin_delete($id = null, $cancelled = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Page->delete($id)) {
            $this->Session->setFlash(__l('Page Deleted Successfully') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index',
                $cancelled
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_view($slug = null)
    {
        $this->setAction('view', $slug);
    }
    public function view($slug = null)
    {
        $this->Page->recursive = -1;
        if (!empty($slug)) {
            $page = $this->Page->findBySlug($slug);
        } else {
            $page = $this->Page->find('first', array(
                'conditions' => array(
                    'Page.is_default' => 1
                )
            ));
        }
        $about_us_url = array(
            'controller' => 'users',
            'action' => 'login',
        );
        $pageFindReplace = array(
            '##SITE_NAME##' => Configure::read('site.name') ,
            '##SITE_URL##' => Router::url('/', true) ,
            '##ABOUT_US_URL##' => Router::url(array(
                'controller' => 'pages',
                'action' => 'view',
                'about',
                'admin' => false
            ) , true) ,
            '##CONTACT_US_URL##' => Router::url(array(
                'controller' => 'contacts',
                'action' => 'add',
                'admin' => false
            ) , true) ,
            '##FAQ_URL##' => Router::url(array(
                'controller' => 'pages',
                'action' => 'view',
                'faq',
                'admin' => false
            ) , true) ,
            '##SITE_CONTACT_EMAIL##' => "<a href='mailto:" . Configure::read('site.contact_email') . "'>" . Configure::read('site.contact_email') . "</a>",
        );
        if ($page) {
            $page['Page']['title'] = strtr($page['Page']['title'], $pageFindReplace);
            $page['Page']['content'] = strtr($page['Page']['content'], $pageFindReplace);
            $this->pageTitle = $page[$this->modelClass]['title'];
            $this->set('page', $page);
            $this->set('currentPageId', $page[$this->modelClass]['id']);
            $this->set('isPage', true);
            $this->_chooseTemplate($page);
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    private function _chooseTemplate($page)
    {
        $render = 'view';
        if (!empty($page[$this->modelClass]['template'])) {
            $possibleThemeFile = APP . 'views' . DS . 'pages' . DS . 'themes' . DS . $page[$this->modelClass]['template'];
            if (file_exists($possibleThemeFile)) {
                $render = $possibleThemeFile;
            }
        }
        return $this->render($render);
    }
    public function display()
    {
        $path = func_get_args();
        if (!empty($path[0]) && $path[0] == 'tools' && $this->Auth->user('user_type_id') != ConstUserTypes::Admin) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $count = count($path);
        if (!$count) {
            $this->redirect(Router::url('/', true));
        }
        $page = $subpage = $title = null;
        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count-1])) {
            $title = Inflector::humanize($path[$count-1]);
        }
		if(!empty($path[0]) && $path[0] == 'refer_a_friend'){
			$this->pageTitle = __l('Refer a friend');
		}
		else{
        $this->pageTitle = __l('Home');
		}
        $this->set(compact('page', 'subpage', 'title'));
        $this->render(join('/', $path));
    }
    public function admin_display()
    {
        $path = func_get_args();
        $count = count($path);
        if (!$count) {
            $this->redirect(Router::url('/', true));
        }
        $page = $subpage = $title = null;
        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count-1])) {
            $title = Inflector::humanize($path[$count-1]);
        }
        $this->set(compact('page', 'subpage', 'title'));
        $this->render(join('/', $path));
    }
}

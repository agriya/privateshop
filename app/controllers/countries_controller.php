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
class CountriesController extends AppController
{
    public $name = 'Countries';
    public function admin_index()
    {
        $this->_redirectPOST2Named(array(
            'q'
        ));
        $this->pageTitle = __l('Countries');
        $this->Country->recursive = -1;
        $this->paginate = array(
            'fields' => array(
                'Country.id',
                'Country.name',
                'Country.fips104',
                'Country.iso2',
                'Country.iso3',
                'Country.ison',
                'Country.internet',
                'Country.capital',
                'Country.map_reference',
                'Country.nationality_singular',
                'Country.nationality_plural',
                'Country.currency',
                'Country.currency_code',
                'Country.population',
                'Country.title',
                'Country.comment',
            ) ,
            'order' => array(
                'Country.name' => 'asc'
            ) ,
            'recursive' => -1
        );
        if (isset($this->request->params['named']['q'])) {
            $this->paginate = array_merge($this->paginate, array('search' => $this->request->params['named']['q']));
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
			$this->request->data['Country']['q'] = $this->request->params['named']['q'];
        }
        $this->set('countries', $this->paginate());
        $moreActions = $this->Country->moreActions;
        $this->set(compact('moreActions'));
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Country');
		$this->Country->create();
        if (!empty($this->request->data)) {           
            if ($this->Country->save($this->request->data)) {
                $this->Session->setFlash(__l('Country has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Country could not be added. Please, try again') , 'default', null, 'error');
            }
        }
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Country');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->Country->save($this->request->data)) {
                $this->Session->setFlash(__l('Country has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Country could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->Country->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->pageTitle.= ' - ' . $this->request->data['Country']['name'];
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Country->delete($id)) {
            $this->Session->setFlash(__l('Country deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_update()
    {
        if (!empty($this->request->data['Country'])) {
            $r = $this->request->data[$this->modelClass]['r'];
            $actionid = $this->request->data[$this->modelClass]['more_action_id'];
            unset($this->request->data[$this->modelClass]['r']);
            unset($this->request->data[$this->modelClass]['more_action_id']);
            $countryIds = array();
            foreach($this->request->data['Country'] as $country_id => $is_checked) {
                if ($is_checked['id']) {
                    $countryIds[] = $country_id;
                }
            }
            if ($actionid && !empty($countryIds)) {
                if ($actionid == ConstMoreAction::Delete) {
                    $this->Country->deleteAll(array(
                        'Country.id' => $countryIds
                    ));
                    $this->Session->setFlash(__l('Checked countries has been deleted') , 'default', null, 'success');
                }
            }
        }
        $this->redirect(Router::url('/', true) . $r);
    }
}
?>
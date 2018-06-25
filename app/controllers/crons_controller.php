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
class CronsController extends AppController
{
    public $name = 'Crons';
	public $components = array(
		'Cron',
    );
    public function admin_main()
    {
        $this->autoRender = false;
        $this->Cron->main();
        if (!empty($_GET['f'])) {
            $this->Session->setFlash(__l('Product status updated successfully') , 'default', null, 'success');
            $this->redirect(Router::url('/', true) . $_GET['f']);
        }
    }	
}
?>
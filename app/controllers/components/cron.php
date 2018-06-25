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
class CronComponent extends Component
{
    var $controller;
    public function main()
    {
        $this->auto_expire();
        $this->auto_complete();
        //change the status from upcoming to open
        App::import('Model', 'Product');
        $this->Product = new Product();
        $this->Product->process_upcoming_status();
        //Order completed the status
        $this->Product->OrderItem->Order->order_completed_status();
    }
    public function auto_expire()
    {
        App::import('Model', 'Cart');
        $this->Cart = new Cart();
        // set cart products as not available
        $this->Cart->updateAll(array(
            'Cart.is_available' => 0,
        ) , array(
            'OR' => array(
                'Product.end_date < ' => date('Y-m-d') ,
                'Product.quantity' => DboSource::expression('Product.sold_quantity') ,
            ),
			'AND' => array(
                'Product.end_date != ' => '0000-00-00 00:00:00' , 
			),
        ));
        // set order products as not available
        $this->Cart->User->Order->OrderItem->updateAll(array(
            'Order.order_status_id' => ConstOrderStatus::Expired,
        ) , array(
            'OR' => array(
                'Product.end_date < ' => date('Y-m-d') ,
                'Product.quantity' => DboSource::expression('Product.sold_quantity') ,
            ) ,
			'AND' => array(
                'Product.end_date != ' => '0000-00-00 00:00:00' , 
			),
            'Order.order_status_id' => ConstOrderStatus::PaymentPending,
        ));
        $this->Cart->User->Order->Behaviors->attach('Aggregatable');
        $this->Cart->User->Order->updateRealAggregators();
        $this->Cart->User->Order->Behaviors->detach('Aggregatable');
    }
    public function auto_complete()
    {
        App::import('Model', 'Product');
        $this->Product = new Product();
        $product_list = $this->Product->find('all', array(
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Open,
				'OR' => array(
					'Product.quantity' => DboSource::expression('Product.sold_quantity'),
					'AND' => array(						
						'Product.end_date != ' => '0000-00-00 00:00:00' , 
						'Product.end_date < ' => date('Y-m-d') ,
					),
				)				         
            ) ,
            'fields' => array(
                'Product.id',
				'Product.sold_quantity',
				'Product.quantity'
            ) ,
            'recursive' => -1,
        ));		
		foreach($product_list as $product) {
			$data = array();
            $data['Product']['id'] = $product['Product']['id'];
            $data['Product']['product_status_id'] = ConstProductStatus::Closed;			
            $this->Product->save($data, false);
		}        
        $this->Product->Behaviors->attach('Aggregatable');
        $this->Product->updateRealAggregators();
        $this->Product->Behaviors->detach('Aggregatable');
        // send buyer list to seller
        if (Configure::read('module.seller')) {
            foreach($product_list as $product_id) {
                $orderItem = $this->Product->OrderItem->find('all', array(
                    'conditions' => array(
                        'OrderItem.product_id' => $product_id,
                    ) ,
                    'contain' => array(
                        'Product',
                        'Order',
                        'User',
                    ) ,
                    'recursive' => 3
                ));
                App::import('Model', 'Seller');
                $this->Seller = new Seller();
                $this->Seller->_sendBuyersListToSeller($orderItem);
            }
        }
    }
}

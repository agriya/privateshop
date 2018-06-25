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
class Product extends AppModel
{
    public $name = 'Product';
    public $displayField = 'title';
    public $actsAs = array(
        'Aggregatable',
        'SuspiciousWordsDetector' => array(
            'fields' => array(
                'title',
                'description',
            )
        ) ,
        'Sluggable' => array(
            'label' => array(
                'title'
            )
        ) ,
    );
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'ProductStatus' => array(
            'className' => 'ProductStatus',
            'foreignKey' => 'product_status_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ) ,
        'Ip' => array(
            'className' => 'Ip',
            'foreignKey' => 'ip_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        ),
		'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'Category_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => false
        )
    );
    public $hasOne = array(
        'ProductFile' => array(
            'className' => 'ProductFile',
            'foreignKey' => 'foreign_id',
            'conditions' => array(
                'ProductFile.class =' => 'ProductFile'
            ) ,
            'dependent' => true
        ) ,
    );
    public $hasMany = array(
        'Cart' => array(
            'className' => 'Cart',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'foreign_id',
            'dependent' => false,
            'conditions' => array(
                'Attachment.class =' => 'Product'
            ) ,
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'OrderItem' => array(
            'className' => 'OrderItem',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'ProductDownload' => array(
            'className' => 'ProductDownload',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'ProductShipmentCost' => array(
            'className' => 'ProductShipmentCost',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
        'ProductView' => array(
            'className' => 'ProductView',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ProductAttribute' => array(
            'className' => 'ProductAttribute',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'AttributeGroupsProduct' => array(
            'className' => 'AttributeGroupsProduct',
            'foreignKey' => 'product_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ) ,
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'title' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'description' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'first_category_id' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'second_category_id' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
			'category_id' => array(
                'rule1' => array(
                    'rule' => 'notempty',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'start_date' => array(
                'rule2' => array(
                    'rule' => '_isValidStartDate',
                    'message' => __l('Start date should be greater than current time') ,
                    'allowEmpty' => false
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'end_date' => array(
                'rule2' => array(
                    'rule' => '_isValidEndDate',
                    'message' => __l('End date should be greater than start date') ,
                    'allowEmpty' => false
                ) ,
                'rule1' => array(
                    'rule' => 'notempty',
                    'message' => __l('Required')
                )
            ) ,
            'product_type_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'product_status_id' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'quantity' => array(
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required') ,
                ) ,
            ) ,
            'original_price' => array(
                'rule2' => array(
                    'rule' => array(
                        'comparison',
                        '>',
                        0
                    ) ,
                    'allowEmpty' => false,
                    'message' => __l('Should be greater than 0')
                ) ,
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => false,
                    'message' => __l('Required')
                ) ,
            ) ,            
            'maximum_quantity_to_send_as_gift' => array(
                'rule3' => array(
                    'rule' => '_isValidGiftQuantity',
                    'message' => __l('Gift quantity should be less than quantity') ,
                    'allowEmpty' => true
                ) ,
				'rule2' => array(
                    'rule' => array(
                        'comparison',
                        '>',
                        0
                    ) ,
                    'allowEmpty' => true,
                    'message' => __l('Should be greater than 0')
                ) ,
                'rule1' => array(
                    'rule' => array(
                        'custom',
                        '/^[1-9]\d*\.?[0]*$/'
                    ) ,
                    'allowEmpty' => true,
                    'message' => __l('Should be a number')
                ) ,
            ) , 
		   'discounted_price' => array(
                'rule2' => array(
                    'rule' => array(
                        'comparison',
                        '>',
                        0
                    ) ,
                    'allowEmpty' => true,
                    'message' => __l('Should be greater than 0')
                ) ,
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => true,
                    'message' => __l('Required')
                ) ,
            ) ,
            'discount_amount' => array(
                'rule2' => array(
                    'rule' => array(
                        '_checkDiscountAmount',
                        'original_price',
                        'discount_amount'
                    ) ,
					'allowEmpty' => true,
                    'message' => __l('Discount amouont should be less than original amount.')
                ) ,
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => true,
                    'message' => __l('Required')
                )
            ) ,
			'discount_percentage' => array(
                'rule2' => array(
                    'rule' => array(
                        'range',
                        -1,
                        101
                    ) ,
                    'allowEmpty' => true,
                    'message' => __l('Should be greater than 0 and less than 100')
                ) ,
                'rule1' => array(
                    'rule' => 'numeric',
                    'allowEmpty' => true,
                    'message' => __l('Should be a number')
                ) ,
            ) ,
        );
        $this->moreActions = array(
            ConstMoreAction::Delete => __l('Delete'),
            ConstMoreAction::Canceled => __l('Canceled'),
			ConstMoreAction::Active => __l('Active'),
			ConstMoreAction::Inactive => __l('Inactive'),
        );
		$this->priceRanges = array(
			0 => array(
			'display' => Configure::read('site.currency').'0 - '.Configure::read('site.currency').'100', 
			'range' => array(0,100)
		     ),
			1 =>array(
			'display' => Configure::read('site.currency').'100 - '.Configure::read('site.currency').'1000',
			'range' => array(100,1000)
		     ),
			2 =>array(
			'display' => Configure::read('site.currency').'1000 - '.Configure::read('site.currency').'10000',
			'range' => array(1000,10000)
		     ));
    }
    function quantityCheck($product_id)
    {
        return $this->find('count', array(
            'conditions' => array(
                'Product.id = ' => $product_id,
                'Product.quantity > ' => 0
            ) ,
            'recursive' => -1,
        ));
    }
	function _checkDiscountAmount()
    {
        if ($this->data[$this->name]['discount_amount'] > $this->data[$this->name]['original_price']) {
            return false;
        }
        return true;
    }
	function _isValidGiftQuantity()
	{
		if (!empty($this->data[$this->name]['maximum_quantity_to_send_as_gift']) &&  $this->data[$this->name]['maximum_quantity_to_send_as_gift'] > $this->data[$this->name]['quantity']) {
            return false;
        }
        return true;
	}
    function _isValidStartDate()
    {
        if (strtotime($this->data[$this->name]['start_date']) > strtotime('now')) {
            return true;
        }
        return false;
    }
    function _isValidEndDate()
    {
		if(!empty($this->data[$this->name]['start_date']))
		{
			if (strtotime($this->data[$this->name]['end_date']) > strtotime($this->data[$this->name]['start_date'])) {
				return true;
        }
		}
		else
		{
			if (strtotime($this->data[$this->name]['end_date']) >= strtotime(date('Y-m-d'))) {
				return true;
			}
		}
        return false;    }
	// [credit] credit expiry date check
	function _isValidExpiryDate()
    {
        if (strtotime($this->data[$this->name]['credit_expiry_date']) > strtotime($this->data[$this->name]['end_date'])) {
            return true;
        }
        return false;
    }
    public function process_upcoming_status()
    {        
        $products = $this->find('all', array(
            'conditions' => array(
				'OR' => array(					
					array(			
						'Product.product_status_id' => ConstProductStatus::Upcoming,
						'Product.start_date != ' => '0000-00-00 00:00:00' , 
						'Product.start_date < ' => date('Y-m-d') ,
					),
					array(		
						'Product.product_status_id' => ConstProductStatus::Upcoming,
						'Product.start_date' => '0000-00-00 00:00:00' ,						
					),
				)
			),
            'recursive' => -1
        ));		
        foreach($products as $product) {
            $data = array();
            $data['Product']['id'] = $product['Product']['id'];
            $data['Product']['product_status_id'] = ConstProductStatus::Open;			
            $this->save($data, false);
			$this->_post_to_third_party_web($product['Product']['id']);
        }
    }
    public function getProductShipmentCost($product_ids)
    {
        $products = $this->find('all', array(
            'conditions' => array(
                'Product.id' => $product_ids
            ) ,
            'contain' => array(
                'ProductShipmentCost' => array(
                    'GroupedCountry' => array(
                        'Union' => array(
                            'Country' => array(
                                'fields' => array(
                                    'Country.id',
                                    'Country.name'
                                )
                            ) ,
                            'fields' => array(
                                'Union.id',
                                'Union.name'
                            )
                        ) ,
                        'Continent' => array(
                            'Country' => array(
                                'fields' => array(
                                    'Country.id',
                                    'Country.name'
                                )
                            ) ,
                            'fields' => array(
                                'Continent.id',
                                'Continent.name'
                            )
                        )
                    )
                )
            ) ,
            'recursive' => 4
        ));
        $countries = $this->User->UserProfile->Country->find('all', array(
            'recursive' => -1
        ));
        $productShipmentCosts = array();
        if (!empty($products)) {
            foreach($products as $product) {
                foreach($product['ProductShipmentCost'] as $productShipmentCost) {
                    if (!empty($productShipmentCost['GroupedCountry'])) {
                        if ($productShipmentCost['GroupedCountry']['id'] == ConsGroupedCountry::Worldwide) {
                            foreach($countries as $country) {
                                $productShipmentCosts[$country['Country']['id']]['shipment_cost'] = $productShipmentCost['shipment_cost'];
                                $productShipmentCosts[$country['Country']['id']]['additional_quantity_shipment_cost'] = $productShipmentCost['additional_quantity_shipment_cost'];
                                $productShipmentCosts['Country'][] = $country['Country']['id'];
                            }
                        } elseif (empty($productShipmentCost['GroupedCountry']['Union']) && empty($productShipmentCost['GroupedCountry']['Continent'])) {
                            $productShipmentCosts[$productShipmentCost['GroupedCountry']['id']]['shipment_cost'] = $productShipmentCost['shipment_cost'];
                            $productShipmentCosts[$productShipmentCost['GroupedCountry']['id']]['additional_quantity_shipment_cost'] = $productShipmentCost['additional_quantity_shipment_cost'];
                            $productShipmentCosts['Country'][] = $productShipmentCost['GroupedCountry']['id'];
                        } elseif (!empty($productShipmentCost['GroupedCountry']['Union'])) {
                            if (!empty($productShipmentCost['GroupedCountry']['Union']['Country'])) {
                                foreach($productShipmentCost['GroupedCountry']['Union']['Country'] as $country) {
                                    $productShipmentCosts[$country['id']]['shipment_cost'] = $productShipmentCost['shipment_cost'];
                                    $productShipmentCosts[$country['id']]['additional_quantity_shipment_cost'] = $productShipmentCost['additional_quantity_shipment_cost'];
                                    $productShipmentCosts['Country'][] = $country['id'];
                                }
                            }
                        } elseif (!empty($productShipmentCost['GroupedCountry']['Continent'])) {
                            if (!empty($productShipmentCost['GroupedCountry']['Continent']['Country'])) {
                                foreach($productShipmentCost['GroupedCountry']['Continent']['Country'] as $country) {
                                    $productShipmentCosts[$country['id']]['shipment_cost'] = $productShipmentCost['shipment_cost'];
                                    $productShipmentCosts[$country['id']]['additional_quantity_shipment_cost'] = $productShipmentCost['additional_quantity_shipment_cost'];
                                    $productShipmentCosts['Country'][] = $country['id'];
                                }
                            }
                        }
                    }
                }
            }
        }
        return $productShipmentCosts;
    }
    public function _updateProductSaleFields($product_id)
    {
        $order_sale_arr = array(
            'cleared' => array(
                'Order.order_status_id' => array(
                    ConstOrderStatus::Completed,
                    ConstOrderStatus::Shipped,
                )
            ) ,
            'pending' => array(
                'Order.order_status_id' => array(
                    ConstOrderStatus::InProcess
                )
            ) ,
            'lost' => array(
                'Order.order_status_id' => array(
                    ConstOrderStatus::CanceledAndRefunded
                )
            )
        );
        foreach($order_sale_arr as $key => $conditions) {
            $conditions = array_merge($conditions, array(
                'OrderItem.product_id' => $product_id
            ));
            $order = $this->User->Order->OrderItem->find('all', array(
                'conditions' => $conditions,
                'fields' => array(
                    'SUM(OrderItem.price) as total_sales_amount',
                    'COUNT(OrderItem.id) as total_sales',
                    'OrderItem.id',
                    'OrderItem.product_id',
                    'OrderItem.price',
                    'Order.id',
                    'Order.order_status_id',
                ) ,
                'group' => 'Order.order_status_id, OrderItem.product_id',
                'recursive' => 0
            ));
            if (!empty($order['0'])) {
                $this->updateAll(array(
                    'Product.sales_' . $key . '_amount' => "'" . $order['0']['0']['total_sales_amount'] . "'",
                    'Product.sales_' . $key . '_count' => "'" . $order['0']['0']['total_sales'] . "'"
                ) , array(
                    'Product.id' => $product_id
                ));
            }
        }
    }
	public function attribute_matrix_array($a){
		$out = array();
		if (count($a) == 1) {
			$x = array_shift($a);
			foreach ($x as $v) $out[] = array($v);
			return $out;
		}
		foreach ($a as $k => $v){
			$b = $a;
			unset($b[$k]);
			$x = $this->attribute_matrix_array($b);
			foreach ($v as $v1){
				foreach ($x As $v2){ 
					$out[] = array_merge(array($v1), $v2);
				}
			}
		}
		return $out;
	}
	
	public function product_attribute_group_array($a1, $a2) {
  		return !array_diff($a1, $a2) && !array_diff($a2, $a1);
	}
	function updateProductQuantity($product_id){
		$total_quantity = $this->ProductAttribute->find('all', array(
			'conditions' => array(
				'ProductAttribute.product_id' => $product_id
			),
			'fields' => array(
				'SUM(ProductAttribute.quantity) as total_quantity',				
			) ,
		));		
		$this->updateAll(array(
			'Product.quantity' => $total_quantity[0][0]['total_quantity'],				
		) , array(
			'Product.id' => $product_id
		));
	}
	function _post_to_third_party_web($product_id)
	{
		$product = $this->find('first', array(
            'conditions' => array(
				'Product.id' => $product_id,
				'Product.is_system_flagged' => 0
			),
			'fields' => array(
				'Product.id',
				'Product.title',
				'Product.slug',
				'Product.description',
			),
            'recursive' => -1            
        ));
		if(empty($product)){
			return false;
		}
		$url = Router::url('/', true) . 'product/' . $product['Product']['slug'];
		// Facebook //		
		if (Configure::read('product.post_product_on_facebook') == 1) {
			$fb_message = strtr(Configure::read('facebook.new_product_message') , array(
				'##PRODUCT_LINK##' => $url,
				'##PRODUCT_NAME##' => $product['Product']['title'],
			));
			$data['message'] = $fb_message;			
			$data['url'] = $url;
			$data['description'] = $product['Product']['description'];
			$data['fb_access_token'] = '';
			$data['fb_user_id'] = '';
			$this->_postInFacebook($data);
		}
		// Twitter //				
		if (Configure::read('product.post_product_on_twitter') == 1) {
			$tw_message = strtr(Configure::read('twitter.new_product_message') , array(
				'##URL##' => $url,
				'##PRODUCT_NAME##' => $product['Product']['title'],
				'##SLUGED_SITE_NAME##' => Inflector::slug(strtolower(Configure::read('site.name'))) ,
			));
			$data['message'] = $tw_message;
			$data['twitter_access_token'] = '';
			$data['twitter_access_key'] = '';
			$this->_postInTwitter($data);
		}		
	}
	function _postInTwitter($data)
    {
        App::import('Core', 'ComponentCollection');
		$collection = new ComponentCollection();
		App::import('Component', 'OauthConsumer');
		$this->OauthConsumer = new OauthConsumerComponent($collection);		

		$xml = $this->OauthConsumer->post('Twitter', (!empty($data['twitter_access_token']) ? $data['twitter_access_token'] : Configure::read('twitter.site_user_access_token')) , (!empty($data['twitter_access_key']) ? $data['twitter_access_key'] : Configure::read('twitter.site_user_access_key')) , 'http://api.twitter.com/1/statuses/update.json', array(
            'status' => $data['message']
        ));		
    }
	function _postInFacebook($data)
    {
        App::import('Vendor', 'facebook/facebook');
		$this->facebook = new Facebook(array(
			'appId' => Configure::read('facebook.fb_api_key') ,
			'secret' => Configure::read('facebook.fb_secrect_key') ,
			'cookie' => true
		));		
		try {
            $this->facebook->api('/' . (!empty($data['fb_user_id']) ? $data['fb_user_id'] : Configure::read('facebook.page_id')) . '/feed', 'POST', array(
                'access_token' => (!empty($data['fb_access_token']) ? $data['fb_access_token'] : Configure::read('facebook.fb_access_token')) ,
                'message' => $data['message'],                                
                'link' => $data['url'],
                'caption' => Router::url('/', true) ,
                'description' => strip_tags($data['description'])
            ));
        }
        catch(Exception $e) {
            $this->log('Post on facebook error');
        }
    }
}

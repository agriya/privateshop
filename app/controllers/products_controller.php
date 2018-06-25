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
class ProductsController extends AppController
{
    public $name = 'Products';
    public $components = array(
        'OauthConsumer',
    );
    public function beforeFilter()
    {
        $this->Security->disabledFields = array(
            'Attachment',
            'ProductShipmentCost',
            'Product.is_save_draft',
            'Product.save_as_draft',
            'AttributesProductAttribute',
            'ProductAttribute',
            'Cart.product_attribute_id',
            'Cart.quantity',
			'Product.pricerange',
			'Product.attribute',
			'User.email',
			'OrderItem'
        );
        parent::beforeFilter();
    }
    public function index()
    {		
        $this->pageTitle = __l('Products');
        if (!$this->Auth->user('id') && Configure::read('site.force_login') && !empty($this->request->params['named']['type']) && ($this->request->params['named']['type'] !='recommended')){
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'admin' => false
			));
		}
		$conditions = array();
        $this->_redirectGET2Named(array(
            'q',
            'username',
            'product_status_id'
        ));
        if (!empty($this->request->params['named']['filter_id'])) {
            $this->request->data['Product']['filter_id'] = $this->request->params['named']['filter_id'];
        }
		if (!empty($this->request->data)){
			$this->Session->write('product_search', $this->request->data);
		} else{
			$product_search = $this->Session->read('product_search');			
			if(!empty($this->request->params['named']['page']) || !empty($this->request->params['named']['sort'])){
				$this->request->data = $product_search;
			} else{
				$this->Session->delete('product_search');
			}
		}		
        if (!empty($this->request->data['Product']['filter_id'])) {
            if ($this->request->data['Product']['filter_id'] == ConstMoreAction::Active) {
                $conditions['Product.is_active'] = 1;
                $conditions['Product.admin_suspend'] = 0;
                $this->pageTitle.= __l(' - Active ');
            } else if ($this->request->data['Product']['filter_id'] == ConstMoreAction::Inactive) {
                $conditions['Product.is_active'] = 0;
                $this->pageTitle.= __l(' - User suspended ');
            }
        }
        if (!empty($this->request->params['named']['status_filter_id'])) {
            if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Draft) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Draft;
                $this->pageTitle.= __l(' - Draft ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Upcoming) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Upcoming;
                $this->pageTitle.= __l(' - Upcoming ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Open) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Open;
                $this->pageTitle.= __l(' - Open ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Closed) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Closed;
                $this->pageTitle.= __l(' - Closed ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Canceled) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Canceled;
                $this->pageTitle.= __l(' - Canceled ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::AwaitingApproval) {
                $conditions['Product.product_status_id'] = ConstProductStatus::AwaitingApproval;
                $this->pageTitle.= __l(' - A waiting for approval ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Rejected) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Rejected;
                $this->pageTitle.= __l(' - Rejected ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::PaidToSeller) {
                $conditions['Product.product_status_id'] = ConstProductStatus::PaidToSeller;
                $this->pageTitle.= __l(' - Paid to Seller ');
            }
        }
		if (!empty($this->request->data['Product']['category'])) {
            $this->request->params['named']['category'] = $this->request->data['Product']['category'];
        }
		$group_conditions = array();
        if (!empty($this->request->params['named']['category'])) {
            $category = $this->Product->Category->find('first', array(
                'conditions' => array(
                    'Category.slug' => $this->request->params['named']['category'],
                ) ,
                'recursive' => -1,
            ));
            $categoriesList = $this->Product->Category->find('all', array(
                'conditions' => array(
                    'Category.parent_id' => $category['Category']['parent_id'],
                ) ,
                'recursive' => -1,
            ));
            $parentCategory = $this->Product->Category->find('first', array(
                'conditions' => array(
                    'Category.id' => $category['Category']['parent_id'],
                ) ,
                'recursive' => -1,
            ));
            $this->set('parentCategory', $parentCategory);
            $this->set('categoriesList', $categoriesList);
            $categoeyBreadCrumb = $this->Product->Category->getCategoeyBreadCrumb($category['Category']['id']);
            $this->set('categoeyBreadCrumb', $categoeyBreadCrumb);

			$cat_groups = $this->Product->query("SELECT DISTINCT(ag.id) FROM attribute_groups ag JOIN attribute_groups_products agp ON agp.attribute_group_id = ag.id  JOIN products p ON p.id = agp.product_id WHERE p.category_id ='".$category['Category']['id']."' ");
			if(!empty($cat_groups)){
				foreach($cat_groups as $group){
					$group_conditions['AttributeGroup.id'][] = $group['ag']['id'];
				}
			}			
        }
		$limit = 12;
        $attributeGroups = array();
        if (Configure::read('attribute.is_enabled_attribute')) {
            $this->loadModel('AttributeGroup');
            $attributeGroups = $this->AttributeGroup->find('all', array(
				'conditions' => $group_conditions,
                'contain' => array(
                    'Attribute',
                ) ,
                'recursive' => 2,
            ));
        }
        $this->set('attributeGroups', $attributeGroups);
        $priceRanges = $this->Product->priceRanges;
        $this->set(compact('priceRanges'));
		$productIds = array();	
		$category_filter = true;
		$group_filter = false;
        if (!empty($this->request->data['Product']['attribute'])) {
			$first = true;
			foreach($this->request->data['Product']['attribute'] as $group) {
				$groupAttributes = array();
				foreach($group as $key => $val) {
                    if (!empty($val)) {
                        array_push($groupAttributes, $key);
                    }
				}			
				$groupAttributeImplode = implode(",", $groupAttributes);				
				if(!empty($groupAttributes)){
					$category_filter = false;
					$group_filter = true;
					if(isset($category) && !empty($category)){
						$groupProducts = $this->Product->query("SELECT DISTINCT(pa.product_id) FROM product_attributes pa  LEFT JOIN attributes_product_attributes apa ON pa.id= apa.product_attribute_id JOIN products p ON pa.product_id = p.id WHERE  p.category_id ='".$category['Category']['id']."' AND apa.attribute_id IN(" . $groupAttributeImplode . ")");
					} else{
						$groupProducts = $this->Product->query("SELECT DISTINCT(pa.product_id) FROM product_attributes pa  LEFT JOIN attributes_product_attributes apa ON pa.id= apa.product_attribute_id WHERE apa.attribute_id IN(" . $groupAttributeImplode . ")");
						
					}
					$tmpProducts = array();
					foreach($groupProducts as $groupProduct){
						array_push($tmpProducts, $groupProduct['pa']['product_id']);
					}
					if($first){
						$productIds = $tmpProducts;
						$first = false;
					} else{						
						$productIds = array_intersect($tmpProducts, $productIds);
					}					
				}
				
			}			
        }       		
		$range_filter = false;
        if (!empty($this->request->data['Product']['pricerange'])) {			
            $rangeProductIds = array();
			foreach($this->request->data['Product']['pricerange'] as $productPriceRangeKey => $productPriceRangeVal) {
                if (!empty($productPriceRangeVal)) {     
					$category_filter = false;
					$range_conditions = array(
						'Product.discounted_price BETWEEN ? AND ?' => array(
							$this->Product->priceRanges[$productPriceRangeKey]['range'][0],
							$this->Product->priceRanges[$productPriceRangeKey]['range'][1]
						),

					);
					if (!empty($this->request->params['named']['category'])) {
						$range_conditions['Product.category_id'] = $category['Category']['id'];			
					}
					$priceRangeProducts = $this->Product->find('list', array(
                        'conditions' => $range_conditions ,
                        'fields' => array(
                            'Product.id'
                        ) ,
                        'recursive' => -1,
                    ));
					$rangeProductIds = array_merge($rangeProductIds, $priceRangeProducts);
					$range_filter = true;
                }
            }
			if($range_filter){
				if($group_filter){
					$productIds = array_intersect($productIds, $rangeProductIds);
				} else{
					$productIds = $rangeProductIds;
				}
			}
		}  			
		if(!empty($productIds)){
			$conditions['Product.id'] = array_unique($productIds);
		}        
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'myproduct') {
            //check module is enabled or not
            // [seller] my products listing with filter
            if (!Configure::read('module.seller')) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $this->set('active_product_count', $this->Product->find('count', array(
                'conditions' => array(
                    'Product.is_active' => 1,
                    'Product.user_id' => $this->Auth->user('id') ,
                    'Product.admin_suspend' => 0,
                ) ,
                'recursive' => -1
            )));
            $this->set('inactive_product_count', $this->Product->find('count', array(
                'conditions' => array(
                    'Product.is_active' => 0,
                    'Product.user_id' => $this->Auth->user('id') ,
                ) ,
                'recursive' => -1
            )));
            $conditions['Product.user_id'] = $this->Auth->user('id');
        } else {
            $conditions['Product.product_status_id'] = ConstProductStatus::Open;
            $conditions['Product.is_active'] = 1;
        }		
		if (isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'recommended') {
			$product = $this->Product->find('first', array(
				'conditions' => array(
					'Product.id' => $this->request->params['named']['product_id']
				),
				'fields' => array(
					'Product.id',
					'Product.category_id'
			),
				'recursive' => -1
			));
			$conditions['Product.category_id'] = $product['Product']['category_id'];
			$conditions['Product.id !='] = $product['Product']['id'];	
			$limit = 5;
		}	
        if (!empty($this->request->params['named']['category']) && $category_filter) {
            $conditions['Product.category_id'] = $category['Category']['id'];			
        }
        $contain = array(
            'User' => array(
                'fields' => array(
                    'User.id',
                    'User.username',
                ) ,
            ) ,
			'Category' => array(
				'fields' => array(
                    'Category.id',
                    'Category.slug',
					'Category.name'
                )
			),
            'ProductStatus',
            'Attachment',
        ); 
		$this->paginate = array(
			'conditions' => $conditions,
			'contain' => $contain,
			'limit' => $limit,
			'recursive' => 2,
			'order' => array(
				'Product.end_date' => 'asc'
			)
		);
		$products = $this->paginate();
		if(empty($productIds) && !$category_filter){
			$products = array();
		} 	
        $productStatuses = $this->Product->ProductStatus->find('list');
        // [seller] product status
        if (!Configure::read('module.seller')) {
            unset($productStatuses[6], $productStatuses[7], $productStatuses[8]);
        }
        foreach($productStatuses as $product_status_id => $product_status_name) {
            $this->set('product_status_' . $product_status_id, $this->Product->find('count', array(
                'conditions' => array(
                    'Product.product_status_id' => $product_status_id,
                    'Product.user_id' => $this->Auth->user('id') ,
                ) ,
                'recursive' => -1
            )));
        }
        $moreActions = $this->Product->moreActions;
        unset($moreActions[13], $moreActions[14], $moreActions[10], $moreActions[15], $moreActions[6], $moreActions[7]);
        $this->set(compact('moreActions', 'productStatuses'));
        $this->set('products', $products);
        if (!empty($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'myproduct') {
            $this->autoRender = false;
            $this->render('myproduct');
        }
		if (isset($this->request->params['named']['type']) && $this->request->params['named']['type'] == 'recommended') {
			$this->render('recommended-index');
		}
    }
    public function buyers($product_id)
    {
     if($this->Auth->user('user_type_id') != ConstUserTypes::Admin){
		 $this->redirect(array(
                        'controller' => 'products',
                        'action' => 'index',
                        'admin' => false
                    ));
	 } else{
       if (empty($product_id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $orderItems = $this->Product->OrderItem->find('all', array(
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
        $this->set('orderItems', $orderItems);
	 }
    }
    public function view($slug = null)
    {
        $this->pageTitle = __l('Product');
        $contain = array(
            'User' => array(
                'fields' => array(
                    'User.id',
                    'User.username',
                ) ,
            ) ,
            'ProductStatus' => array(
                'fields' => array(
                    'ProductStatus.id',
                    'ProductStatus.name',
                ) ,
            ) ,
            'ProductShipmentCost' => array(
                'GroupedCountry' => array(
                    'fields' => array(
                        'GroupedCountry.name',
                    ) ,
                ) ,
            ) ,
            'Attachment',
        );
        $product = $this->Product->find('first', array(
            'conditions' => array(
                'Product.slug = ' => $slug,
            ) ,
            'contain' => $contain,
            'recursive' => 2,
        ));
		if(empty($product)){
			throw new NotFoundException(__l('Invalid request'));
		}
        if (($this->Auth->user('id') != $product['Product']['user_id']) && $this->Auth->user('user_type_id') != ConstUserTypes::Admin) {
            if (empty($product) || (!empty($product['Product']['admin_suspend']) || !in_array($product['Product']['product_status_id'], array(
                ConstProductStatus::Open,
                ConstProductStatus::Closed
            )))) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        //[variants]
        $groups = $colors = $combinations = array();
        if (Configure::read('attribute.is_enabled_attribute') && $product['Product']['is_product_variant_enabled']) {
            $attributesGroups = $this->Product->query("SELECT a.id as attribute_id, a.attribute_group_id as attribute_group_id, a.name as attribute_name, a.attribute_group_type_value as attribute_group_type_value, ag.attribute_group_type_id as attribute_group_type_id, ag.name as attribute_group_name, ag.display_name as attribute_group_display_name, pa.id as product_attribute_id, pa.product_id as product_id, pa.quantity as quantity, pa.original_price as original_price, pa.discounted_price as discounted_price, pa.discounted_price as discounted_price, pa.sold_quantity as sold_quantity
														  FROM product_attributes pa LEFT JOIN attributes_product_attributes apa ON apa.product_attribute_id = pa.id
														  LEFT JOIN attributes a ON a.id = apa.attribute_id
														  LEFT JOIN attribute_groups ag ON ag.id = a.attribute_group_id WHERE pa.product_id ='" . $product['Product']['id'] . "' ");
            if (is_array($attributesGroups) AND $attributesGroups) {
                foreach($attributesGroups AS $k => $attributesGroup) {
                    /* Color management */
                    if (isset($attributesGroup['a']['attribute_group_type_value']) AND $attributesGroup['a']['attribute_group_type_value'] AND ConstAttributeGroupType::Color == $attributesGroup['ag']['attribute_group_type_id']) {
                        $colors[$attributesGroup['a']['attribute_id']]['value'] = $attributesGroup['a']['attribute_group_type_value'];
                        $colors[$attributesGroup['a']['attribute_id']]['name'] = $attributesGroup['a']['attribute_name'];
                        $colors[$attributesGroup['a']['attribute_id']]['id'] = $attributesGroup['a']['attribute_id'];
                    }
                    if (!isset($groups[$attributesGroup['a']['attribute_group_id']])) {
                        $groups[$attributesGroup['a']['attribute_group_id']] = array(
                            'name' => $attributesGroup['ag']['attribute_group_display_name'],
                            'is_color_group' => (ConstAttributeGroupType::Color == $attributesGroup['ag']['attribute_group_type_id']) ? 1 : 0,
                        );
                    }
                    $groups[$attributesGroup['a']['attribute_group_id']]['attributes'][$attributesGroup['a']['attribute_id']] = $attributesGroup['a']['attribute_name'];
                    $combinations[$attributesGroup['pa']['product_attribute_id']]['attributes_values'][$attributesGroup['a']['attribute_group_id']] = $attributesGroup['a']['attribute_name'];
                    $combinations[$attributesGroup['pa']['product_attribute_id']]['attributes'][] = (int)($attributesGroup['a']['attribute_id']);
                    $combinations[$attributesGroup['pa']['product_attribute_id']]['original_price'] = (float)($attributesGroup['pa']['original_price']);
                    $combinations[$attributesGroup['pa']['product_attribute_id']]['quantity'] = (int)($attributesGroup['pa']['quantity']-$attributesGroup['pa']['sold_quantity']);
                    $combinations[$attributesGroup['pa']['product_attribute_id']]['discounted_price'] = (float)($attributesGroup['pa']['discounted_price']);
                    $combinations[$attributesGroup['pa']['product_attribute_id']]['image_url'] = '';
                    $this->loadModel('ProductAttribute');
                    $productAttributeAttachment = $this->ProductAttribute->find('first', array(
                        'conditions' => array(
                            'ProductAttribute.id' => $attributesGroup['pa']['product_attribute_id']
                        ) ,
                        'contain' => array(
                            'Attachment'
                        ) ,
                        'recursive' => 0
                    ));
                    $combinations[$attributesGroup['pa']['product_attribute_id']]['sold_quantity'] = 0;
                    if (!empty($productAttributeAttachment['Attachment']['id'])) {
                        $image_url = $this->Product->getImageUrl('Product', $productAttributeAttachment['Attachment'], array(
                            'dimension' => 'big_thumb'
                        ));
                        $combinations[$attributesGroup['pa']['product_attribute_id']]['image_url'] = $image_url;
                    }
                }
                $this->js_vars['cfg']['combinations'] = $combinations;
            }
        }
        $this->Product->ProductView->create();
        $this->request->data['ProductView']['user_id'] = ($this->Auth->user('id')) ? $this->Auth->user('id') : 0;
        $this->request->data['ProductView']['product_id'] = $product['Product']['id'];
        $this->request->data['ProductView']['ip_id'] = $this->Product->toSaveIp();
        $this->Product->ProductView->save($this->request->data);
        if (!empty($product['Product']['meta_keywords'])) {
            Configure::write('meta.keywords', $product['Product']['meta_keywords']);
        }
        if (!empty($product['Product']['meta_description'])) {
            Configure::write('meta.description', $product['Product']['meta_description']);
        }
		if (!empty($product['Attachment'])) {
            $image_options = array(
                'dimension' => 'medium_thumb',
                'class' => '',
                'alt' => $product['Product']['title'],
                'title' => $product['Product']['title'],
                'type' => 'png'
            );
			$product_image = $this->Product->getImageUrl('Product', $product['Attachment'][0], $image_options);
			Configure::write('meta.product_image', $product_image);
		}
		Configure::write('meta.product_name', $product['Product']['title']);
        $category = $this->Product->Category->find('first', array(
            'conditions' => array(
                'Category.id' => $product['Product']['category_id'],
            ) ,
            'recursive' => -1,
        ));
        $categoriesList = $this->Product->Category->find('all', array(
            'conditions' => array(
                'Category.parent_id' => $category['Category']['parent_id'],
            ) ,
            'recursive' => -1,
        ));
        $parentCategory = $this->Product->Category->find('first', array(
            'conditions' => array(
                'Category.id' => $category['Category']['parent_id'],
            ) ,
            'recursive' => -1,
        ));
        $this->set('parentCategory', $parentCategory);
        $this->set('categoriesList', $categoriesList);
        $categoeyBreadCrumb = $this->Product->Category->getCategoeyBreadCrumb($category['Category']['id']);
        $this->set('categoeyBreadCrumb', $categoeyBreadCrumb);        
        $this->pageTitle.= ' - ' . $product['Product']['title'];
        $this->set('product', $product);
        $this->set('colors', $colors);
        $this->set('groups', $groups);
    }
    public function add()
    {
        $this->Product->create();
        $this->pageTitle = __l('Add Product');
        if (empty($this->request->data['Product']['is_start_end_date_required'])) {
            unset($this->request->data['Product']['start_date']);
            unset($this->request->data['Product']['end_date']);
        }
        // [seller] Seller Add
        if ($this->Auth->user('user_type_id') != ConstUserTypes::Admin && !Configure::read('module.seller')) {
            throw new NotFoundException(__l('Invalid request'));
        }
        // [seller] validate merge
        if (Configure::read('module.seller')) {
            $this->loadModel('Seller');
            $this->Product->validate = array_merge($this->Product->validate, $this->Seller->validate);
        }
        // [credits] validate merge
        if (Configure::read('module.credits')) {
            $this->loadModel('Credit');
            $this->Product->validate = array_merge($this->Product->validate, $this->Credit->validate);
        }
		unset($this->Product->validate['product_type_id']);
        $this->Product->Behaviors->attach('ImageUpload', Configure::read('image.file'));
        if (!empty($this->request->data)) {
            $this->Product->create();
            $uploaded_photo_count = 1;
            if (!empty($this->request->data['Attachment'])) {
                for ($i = 0; $i < count($this->request->data['Attachment']); $i++) {
                    if (!empty($this->request->data['Attachment'][$i]['filename'])) {
                        $uploaded_photo_count = 1;
                        break;
                    }
                }
            }
            if ($this->request->data['Product']['discounted_price'] == 0) {
                unset($this->Product->validate['discounted_price']['rule2']);
            } else {
                unset($this->Product->validate['discounted_price']['rule3']);
            }
            $this->request->data['Product']['user_id'] = $this->Auth->user('id');
            $this->Product->set($this->request->data);
            $ini_upload_error = $is_shipping_given = 0;
            if (!empty($this->request->data['Product']['product_type_id'])) {
                if ($this->request->data['Product']['product_type_id'] == ConstProductTypes::Shipping) {
                    $this->request->data['Product']['is_requires_shipping'] = 1;
                    // [credits] unset validate
                    if (Configure::read('module.credits')) {
                        unset($this->Product->validate['credit_price']);
                        unset($this->Product->validate['credits']);
                        unset($this->Product->validate['credit_expiry_date']);
                    }
                    foreach($this->request->data['ProductShipmentCost'] as $productShipmentCost) {
                        if (!empty($productShipmentCost['grouped_country_id'])) {
                            $is_shipping_given = 1;
                        }
                    }
                } elseif ($this->request->data['Product']['product_type_id'] == ConstProductTypes::Download) {
                    $this->request->data['Product']['is_having_file_to_download'] = 1;
                    $this->Product->ProductFile->Behaviors->attach('ImageUpload');
                    if (!empty($this->request->data['ProductFile']['filename']['name'])) {
                        $this->request->data['ProductFile']['filename']['type'] = get_mime($this->request->data['ProductFile']['filename']['tmp_name']);
                    }
                    if (!empty($this->request->data['ProductFile']['filename']['name'])) {
                        $this->Product->ProductFile->set($this->request->data);
                    }					
                    if ($this->request->data['ProductFile']['filename']['error'] == 1 || empty($this->request->data['ProductFile']['filename']['name'])) {
                        $ini_upload_error = 1;
                    }
                    // [credits] unset validate
                    if (Configure::read('module.credits')) {
                        unset($this->Product->validate['credit_price']);
                        unset($this->Product->validate['credits']);
                        unset($this->Product->validate['credit_expiry_date']);
                    }
                    $is_shipping_given = 1;
                } elseif ($this->request->data['Product']['product_type_id'] == ConstProductTypes::Credit) {
                    $this->request->data['Product']['is_credit_product'] = 1;
                    $this->request->data['Product']['discounted_price'] = $this->request->data['Product']['original_price'] = $this->request->data['Product']['credit_price'];
                    $is_shipping_given = 1;
                }
            }
            if (!empty($this->request->data['Product']['start_date'])) {
                $current_date = date('Ymd');
                $year = $this->request->data['Product']['start_date']['year'];
                $month = $this->request->data['Product']['start_date']['month'];
                $day = $this->request->data['Product']['start_date']['day'];
                $start_date=date($year.$month.$day);
            }
            if (!empty($this->request->data['Product']['save_as_draft']) || !empty($this->request->data['Product']['is_save_draft'])) {
                $this->request->data['Product']['product_status_id'] = ConstProductStatus::Draft;
            } elseif ($this->Auth->user('user_type_id') == ConstUserTypes::Admin || ($this->Auth->user('user_type_id') == ConstUserTypes::User && Configure::read('seller.is_auto_approve_new_product'))) {
                if (!empty($start_date) && strtotime($start_date) > strtotime($current_date)) {
                    $this->request->data['Product']['product_status_id'] = ConstProductStatus::Upcoming;
                } else {
                    $this->request->data['Product']['product_status_id'] = ConstProductStatus::Open;
                }
            } else {
                $this->request->data['Product']['product_status_id'] = ConstProductStatus::AwaitingApproval;
            }
            if ($this->Product->validates() &$this->Product->ProductFile->validates() &!$ini_upload_error&$is_shipping_given&$uploaded_photo_count) {
                $this->request->data['Product']['ip_id'] = $this->Product->toSaveIp();
                $this->Product->save($this->request->data);
                $product_id = $this->Product->getLastInsertId();
                $is_product_variant_added = false;
                if (!empty($this->request->data['Product']['is_product_variant_enabled']) && !empty($this->request->data['AttributeGroupProduct']['attribute_group_id'])) {
                    $data = array();
                    foreach($this->request->data['AttributeGroupProduct']['attribute_group_id'] as $AttributeGroupProduct) {
                        $this->Product->AttributeGroupsProduct->create();
                        $data['product_id'] = $product_id;
                        $data['attribute_group_id'] = $AttributeGroupProduct;
                        $this->Product->AttributeGroupsProduct->save($data);
                        $is_product_variant_added = true;
                    }
                }
                if (!empty($this->request->data['Product']['is_having_file_to_download']) && !empty($this->request->data['ProductFile']['filename']['name'])) {
                    $this->Product->ProductFile->set($this->request->data);
                    $this->request->data['ProductFile']['class'] = 'ProductFile';
                    $this->request->data['ProductFile']['foreign_id'] = $product_id;
                    $this->Product->Attachment->create();
                    $this->Product->Attachment->save($this->request->data['ProductFile']);
                    $this->Product->Attachment->Behaviors->detach('ImageUpload');
                }
                if (!empty($this->request->data['Attachment'])) { // Flash Upload
                    for ($i = 0; $i < count($this->request->data['Attachment']); $i++) {
                        if (!empty($this->request->data['Attachment'][$i]['filename'])) {
                            $attachment = array();
                            $file_id = $this->request->data['Attachment'][$i]['filename'];
                            $this->Product->Attachment->create();
                            $attachment['Attachment']['foreign_id'] = $product_id;
                            $attachment['Attachment']['class'] = 'Product';
                            $attachment['Attachment']['description'] = $this->request->data['Attachment'][$i]['description'];
                            $this->Product->Attachment->Behaviors->attach('ImageUpload');
                            $this->Product->Attachment->enableUpload(false); //don't trigger upload behavior on save
                            $attachment['Attachment']['mimetype'] = $_SESSION['product_file_info'][$file_id]['type'];
                            $attachment['Attachment']['dir'] = 'Product/' . $product_id;
                            $upload_path = APP . DS . 'media' . DS . 'Product' . DS . $product_id;
                            new Folder($upload_path, true);
                            $file_name = $_SESSION['product_file_info'][$file_id]['filename'];
                            $attachment['Attachment']['filename'] = $file_name;
                            $fp = fopen($upload_path . DS . $file_name, 'w');
                            fwrite($fp, base64_decode($_SESSION['product_file_info'][$file_id]['original']));
                            fclose($fp);
                            $this->Product->Attachment->create();
                            $this->Product->Attachment->save($attachment);
                            $this->Product->Attachment->Behaviors->detach('ImageUpload');
                            unset($_SESSION['product_file_info'][$file_id]);
                        }
                    }
                }
                if (!empty($this->request->data['Product']['is_requires_shipping'])) {
                    foreach($this->request->data['ProductShipmentCost'] as $productShipmentCost) {
                        $shipment_cost = array();
                        if (!empty($productShipmentCost['grouped_country_id'])) {
                            $shipment_cost['ProductShipmentCost'] = $productShipmentCost;
                            $shipment_cost['ProductShipmentCost']['product_id'] = $this->Product->id;
                            $this->Product->ProductShipmentCost->create();
                            $this->Product->ProductShipmentCost->save($shipment_cost['ProductShipmentCost'], false);
                        }
                    }
                }
                $this->Session->setFlash(__l('Product has been added') , 'default', null, 'success');
				if($this->request->data['Product']['product_status_id'] == ConstProductStatus::Open){
					$this->Product->_post_to_third_party_web($product_id);
				}
                if ($is_product_variant_added) {
                    $this->redirect(array(
                        'controller' => 'products',
                        'action' => 'product_variants',
                        'product_id' => $product_id,
                        'admin' => true
                    ));
                } else{
					$this->redirect(array(
                        'controller' => 'products',
                        'action' => 'index',                        
                        'admin' => true
                    ));
				}
            } else {
                // [credits] validate merge
                if (Configure::read('module.credits')) {
                    $this->Product->validate = array_merge($this->Product->validate, $this->Credit->validate);
                }
                if (!empty($this->request->data['Product']['is_requires_shipping']) && empty($is_shipping_given)) {
                    $this->Session->setFlash(__l('Please enter shipping details.') , 'default', null, 'error');
                } elseif($ini_upload_error && $this->request->data['Product']['product_type_id'] == ConstProductTypes::Download) {
					$this->Session->setFlash(__l('Please upload a downloadable file.') , 'default', null, 'error');
				}else{
                    $this->Session->setFlash(__l('Product could not be added. Please, try again.') , 'default', null, 'error');
                }
            }
        } else{
			$this->request->data['Product']['product_type_id'] = ConstProductTypes::Shipping;
		}
        $productStatuses = $this->Product->ProductStatus->find('list');
        $countries = $this->Product->User->UserProfile->Country->find('list');
        $shipment_costs = $this->Product->shipmentCostsOptions;
        $this->set('shipment_costs', $shipment_costs);
        // countries and region settings
        $groupCountries = $this->Product->ProductShipmentCost->GroupedCountry->find('list', array(
            'conditions' => array(
                'GroupedCountry.related_class IS NULL'
            ) ,
            'recursive' => -1
        ));
        $groupUnionCountries = $this->Product->ProductShipmentCost->GroupedCountry->find('list', array(
            'conditions' => array(
                'GroupedCountry.related_class' => 'Union'
            ) ,
            'recursive' => -1
        ));
        $groupContinentCountries = $this->Product->ProductShipmentCost->GroupedCountry->find('list', array(
            'conditions' => array(
                'GroupedCountry.related_class' => 'Continent'
            ) ,
            'recursive' => -1
        ));
        $groupWorldwideCountries = $this->Product->ProductShipmentCost->GroupedCountry->find('list', array(
            'conditions' => array(
                'GroupedCountry.related_class' => 'Worldwide'
            ) ,
            'recursive' => -1
        ));
        if (empty($this->request->data['Product']['is_active'])) {
            $this->request->data['Product']['is_active'] = 1;
        }
        $firstCategories = $this->Product->Category->find('list', array(
            'conditions' => array(
                'Category.parent_id' => 0,
            ) ,
            'recursive' => -1,
        ));
        $this->set('firstCategories', $firstCategories);
        if (!empty($this->request->data['Product']['category_id'])) {
            $CategoryId = $this->Product->Category->find('first', array(
                'conditions' => array(
                    'Category.id' => $this->request->data['Product']['category_id'],
                ) ,
                'recursive' => -1,
            ));
            $categories = $this->Product->Category->find('list', array(
                'conditions' => array(
                    'Category.parent_id' => $CategoryId['Category']['parent_id'],
                ) ,
                'recursive' => -1,
            ));
            $this->set('categories', $categories);
            $secondCategoryId = $this->Product->Category->find('first', array(
                'conditions' => array(
                    'Category.id' => $CategoryId['Category']['parent_id'],
                ) ,
                'recursive' => -1,
            ));
            $secondCategories = $this->Product->Category->find('list', array(
                'conditions' => array(
                    'Category.parent_id' => $secondCategoryId['Category']['parent_id'],
                ) ,
                'recursive' => -1,
            ));
            $this->request->data['Product']['second_category_id'] = $secondCategoryId['Category']['id'];
            $this->set('secondCategories', $secondCategories);
            $firstCategoryId = $this->Product->Category->find('first', array(
                'conditions' => array(
                    'Category.id' => $secondCategoryId['Category']['parent_id'],
                ) ,
                'recursive' => -1,
            ));
        }
        $this->set('firstCategories', $firstCategories);
        $shipCountries['Regions'] = $groupWorldwideCountries;
        $shipCountries['--------------------'] = $groupUnionCountries;
        $shipCountries['---------------------'] = $groupContinentCountries;
        $shipCountries['Individual countries'] = $groupCountries;
        $this->set('shipCountries', $shipCountries);
        $this->set(compact('productStatuses', 'countries'));
        $this->loadModel('AttributeGroup');
        $attributeGroups = $this->AttributeGroup->find('list');
        $this->set('attributeGroups', $attributeGroups);
    }
    public function admin_product_variants()
    {
        $this->loadModel('Attribute');
        $this->loadModel('Attachment');
        $this->loadModel('AttributesProductAttribute');		       
        if (!empty($this->request->data['Product']['id'])) {
            $product_id = $this->request->params['named']['product_id'] = $this->request->data['Product']['id'];
        }
        if (!empty($this->request['named']['product_id'])) {
            $product_id = $this->request->data['Product']['id'] = $this->request->params['named']['product_id'];
        }
		if (isset($this->request->data['Product']['type']) && !empty($this->request->data['Product']['type'])) {
            $this->request->params['named']['type'] = $this->request->data['Product']['type'];
        }elseif (isset($this->request->params['named']['type']) && !empty($this->request->params['named']['type'])) {
            $this->request->data['Product']['type'] = $this->request->params['named']['type'];
        }
		$productAttributeCount = $this->Product->ProductAttribute->find('count', array(
            'conditions' => array(
                'ProductAttribute.product_id' => $product_id
            )
        ));
		if(!isset($this->request->data['Product']['type']) && $productAttributeCount>0){
			 $this->request->data['Product']['type'] = $this->request->params['named']['type'] = 'edit';

		}		
        $this->Attachment->Behaviors->attach('ImageUpload', Configure::read('productattribute.file'));
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['ProductAttribute'])) {
                $is_form_valid = true;
                foreach($this->request->data['ProductAttribute'] as $key => $ProductAttribute) {
                    $data = array();
                    $data['ProductAttribute'] = $ProductAttribute;
                    if ($data['ProductAttribute']['quantity'] > 0) {
                        if ($data['ProductAttribute']['original_price'] <= 0) {
                            $ProductAttributeValidationError[$key]['original_price'] = __l('Orginal price should be greater than zero');
                            $is_form_valid = false;
                        }
                        if (!empty($data['ProductAttribute']['original_price']) && !empty($data['ProductAttribute']['discount_amount']) && $data['ProductAttribute']['discount_amount'] >= $data['ProductAttribute']['original_price']) {
                            $ProductAttributeValidationError[$key]['discount_amount'] = __l('Discount amount should be less than original price');
                            $is_form_valid = false;
                        }
                        if (!empty($data['ProductAttribute']['discount_percentage']) && $data['ProductAttribute']['discount_percentage'] > 100) {
                            $ProductAttributeValidationError[$key]['discount_percentage'] = __l('Discount percentage should be less than 100');
                            $is_form_valid = false;
                        }
                    }
                }
                if (!empty($ProductAttributeValidationError)) {
                    $this->Product->ProductAttribute->validationErrors = array();
                    foreach($ProductAttributeValidationError as $key => $error) {
                        $this->Product->ProductAttribute->validationErrors[$key] = $error;
                    }
                }
                $ini_upload_error = 1;
                $Attachment = array();
                foreach($this->request->data['Attachment'] as $key => $Attachments) {
                    $data = array();
                    $data = $Attachments;
                    if (!empty($Attachments['filename']['name']) || (!Configure::read('productattribute.file.allowEmpty') && empty($Attachments['id']))) {
                        $this->Attachment->set($data);
                    }
                    if (!$this->Attachment->validates()) {
                        $Attachment[$key] = $this->Attachment->validationErrors;
                        $is_form_valid = false;
                    }
                    if ($Attachments['filename']['error'] == 1) {
                        $ini_upload_error = 0;
                    }
                }
                if (!empty($Attachment)) {
                    $this->Attachment->validationErrors = array();
                    foreach($Attachment as $key => $error) {
                        $this->Attachment->validationErrors[$key] = $error;
                    }
                }
                if ($is_form_valid && $ini_upload_error) {
                    if (!empty($this->request->data['ProductAttribute'])) {
                        foreach($this->request->data['ProductAttribute'] as $key => $ProductAttribute) {
                            $data = array();
                            $data['ProductAttribute'] = $ProductAttribute;
                            $data['ProductAttribute']['product_id'] = $product_id;                            
                            if (!empty($data)) {
                                if ($data['ProductAttribute']['quantity'] > 0 || isset($data['ProductAttribute']['id'])) {
                                    if (!isset($data['ProductAttribute']['id'])) {                                        
										$this->Product->ProductAttribute->create();
                                    }									
                                    $this->Product->ProductAttribute->save($data);
                                    if (!isset($data['ProductAttribute']['id'])) {
                                        $product_attribute_id = $this->Product->ProductAttribute->getLastInsertId();
                                    } else {
                                        $product_attribute_id = $data['ProductAttribute']['id'];
                                    }
                                    foreach($this->request->data['Attachment'] as $key_attach => $Attachment) {
                                        if ($key == $key_attach) {
                                            $data_attachment = $Attachment;
                                            if (!empty($Attachment['filename']['name'])) {
                                                $data_attachment['filename']['type'] = get_mime($Attachment['filename']['tmp_name']);
                                            }
                                            if (!empty($Attachment['id']) && !empty($Attachment['filename']['name'])) {
                                                $this->Attachment->delete($Attachment['id']);
                                            }
                                            $this->Attachment->create();
                                            $data_attachment['foreign_id'] = $product_attribute_id;
                                            $data_attachment['class'] = 'ProductAttribute';
                                            $this->Attachment->save($data_attachment);
                                        }
                                    }
                                    if (!isset($data['ProductAttribute']['id'])) {
                                        foreach($this->request->data['AttributesProductAttribute'] as $key_product_attribute => $AttributesProductAttributes) {
                                            if ($key == $key_product_attribute) {
                                                foreach($AttributesProductAttributes as $AttributesProductAttribute) {
                                                    $data = array();
                                                    $data['AttributesProductAttribute']['attribute_id'] = $AttributesProductAttribute['attribute_id'];
                                                    $this->AttributesProductAttribute->create();
                                                    $data['AttributesProductAttribute']['product_attribute_id'] = $product_attribute_id;
                                                    $this->AttributesProductAttribute->save($data);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $this->Session->setFlash(__l('product attribute has been added.') , 'default', null, 'success');
						$this->Product->updateProductQuantity($product_id);
                        $this->redirect(array(
							'controller' => 'products',
							'action' => 'index',
							'admin' => true
						));
                    }
                } else {
                    $this->Session->setFlash(__l('product variant could not be added. Please, try again.') , 'default', null, 'error');
                }
            }
        }
        $product_ids = $this->Product->AttributeGroupsProduct->find('list', array(
            'fields' => array(
                'AttributeGroupsProduct.attribute_group_id',
                'AttributeGroupsProduct.attribute_group_id'
            ) ,
            'conditions' => array(
                'AttributeGroupsProduct.product_id' => $product_id
            )
        ));
        $ids = array_keys($product_ids);
        if (!empty($ids)) {
            $productAttributes = array();
            foreach($ids as $id) {
                $attribute_ids = $this->Attribute->find('list', array(
                    'fields' => array(
                        'Attribute.id',
                        'Attribute.id'
                    ) ,
                    'conditions' => array(
                        'Attribute.attribute_group_id' => $id
                    ) ,
                    'recursive' => -1
                ));
                $attributeids = array_keys($attribute_ids);
                $productAttributes[] = $attributeids;
            }
            $filtered_attributes = array();
            if ($productAttributes) {
                $x = $this->Product->attribute_matrix_array($productAttributes);               
                foreach($x as $k => $v) {					               
                    if (!isCombinationExist($v, $filtered_attributes)) {                        
                        array_push($filtered_attributes, $v);
                    }
                }
            }
            $product = $this->Product->find('first', array(
                'conditions' => array(
                    'Product.id' => $product_id,
                ) ,
                'contain' => array(
                    'ProductAttribute' => array(
                        'Attachment',
                        'AttributesProductAttribute'
                    ) ,
                ) ,
                'recursive' => 2,
            ));
            $this->pageTitle = __l('Product').' - '.$product['Product']['title'].' - '.__l('Combination');
            $this->set('product', $product);
			$this->set('productAttributeCount', $productAttributeCount);
            $this->set('attributes', $filtered_attributes);
        }
    }
    public function edit($id = null)
    {
        $this->pageTitle = __l('Edit Product');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        // [seller] Seller Add
        if ($this->Auth->user('user_type_id') != ConstUserTypes::Admin && !Configure::read('module.seller')) {
            throw new NotFoundException(__l('Invalid request'));
        }
        // [seller] validate merge
        if (Configure::read('module.seller')) {
            $this->loadModel('Seller');
            $this->Product->validate = array_merge($this->Product->validate, $this->Seller->validate);
        }
        // [credits] validate merge
        if (Configure::read('module.credits')) {
            $this->loadModel('Credit');
            $this->Product->validate = array_merge($this->Product->validate, $this->Credit->validate);
        }
        $attribute_group_ids = $this->Product->AttributeGroupsProduct->find('list', array(
            'conditions' => array(
                'AttributeGroupsProduct.product_id' => $id,
            ) ,
            'fields' => array(
                'AttributeGroupsProduct.attribute_group_id',
                'AttributeGroupsProduct.attribute_group_id'
            ) ,
            'recursive' => -1,
        ));
        $attribute_group_ids = array_keys($attribute_group_ids);
        $this->Product->Behaviors->attach('ImageUpload', Configure::read('image.file'));
        if (!empty($this->request->data)) {
            $uploaded_photo_count = 1;
            if (!empty($this->request->data['Attachment'])) {
                for ($i = 0; $i < count($this->request->data['Attachment']); $i++) {
                    if ((!empty($this->request->data['Attachment'][$i]['id']) && empty($this->request->data['Attachment'][$i]['checked_id'])) || (!empty($this->request->data['Attachment'][$i]['filename']))) {
                        $uploaded_photo_count = 1;
                        break;
                    }
                }
            }
            if ($this->request->data['Product']['discounted_price'] == 0) {
                unset($this->Product->validate['discounted_price']['rule2']);
            } else {
                unset($this->Product->validate['discounted_price']['rule3']);
            }
            $this->request->data['Product']['user_id'] = $this->Auth->user('id');
            // [seller] validate merge
            if (Configure::read('module.seller')) {
                if (empty($this->request->data['Product']['is_save_draft'])) {
                    if ($this->Auth->user('user_type_id') != ConstUserTypes::Admin) {
                        $this->request->data['Product']['is_active'] = 1;
                        $this->request->data['Product']['product_status_id'] = ConstProductStatus::AwaitingApproval;
                    }
                }
            }
            $this->Product->set($this->request->data);
            $ini_upload_error = $is_shipping_given = $downloaded_file_delete_notuploaded = 0;
            if (!empty($this->request->data['Product']['product_type_id'])) {
                if ($this->request->data['Product']['product_type_id'] == ConstProductTypes::Shipping) {
                    $this->request->data['Product']['is_requires_shipping'] = 1;
                    // [credits] unset validate
                    if (Configure::read('module.credits')) {
                        unset($this->Product->validate['credit_price']);
                        unset($this->Product->validate['credits']);
                        unset($this->Product->validate['credit_expiry_date']);
                    }
                    foreach($this->request->data['ProductShipmentCost'] as $productShipmentCost) {
                        if (!empty($productShipmentCost['grouped_country_id'])) {
                            $is_shipping_given = 1;
                        }
                    }
                } elseif ($this->request->data['Product']['product_type_id'] == ConstProductTypes::Download) {
                    $this->request->data['Product']['is_having_file_to_download'] = 1;
                    $this->Product->ProductFile->Behaviors->attach('ImageUpload');					
                    if (!empty($this->request->data['ProductFile']['filename']['name'])) {
                        $this->request->data['ProductFile']['filename']['type'] = get_mime($this->request->data['ProductFile']['filename']['tmp_name']);
                    } elseif(!empty($this->request->data['OldAttachment']['id']) && $this->request->data['OldAttachment']['id'] == 1) {
						$downloaded_file_delete_notuploaded = 1;
					}
                    if (!empty($this->request->data['ProductFile']['filename']['name'])) {
                        $this->Product->ProductFile->set($this->request->data);
                    }
                    if ($this->request->data['ProductFile']['filename']['error'] == 1) {
                        $ini_upload_error = 1;
                    }
                    // [credits] unset validate
                    if (Configure::read('module.credits')) {
                        unset($this->Product->validate['credit_price']);
                        unset($this->Product->validate['credits']);
                        unset($this->Product->validate['credit_expiry_date']);
                    }
                    $is_shipping_given = 1;
                } elseif ($this->request->data['Product']['product_type_id'] == ConstProductTypes::Credit) {
                    $this->request->data['Product']['is_credit_product'] = 1;
                    $this->request->data['Product']['discounted_price'] = $this->request->data['Product']['original_price'] = $this->request->data['Product']['credit_price'];
                    $is_shipping_given = 1;
                }
				if(empty($this->request->data['Product']['is_save_draft'])){
                    $this->request->data['Product']['product_status_id'] = ConstProductStatus::Open;
                }
            }
			if (!empty($this->request->data['Product']['start_date'])) {
                $current_date = date('Ymd');
                $year = $this->request->data['Product']['start_date']['year'];
                $month = $this->request->data['Product']['start_date']['month'];
                $day = $this->request->data['Product']['start_date']['day'];
                $start_date=date($year.$month.$day);
            }
            
             if (!empty($this->request->data['Product']['save_as_draft']) || !empty($this->request->data['Product']['is_save_draft'])) {
                $this->request->data['Product']['product_status_id'] = ConstProductStatus::Draft;
            } elseif ($this->Auth->user('user_type_id') == ConstUserTypes::Admin || ($this->Auth->user('user_type_id') == ConstUserTypes::User && Configure::read('seller.is_auto_approve_new_product'))) {
                if (!empty($start_date) && strtotime($start_date) > strtotime($current_date)) {
                    $this->request->data['Product']['product_status_id'] = ConstProductStatus::Upcoming;
                } else {
                    $this->request->data['Product']['product_status_id'] = ConstProductStatus::Open;
                }
            } else {
                $this->request->data['Product']['product_status_id'] = ConstProductStatus::AwaitingApproval;
            }
            
            if ($this->Product->validates() && $this->Product->ProductFile->validates() && !$ini_upload_error && $is_shipping_given && $uploaded_photo_count && !$downloaded_file_delete_notuploaded) {
                $this->Product->save($this->request->data);
                $product_id = $this->request->data['Product']['id'];
                $is_product_variant_added = false;
                $this->loadModel('ProductAttribute');
                if (empty($this->request->data['Product']['is_product_variant_enabled'])) {
                    $this->Product->AttributeGroupsProduct->deleteAll(array(
                        'AttributeGroupsProduct.product_id' => $product_id
                    ));
                    $this->ProductAttribute->deleteAll(array(
                        'ProductAttribute.product_id' => $product_id
                    ));
                }
                if (!empty($this->request->data['Product']['is_product_variant_enabled']) && !empty($this->request->data['AttributeGroupProduct']['attribute_group_id'])) {
                    $is_attribute_group_same = $this->Product->product_attribute_group_array($this->request->data['AttributeGroupProduct']['attribute_group_id'], $attribute_group_ids);
                    if (!$is_attribute_group_same) {
                        if (!empty($attribute_group_ids)) {
                            $this->Product->AttributeGroupsProduct->deleteAll(array(
                                'AttributeGroupsProduct.product_id' => $product_id
                            ));
                        }
                        if ($this->ProductAttribute->deleteAll(array(
                            'ProductAttribute.product_id' => $product_id
                        ))) {
                            $data = array();
                            foreach($this->request->data['AttributeGroupProduct']['attribute_group_id'] as $AttributeGroupProduct) {
                                $this->Product->AttributeGroupsProduct->create();
                                $data['product_id'] = $product_id;
                                $data['attribute_group_id'] = $AttributeGroupProduct;
                                $this->Product->AttributeGroupsProduct->save($data);
                                $is_product_variant_added = true;
                            }
                        }
                    }
                }
                $product_upload_file = 0;
                if (!empty($this->request->data['OldAttachment']['id']) && $this->request->data['OldAttachment']['id'] == 1) {
                    $this->Product->Attachment->delete($this->request->data['ProductFile']['id']);
                    $product_upload_file = 1;
                    $this->request->data['Product']['is_having_file_to_download'] = 0;
                } else {
                    if (empty($this->request->data['ProductFile']['id'])) {
                        $product_upload_file = 1;
                    }
                }
                if ($product_upload_file && !empty($this->request->data['ProductFile']['filename']['name'])) {
                    $this->request->data['ProductFile']['class'] = 'ProductFile';
                    $this->request->data['ProductFile']['foreign_id'] = $product_id;
                    $this->Product->Attachment->create();
                    $this->Product->Attachment->save($this->request->data['ProductFile']);
                    $this->Product->Attachment->Behaviors->detach('ImageUpload');
                    $this->request->data['Product']['is_having_file_to_download'] = 1;
                }
                if (!empty($this->request->data['Attachment'])) { // Flash Upload
                    for ($i = 0; $i < count($this->request->data['Attachment']); $i++) {
                        $upload_photo = 0;
                        if (!empty($this->request->data['Attachment'][$i]['checked_id']) && !empty($this->request->data['Attachment'][$i]['id'])) {
                            $this->Product->Attachment->delete($this->request->data['Attachment'][$i]['id']);
                            $upload_photo = 1;
                        }
                        if (!empty($this->request->data['Attachment'][$i]['filename'])) {
                            $attachment = array();
                            $file_id = $this->request->data['Attachment'][$i]['filename'];
                            $this->Product->Attachment->create();
                            $attachment['Attachment']['foreign_id'] = $product_id;
                            $attachment['Attachment']['class'] = 'Product';
                            $attachment['Attachment']['description'] = $this->request->data['Attachment'][$i]['description'];
                            $this->Product->Attachment->Behaviors->attach('ImageUpload');
                            $this->Product->Attachment->enableUpload(false); //don't trigger upload behavior on save
                            $attachment['Attachment']['mimetype'] = $_SESSION['product_file_info'][$file_id]['type'];
                            $attachment['Attachment']['dir'] = 'Product' . DS . $product_id;
                            $upload_path = APP . DS . 'media' . DS . 'Product' . DS . $product_id;
                            new Folder($upload_path, true);
                            $file_name = $_SESSION['product_file_info'][$file_id]['filename'];
                            $attachment['Attachment']['filename'] = $file_name;
                            $fp = fopen($upload_path . DS . $file_name, 'w');
                            fwrite($fp, base64_decode($_SESSION['product_file_info'][$file_id]['original']));
                            fclose($fp);
                            $this->Product->Attachment->create();
                            $this->Product->Attachment->save($attachment);
                            $this->Product->Attachment->Behaviors->detach('ImageUpload');
                            unset($_SESSION['product_file_info'][$file_id]);
                        } elseif (empty($this->request->data['Attachment'][$i]['checked_id']) && !empty($this->request->data['Attachment'][$i]['id'])) {
                            $_attachment['Attachment']['foreign_id'] = $product_id;
                            $_attachment['Attachment']['id'] = $this->request->data['Attachment'][$i]['id'];
                            $_attachment['Attachment']['id'] = $this->request->data['Attachment'][$i]['id'];
                            $_attachment['Attachment']['description'] = $this->request->data['Attachment'][$i]['description'];
                            $_attachment['Attachment']['class'] = 'Product';
                            $this->Product->Attachment->save($_attachment);
                        }
                    }
                }
                if (!empty($this->request->data['Product']['is_requires_shipping'])) {
                    foreach($this->request->data['ProductShipmentCost'] as $productShipmentCost) {
                        $shipment_cost = array();
                        if (!empty($productShipmentCost['grouped_country_id'])) {
                            $shipment_cost['ProductShipmentCost'] = $productShipmentCost;
                            $shipment_cost['ProductShipmentCost']['product_id'] = $this->Product->id;
                            $this->Product->ProductShipmentCost->create();
                            $this->Product->ProductShipmentCost->save($shipment_cost['ProductShipmentCost'], false);
                        }
                    }
                }
                $this->Session->setFlash(__l('Product has been updated') , 'default', null, 'success');
                if ($is_product_variant_added) {
                    $this->redirect(array(
                        'controller' => 'products',
                        'action' => 'product_variants',
                        'product_id' => $product_id,
                        'admin' => true,
                        'type' => 'edit'
                    ));
                } else {
                    $this->redirect(array(
                        'action' => 'index'
                    ));
                }
            } else {
                // [Credits] validate merge
                if (Configure::read('module.credits')) {
                    $this->Product->validate = array_merge($this->Product->validate, $this->Credit->validate);
                }
                if (!empty($this->request->data['Product']['is_requires_shipping']) && empty($is_shipping_given)) {
                    $this->Session->setFlash(__l('Please enter shipping details.') , 'default', null, 'error');
                } else if(!$uploaded_photo_count) {
					 $this->Session->setFlash(__l('Please upload product photos.') , 'default', null, 'error');
				} else if($downloaded_file_delete_notuploaded) {
					 $this->Session->setFlash(__l('Download file should not be empty. Please, try again.') , 'default', null, 'error');
				} else{
                    $this->Session->setFlash(__l('Product could not be updated. Please, try again.') , 'default', null, 'error');
                }				
            }
        } else {
            $this->request->data = $this->Product->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $product_order = $this->Product->OrderItem->find('count', array(
            'conditions' => array(
                'OrderItem.product_id' => $id
            )
        ));
        $this->set('product_order', $product_order);
        if (!empty($this->request->data['Product']['maximum_quantity_to_buy_as_own']) && !$this->request->data['Product']['maximum_quantity_to_buy_as_own']) {
            $this->request->data['Product']['maximum_quantity_to_buy_as_own'] = '';
        }
        if (!empty($this->request->data['Product']['maximum_quantity_to_buy_as_gift']) && !$this->request->data['Product']['maximum_quantity_to_buy_as_gift']) {
            $this->request->data['Product']['maximum_quantity_to_buy_as_gift'] = '';
        }
        $productStatuses = $this->Product->ProductStatus->find('list');
        $countries = $this->Product->User->UserProfile->Country->find('list');
        $shipment_costs = $this->Product->shipmentCostsOptions;
        $this->set('shipment_costs', $shipment_costs);
        // countries and region settings
        $groupCountries = $this->Product->ProductShipmentCost->GroupedCountry->find('list', array(
            'conditions' => array(
                'GroupedCountry.related_class IS NULL'
            ) ,
            'recursive' => -1
        ));
        $groupUnionCountries = $this->Product->ProductShipmentCost->GroupedCountry->find('list', array(
            'conditions' => array(
                'GroupedCountry.related_class' => 'Union'
            ) ,
            'recursive' => -1
        ));
        $groupContinentCountries = $this->Product->ProductShipmentCost->GroupedCountry->find('list', array(
            'conditions' => array(
                'GroupedCountry.related_class' => 'Continent'
            ) ,
            'recursive' => -1
        ));
        $groupWorldwideCountries = $this->Product->ProductShipmentCost->GroupedCountry->find('list', array(
            'conditions' => array(
                'GroupedCountry.related_class' => 'Worldwide'
            ) ,
            'recursive' => -1
        ));
        $CategoryId = $this->Product->Category->find('first', array(
            'conditions' => array(
                'Category.id' => $this->request->data['Product']['category_id'],
            ) ,
            'recursive' => -1,
        ));
        $categories = $this->Product->Category->find('list', array(
            'conditions' => array(
                'Category.parent_id' => $CategoryId['Category']['parent_id'],
            ) ,
            'recursive' => -1,
        ));
        $this->set('categories', $categories);
        $secondCategoryId = $this->Product->Category->find('first', array(
            'conditions' => array(
                'Category.id' => $CategoryId['Category']['parent_id'],
            ) ,
            'recursive' => -1,
        ));
        $secondCategories = $this->Product->Category->find('list', array(
            'conditions' => array(
                'Category.parent_id' => $secondCategoryId['Category']['parent_id'],
            ) ,
            'recursive' => -1,
        ));
        $this->request->data['Product']['second_category_id'] = $secondCategoryId['Category']['id'];
        $this->set('secondCategories', $secondCategories);
        $firstCategoryId = $this->Product->Category->find('first', array(
            'conditions' => array(
                'Category.id' => $secondCategoryId['Category']['parent_id'],
            ) ,
            'recursive' => -1,
        ));
        $firstCategories = $this->Product->Category->find('list', array(
            'conditions' => array(
                'Category.parent_id' => 0,
            ) ,
            'recursive' => -1,
        ));
        $this->request->data['Product']['first_category_id'] = $firstCategoryId['Category']['id'];
        $this->set('firstCategories', $firstCategories);
        $shipCountries['Regions'] = $groupWorldwideCountries;
        $shipCountries['--------------------'] = $groupUnionCountries;
        $shipCountries['---------------------'] = $groupContinentCountries;
        $shipCountries['Individual countries'] = $groupCountries;
        $this->set('shipCountries', $shipCountries);
        $this->set(compact('productStatuses', 'countries'));
        $this->loadModel('AttributeGroup');
        $attributeGroups = $this->AttributeGroup->find('list');
        if (!empty($attribute_group_ids)) {
            $this->request->data['AttributeGroupProduct']['attribute_group_id'] = $attribute_group_ids;
        }
        $this->set('attributeGroups', $attributeGroups);
    }
    public function delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->Product->delete($id)) {
            $this->Session->setFlash(__l('Product deleted') , 'default', null, 'success');
            $this->redirect(array(
                'controller' => 'products',
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
    public function admin_index()
    {
        $conditions = array();
        $this->_redirectPOST2Named(array(
            'filter_id',
            'q',
            'product_status_id'
        ));
        $this->pageTitle = __l('Products');
        $productStatuses = $this->Product->ProductStatus->find('list');
        // [seller] product status
        if (!Configure::read('module.seller')) {
            unset($productStatuses[6], $productStatuses[7], $productStatuses[8]);
        }
        if (!empty($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'day') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(Product.created) <= '] = 0;
            $this->pageTitle.= __l(' - today');
        }
        if (!empty($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'week') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(Product.created) <= '] = 7;
            $this->pageTitle.= __l(' - in this week');
        }
        if (!empty($this->request->params['named']['stat']) && $this->request->params['named']['stat'] == 'month') {
            $conditions['TO_DAYS(NOW()) - TO_DAYS(Product.created) <= '] = 30;
            $this->pageTitle.= __l(' - in this month');
        }
        if (!empty($this->request->params['named']['product_status_id'])) {
            $this->request->data['Product']['product_status_id'] = $this->request->params['named']['product_status_id'];
            $conditions['Product.product_status_id'] = $this->request->params['named']['product_status_id'];
            $productStatus = $this->Product->ProductStatus->find('first', array(
                'conditions' => array(
                    'ProductStatus.id' => $this->request->params['named']['product_status_id']
                ) ,
                'fields' => array(
                    'ProductStatus.name',
                ) ,
                'recursive' => -1
            ));
            $this->pageTitle.= __l(' - Product Status - ') . $productStatus['ProductStatus']['name'];
        }
        if (!empty($this->request->params['named']['username']) || !empty($this->request->params['named']['user_id'])) {
            $userConditions = !empty($this->request->params['named']['username']) ? array(
                'User.username' => $this->request->params['named']['username']
            ) : array(
                'User.id' => $this->request->params['named']['user_id']
            );
            $user = $this->{$this->modelClass}->User->find('first', array(
                'conditions' => $userConditions,
                'fields' => array(
                    'User.id',
                    'User.username'
                ) ,
                'recursive' => -1
            ));
            if (empty($user)) {
                throw new NotFoundException(__l('Invalid request'));
            }
            $conditions['User.id'] = $this->request->data[$this->modelClass]['user_id'] = $user['User']['id'];
            $this->pageTitle.= ' - ' . $user['User']['username'];
        }
        if (!empty($this->request->params['named']['filter_id'])) {
            $this->request->data['Product']['filter_id'] = $this->request->params['named']['filter_id'];
        }
        if (!empty($this->request->data['Product']['filter_id'])) {
            if ($this->request->data['Product']['filter_id'] == ConstMoreAction::Active) {
                $conditions['Product.is_active'] = 1;
                $conditions['Product.admin_suspend'] = 0;
                $this->pageTitle.= __l(' - Active ');
            } else if ($this->request->data['Product']['filter_id'] == ConstMoreAction::Inactive) {
                $conditions['Product.is_active'] = 0;
                $this->pageTitle.= __l(' - Inactive');
            } else if ($this->request->data['Product']['filter_id'] == ConstProductTypeFilter::Shipping) {
                $conditions['Product.is_requires_shipping'] = 1;
                $this->pageTitle.= __l(' - Shipping');
            } else if ($this->request->data['Product']['filter_id'] == ConstProductTypeFilter::Downloadable) {
                $conditions['Product.is_having_file_to_download'] = 1;
                $this->pageTitle.= __l(' - Downloadable');
            }
        }
        if (!empty($this->request->params['named']['status_filter_id'])) {
            if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Draft) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Draft;
                $this->pageTitle.= __l(' - Draft ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Upcoming) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Upcoming;
                $this->pageTitle.= __l(' - Upcoming ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Open) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Open;
                $this->pageTitle.= __l(' - Open ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Closed) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Closed;
                $this->pageTitle.= __l(' - Closed ');
            } else if ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Canceled) {
                $conditions['Product.product_status_id'] = ConstProductStatus::Canceled;
                $this->pageTitle.= __l(' - Canceled ');
            }
            $this->request->data['Product']['status_filter_id'] = $this->request->params['named']['status_filter_id'];
        }
        if (!empty($this->request->params['named']['q'])) {
            $this->request->data['Product']['q'] = $this->request->params['named']['q'];
            $this->pageTitle.= sprintf(__l(' - Search - %s') , $this->request->params['named']['q']);
        }
        foreach($productStatuses as $product_status_id => $product_status_name) {
            $this->set('product_status_' . $product_status_id, $this->Product->find('count', array(
                'conditions' => array(
                    'Product.product_status_id' => $product_status_id,
                    $conditions
                ) ,
                'recursive' => -1
            )));
        }
        $this->Product->recursive = 1;
        $this->paginate = array(
            'conditions' => array(
                $conditions
            ) ,
            'contain' => array(
                'User' => array(
                    'fields' => array(
                        'User.id',
                        'User.attachment_id',
                        'User.username',
                        'User.is_active'
                    )
                ) ,
                'ProductStatus',
                'Attachment',
                'Message',
                'Ip' => array(
                    'City',
                    'Country',
                    'State'
                ) ,
            ) ,
            'order' => array(
                'Product.id' => 'desc'
            )
        );
        if (!empty($this->request->data['Product']['q'])) {
            $this->paginate = array_merge($this->paginate, array(
                'search' => $this->request->data['Product']['q']
            ));
        }
		unset($conditions['Product.product_status_id']);
		$this->set('active_product_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.is_active' => 1,
                'Product.admin_suspend' => 0,
            ) ,
            'recursive' => -1
        )));
        $this->set('inactive_product_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.is_active' => 0,
            ) ,
            'recursive' => -1
        )));
        $this->set('shipping_product_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.is_requires_shipping' => 1,
            ) ,
            'recursive' => -1
        )));
        $this->set('downloadable_product_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.is_having_file_to_download' => 1,
            ) ,
            'recursive' => -1
        )));
        $this->set('draft_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Draft,
    			 $conditions,
            ) ,
            'recursive' => -1
        )));
        $this->set('upcoming_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Upcoming,
    			 $conditions,
            ) ,
            'recursive' => -1
        )));
        $this->set('open_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Open,
			 $conditions,
            ) ,
            'recursive' => -1
        )));
        $this->set('closed_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Closed,
			 $conditions,
            ) ,
            'recursive' => -1
        )));
        $this->set('canceled_count', $this->Product->find('count', array(
            'conditions' => array(
                'Product.product_status_id' => ConstProductStatus::Canceled,
			 $conditions,
            ) ,
            'recursive' => -1
        )));
        $this->set('products', $this->paginate());
        // [seller] More action merge
        if (Configure::read('module.seller')) {
            $this->loadModel('Seller');
            $this->Product->moreActions = $this->Product->moreActions;
        }
        $moreActions = $this->Product->moreActions;
        if (isset($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id'] == ConstProductStatus::Upcoming) {
            $moreActions = array(
                ConstMoreAction::Open => __l('Open') ,
				ConstMoreAction::Delete => __l('Delete'),
            );			
        }
		if (isset($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id'] == ConstProductStatus::Draft){
			$moreActions = array(
                ConstMoreAction::Upcoming => __l('Upcoming') ,
				ConstMoreAction::Delete => __l('Delete'),
            );				
		}
		if (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id'] == ConstProductStatus::Canceled || $this->request->params['named']['status_filter_id'] == ConstProductStatus::Closed)) {
			unset($moreActions[ConstMoreAction::Canceled]);
		}
        $users = $this->Product->User->find('list');
        $this->set(compact('moreActions', 'productStatuses', 'users'));
    }
    public function admin_add()
    {
        $this->setAction('add');
    }
    public function admin_edit($id = null)
    {
        $this->setAction('edit', $id);
    }
    public function admin_buyers($id = null)
    {
        $this->setAction('buyers', $id);
    }
    public function admin_delete($id = null)
    {
        $this->setAction('delete', $id);
    }
    public function flashupload()
    {
        $this->Product->Attachment->Behaviors->attach('ImageUpload', Configure::read('product.file'));
        $this->XAjax->previewImage();
    }
    public function thumbnail()
    {
        $file_id = $this->request->params['pass'][1]; // show preview uploaded product image, session unique id
        $this->XAjax->thumbnail($file_id);
    }
    public function sample_data()
    {
        set_time_limit(0);
        Configure::write('debug', 1);
        $description = array(
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.',
            'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'
        );
        $video_url = array(
            '',
        );
        $img_dir = APP . 'media' . DS . 'images';
        $handle = opendir($img_dir);
        while (false !== ($readdir = readdir($handle))) {
            if ($readdir != '.' && $readdir != '..' && $readdir != 'Thumbs.db') {
                $image_path_arr[] = $readdir;
            }
        }
        $image = 0;
        for ($p = 1; $p <= 44; $p++) {
            $_data['Product']['user_id'] = 1;
            if (in_array($p, array(
                11,
                19,
                26
            ))) {
                $_data['Product']['product_status_id'] = ConstProductStatus::Draft;
            } elseif (in_array($p, array(
                13,
                17,
                23
            ))) {
                $_data['Product']['product_status_id'] = ConstProductStatus::Canceled;
            } elseif (in_array($p, array(
                3,
                7,
                15
            ))) {
                $_data['Product']['product_status_id'] = ConstProductStatus::Upcoming;
            } else {
                $_data['Product']['product_status_id'] = ConstProductStatus::Open;
            }
            $title = explode('.', $image_path_arr[$image]);
            $_data['Product']['title'] = $title[0];
            $_data['Product']['description'] = $description[mt_rand(0, 2) ];
            $price_arr = array(
                10,
                20,
                30,
                40,
                50,
                60,
                70,
                80,
                90,
                100,
                200,
                300,
                400,
                500,
                150,
                250,
                350,
                450
            );
            $_data['Product']['original_price'] = $price_arr[mt_rand(0, 17) ];
            $discount_arr = array(
                5,
                10,
                15,
                20,
                25,
                30,
                35,
                40,
                45
            );
            if ($p%4 == 0) {
                $_data['Product']['discount_percentage'] = $discount_arr[mt_rand(0, 8) ];
                $_data['Product']['discount_amount'] = $_data['Product']['discount_percentage']/100;
                $_data['Product']['savings'] = $_data['Product']['discount_amount']*$_data['Product']['original_price'];
                $_data['Product']['discounted_price'] = $_data['Product']['original_price']-$_data['Product']['savings'];
            } else {
                $_data['Product']['discount_percentage'] = $_data['Product']['discount_amount'] = $_data['Product']['savings'] = $_data['Product']['discounted_price'] = 0;
            }
            $_data['Product']['quantity'] = mt_rand(10, 20);
            $start_date_arr = array(
                '2011-09-01 00:00:00',
                '2011-10-11 00:00:00',
                '2011-09-11 00:00:00',
                '2012-01-21 00:00:00',
                '2012-04-21 00:00:00',
            );
            if ($_data['Product']['product_status_id'] == ConstProductStatus::Draft) {
                $_data['Product']['start_date'] = $start_date_arr[mt_rand(3, 4) ];
            } elseif ($_data['Product']['product_status_id'] == ConstProductStatus::Canceled) {
                $_data['Product']['start_date'] = $start_date_arr[mt_rand(0, 4) ];
            } elseif ($_data['Product']['product_status_id'] == ConstProductStatus::Upcoming) {
                $_data['Product']['start_date'] = $start_date_arr[mt_rand(3, 4) ];
            } elseif ($_data['Product']['product_status_id'] == ConstProductStatus::Open) {
                $_data['Product']['start_date'] = $start_date_arr[mt_rand(0, 2) ];
            }
            $end_date_arr = array(
                '2012-09-01 00:00:00',
                '2012-10-11 00:00:00',
                '2012-11-21 00:00:00',
                '2012-12-31 00:00:00',
            );
            $_data['Product']['end_date'] = $end_date_arr[mt_rand(0, 3) ];
            $_data['Product']['is_requires_shipping'] = mt_rand(0, 1);
            //$_data['Product']['video_url'] = $video_url[mt_rand(0, 4) ];
            $_data['Product']['is_active'] = 1;
            //$_data['Product']['meta_keywords'] = 2;
            //$_data['Product']['meta_description'] = 2;
            $_data['Product']['ip_id'] = 1;
            $_data['Product']['id'] = '';
            $this->Product->create();
            if ($this->Product->save($_data, false)) {
                $product_id = $this->Product->getLastInsertId();
                for ($i = 0; $i < 1; $i++) {
                    $img_url = $img_dir . DS . $image_path_arr[$image];
                    $image_size = getimagesize($img_url);
                    $filename = basename($image_path_arr[$image]);
                    $_attachment_data['Attachment']['filename']['type'] = $image_size['mime'];
                    $_attachment_data['Attachment']['filename']['name'] = $filename;
                    $_attachment_data['Attachment']['filename']['tmp_name'] = $img_url;
                    $_attachment_data['Attachment']['filename']['size'] = filesize($img_url);
                    $_attachment_data['Attachment']['filename']['error'] = 0;
                    $this->Product->Attachment->Behaviors->attach('ImageUpload', Configure::read('product.file'));
                    $this->Product->Attachment->isCopyUpload(true);
                    $this->Product->Attachment->set($_attachment_data);
                    $this->Product->Attachment->create();
                    $_attachment_data['Attachment']['filename'] = $_attachment_data['Attachment']['filename'];
                    $_attachment_data['Attachment']['class'] = 'Product';
                    $_attachment_data['Attachment']['description'] = str_replace('.jpeg', '', str_replace('.jpg', '', $filename));
                    $_attachment_data['Attachment']['width'] = $image_size[0];
                    $_attachment_data['Attachment']['height'] = $image_size[1];
                    $_attachment_data['Attachment']['foreign_id'] = $product_id;
                    $this->Product->Attachment->data = $_attachment_data['Attachment'];
                    $this->Product->Attachment->save($_attachment_data);
                    $this->Product->Attachment->Behaviors->detach('ImageUpload');
                    if ($image == 45) {
                        $image = 0;
                    } else {
                        $image++;
                    }
                    $_attachment_data = array();
                }
                if (!empty($_data['Product']['is_requires_shipping'])) {
                    for ($i = 0; $i < 3; $i++) {
                        $_product_shipment_data = array();
                        $_product_shipment_data['ProductShipmentCost']['product_id'] = $product_id;
                        $grouped_country_id_arr = array(
                            '0',
                            '-1',
                            '-2',
                            '-3',
                            '-4',
                            '-5',
                            '-6',
                            '-7',
                            '-8',
                        );
                        $grouped_country_id = $grouped_country_id_arr[mt_rand(0, 8) ];
                        if (empty($grouped_country_id)) {
                            $grouped_country_id = mt_rand(1, 275);
                        }
                        $_product_shipment_data['ProductShipmentCost']['grouped_country_id'] = $grouped_country_id;
                        $shipment_cost_arr = array(
                            '15',
                            '19',
                            '22',
                            '24',
                            '13',
                            '11',
                            '17',
                            '21',
                            '9',
                            '7',
                        );
                        $_product_shipment_data['ProductShipmentCost']['shipment_cost'] = $shipment_cost_arr[mt_rand(0, 9) ];
                        $additional_shipment_cost_arr = array(
                            '0.50',
                            '1.50',
                            '2.50',
                            '3.50',
                            '4.50',
                            '5.50',
                            '6.50',
                            '7.50',
                            '8.50',
                            '9.50',
                        );
                        $_product_shipment_data['ProductShipmentCost']['additional_quantity_shipment_cost'] = $additional_shipment_cost_arr[mt_rand(0, 9) ];
                        $this->Product->ProductShipmentCost->create();
                        $this->Product->ProductShipmentCost->save($_product_shipment_data['ProductShipmentCost'], false);
                    }
                }
            } else {
                pr($this->Product->validationErrors);
                exit;
            }
            $_data = array();
        }
        exit;
    }   
    function download($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $order_item = $this->Product->OrderItem->find('first', array(
            'conditions' => array(
                'OrderItem.id' => $id
            ) ,
            'contain' => array(
                'User',
                'Product' => array(
                    'fields' => array(
                        'Product.id',
                        'Product.is_having_file_to_download',
                        'Product.slug',
                        'Product.title'
                    ) ,
                    'ProductFile' => array(
                        'fields' => array(
                            'ProductFile.id',
                            'ProductFile.filename',
                            'ProductFile.dir',
                            'ProductFile.width',
                            'ProductFile.height',
							'ProductFile.foreign_id'
                        )
                    ) ,
                ) ,
            ) ,
            'recursive' => 2
        ));
        if (empty($order_item)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        $this->pageTitle = __l('Product file download');
        if (!empty($this->request->data)) {
            if ($order_item['OrderItem']['is_send_as_gift']) {
                $sender_mail = $order_item['OrderItem']['gift_friend_email'];
            } else {
                $sender_mail = $order_item['User']['email'];
            }
            if ($this->request->data['OrderItem']['sender_email'] != $sender_mail) {
                $this->set('error', 1);
            } else {
                $order_array['OrderItem']['id'] = $order_item['OrderItem']['id'];
                $order_array['OrderItem']['is_downloaded'] = 0;
                $this->Product->OrderItem->save($order_array, false);
                if ($order_item['OrderItem']['is_send_as_gift']) {
                    $this->Product->OrderItem->Order->sendDownloadAlert($order_item['OrderItem'], $order_item['OrderItem']['user_id'], $order_item['OrderItem']['gift_friend_email']);
                }
                $this->set('success', 1);
            }
        } elseif (!empty($order_item['Product']['is_having_file_to_download']) && (!$order_item['OrderItem']['is_downloaded'] || $this->Auth->user('user_type_id') == ConstUserTypes::Admin) ) {
            $this->request->data = $order_item;
            $this->request->data['Product']['sender_email'] = '';
            $orderItem['OrderItem']['id'] = $order_item['OrderItem']['id'];
            $orderItem['OrderItem']['is_downloaded'] = 1;
            $orderItem['OrderItem']['product_download_count'] = $order_item['OrderItem']['product_download_count']+1;
            $this->Product->OrderItem->save($orderItem, false);
            $data = array();
            $data['ProductDownload']['user_id'] = $this->Auth->user('id');
            $data['ProductDownload']['product_id'] = $order_item['Product']['id'];
            $data['ProductDownload']['ip_id'] = $this->Product->toSaveIp();
            $this->Product->ProductDownload->save($data, false);
            $file_path = str_replace('\\', '/', 'media' . DS . 'Product' . DS . $order_item['Product']['id'] . DS . $order_item['Product']['ProductFile']['filename']);
            $file_extension = explode('.', $order_item['Product']['ProductFile']['filename']);
            // Code to download
            Configure::write('debug', 0);			
            header('Content-type: ' . $order_item['Product']['ProductFile']['mimetype']);
            header('Content-length: ' . $order_item['Product']['ProductFile']['filesize']);
            header('Content-Disposition: attachment; filename="' . $order_item['Product']['ProductFile']['filename'] . '"');
            echo $contents = file_get_contents('..'. DS .'media' . DS . 'ProductFile' . DS  . $order_item['Product']['ProductFile']['foreign_id'] . DS . $order_item['Product']['ProductFile']['filename']);
            $this->autoRender = false;
        } else {
            if (empty($order_item['Product']['is_having_file_to_download'])) {
                $this->Session->setFlash(__l('download failure. Please try once again.') , 'default', null, 'error');
            }
        }
    }
    // Posting Product on Facebook
    function postOnFacebook($product = null, $message = null, $admin = null)
    {
        if (!empty($product)) {
            $slug = $product['Product']['slug'];
            $image_options = array(
                'dimension' => 'normal_thumb',
                'class' => '',
                'alt' => $product['Product']['title'],
                'title' => $product['Product']['title'],
                'type' => 'jpg'
            );
            if ($admin) {
                $facebook_dest_user_id = Configure::read('facebook.page_id'); // Site Page ID
                $facebook_dest_access_token = Configure::read('facebook.fb_access_token');
            } else {
                $facebook_dest_user_id = $this->Auth->user('fb_user_id');
                $facebook_dest_access_token = $this->Auth->user('fb_access_token');
            }
            App::import('Vendor', 'facebook/facebook');
            $this->facebook = new Facebook(array(
                'appId' => Configure::read('facebook.api_key') ,
                'secret' => Configure::read('facebook.secrect_key') ,
                'cookie' => true
            ));
            if (empty($message)) {
                $message = $product['Product']['title'];
            }
            $product['Attachment']['0'] = !empty($product['Attachment']['0']) ? $product['Attachment']['0'] : array();
            $image_url = Router::url('/', true) . getImageUrl('Product', $product['Attachment']['0'], $image_options);
            $image_link = Router::url(array(
                'controller' => 'products',
                'action' => 'view',
                'admin' => false,
                $slug
            ) , true);
            try {
                $getPostCheck = $this->facebook->api('/' . $facebook_dest_user_id . '/feed', 'POST', array(
                    'access_token' => $facebook_dest_access_token,
                    'message' => $message,
                    'picture' => $image_url,
                    'icon' => $image_url,
                    'link' => $image_link,
                    'description' => $product['Product']['description']
                ));
            }
            catch(Exception $e) {
                $this->log('Post on facebook error');
                return 2;
            }
        }
    }
}

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
App::import('Core', 'Helper');
/**
 * This is a placeholder class.
 * Create the same file in app/app_helper.php
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake
 */
class AppHelper extends Helper
{
	function getUserAvatar($user_id)
    {
        App::import('Model', 'User');
        $modelObj = new User();
        $user = $modelObj->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
            ) ,
            'fields' => array(
                'UserAvatar.id',
                'UserAvatar.dir',
                'UserAvatar.filename'
            ) ,
            'recursive' => 0
        ));
        return $user['UserAvatar'];
    }
    function getLanguage()
    {
        App::import('Model', 'Translation');
        $modelObj = new Translation();
        $languages = $modelObj->find('all', array(
            'fields' => array(
                'DISTINCT(Translation.language_id)',
                'Language.name',
                'Language.iso2'
            )
        ));
        $languageList = array();
        if (!empty($languages)) {
            foreach($languages as $language) {
                $languageList[$language['Language']['iso2']] = $language['Language']['name'];
            }
        }
        return $languageList;
    }
    function filterSuspiciousWords($replace = null, $filtered_words = null)
    {
        if (!empty($filtered_words)) {
            $bad_words = unserialize($filtered_words);
            foreach($bad_words as $bad_word) {
                $replace = str_replace($bad_word, "<span class='filtered'>" . $bad_word . "</span>", $replace);
            }
        }
        return $replace;
    }
    function getUserAvatarLink($user_details, $dimension = 'medium_thumb', $is_link = true)
    {
        App::import('Model', 'Setting');
        $this->Setting = new Setting();
        if ($user_details['user_type_id'] == ConstUserTypes::Admin || $user_details['user_type_id'] == ConstUserTypes::User) {
            $user_image = '';
            if (isset($user_details['fb_user_id']) && !empty($user_details['fb_user_id']) && empty($user_details['UserAvatar']['id'])) {
                $width = $this->Setting->find('first', array(
                    'conditions' => array(
                        'Setting.name' => 'thumb_size.' . $dimension . '.width'
                    ) ,
                    'recursive' => -1
                ));
                $height = $this->Setting->find('first', array(
                    'conditions' => array(
                        'Setting.name' => 'thumb_size.' . $dimension . '.height'
                    ) ,
                    'recursive' => -1
                ));
                $user_image = $this->getFacebookAvatar($user_details['fb_user_id'], $height['Setting']['value'], $width['Setting']['value']);
            } else {
                //get user image
                $user_image = $this->showImage('UserAvatar', (!empty($user_details['UserAvatar'])) ? $user_details['UserAvatar'] : '', array(
                    'dimension' => $dimension,
                    'alt' => sprintf('[Image: %s]', $user_details['username']) ,
                    'title' => $user_details['username']
                ));
            }
            //return image to user
            return (!$is_link) ? $user_image : $this->link($user_image, array(
                'controller' => 'users',
                'action' => 'view',
                $user_details['username'],
                'admin' => false
            ) , array(
                'title' => $this->cText($user_details['username'], false) ,
                'escape' => false
            ));
        }
    }
    function getUserLink($user_details)
    {
		return $this->link($this->cText($user_details['username'], false) , array(
			'controller' => 'users',
			'action' => 'view',
			$user_details['username'],
			'admin' => false
		) , array(
			'title' => $this->cText($user_details['username'], false) ,
			'escape' => false
		));
        
    }	 
	function siteCurrencyFormat($amount, $append_ccurency = false)
    {       
        $currency = Configure::read('site.currency');       
        if (Configure::read('site.currency_symbol_place') == 'left') {
            if (!empty($append_ccurency)) {
                return $currency . $this->cCurrency($amount);
            }
            return $currency . $amount;
        } else {
            if (!empty($append_ccurency)) {
                return $this->cCurrency($amount) . $currency;
            }
            return $amount . $currency;
        }
    }
    function transactionDescription($transaction, $exparam = '')
    {
		$user_link = $product = '';
        if ($transaction['Transaction']['class'] == 'SecondUser') {
            if ($exparam == 'csv') {
                $user_link = $transaction['SecondUser']['username'];
            } else {
				if($transaction['Transaction']['transaction_type_id'] == ConstTransactionTypes::ReferralAmount){
					$user_link = $this->getUserLink($transaction['User']);
				}
				else{
                $user_link = $this->getUserLink($transaction['SecondUser']);
				}
            }
            $description = (!empty($transaction['Transaction']['description']) ? ' - ' . $transaction['Transaction']['description'] : '');
        }
		if ($transaction['Transaction']['class'] == 'User') {
            if ($exparam == 'csv') {
                $user_link = $transaction['User']['username'];
            } else {
                $user_link = $this->getUserLink($transaction['SecondUser']);
            }
        }
		$order_no = !empty($transaction['Order']['id']) ? $transaction['Order']['id'] : '';
		$amount = !empty($transaction['Transaction']['amount']) ? $this->Html->siteCurrencyFormat($transaction['Transaction']['amount']) :  '0';
		if ($transaction['Transaction']['class'] == 'Product' || !empty($transaction['Product'])) {
            if ($exparam == 'csv') {
                $product = $transaction['Product']['name'];
            } else {
                $product = $this->link($this->cText($transaction['Product']['title']) , array(
                    'controller' => 'products',
                    'action' => 'view',
                    $transaction['Product']['slug'],
                    'admin' => false
                ) , array(
                    'title' => $this->cText($transaction['Product']['title'], false) ,
                    'escape' => false
                ));
            }
        }
        if (empty($description)) {
            $description = '';
        }
		$transactionReplace = array(
            '##DESCRIPTION##' => $description,
            '##USER##' => $user_link,
            '##PRODUCT##' => $product,
            '##ORDER_NO##' => $order_no,
			'##AMOUNT##' => $amount
        );		
		return strtr($transaction['TransactionType']['message'], $transactionReplace);
	}
	function isWalletEnabled($field = null)
    {
        App::import('Model', 'PaymentGateway');
        $this->PaymentGateway = new PaymentGateway();
        $paymentGateway = $this->PaymentGateway->find('count', array(
            'conditions' => array(
                'PaymentGateway.id' => ConstPaymentGateways::Wallet,
                'PaymentGateway.is_active' => 1,
            ) ,
            'recursive' => -1
        ));
        if ($paymentGateway) {
            return true;
        }
        return false;
    }
	function getFacebookAvatar($fbuser_id, $height = 35, $width = 35)
    {
        return $this->image("http://graph.facebook.com/{$fbuser_id}/picture", array(
            'height' => $height,
            'width' => $width
        ));
    }
	function getUserUnReadMessages($user_id = null)
	{
		App::import('Model', 'Message');
		$this->Message = new Message();
		$unread_count = $this->Message->find('count', array(
			'conditions' => array(
				'Message.is_read' => '0',
				'Message.user_id' => $user_id,
				'Message.is_sender' => '0',
				'Message.message_folder_id' => ConstMessageFolder::Inbox,
				'MessageContent.is_system_flagged' => 0
			) ,
			'recursive' => 1
		));
		return $unread_count;
	}
	function getUserCartCount($user_id = null)
	{
		App::import('Model', 'Cart');
		$this->Cart = new Cart();
		$conditions = array();
		if (!empty($user_id)) {
			$conditions['Cart.user_id'] = $user_id;
		} else {
			$conditions['Cart.session_id']=session_id();
		}
		$cart_count = $this->Cart->find('count', array(
			'conditions' => $conditions,
			'recursive' => -1
		));
		return $cart_count;
	}
	function getColspan($is_multiple_addresses = null, $is_shipping_allowed_arr = null)
	{
		$colspan = 0;
		if (!empty($is_multiple_addresses)):
			$colspan++;
		endif;
		if (!empty($is_shipping_allowed_arr)):
			$colspan++;
		endif;
		if (Configure::read('module.buy_as_gift')):
			$colspan++;
		endif;
		return $colspan;
	}
    function getImageUrl($model, $attachment, $options, $path = 'absolute') 
    {
        $default_options = array(
            'dimension' => 'original',
            'class' => '',
            'alt' => 'alt',
            'title' => 'title',
            'type' => 'jpg'
        );
        $options = array_merge($default_options, $options);
        $image_hash = $options['dimension'] . '/' . $model . '/' . $attachment['id'] . '.' . md5(Configure::read('Security.salt') . $model . $attachment['id'] . $options['type'] . $options['dimension'] . Configure::read('site.name')) . '.' . $options['type'];
        if ($path == 'absolute') return Cache::read('site_url_for_shell', 'long') . 'img/' . $image_hash;
        else return 'img/' . $image_hash;
    }

    function isParent($parentId)
	{
		 App::import('Model', 'Category');
		 $categoryObj = new Category();
		 $category = $categoryObj->find('count', array(
            'conditions' => array(
                'Category.parent_id' => $parentId,
            ) ,
            'recursive' => -1,
        ));
		return $category != 0 ? true : false ;
	}
	function getAttributeGroupDetails($attribute_id)
    {
        App::import('Model', 'Attribute');
        $Attribute = new Attribute();
        $attribute = $Attribute->find('first', array(
            'conditions' => array(
                'Attribute.id' => $attribute_id,
            ) ,
			'contain' => array (
				'AttributeGroup'
			),
            'fields' => array(
                'Attribute.id',
				'Attribute.name',
				'AttributeGroup.display_name',
            ) ,
            'recursive' => 0
        ));
        return $attribute;
    }
	function getProductAttributeDetails($product_id)
    {
        App::import('Model', 'ProductAttribute');
        $ProductAttribute = new ProductAttribute();		
		$product_attribute = $ProductAttribute->find('all', array(
            'conditions' => array(
                'ProductAttribute.product_id' => $product_id
            ) ,
			'contain' => array(
				'AttributesProductAttribute'
			),			
            'recursive' => 1
        ));
        return $product_attribute;
    }

}
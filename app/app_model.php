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
class AppModel extends Model
{
    public $actsAs = array(
        'Containable',
    );
    function beforeSave()
    {
        $this->useDbConfig = 'master';
        return true;
    }
    function afterSave()
    {
        $this->useDbConfig = 'default';
        return true;
    }
    function beforeDelete()
    {
        $this->useDbConfig = 'master';
        return true;
    }
    function afterDelete()
    {
        $this->useDbConfig = 'default';
        return true;
    }

    function findOrSaveAndGetId($data)
    {
        $findExist = $this->find('first', array(
            'conditions' => array(
                'name' => $data
            ) ,
            'fields' => array(
                'id'
            ) ,
            'recursive' => -1
        ));
        if (!empty($findExist)) {
            return $findExist[$this->name]['id'];
        } else {
            $this->data[$this->name]['name'] = $data;
            $this->save($this->data[$this->name]);
            return $this->id;
        }
    }
    function _isValidCaptcha()
    {
        include_once VENDORS . DS . 'securimage' . DS . 'securimage.php';
        $img = new Securimage();
        return $img->check($this->data[$this->name]['captcha']);
    }
	function getGatewayTypes($field = null) 
    {
        App::import('Model', 'PaymentGateway');
        $this->PaymentGateway = new PaymentGateway();
        $paymentGateways = $this->PaymentGateway->find('all', array(
            'conditions' => array(
                'PaymentGateway.is_active' => 1
            ) ,
            'contain' => array(
                'PaymentGatewaySetting' => array(
                    'conditions' => array(
                        'PaymentGatewaySetting.key' => $field,
                        'PaymentGatewaySetting.test_mode_value' => 1
                    ) ,
                ) ,
            ) ,
            'order' => array(
                'PaymentGateway.display_name' => 'asc'
            ) ,
            'recursive' => 1
        ));
		$payment_gateway_types = array();
		foreach($paymentGateways as $paymentGateway) {
            if (!empty($paymentGateway['PaymentGatewaySetting'])) {
				$payment_gateway_types[$paymentGateway['PaymentGateway']['id']] = $paymentGateway['PaymentGateway']['display_name'];
            }
        }
        return $payment_gateway_types;
    }
	function getPaymentGatewaySettings($payment_gateway_id = null)
    {
        App::import('Model', 'PaymentGateway');
        $this->PaymentGateway = new PaymentGateway();
        $paymentGateway = $this->PaymentGateway->find('first', array(
			'conditions' => array(
				'PaymentGateway.id' => $payment_gateway_id,
			) ,
			'contain' => array(
				'PaymentGatewaySetting' => array(
					'fields' => array(
						'PaymentGatewaySetting.key',
						'PaymentGatewaySetting.test_mode_value',
						'PaymentGatewaySetting.live_mode_value',
					) ,
				) ,
			) ,
			'recursive' => 1
		));
		$paymentGatewaySettings = array();
		if (!empty($paymentGateway['PaymentGatewaySetting'])) {
			$tmpPaymentGateway['PaymentGatewaySetting'] = $paymentGateway['PaymentGatewaySetting'];
			unset($paymentGateway['PaymentGatewaySetting']);
			foreach($tmpPaymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting) {
				$paymentGateway['PaymentGatewaySetting'][$paymentGatewaySetting['key']] = $paymentGateway['PaymentGateway']['is_test_mode'] ? $paymentGatewaySetting['test_mode_value'] : $paymentGatewaySetting['live_mode_value'];
			}
		}
        return $paymentGateway;
    }
    function _sendAlertOnNewMessage($email, $message, $message_id, $template)
    {
        App::import('Model', 'EmailTemplate');
        $this->EmailTemplate = new EmailTemplate();
        App::import('Model', 'Message');
        $this->Message = new Message();
        App::import('Model', 'MessageContent');
        $this->MessageContent = new MessageContent();
        App::import('Core', 'ComponentCollection');
		$collection = new ComponentCollection();
		App::import('Component', 'Email');
		$this->Email = new EmailComponent($collection);
        $template = $this->EmailTemplate->selectTemplate($template);
        $get_message_hash = $this->Message->find('first', array(
            'conditions' => array(
                'Message.message_content_id = ' => $message_id,
                'Message.is_sender' => 0
            ) ,
            'fields' => array(
                'Message.id',
                'Message.created',
                'Message.user_id',
                'Message.other_user_id',
                'Message.parent_message_id',
                'Message.message_content_id',
                'Message.message_folder_id',
                'Message.is_sender',
                'Message.is_starred',
                'Message.is_read',
                'Message.is_deleted',
                'Message.hash',
            ) ,
            'contain' => array(
                'MessageContent' => array(
                    'fields' => array(
                        'MessageContent.id',
                        'MessageContent.message',
                        'MessageContent.is_system_flagged',
                        'MessageContent.detected_suspicious_words',
                    )
                )
            ) ,
            'recursive' => 2
        ));
        if (!empty($get_message_hash) && empty($get_message_hash['MessageContent']['is_system_flagged'])) {
            $get_user = $this->Message->User->find('first', array(
                'conditions' => array(
                    'User.id' => $get_message_hash['Message']['user_id']
                ) ,
                'recursive' => -1
            ));
            $emailFindReplace = array(
                '##MESSAGE##' => $message['message'],
                '##SITE_NAME##' => Configure::read('site.name') ,
                '##SITE_URL##' => Router::url('/', true) ,
                '##REPLY_LINK##' => Router::url(array(
                    'controller' => 'messages',
                    'action' => 'compose',
                    'admin' => false,
                    $get_message_hash['Message']['id'],
                    'reply'
                ) , true) ,
                '##VIEW_LINK##' => Router::url(array(
                    'controller' => 'messages',
                    'action' => 'v',
                    'admin' => false,
                    $get_message_hash['Message']['id'],
                ) , true) ,
                '##TO_USER##' => $get_user['User']['username'],
                '##FROM_USER##' => (($template == 'Fund Alert Mail') ? 'Administrator' : $_SESSION['Auth']['User']['username']) ,
                '##SITE_NAME##' => Configure::read('site.name') ,
                '##FROM_USER##' => (($template == 'Fund Alert Mail') ? 'Administrator' : $_SESSION['Auth']['User']['username']) ,
                '##SUBJECT##' => $message['subject'],
            );
            $subject = strtr($template['subject'], $emailFindReplace);
            $content = strtr($template['email_content'], $emailFindReplace);
            // Send e-mail to users
            $this->Email->from = ($template['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $template['from'];
            $this->Email->replyTo = (!empty($template['from']) && $template['reply_to'] == '##REPLY_TO_EMAIL##') ? Configure::read('site.reply_to_email') : $template['reply_to'];
            $this->Email->to = $email;
            $this->Email->subject = $subject;
            $this->Email->send($content);
        }
    }
    function _checkUserNotifications($to_user_id, $order_status_id, $is_sender, $is_contact = null) 
    {
        App::import('Model', 'UserNotification');
        $this->UserNotification = new UserNotification();
        $conditions = array();
        $notification_check_array = array(
            '1' => 'is_mail_alert_for_shipped_item',
            '2' => 'is_mail_alert_for_refunded_item',
            '3' => 'is_mail_alert_for_purchased_item',
        );
        $notification_check_sender_array = array(
            '1' => 'is_mail_alert_for_shipped_item',
            '2' => 'is_mail_alert_for_refunded_item',
            '3' => 'is_mail_alert_for_purchased_item',
        );
        if (!empty($to_user_id)) {
            $check_notifications = $this->UserNotification->find('first', array(
                'conditions' => array(
                    'UserNotification.user_id' => $to_user_id
                ) ,
                'recursive' => -1
            ));
            if (!empty($check_notifications)) {
                $conditions['UserNotification.user_id'] = $to_user_id;
                if (empty($is_contact)) {
                    if (empty($is_sender)) {
                        if (isset($notification_check_array[$order_status_id])) {
                            $conditions["UserNotification.$notification_check_array[$order_status_id]"] = '1';
                        }
                    } else {
                        $conditions["UserNotification.$notification_check_sender_array[$order_status_id]"] = '1';
                    }
                }
                $check_send_mail = $this->UserNotification->find('first', array(
                    'conditions' => $conditions,
                    'recursive' => -1
                ));
                if (!empty($check_send_mail)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }
    }
    function findCountryId($data) 
    {
        $findExist = $this->find('first', array(
            'conditions' => array(
                'iso2' => $data
            ) ,
            'fields' => array(
                'id'
            ) ,
            'recursive' => -1
        ));
        return $findExist[$this->name]['id'];
    }
    function _uuid()
    {
        return sprintf('%07x%1x', mt_rand(0, 0xffff) , mt_rand(0, 0x000f));
    }
    function _unum()
    {
        $acceptedChars = '0123456789';
        $max = strlen($acceptedChars) -1;
        $unique_code = '';
        for ($i = 0; $i < 8; $i++) {
            $unique_code.= $acceptedChars{mt_rand(0, $max) };
        }
        return $unique_code;
    }
	public function toSaveIp() 
	{
	App::import('Model', 'Ip');
	$this->Ip = new Ip();
	$this->data['Ip']['ip'] = RequestHandlerComponent::getClientIP();
	$ip = $this->Ip->find('first', array(
		'conditions' => array(
			'Ip.ip' => $this->data['Ip']['ip']
		) ,
		'fields' => array(
			'Ip.id'
		) ,
		'recursive' => -1
	));
	if (empty($ip)) {
       $this->data['Ip']['host'] = gethostbyaddr($this->data['Ip']['ip']);
		if (!empty($_COOKIE['_geo'])) {
			$_geo = explode('|', $_COOKIE['_geo']);
			$country = $this->Ip->Country->find('first', array(
				'conditions' => array(
					'Country.iso2' => $_geo[0]
				) ,
				'fields' => array(
					'Country.id'
				) ,
				'recursive' => -1
			));
			if (empty($country)) {
				$this->data['Ip']['country_id'] = 0;
			} else {
				$this->data['Ip']['country_id'] = $country['Country']['id'];
			}
			if (!empty($_geo[1])) {
				$this->data['Ip']['state_id'] = $this->Ip->State->findOrSaveAndGetId($_geo[1]);
			}
			if (!empty($_geo[2])) {
				$this->data['Ip']['city_id'] = $this->Ip->City->findOrSaveCityAndGetId($_geo[2], $this->data['Ip']['state_id'], $this->data['Ip']['country_id'], $_geo[3], $_geo[4]);
			}
			$this->data['Ip']['latitude'] = $_geo[3];
			$this->data['Ip']['longitude'] = $_geo[4];
			$this->Ip->create();
			$this->Ip->save($this->data['Ip']);
			return $this->Ip->getLastInsertId();
		} else {
			$this->log('non-save ip data');
			$this->log($this->data['Ip']);
		}
	} else {
		return $ip['Ip']['id'];
	}
	}
	function getIdHash($ids = null)
    {
        return md5($ids . Configure::read('Security.salt'));
    }
	function isValidIdHash($ids = null, $hash = null) 
    {
        return (md5($ids . Configure::read('Security.salt')) == $hash);
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
}
?>
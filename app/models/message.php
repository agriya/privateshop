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
class Message extends AppModel
{
    public $name = 'Message';
    //$validate set in __construct for multi-language support
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'OtherUser' => array(
            'className' => 'User',
            'foreignKey' => 'other_user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'MessageContent' => array(
            'className' => 'MessageContent',
            'foreignKey' => 'message_content_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'MessageFolder' => array(
            'className' => 'MessageFolder',
            'foreignKey' => 'message_folder_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ) ,
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'product_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    public $hasAndBelongsToMany = array(
        'Label' => array(
            'className' => 'Label',
            'joinTable' => 'labels_messages',
            'foreignKey' => 'message_id',
            'associationForeignKey' => 'label_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );
    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        $this->validate = array(
            'message_content_id' => array(
                'numeric'
            ) ,
            'message_folder_id' => array(
                'numeric'
            ) ,
            'is_sender' => array(
                'numeric'
            ) ,
            'subject' => array(
                'rule' => 'notempty',
                'allowEmpty' => false,
                'message' => __l('Required')
            ) ,
            'message' => array(
                'rule' => 'notempty',
                'allowEmpty' => false,
                'message' => __l('Required')
            )
        );
        $this->moreActions = array(
            ConstMoreAction::Suspend => __l('Suspend') ,
            ConstMoreAction::Unsuspend => __l('Unsuspend') ,
            ConstMoreAction::Flagged => __l('Flag') ,
            ConstMoreAction::Unflagged => __l('Clear flag') ,            
        );
    }
    function myUsedSpace()
    {
        // to retreive my used mail space
        $size = $this->find('all', array(
            'conditions' => array(
                'is_deleted' => 0,
                'OR' => array(
                    array(
                        'Message.user_id' => $_SESSION['Auth']['User']['id']
                    ) ,
                    array(
                        'Message.other_user_id' => $_SESSION['Auth']['User']['id']
                    )
                )
            ) ,
            'fields' => 'SUM(Message.size) AS size',
            'recursive' => - 1,
        ));
        return $size[0][0]['size'];
    }
    function myMessagePageSize()
    {
        // it returns the user's imbox page size or default styel decide by config
        $message_page_size = $this->User->UserProfile->find('first', array(
            'conditions' => array(
                'UserProfile.user_id' => $_SESSION['Auth']['User']['id']
            ) ,
            'fields' => array(
                'UserProfile.message_page_size'
            ) ,
            'recursive' => - 1
        ));
        if (!empty($message_page_size['UserProfile']['message_page_size'])) {
            $limit = $message_page_size['UserProfile']['message_page_size'];
        } else {
            $limit = Configure::read('messages.page_size');
        }
        return $limit;
    }
    function getMessageOptionArray($folder_type)
    {
        $options = array();
        $options['More actions'] = __l('---- More actions ----');
        $options['Mark as unread'] = __l('Mark as unread');
        $options['Create Label'] = __l('Create Label');
        $options['Add star'] = __l('Add star');
        $options['Remove star'] = __l('Remove star');
        if ($folder_type != 'inbox' && $folder_type != 'sent') {
            $options['Move to inbox'] = 'Move to inbox';
        }
        $labels = $this->Label->LabelsUser->find('all', array(
            'conditions' => array(
                'LabelsUser.user_id' => $_SESSION['Auth']['User']['id']
            )
        ));
        if (!empty($labels)) {
            $options['Apply label'] = __l('----Apply label----');
            foreach($labels as $label) {
                $options['##apply##' . $label['Label']['slug']] = $label['Label']['name'];
            }
            $options['Remove label'] = __l('----Remove label----');
            foreach($labels as $label) {
                $options['##remove##' . $label['Label']['slug']] = $label['Label']['name'];
            }
        }
        return $options;
    }
    function sendNotifications($to_users, $subject, $message, $order_id)
    {
        //  to save message content
        $message_content['MessageContent']['id'] = '';
        $message_content['MessageContent']['subject'] = $subject;
        $message_content['MessageContent']['message'] = $message;
        $this->MessageContent->save($message_content);
        $message_id = $this->MessageContent->id;
        $size = strlen($subject) + strlen($message);
        $from = ConstUserIds::Admin;
        // To save in inbox //
        foreach($to_users as $to) {
            $is_saved = $this->saveMessage($to, $from, $message_id, ConstMessageFolder::Inbox, 0, 0, 0, $size, $order_id);
            // To save in sent iteams //
            $is_saved = $this->saveMessage($from, $to, $message_id, ConstMessageFolder::SentMail, 1, 1, 0, $size, $order_id);
        }
        return $message_id;
    }
    function saveMessage($user_id, $other_user_id, $message_id, $folder_id, $is_sender = 0, $is_read = 0, $parent_id = null, $size, $order_id = null)
    {
        $message['Message']['message_content_id'] = $message_id;
        $message['Message']['user_id'] = $user_id;
        $message['Message']['other_user_id'] = $other_user_id;
        $message['Message']['message_folder_id'] = $folder_id;
        $message['Message']['is_sender'] = $is_sender;
        $message['Message']['is_read'] = $is_read;
        $message['Message']['parent_message_id'] = $parent_id;
        $message['Message']['size'] = $size;
        $message['Message']['order_id'] = $order_id;
        $this->create();
        $this->save($message);
        $id = $this->id;
        $message['Message']['id'] = $id;
        $this->save($message);
        return $id;
    }
}
?>
<div class="messages index js-response js-responses">
    <div class="page-count-block clearfix">
    
  <?php echo $this->element('paging_counter');?>

        <?php echo $this->Form->create('Message' , array('action' => 'admin_index', 'type' => 'post', 'class' => 'normal search-form clearfix ')); //js-ajax-form ?>
     <div class="grid_left">
     	 <?php echo $this->Form->input('filter_id', array('type' =>'hidden'));
        	echo $this->Form->autocomplete('Message.username', array('label' => __l('From'), 'acFieldKey' => 'Message.user_id', 'acFields' => array('User.username'), 'acSearchFieldNames' => array('User.username'), 'maxlength' => '255'));
        	echo $this->Form->autocomplete('Message.other_username', array('label' => __l('To'), 'acFieldKey' => 'Message.other_user_id', 'acFields' => array('User.username'), 'acSearchFieldNames' => array('User.username'), 'maxlength' => '255'));
        ?>
    </div>
    <div class="grid_left clearfix">
    	<?php
        	echo $this->Form->submit(__l('Filter'));
    	?>
    </div>
    <?php echo $this->Form->end(); ?>

    </div>
<?php echo $this->Form->create('Message' , array('class' => 'normal','action' => 'update')); ?>
<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<table class="list">
<tr>	
	<th><?php echo __l('Subject'); ?></th>
	<th><?php echo __l('From'); ?></th>
	<th><?php echo __l('To'); ?></th>
	<th><?php echo __l('Date'); ?></th>
</tr>
<?php
if (!empty($messages)) :
$i = 0;
foreach($messages as $message):
   // if empty subject, showing with (no suject) as subject as like in gmail
    if (!$message['MessageContent']['subject']) :
		$message['MessageContent']['subject'] = '(no subject)';
    endif;
	if ($i++ % 2 == 0) :
		$row_class = 'row';
	else :
		$row_class = 'altrow';
    endif;
	
	$message_class = "checkbox-message ";
	
	$is_read_class = "";
	
    if ($message['Message']['is_read']) :
        $message_class .= "js-checkbox-active";
    else :
        $message_class .= "js-checkbox-inactive";
        $is_read_class .= "unread-message-bold";
        $row_class=$row_class.' unread-row';
    endif;
	$row_class='class="'.$row_class.'"';

	$row_three_class='w-three';
	 if (!empty($message['MessageContent']['Attachment'])):
			$row_three_class.=' has-attachment';
	endif;
	
	if($message['MessageContent']['admin_suspend']):
		$message_class.= ' js-checkbox-suspended';
	else:
		$message_class.= ' js-checkbox-unsuspended';
	endif;
	if($message['MessageContent']['is_system_flagged']):
		$message_class.= ' js-checkbox-flagged';
	else:
		$message_class.= ' js-checkbox-unflagged';
	endif;
	
		$view_url=array('controller' => 'messages','action' => 'v',$message['Message']['id'], 'admin' => false);
?>
    <tr <?php echo $row_class;?>>						
		    <td  class=" <?php echo $row_three_class;?>">
             <?php
               if (!empty($message['Label'])):
					?>
					<ul class="message-label-list">
						<?php foreach($message['Label'] as $label): ?>
							<li>
								<?php echo $this->Html->cText($this->Html->truncate($label['name']), false);?>
							</li>
						<?php
						endforeach;
					?>					
					</ul>
					<?php
                endif;
			?>
			<?php 
				echo $this->Html->link($this->Html->truncate($message['MessageContent']['subject'] . ' - ' . substr($message['MessageContent']['message'], 0, Configure::read('messages.content_length'))) ,$view_url);?>
			<?php
				if($message['MessageContent']['admin_suspend']):
					echo '<span class="suspended round-5">'.__l('Admin Suspended').'</span>';
				endif;
				if($message['MessageContent']['is_system_flagged']):
					echo '<span class="flagged round-5">'.__l('System Flagged').'</span>';
				endif;
				
			?>
        </td>
		
		<td class="w-two <?php  echo $is_read_class;?>">
				<span class="user-name-block c1">
					<?php echo $this->Html->link($this->Html->cText($message['User']['username']), array('controller' => 'users', 'action' => 'view', $message['User']['username'], 'admin' => false), array('title' => $message['User']['username'], 'escape' => false));?>
				</span>
                <div class="clear"></div>
            </td>
			        <td class="w-two <?php  echo $is_read_class;?>">
				<span class="user-name-block c1">
					<?php echo $this->Html->link($this->Html->cText($message['OtherUser']['username']), array('controller' => 'users', 'action' => 'view', $message['OtherUser']['username'], 'admin' => false), array('title' => $message['OtherUser']['username'], 'escape' => false));?>
				</span>
                <div class="clear"></div>
            </td>

        <td  class="w-four <?php echo $is_read_class;?>"><?php echo $this->Html->cDateTimeHighlight($message['Message']['created']);?></td>
    </tr>
<?php
    endforeach;
else :
?>
<tr>
    <td colspan="8"><p class="notice"><?php echo __l('No messages available') ?></p></td>
</tr>
<?php
endif;
?>
</table>
<?php
    echo $this->Form->end();
    ?>
</div>
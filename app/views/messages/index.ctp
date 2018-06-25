<div class="mail-menu-block clearfix">
<h2 class="grid_left">
<?php
    if ($is_starred == 1) :
    	$folder_type = 'Starred';
    endif;
?>
<?php echo __l('My') . ' ' .  ucfirst($folder_type) .  ' ' .__l(' Messages');?>
</h2>
<div class="grid_right">
	<?php echo $this->element('message_message-left_sidebar', array('config' => 'sec')); ?>
</div>
</div>
<div class="common-outet-block">		
	<?php
	if ($size  == Configure::read('messages.allowed_message_size') * 1024 * 1024) :
	?>
		<p><?php echo __l('You are exceeding the allowed messages quoto. Please delete some messages from your inbox/sent/trash folders'); ?></p>
	<?php
	endif;
	?>

<?php echo $this->Form->create('Message', array('action' => 'move_to', 'class' => 'normal inbox-messages')); ?>
<?php
$refresh_folder_type = $folder_type;
if ($folder_type == 'draft') $refresh_folder_type = 'drafts';
if ($folder_type == 'sent') $refresh_folder_type = 'sentmail';
echo $this->Form->hidden('folder_type', array('value' => $folder_type, 'name' => 'data[Message][folder_type]'));
echo $this->Form->hidden('is_starred', array('value' => $is_starred, 'name' => 'data[Message][is_starred]'));
echo $this->Form->hidden('label_slug', array('value' => $label_slug, 'name' => 'data[Message][label_slug]'));
?>
<table class="message-table-list list">
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
	$is_starred_class = "star";
    if ($message['Message']['is_read']) :
        $message_class .= " checkbox-read ";
    else :
        $message_class .= " checkbox-unread ";
        $is_read_class .= "unread-message-bold";
        $row_class=$row_class.' unread-row';
    endif;
    if ($message['Message']['is_starred']):
        $message_class .= " checkbox-starred ";
        $is_starred_class = "star-select";
    else:
        $message_class .= " checkbox-unstarred ";
    endif;
	$row_class='class="'.$row_class.'"';

	$row_three_class='w-three';
	 if (!empty($message['MessageContent']['Attachment'])):
			$row_three_class.=' has-attachment';
	endif;
if ($folder_type == 'draft'):
	$view_url=array('controller' => 'messages','action' => 'compose',$message['Message']['id'],'draft');
else:
	$view_url=array('controller' => 'messages','action' => 'v',$message['Message']['id']);
endif;

?>
    <tr <?php echo $row_class;?>>        
		<td class="w-two <?php  echo $is_read_class;?>">
				<span  class="<?php echo $is_starred_class;?>">
					<?php echo $this->Html->link(__l('Star') , array('controller' => 'messages', 'action' => 'star', $message['Message']['id'], $is_starred_class) , array('class' => 'change-star-unstar'));?>
				</span>
				<span class="user-name-block c1">
                    <?php
                    if ($message['Message']['is_sender'] == 1) :
                        echo $this->Html->link(__l('To: ') . $this->Html->cText($this->Html->truncate($message['OtherUser']['username']), false) , $view_url);
                    elseif ($message['Message']['is_sender'] == 2) :
                        echo $this->Html->link(__l('Me   : ') , $view_url);
                    else:
                        echo $this->Html->link($this->Html->cText($this->Html->truncate($message['OtherUser']['username']), false), $view_url);
                    endif;
                    ?>
				</span>
                <div class="clear"></div>
            </td>
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
        </td>
        <td  class="dr w-four <?php echo $is_read_class;?>"><?php echo $this->Html->cDateTimeHighlight($message['Message']['created']);?></td>
    </tr>
<?php
    endforeach;
else :
?>
<tr>
    <td colspan="4"><p class="notice"><?php echo __l('No') ?> <?php echo $folder_type; ?> <?php echo __l('messages available') ?></p></td>
</tr>
<?php
endif;
?>
</table>
<div class="refresh-section clearfix">
<p class="grid_left">
<?php
if (!empty($label_slug) && $label_slug != 'null') :
    echo $this->Html->link(__l('Refresh') , array('controller' => 'messages',
            'action' => 'label',
            $label_slug
            ),array('class' => 'refresh', 'title' => __l('Refresh')));
 elseif (!empty($is_starred)) :
    echo $this->Html->link(__l('Refresh') , array('controller' => 'messages',
            'action' => 'starred'
            ),array('class' => 'refresh', 'title' => __l('Refresh')));
 else:
    echo $this->Html->link(__l('Refresh') , array('controller' => 'messages',
            'action' => $refresh_folder_type
            ),array('class' => 'refresh', 'title' => __l('Refresh')));
endif;
?>
</p>
<div class="grid_right">
<?php
if (!empty($messages)) :
    echo $this->element('paging_links');
endif;
?>
</div>
</div>
<?php echo $this->Form->end();?>
</div>



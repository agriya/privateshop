<?php /* SVN: $Id: $ */ ?>
<div class="mail-top-block clearfix">
	<h3 class="mail-head grid_left"><?php echo __l('Mail'); ?></h3>
	<div class="grid_right">
		<?php echo $this->element('message_message-left_sidebar', array('config' => 'sec')); ?>
	</div>
</div>
<div class="messages">
<div class="common-outet-block js-corner">
<div class="mail-side-two">
	<?php
        echo $this->Form->create('Message', array('action' => 'move_to','class' => 'normal inbox-messages'));
        echo $this->Form->hidden('folder_type', array('value' => $folder_type,'name' => 'data[Message][folder_type]'));
        echo $this->Form->hidden('is_starred', array('value' => $is_starred,'name' => 'data[Message][is_starred]'));
        echo $this->Form->hidden('label_slug', array('value' => $label_slug,'name' => 'data[Message][label_slug]'));
        echo $this->Form->hidden("Message.Id." . $message['Message']['id'], array('value' => '1'));
    ?>
    <div class="mail-main-curve">
			<p class="back-to-inbox">
			<?php
                if (!empty($label_slug) && $label_slug != 'null') :
                    echo $this->Html->link(__l('Back to Label') , array('controller' => 'messages','action' => 'label',$label_slug));
                elseif (!empty($is_starred)) :
                    echo $this->Html->link(__l('Back to Starred') , array('controller' => 'messages','action' => 'starred'));
                else :
                    echo $this->Html->link(__l('Back to') . ' ' . $back_link_msg, array('controller' => 'messages','action' => $folder_type));
                endif;
            ?>
			</p>			
		<div class="mail-body js-corner round-5">
			<?php
				if (!empty($all_parents)) :
					foreach($all_parents as $parent_message):
			?>
						<div class="js-show-mail-detail-div">
						  <h3><?php echo $this->Html->cText($parent_message['MessageContent']['subject']); ?></h3>
							<div class="clearfix">
							<p class="grid_left">
								<span class="show-details-left"><?php echo $parent_message['OtherUser']['username']; ?></span>
								<span class="to-address"><?php echo $parent_message['User']['username']; ?></span>
							</p>
							<p class="to-address grid_right">
								<?php
									echo $this->Html->cDateTimeHighlight($parent_message['Message']['created']);
								?>
							</p></div>
							<?php if (!empty($parent_message['Message']['product_id'])) :?>
								<p>
									<span class="show-details-left"><?php echo __l('Product').': '; ?></span>
									<?php echo $this->Html->link($parent_message['Product']['title'], array('controller' => 'products', 'action' => 'view', $message['Product']['slug']), array('escape' => false, 'title' => $message['Product']['slug']));?>
								</p>
							<?php endif;?>
                        </div>
						<div class="message-view-content clearfix">
							<span class="c"><?php echo nl2br($this->Html->cHtml($parent_message['MessageContent']['message'])); ?></span>
						</div>
			<?php
					endforeach;
				endif;
			?>
					<div class="js-show-mail-detail-div show-mail">
						<h3 class="subject"><?php echo $this->Html->cText($message['MessageContent']['subject']); ?></h3>
						<div class="clearfix">
						<p class="grid_left">
						<?php if ($message['Message']['is_sender'] == 0) : ?>
							<span class="show-details-left"><?php echo $message['OtherUser']['username']; ?></span>
						<?php else: ?>
							<span class="show-details-left"><?php echo $message['User']['username']; ?></span>
						<?php endif; ?>
						<span class="to-address"><?php echo __l('to'); ?> <?php echo $show_detail_to; ?></span></p>
						<p class="to-address grid_right"><?php echo $this->Html->cDateTimeHighlight($message['Message']['created']); ?></p></div>
						<?php if (!empty($message['Message']['product_id'])) :?>
							<p><span class="show-details-left"><?php echo __l('Product') . ': '; ?></span><?php echo $this->Html->link($message['Product']['title'], array('controller' => 'products', 'action' => 'view', $message['Product']['slug']), array('escape' => false, 'title' => $message['Product']['slug']));?></p>
						<?php endif;?>
					</div>
					<div class="message-view-content">
						<?php if(preg_match('/\b(Invoice)\b/',$message['MessageContent']['subject'])): ?>
						<?php  echo $message['MessageContent']['message']; ?>
						<?php else: ?>
						<?php  echo nl2br($message['MessageContent']['message']); ?>
						<?php endif; ?>
					</div>
          
                <?php
                if (!empty($message['MessageContent']['Attachment'])) :
					?>
				      <div class="download-block">
					<h4><?php echo count($message['MessageContent']['Attachment']).' '. __l('attachments');?></h4>
					<ul>
					<?php
                    foreach($message['MessageContent']['Attachment'] as $attachment) :
                ?>
					<li>
                	<span class="attachement"><?php echo $attachment['filename']; ?></span>
                	<span><?php echo bytes_to_higher($attachment['filesize']); ?></span>
                    <span><?php echo $this->Html->link(__l('Download') , array( 'action' => 'download', $message['Message']['id'], $attachment['id'])); ?></span>
					</li>
                <?php
                    endforeach;
				?>
				</ul>
				     </div>
				<?php
                endif;
                ?>

       </div>        
<p class="back-to-inbox back-to-inbox-bottom">
    <?php
    if (!empty($label_slug) && $label_slug != 'null') :
        echo $this->Html->link('Back to Label', array( 'controller' => 'messages','action' => 'label', $label_slug));
    elseif (!empty($is_starred)) :
        echo $this->Html->link('Back to Starred', array('controller' => 'messages','action' => 'starred'));
    else :
        echo $this->Html->link(__l('Back to') . ' ' . $back_link_msg, array(
            'controller' => 'messages',
            'action' => $folder_type
        ));
    endif;
    ?>
</p>
     </div>
	<?php echo $this->Form->end();
?>
</div>
</div>
	
</div>

<h2 class="title"><?php echo __l('Compose') ?></h2>
<div class="mail-right-block alpha omega grid_6 grid_left">
	<?php echo $this->element('message_message-left_sidebar', array('config' => 'sec')); ?>
</div>
<div class="messages common-outet-block alpha omega grid_18 grid_right">
					<?php echo $this->Form->create('Message', array('action' => 'compose', 'class' => 'compose normal', 'enctype' => 'multipart/form-data')); ?>
					<?php
						if (!empty($all_parents)) :
							foreach($all_parents as $parent_message) :
					?>
								<h1><?php echo $this->Html->cText($parent_message['OtherUser']['username']); ?></h1>
								<p><?php echo __l('to me'); ?></p>
								<p><?php echo $this->Html->cText($parent_message['MessageContent']['message']); ?></p>
					<?php
							endforeach;
						endif;
					?>
					<div class="compose-block clearfix">
						<div class="message-block-right grid_left submit-block delete-block" >
							<?php echo $this->Form->submit(__l('Send'), array('class' => 'js-without-subject', 'name' => 'data[Message][send]')); ?>
							<?php echo $this->Form->submit(__l('Save'), array('value' => 'draft', 'name' => 'data[Message][save]')); ?>
							<div class="cancel-block"><?php echo $this->Html->link(__l('Discard') , array('controller' => 'messages', 'action' => 'inbox') , array('class' => 'js-compose-delete compose-delete','title' => __l('Discard')) , null, false); ?><?php echo $this->Html->link(__l('Cancel'), array('controller' => 'messages', 'action' => 'inbox') , array('title' => __l('Cancel'))); ?></div>
						</div>
					</div>
					<div class="compose-box">
						<fieldset>
							<div class="clearfix input">
								<span class="grid_2 omega message-title  alpha">
									<?php echo __l('From'); ?>
								</span>
								<span class="grid_10  omega alpha">
									<?php echo $this->Html->link($this->Html->cText($this->Auth->user('username')), array('controller'=> 'users', 'action' => 'view', $this->Auth->user('username')), array('title' => $this->Html->cText($this->Auth->user('username'),false),'escape' => false)); ?>
								</span>
							</div>
							<?php if(!empty($this->request->data['Message']['to_username'])): ?>
								<div class="clearfix input">
									<span class="grid_5 message-title omega alpha"><?php 	echo __l('To'); ?></span>
									<span class="grid_10 omega alpha"><?php echo !empty($this->request->data['Message']['to_username']) ? $this->Html->link($this->Html->cText($this->request->data['Message']['to_username']), array('controller'=> 'users', 'action' => 'view', $this->request->data['Message']['to_username']), array('title' => $this->Html->cText($this->request->data['Message']['to_username'],false),'escape' => false)) : ''; ?></span>
								</div>
							<?php endif; ?>
							<?php if (!empty($this->request->data['Message']['product_title'])): ?>
								<div class="clearfix input">
									<span class="grid_5 message-title omega alpha"><?php echo __l('Product');  ?></span>
									<span class="grid_10 omega alpha"><?php echo $this->Html->link($this->Html->cText($this->request->data['Message']['product_title']), array('controller' => 'products', 'action' => 'view',  $this->request->data['Message']['product_slug']), array('title' => $this->Html->cText($this->request->data['Message']['product_name'],false),'escape' => false));?></span>
								</div>
							<?php endif; ?>
							<?php
								if(!empty($this->request->data['Message']['to_username'])):
									echo $this->Form->input('to_username', array('type' => 'hidden', 'id' => 'message-to'));
									echo $this->Form->input('to', array('type' => 'hidden', 'id' => 'message-to-name', 'value' => $this->request->data['Message']['to_username']));
								else:
									echo $this->Form->input('to', array('type' => 'hidden', 'id' => 'message-to'));
								endif;
								echo $this->Form->input('parent_message_id', array('type' => 'hidden'));
								echo $this->Form->input('type', array('type' => 'hidden'));
								echo $this->Form->input('subject', array('id' => 'MessSubject', 'maxlength' => '100', 'label'=>__l('Subject')));
							?>
							<div class="atachment">
								<?php echo $this->Form->input('Attachment.filename. ', array('type' => 'file', 'label' => '','size' => '33', 'class' => 'multi file attachment browse-field')); ?>
							</div>
							<p><?php echo $this->Html->link(__l('Add more attachment'),array('#'),array('class'=>'js-attachmant add','title' => __l('Add more attachment')));?></p>
							<div class="js-attachment-list">
								<?php if(!empty($parent_message['MessageContent']['Attachment'])) { ?>
									<ol class="clearfix">
										<?php foreach($parent_message['MessageContent']['Attachment'] as $attachment) { ?>
											<li>
												<div class="js-old-attachmant-div-<?php echo $attachment['id']; ?>">
													<?php 
														echo $attachment['filename'];
														echo $this->Form->input('OldAttachment.'.$attachment['id'].'.id', array('type' => 'hidden'));
														echo $this->Html->link(__l('Remove attachment'), array('#'), array('class'=>'delete js-old-attachmant {"id" : "'.$attachment['id'].'"}','title' => __l('Remove attachment')));
													?>
												</div>
											</li>
										<?php } ?>
									</ol>
								<?php } ?>
							</div>
							<?php
								if(!empty($this->request->params['named']['product_id'])):
									echo $this->Form->input('product_id', array('type' => 'hidden','value'=>$this->request->params['named']['product_id']));
								endif;
								echo $this->Form->input('message', array('type' => 'textarea', 'label' => '')); 
								echo $this->Form->input('message_content_id', array('type' => 'hidden'));
							?>
						</fieldset>
					</div>
					<div class="compose-block clearfix">
						<div class="message-block-right grid_left submit-block delete-block" >
							<?php echo $this->Form->submit(__l('Send'), array('class' => 'js-without-subject')); ?>
							<?php echo $this->Form->submit(__l('Save'), array('value' => 'draft', 'name' => 'data[Message][save]')); ?>
							<div class="cancel-block"><?php echo $this->Html->link(__l('Discard') , array('controller' => 'messages', 'action' => 'inbox') , array('class' => 'js-compose-delete compose-delete','title' => __l('Discard')) , null, false); ?><?php echo $this->Html->link(__l('Cancel'), array('controller' => 'messages', 'action' => 'inbox') , array('title' => __l('Cancel'))); ?></div>
						</div>
					</div>
				<?php echo $this->Form->end(); ?>
</div>
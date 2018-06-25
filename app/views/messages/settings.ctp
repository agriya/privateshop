<?php /* SVN: $Id: $ */ ?>
<h2 class="title"><?php echo __l('General Settings'); ?> </h2>
<div class="mail-right-block alpha omega grid_6 grid_left">
<?php echo $this->element('message_message-left_sidebar', array('config' => 'sec')); ?>
</div>
<div class="messages common-outet-block alpha omega grid_18 grid_right">
	<div id="message-settings">
		<?php
			echo $this->Form->create('Message', array('action' => 'settings', 'class' => 'normal  js-form-settings'));
			echo $this->Form->input('UserProfile.message_page_size', array('info' => __l('Show conversations per page'),'label'=>__l('Message Page Size')));
			echo $this->Form->input('UserProfile.message_signature', array('type' => 'textarea', 'label'=>__l('Message Signature')));
		?>
		<div class="submit-block clearfix">
			<?php echo $this->Form->submit(__l('Update')); ?>
		</div>
		<?php
			echo $this->Form->end();
		?>
	</div>
</div>

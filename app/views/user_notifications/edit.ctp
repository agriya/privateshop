<?php /* SVN: $Id: $ */ ?>
<?PHP if(!Configure::read('messages.is_send_email_on_new_message')) { ?>
<p class="notice"><?php echo __l('Admin disabled external E-mail features.');?></p>
<?PHP } else{ ?>
<h2><?php echo __l("Manage General Email Notifications");?></h2>
<div class="userNotifications form">
<div class="common-outet-block">
<?php echo $this->Form->create('UserNotification', array('action' => 'edit', 'class' => 'normal'));?>

	<?php
		if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
			echo $this->Form->input('id');
		endif;
	?>
	<div class="notification-block">
	<table class="list email-list">		
		<tr>
			<td class="dl"><?php echo $this->Form->input('is_mail_alert_for_purchased_item', array('label' => __l('Send notification when you purchased the new item')));?></td>
		</tr>		<tr>
			<td class="dl"><?php echo $this->Form->input('is_mail_alert_for_shipped_item', array('label' => __l('Send notification when your order has been shipped ')));?></td>
		</tr>
		<tr>
			<td class="dl"><?php echo $this->Form->input('is_mail_alert_for_refunded_item', array('label' => __l('Send notification when your order has been refunded')));?></td>
		</tr>
	</table>
	</div>
<div class="clearfix">
<?php echo $this->Form->submit(__l('Update'));?>
</div>
<?php echo $this->Form->end();?>
</div>
</div>
<?PHP } ?>
<?php /* SVN: $Id: admin_add.ctp 1456 2010-04-28 08:53:26Z vinothraja_091at09 $ */ ?>
<div class="userOpenids form">
<?php echo $this->Form->create('UserOpenid', array('class' => 'normal clearfix'));?>
	<fieldset>
 		<legend><?php echo $this->Html->link(__l('User Openids'), array('action' => 'index'),array('title' => __l('User openids')));?> &raquo; <?php echo __l('Add User Openid');?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('openid');
		echo $this->Form->input('verify',array('type' => 'checkbox'));
	?>
	</fieldset>
<?php echo $this->Form->end(__l('Add'));?>
</div>

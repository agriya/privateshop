<h2 class="login-title"><?php echo __l('Forgot your password?');?></h2>
<div class="common-outet-block">
<div class="page-info">
	<?php echo __l('Enter your Email, and we will send you instructions for resetting your password.'); ?>
</div>
<?php
	echo $this->Form->create('User', array('action' => 'forgot_password', 'class' => 'normal'));
	echo $this->Form->input('email', array('type' => 'text'));
?>
<div class="submit-block clearfix">
	<?php echo $this->Form->Submit(__l('Send')); ?>
</div>
<?php echo $this->Form->end();
?>
</div>
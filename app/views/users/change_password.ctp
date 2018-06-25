<div class="user-profile-form">
<?php
	echo $this->Form->create('User', array('action' => 'change_password' ,'class' => 'normal clearfix')); ?>
	<?php  if(empty($this->request->params['admin'])) {?>
	 <h2><?php echo __l('Change password'); ?></h2>
	<?php } ?>
<div class="common-outet-block">
	<fieldset class="fields-block">
	<?php if($this->Auth->user('user_type_id') == ConstUserTypes::Admin) :
    	echo $this->Form->input('user_id', array('empty' => 'Select'));
    endif;
    if($this->Auth->user('user_type_id') != ConstUserTypes::Admin) :
        echo $this->Form->input('user_id', array('type' => 'hidden'));
    	echo $this->Form->input('old_password', array('type' => 'password','label' => __l('Old password') ,'id' => 'old-password'));
    endif;
    echo $this->Form->input('passwd', array('type' => 'password','label' => __l('Enter a new password') , 'id' => 'new-password'));
	echo $this->Form->input('confirm_password', array('type' => 'password', 'label' => __l('Confirm Password'))); ?>
	<div class="submit-block clearfix"><?php echo $this->Form->submit(__l('Change password')); ?></div>
	</fieldset>
	</div>
	<?php echo $this->Form->end(); ?>
</div>

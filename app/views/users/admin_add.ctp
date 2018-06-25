<?php /* SVN: $Id: $ */ ?>
<div class="users form">
<?php echo $this->Form->create('User', array('class' => 'normal clearfix'));?>
	<fieldset>
 		
	<?php
        echo $this->Form->input('user_type_id');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('passwd', array('label' => __l('Password')));
	?>
	</fieldset>
<div class="submit-block clearfix"><?php echo $this->Form->submit('Add'); ?></div>
<?php echo $this->Form->end();?>
</div>
<?php /* SVN: $Id: $ */ ?>
<h2 class="title"><?php echo __l('Edit Label'); ?></h2>
<div class="alpha omega grid_6"><?php echo $this->element('message_message-left_sidebar', array('config' => 'sec'));?></div>
<div class="common-outet-block alpha omega grid_18 grid_right">
<div class="labels form">
<?php echo $this->Form->create('Label', array('class' => 'normal'));?>
	<fieldset>
 		<legend><?php echo $this->Html->link(__l('Labels'), array('action' => 'index'));?> &raquo; <?php echo __l('Edit Label');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<div class="submit-block clearfix"><?php echo $this->Form->end(__l('Update'));?></div>
</div>
</div>

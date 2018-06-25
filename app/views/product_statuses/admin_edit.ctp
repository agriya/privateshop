<?php /* SVN: $Id: $ */ ?>
<div class="productStatuses form">
<?php echo $this->Form->create('ProductStatus', array('class' => 'normal clearfix'));?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
<div class="submit-block clearfix"><?php echo $this->Form->end(__l('Update'));?>
<div class="cancel-block">
	<?php echo $this->Html->link(__l('Cancel') , array('action' => 'index'));?>
</div>
</div>
</div>
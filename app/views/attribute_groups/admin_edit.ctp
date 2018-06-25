<?php /* SVN: $Id: $ */ ?>
<div class="attributeGroups form clearfix">
<?php echo $this->Form->create('AttributeGroup', array('class' => 'normal'));?>
	<fieldset>
		<legend><?php echo $this->Html->link(__l('Attribute Groups'), array('action' => 'index'));?> &raquo; <?php echo __l('Admin Edit Attribute Group');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('attribute_group_type_id');
		echo $this->Form->input('name');
		echo $this->Form->input('display_name');
		echo $this->Form->input('order');
	?>
	</fieldset>
<div class="submit-block clearfix"><?php echo $this->Form->end(__l('Update'));?></div>
</div>
<?php /* SVN: $Id: $ */ ?>
<div class="attributeGroups form clearfix">
<?php echo $this->Form->create('AttributeGroup', array('class' => 'normal add-form'));?>
	<fieldset>
		<h3><?php echo $this->Html->link(__l('Attribute Groups'), array('action' => 'index'));?> &raquo; <?php echo __l('Add Variant Group');?></h3>
	<?php
		echo $this->Form->input('attribute_group_type_id');
		echo $this->Form->input('name');
		echo $this->Form->input('display_name');
		echo $this->Form->input('order');
	?>
	</fieldset>
<div class="submit-block clearfix"><?php echo $this->Form->end(__l('Add'));?></div>
</div>
<?php /* SVN: $Id: $ */ ?>
<div class="attributeGroups clearfix form js-ajax-form-container">
<?php echo $this->Form->create('AttributeGroup', array('class' => 'normal add-form js-attribute-form {container:"js-ajax-form-container",responsecontainer:"js-attribute-responses"}'));?>
<h3><?php echo __l('Add Variant Group'); ?></h3>
    <?php
		echo $this->Form->input('add', array('type' => 'hidden', 'value' => 1));
		echo $this->Form->input('name');
		echo $this->Form->input('attribute_group_type_id', array('label' => 'Group Type'));
		echo $this->Form->input('display_name');
		echo $this->Form->input('order', array('type' => 'hidden', 'value' => 1));
	?>
<div class="submit-block clearfix"><?php echo $this->Form->submit(__l('Add'));?></div>
<?php echo $this->Form->end();?>
</div>

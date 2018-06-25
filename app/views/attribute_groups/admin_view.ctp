<?php /* SVN: $Id: $ */ ?>
<div class="attributeGroups view">
<h2><?php echo __l('Attribute Group');?></h2>
	<dl class="list"><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Id');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($attributeGroup['AttributeGroup']['id']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Attribute Group Type');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->link($this->Html->cText($attributeGroup['AttributeGroupType']['name']), array('controller' => 'attribute_group_types', 'action' => 'view', $attributeGroup['AttributeGroupType']['id']), array('escape' => false));?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Name');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($attributeGroup['AttributeGroup']['name']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Display Name');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cText($attributeGroup['AttributeGroup']['display_name']);?></dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __l('Order');?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Html->cInt($attributeGroup['AttributeGroup']['order']);?></dd>
	</dl>
</div>
<?php /* SVN: $Id: $ */ ?>
<div class="attributeGroups index">
	<h2><?php echo __l('Attribute Groups');?></h2>
<?php echo $this->element('paging_counter');?>
<table class="list">
	<tr>
		<th class="actions"><?php echo __l('Actions');?></th>
				<th><?php echo $this->Paginator->sort('id');?></th>
				<th><?php echo $this->Paginator->sort('attribute_group_type_id');?></th>
				<th><?php echo $this->Paginator->sort('name');?></th>
				<th><?php echo $this->Paginator->sort('display_name');?></th>
				<th><?php echo $this->Paginator->sort('order');?></th>
			</tr>
	<?php
if (!empty($attributeGroups)):
	$i = 0;
	foreach ($attributeGroups as $attributeGroup):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="actions"><span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $attributeGroup['AttributeGroup']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span> <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $attributeGroup['AttributeGroup']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span></td>
		<td class="dc">
			<?php echo $this->Html->cInt($attributeGroup['AttributeGroup']['id']); ?>
		</td>
		<td class="dl">
			<?php echo $this->Html->link($this->Html->cText($attributeGroup['AttributeGroupType']['name']), array('controller' => 'attribute_group_types', 'action' => 'view', $attributeGroup['AttributeGroupType']['id']), array('escape' => false)); ?>
		</td>
		<td class="dl">
			<?php echo $this->Html->cText($attributeGroup['AttributeGroup']['name']); ?>
		</td>
		<td class="dl">
			<?php echo $this->Html->cText($attributeGroup['AttributeGroup']['display_name']); ?>
		</td>
		<td class="dc">
			<?php echo $this->Html->cInt($attributeGroup['AttributeGroup']['order']); ?>
		</td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="6"><p class="notice"><?php echo __l('No Attribute Groups available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($attributeGroups)) {
    echo $this->element('paging_links');
}
?>
</div>

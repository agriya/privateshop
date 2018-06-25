<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="attributeGroups index">
<h2><?php echo __l('Attribute Groups');?></h2>
<?php echo $this->element('paging_counter');?>
<ol class="list" start="<?php echo $paginator->counter(array(
    'format' => '%start%'
));?>">
<?php
if (!empty($attributeGroups)):

$i = 0;
foreach ($attributeGroups as $attributeGroup):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cInt($attributeGroup['AttributeGroup']['id']);?></p>
		<p><?php echo $this->Html->link($this->Html->cText($attributeGroup['AttributeGroupType']['name']), array('controller'=> 'attribute_group_types', 'action' => 'view', $attributeGroup['AttributeGroupType']['id']), array('escape' => false));?></p>
		<p><?php echo $this->Html->cText($attributeGroup['AttributeGroup']['name']);?></p>
		<p><?php echo $this->Html->cText($attributeGroup['AttributeGroup']['display_name']);?></p>
		<p><?php echo $this->Html->cInt($attributeGroup['AttributeGroup']['order']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $attributeGroup['AttributeGroup']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $attributeGroup['AttributeGroup']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Attribute Groups available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($attributeGroups)) {
    echo $this->element('paging_links');
}
?>
</div>

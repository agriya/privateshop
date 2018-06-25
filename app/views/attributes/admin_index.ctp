<?php /* SVN: $Id: $ */ ?>
<div class="attributes index js-ajax-responses js-response">
<div class="page-info">
	<?php echo __l('For Reordering the list, you have click "I am done reordering" after drag and drop, then click save to update the order.');?>
</div>
<div class="clearfix">
<div class="group-block">
    <?php echo $this->Html->link(__l('Add Group'), array(), array('class' => 'js-add-attributegroup', 'title' => __l('Add Group'))); ?>
</div>
</div>
<div class="hide" id="js-attribute-add-form">
    <?php echo $this->element('attribute_groups-add');?>
</div>
<?php if (!empty($attributeGroups)): ?>
<?php echo $this->Form->create('Attribute', array('class' => 'normal js-attributedrag add-form att-form clearfix', 'action' => 'index')); ?>
<?php echo $this->Form->input('Attribute.add', array('type' => 'hidden', 'value' => 1)); ?>
<ul class="attribute-list clearfix js-attribute-responses">
<?php foreach ($attributeGroups as $attributeGroup):
	$i = 1;
	$count = 0;
?>
<li>
    <div class="att-title clearfix">
			<h3 class="grid_left"><?php echo $attributeGroup['AttributeGroup']['display_name']; ?></h3>
            <div class="edit-delete grid_right js-attribute-group-action-<?php echo $attributeGroup['AttributeGroup']['id']; ?> <?php echo (!empty($ValidateAttributeGroup[$attributeGroup['AttributeGroup']['id']]) && $ValidateAttributeGroup[$attributeGroup['AttributeGroup']['id']][0] == 'show')?'hide':''; ?>">
			<?php echo $this->Html->link(__l('Edit'), array(), array('class' => 'edit js-edit-attributegroup {id:'.$attributeGroup['AttributeGroup']['id'].'}', 'title' => __l('Edit'))); ?>
            <?php echo $this->Html->link(__l('Delete'), array('controller' =>'attribute_groups','action'=>'delete', $attributeGroup['AttributeGroup']['id'],1), array('class' => 'delete js-delete', 'title' => __l('Delete'))); ?>
			</div>
   </div>
   <div class="clearfix edit-block js-show-attribute-group-<?php echo $attributeGroup['AttributeGroup']['id']; ?> 
   
   <?php echo (!empty($ValidateAttributeGroup[$attributeGroup['AttributeGroup']['id']]) && $ValidateAttributeGroup[$attributeGroup['AttributeGroup']['id']][0] == 'show')?'':'hide'; ?>">	 <div class="js-clone">
                <h3 class="edit"><?php echo __l('Edit'); ?></h3>
               <div class="title-block clearfix"><span><?php echo __l('Name');?></span>
                        <span><?php echo __l('Display Name');?></span>
						<span><?php echo __l('Group Type');?></span>
             </div>
            <?php
            echo $this->Form->input('AttributeGroup.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.id', array('type' => 'hidden', 'value' => $attributeGroup['AttributeGroup']['id'])); ?>
            <div class="grid_left"><?php echo $this->Form->input('AttributeGroup.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.name', array('label' => false,'type' => 'text', 'value' => (isset($this->request->data['AttributeGroup'][$attributeGroup['AttributeGroup']['id']][$i]['name']))?$this->request->data['AttributeGroup'][$attributeGroup['AttributeGroup']['id']][$i]['name'] : $attributeGroup['AttributeGroup']['name'])); ?></div>
            <div class="grid_left"><?php echo $this->Form->input('AttributeGroup.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.display_name', array('label' => false,'type' => 'text', 'value' => (isset($this->request->data['AttributeGroup'][$attributeGroup['AttributeGroup']['id']][$i]['display_name']))?$this->request->data['AttributeGroup'][$attributeGroup['AttributeGroup']['id']][$i]['display_name'] : $attributeGroup['AttributeGroup']['display_name'])); ?></div>
            <div class="grid_left"><?php echo $this->Form->input('AttributeGroup.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.attribute_group_type_id',array('label' => false, 'options' => $attributeGroupTypes ,'value' => (isset($this->request->data['AttributeGroup'][$attributeGroup['AttributeGroup']['id']][$i]['attribute_group_type_id']))?$this->request->data['AttributeGroup'][$attributeGroup['AttributeGroup']['id']][$i]['attribute_group_type_id'] : $attributeGroup['AttributeGroup']['attribute_group_type_id'] )); ?></div>
      </div>
   </div>
    <div class="attribute-inner-block clearfix">
    <?php if($attributeGroup['Attribute']): ?>
    <div class="clearfix">
        <?php echo $this->Html->link(__l('Reorder'), '#', array( 'class' => "reloader grid_right js-dragdrop {'met_tab':'js-tab-list-".$attributeGroup['AttributeGroup']['id']."', 'met_drag_cls':'js-drag_attribute','met_data_action':'js-reorder','met_tr_drag':'js-dragbox', 'met_form_cls':'js-attributedrag', 'met_tab_order':'js-attributeorder'}", 'title' => __l('Reorder'), 'rel' => 'reorder')); ?>
    </div>
	<table class="list">
	<?php
	$count = count($attributeGroup['Attribute']);
	foreach ($attributeGroup['Attribute'] as $attribute): ?>
	<?php if($i == 1): ?>
    	<tr class="title-block">
            <th class="att-title" ><?php echo __l('Name');?></th>
            <?php if($attributeGroup['AttributeGroup']['attribute_group_type_id'] == ConstAttributeGroupType::Color): ?>
                <th class="att-title"><?php echo __l('Color');?></th>
            <?php endif; ?>
              </tr>
			  </table>
	<table class="list js-tab-list-<?php echo $attributeGroup['AttributeGroup']['id']; ?>">
    <?php endif; ?>
	
	<tr>
    	<td class="title-hover title-name" <?php if (!($attributeGroup['AttributeGroup']['attribute_group_type_id'] == ConstAttributeGroupType::Color)): ?> colspan="2" <?php endif?>>
              <?php echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.id', array('type' => 'hidden', 'value' => $attribute['id']));
                  echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.attribute_group_type_id', array('type' => 'hidden', 'value' => $attributeGroup['AttributeGroupType']['id']));
                  echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.attribute_group_id', array('id'=>'attribute_group_id'.$attributeGroup['AttributeGroup']['id'].'_id_'.$i,'type' => 'hidden', 'value' => $attributeGroup['AttributeGroup']['id'])); ?>
              <?php echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.name', array('id'=>'attribute_name'.$attributeGroup['AttributeGroup']['id'].'_id_'.$i, 'type' => 'text', 'value' => $attribute['name'],'label'=>false)); ?>
          	</td>
        <?php if($attributeGroup['AttributeGroup']['attribute_group_type_id'] == ConstAttributeGroupType::Color): ?>
			 <td class="title-hover title-color"><div class="clearfix"><?php echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.attribute_group_type_value', array('id'=>'attribute_value'.$attributeGroup['AttributeGroup']['id'].'_id_'.$i, 'type' => 'text', 'value' => $attribute['attribute_group_type_value'],'label'=>false,'class' => 'js_colorpick js_colorpicker-'.$attribute['attribute_group_id'].'-'.$i.' {id:'.$i.',attribute_group_id:'.$attribute['attribute_group_id'].'}', 'style' => 'background:#'.$attribute['attribute_group_type_value'])); ?></div></td>
        <?php endif; ?>
         <td class="hide js-dragbox">
            <?php echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$i.'.order', array('value' =>  $attribute['order'], 'class' => 'js-attributeorder'));?>
        </td>
        <td class="att-delete">
       		<div class="grid_left att-delete"><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $attribute['id']), array('class' => 'delete js-delete', 'title' => __l('Delete'))); ?></div>
        </td>    
	</tr>

<?php
	$i++;
	endforeach;
?>
</table>
<?php endif; ?>
	<?php if(empty($count)): ?>
        <div class="title-block clearfix"><span class="att-title"><?php echo __l('Name');?></span>
        <?php if($attributeGroup['AttributeGroup']['attribute_group_type_id'] == ConstAttributeGroupType::Color): ?>
            <span class="att-title1"><?php echo __l('Color');?></span>
        <?php endif; ?>
        </div>
    <?php endif; ?>
	<div class="js-clone add-form-block clearfix  {attribute_count:'<?php echo $i; ?>'}">
    	<?php echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.attribute_group_id', array('id'=>'attribute_group_id'.$attributeGroup['AttributeGroup']['id'],'type' => 'hidden', 'value' => $attributeGroup['AttributeGroup']['id'])); ?>
		<?php for($j=$i; $j<= $count+1; $j++){ ?>
        <div class="js-field-list clearfix">
        <div class="clone-block grid_left"><?php echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$j.'.name',array('id'=>'attribute_name'.$attributeGroup['AttributeGroup']['id'].'_id_'.$j, 'label'=>false)); ?></div>
        <?php if($attributeGroup['AttributeGroup']['attribute_group_type_id'] == ConstAttributeGroupType::Color): ?>
			<div class="clone-block1 grid_left"><?php echo $this->Form->input('Attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$j.'.attribute_group_type_value', array('id'=>'attribute_value'.$attributeGroup['AttributeGroup']['id'].'_id_'.$j, 'label'=>false,'class' => 'js_colorpick js_colorpicker-'.$attributeGroup['AttributeGroup']['id'].'-'.$j.' {id:'.$j.',attribute_group_id:'.$attributeGroup['AttributeGroup']['id'].'}')); ?></div>
        <?php endif; ?>
          </div>
        <?php } ?>
        <p class="add clearfix"> <?php echo $this->Html->link(__l('Add more'), '#', array('class' => 'js-addmore add'));?></p>
    </div>
    </div>
</li>
<?php endforeach; ?>
</ul>
  <?php else: ?>
	<div class="notice-block"><?php echo __l('No Attributes available');?></div>
<?php endif; ?>

<?php if (!empty($attributeGroups)) {
	echo $this->Form->end(__l('Save'));
} ?>
</div>

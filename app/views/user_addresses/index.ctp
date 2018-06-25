<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="userAddresses index">
	<h2><?php echo __l('My Shipping Addresses');?></h2>
	<div class="clearfix">
	<div class="grid_left"><?php echo $this->element('paging_counter');?></div>
    	<?php echo $this->Html->link(__l('Add Shipping Address'), array('action' => 'add'), array('class'=>'add grid_right','title' => __l('Add Shipping Address')));?>
	</div>

	<?php echo $this->Form->create('UserAddress' , array('class' => 'normal table-form', 'action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<div class="table-outer-block">
	<table class="list">
		<tr>
			<th><?php echo __l('Select');?></th>
			<th class="actions"><?php echo __l('Actions');?></th>
			<th><?php echo $this->Paginator->sort(__l('Created'), 'created');?></th>
			<th><?php echo $this->Paginator->sort(__l('Name'), 'full_name');?></th>
			<th><?php echo $this->Paginator->sort(__l('Address'), 'address');?></th>
			<th><?php echo $this->Paginator->sort(__l('Phone'), 'phone');?></th>
			<th><?php echo $this->Paginator->sort(__l('Primary?'), 'is_primary');?></th>
			<th><?php echo $this->Paginator->sort(__l('Active?'), 'is_active');?></th>
		</tr>
		<?php
			if (!empty($userAddresses)):
				$i = 0;
				foreach ($userAddresses as $userAddress):
					$class = null;
					if ($i++ % 2 == 0):
						$class = ' class="altrow"';
					endif;
					if($userAddress['UserAddress']['is_active']):
						$status_class = 'js-checkbox-active';
						$class = ' class="active-record"';
					else:
						$status_class = 'js-checkbox-inactive';
						$class = ' class="inactive-record"';
					endif;
					if($userAddress['UserAddress']['is_active']):
						$status_class = 'js-checkbox-primary';
					endif;
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Form->input('UserAddress.'.$userAddress['UserAddress']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userAddress['UserAddress']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
			<td class="actions">
					<div class="action-block">
					<span class="action-information-block">
						<span class="action-left-block">&nbsp;&nbsp;</span>
						<span class="action-center-block">
							<span class="action-info">
								<?php echo __l('Action');?>
							</span>
						</span>
					</span>
					<div class="action-inner-block">
						<div class="action-inner-left-block">
							<ul class="action-link clearfix">
                            <li><span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $userAddress['UserAddress']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span></li>
				<li><span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $userAddress['UserAddress']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span></li>
            <?php if(empty($userAddress['UserAddress']['is_primary'])) { ?>
			<li>	<span><?php echo $this->Html->link(__l('Set primary'), array('action' => 'update_status', $userAddress['UserAddress']['id'],'primary'), array('class' => 'set-primary', 'title' => __l('Set primary')));?></span></li>
			<?php } ?>

							</ul>
						</div>
						<div class="action-bottom-block"></div>
					</div>
				</div>
            </td>
			<td><?php echo $this->Html->cDateTimeHighlight($userAddress['UserAddress']['created']);?></td>
			<td><?php echo $this->Html->cText($userAddress['UserAddress']['full_name']);?></td>
			<td><?php echo $this->Html->cText($userAddress['UserAddress']['address']);?></td>
			<td><?php echo !empty($userAddress['UserAddress']['phone'])?$userAddress['UserAddress']['phone']:'-';?></td>
			<td><?php echo $this->Html->cBool($userAddress['UserAddress']['is_primary']);?></td>
			<td><?php echo $this->Html->cBool($userAddress['UserAddress']['is_active']);?></td>
		</tr>
		<?php
				endforeach;
			else:
		?>
		<tr>
			<td colspan="20"><p class="notice"><?php echo __l('No shipping addresss available');?></p></td>
		</tr>
		<?php
			endif;
		?>
	</table>
</div>
	<?php if (!empty($userAddresses)): ?>
 <div class="clearfix">
		<div class="admin-select-block grid_left">
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
		</div>
		<div class="admin-checkbox-button grid_4 grid_left">
			<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'options'=>$moreActions, 'empty' => __l('-- More actions --'))); ?>
	</div>
		</div>
	<?php endif; ?>

	<?php echo $this->Form->end(); ?>
	<?php
		if (!empty($userAddresss)):
			echo $this->element('paging_links');
		endif;
	?>
</div>
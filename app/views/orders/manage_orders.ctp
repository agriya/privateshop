<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="orders index js-response">
<h2><?php echo __l('Manage Orders'); ?></h2>
	<div class="common-outet-block ">
	<div class="dashboard-filter-block clearfix">

	<ul class="dashboard-filter-list celarfix">
		<?php $total_orders = 0; ?>
		<?php foreach($orderStatuses as $order_status_id => $order_status_name): ?>
			<?php $class = (!empty($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id'] == $order_status_id) ? ' active-filter' : null; ?>
			<li><span class="<?php echo $class; ?> <?php echo strtolower(Inflector::camelize($order_status_name)); ?>"><?php echo $this->Html->link($order_status_name . ': ' . $this->Html->cInt(${'order_status_' . $order_status_id}, false), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders', 'status_filter_id' => $order_status_id), array('class' => $class, 'title' => $order_status_name . ' ' . __l('Orders')));?></span></li>
			<?php $total_orders += ${'order_status_' . $order_status_id}; ?>
		<?php endforeach; ?>
		<?php $class = (empty($this->request->params['named']['status_filter_id'])) ? ' active-filter' : null; ?>
		<li><span class="all <?php echo $class; ?>"><?php echo $this->Html->link(__l('Total') . ': ' . $this->Html->cInt($total_orders, false), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders'), array('class' => $class, 'title' => __l('Total Orders')));?></span></li>
   </ul>
  
	</div>
	
	<?php echo $this->element('paging_counter'); ?>

    <?php echo $this->Form->create('Order' , array('class' => 'normal', 'action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<div class="filter-section manage clearfix">
		<div class="input date ">
			<div>
				<?php echo $this->Form->input('From', array('empty' => __l('Select'), 'type' => 'date','dateFormat' => 'DMY','label' => __l('From'), 'div' => false, 'minYear' => date('Y'), 'maxYear' => date('Y')+1));?>
			</div>
		</div>
		<div class="input date ">
			<div>
				<?php echo $this->Form->input('To', array('empty' => __l('Select'), 'type' => 'date','dateFormat' => 'DMY', 'label' => __l('To'), 'div' => false, 'minYear' => date('Y'), 'maxYear' => date('Y')+1));?>
			</div>
		</div>
		<div class="submit-block clearfix"><?php echo $this->Form->submit(__l('Search'));?></div>
	</div>
	<table class="list">
		<tr>
			<?php if (!empty($moreActions)): ?>
				<th><?php echo __l('Select'); ?></th>
			<?php endif; ?>
			<th><?php echo __l('Actions'); ?></th>
			<th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Order id'), 'id'); ?></div></th>
			<th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username'); ?></div></th>
			<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Ordered Date'), 'created'); ?></div></th>
			<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Amount (').Configure::read('site.currency').__l(')'), 'amount'); ?></div></th>
			<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Order Status'), 'order_status_id'); ?></div></th>
			<?php if(empty($this->request->params['named']['status_filter_id']) || (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id']==ConstOrderStatus::InProcess))) : ?>
				<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Paid Date'), 'paid_date'); ?></div></th>
			<?php endif; ?>
			<?php if (empty($this->request->params['named']['status_filter_id']) || (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id'] == ConstOrderStatus::Shipped || ($this->request->params['named']['status_filter_id']==ConstOrderStatus::Completed)))) : ?>
				<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Shipped Date'), 'shipped_date'); ?></div></th>
				<th class="dc"><div class="js-pagination"><?php echo __l('Shipping Remarks'); ?></div></th>
			<?php endif; ?>
			<?php if (empty($this->request->params['named']['status_filter_id']) || (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id']==ConstOrderStatus::CanceledAndRefunded))) : ?>
				<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Canceled Date'), 'canceled_date'); ?></div></th>
			<?php endif; ?>
			<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Product Count'), 'order_item_count'); ?></div></th>
		</tr>
		<?php
			if (!empty($orders)):
				$i = 0;
				foreach ($orders as $order):
					$class = null;
					if ($i++ % 2 == 0):
						$class = ' class="altrow"';
					endif;
		?>
		<tr<?php echo $class;?>>
			<?php if (!empty($moreActions)): ?>

				<td>
				<?php if($order['Order']['order_status_id']==ConstOrderStatus::InProcess) : ?>
				<?php echo $this->Form->input('Order.'.$order['Order']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$order['Order']['id'], 'label' => false, 'class' =>' js-checkbox-list')); ?>
				<?php endif; ?>
				</td>
			<?php endif; ?>
			<td class="actions">
				<?php if (!empty($order['OrderItem'])): ?>
					<span><?php echo $this->Html->link(__l('View Ordered items'), '#', array('class' => 'js-order-colorbox {"id":"js-order-item-' . $order['Order']['id'] . '"}', 'title' => __l('View Ordered items'))); ?></span>
					<div class="hide">
						<div id="js-order-item-<?php echo $order['Order']['id']; ?>">
							<h2><?php echo __l('Order details - #') . $order['Order']['id']; ?></h2>
							<table class="list">
								<?php
									$i=1;
									foreach($order['OrderItem'] as $orderItem):
								?>
								<?php if ($i == 1): ?>
									<tr>
										<th><?php echo __l('Product'); ?></th>
										<th><?php echo __l('Quantity'); ?></th>
										<th><?php echo __l('Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
										<th><?php echo __l('Total Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
										<?php if (Configure::read('module.buy_as_gift')) : ?>
											<th><?php echo __l('Gift Wrap?'); ?></th>
											<th><?php echo __l('Gift Note'); ?></th>
											<th><?php echo __l('Friend Email'); ?></th>
										<?php endif; ?>
										<?php if (Configure::read('module.credits')) : ?>
											<th><?php echo __l('Credits'); ?></th>
										<?php endif; ?>
										<th><?php echo __l('Action'); ?></th>
									</tr>
								<?php endif; ?>
								<tr>
									<td><?php echo $this->Html->cText($orderItem['Product']['title']); ?></td>
									<td><?php echo $this->Html->cInt($orderItem['quantity']); ?></td>
									<td><?php echo $this->Html->cCurrency($orderItem['price']); ?></td>
									<td><?php echo $this->Html->cCurrency($orderItem['total_price']); ?></td>
									<?php if (Configure::read('module.buy_as_gift')) : ?>
										<td><?php echo !empty($orderItem['is_gift_wrap']) ? $this->Html->cBool($orderItem['is_gift_wrap']) : '-'; ?></td>
										<td><?php echo !empty($orderItem['gift_wrap_note']) ? $this->Html->cText($orderItem['gift_wrap_note']) : '-'; ?></td>
										<td><?php echo !empty($orderItem['gift_friend_email']) ? $this->Html->cText($orderItem['gift_friend_email']) : '-'; ?></td>
									<?php endif; ?>
									<?php if (Configure::read('module.credits')) : ?>
										<td><?php echo $this->Html->cCurrency($orderItem['credits']); ?></td>
									<?php endif; ?>
									<?php if (!empty($orderItem['Product']['is_having_file_to_download']) && !$orderItem['is_send_as_gift']): ?>
										<td><?php echo $this->Html->link(__l('Download'), array('controller' => 'products','action' => 'download', $orderItem['id']), array('title' => __l('Download'))); ?></td>
									<?php endif; ?>
								</tr>
								<?php 
									$i++;
									endforeach;
								?>
							</table>
						</div>
					</div>
				<?php endif; ?>
				<?php if (!empty($order['Order']['is_shipped_order'])): ?>
					<span><?php echo $this->Html->link(__l('Generate Address Label'), array('controller' => 'orders', 'action' => 'update_status', $order['Order']['id'], 'addresslabel'), array('title' => __l('Generate Address Label'))); ?></span>
				<?php endif; ?>
				<?php if (!empty($order['Order']['order_status_id']) && ($order['Order']['order_status_id'] == ConstOrderStatus::PaymentPending || $order['Order']['order_status_id'] == ConstOrderStatus::Expired)): ?>
					<span><?php echo $this->Html->link(__l('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['Order']['id']), array('class' => 'js-delete', 'title' => __l('Delete'))); ?></span>
				<?php endif; ?>
				<?php if (!empty($order['Order']['order_status_id']) && $order['Order']['order_status_id'] == ConstOrderStatus::InProcess): ?>
					<span><?php echo $this->Html->link(__l('Cancel'), array('controller' => 'payments', 'action' => 'order_cancel', $order['Order']['id']), array('class' => 'js-delete', 'title' => __l('Cancel'))); ?></span>
				<?php endif; ?>
			</td>
			<td class="dc"><?php echo '#'.$this->Html->cInt($order['Order']['id']);?></td>
			<td class="dl"><?php echo $this->Html->link($this->Html->cText($order['User']['username']), array('controller'=> 'users', 'action' => 'view', $order['User']['username']), array('escape' => false));?></td>
			<td class="dc"><?php echo $this->Html->cDateTime($order['Order']['created']);?></td>
			<td class="dc"><?php echo $this->Html->cCurrency($order['Order']['amount']);?></td>
			<td class="dc"><?php echo $this->Html->cText($order['OrderStatus']['name']);?></td>
			<?php if(empty($this->request->params['named']['status_filter_id']) || (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id']==ConstOrderStatus::InProcess))) : ?>
				<td class="dc"><?php echo ($order['Order']['paid_date']!='0000-00-00 00:00:00')?$this->Html->cDateTime($order['Order']['paid_date']):'-';?></td>
			<?php endif; ?>
			<?php if(empty($this->request->params['named']['status_filter_id']) || (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id']==ConstOrderStatus::Shipped || ($this->request->params['named']['status_filter_id']==ConstOrderStatus::Completed) ) )) : ?>
				<td class="dc"><?php echo ($order['Order']['shipped_date']!='0000-00-00 00:00:00')?$this->Html->cDateTime($order['Order']['shipped_date']):'-';?></td>
				<td class="dc"><?php echo !empty($order['Order']['shipping_remarks'])?$this->Html->cText($order['Order']['shipping_remarks']):'-';?></td>
			<?php endif; ?>
			<?php if(empty($this->request->params['named']['status_filter_id']) || (!empty($this->request->params['named']['status_filter_id']) && ($this->request->params['named']['status_filter_id']==ConstOrderStatus::CanceledAndRefunded))) : ?>
				<td class="dc"><?php echo ($order['Order']['canceled_date']!='0000-00-00 00:00:00')?$this->Html->cDateTime($order['Order']['canceled_date']):'-';?></td>
			<?php endif; ?>
			<td class="dc"><?php echo $this->Html->cInt($order['Order']['order_item_count']);?></td>
		<?php
				endforeach;
			else:
		?>
		<tr>
			<td colspan="14"><p class="notice"><?php echo __l('No orders available');?></p></td>
		</tr>
		<?php
			endif;
		?>
	</table>
	
	<?php if (!empty($moreActions)): ?>
	<div class="clearfix">
		<div class="admin-select-block grid_left">
			<div class="admin-select-option grid_left">
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
			</div>
		<div class="admin-checkbox-button grid_left"><?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?></div>
		<div class="submit-block clearfix hide"><?php echo $this->Form->submit('Submit'); ?></div>
		</div>
	<?php endif; ?>
	<div class="grid_right js-pagination"><?php echo $this->element('paging_links'); ?></div>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
</div>
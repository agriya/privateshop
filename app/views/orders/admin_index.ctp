<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="orders index js-response">
    <?php echo $this->Form->create('Order' , array('action' => 'admin_index', 'type' => 'post', 'class' => 'normal search-form clearfix ')); ?>
	<div class="clearfix">
		<?php $total_orders = 0; ?>
		<?php foreach($orderStatuses as $order_status_id => $order_status_name): ?>
			<?php $class = (!empty($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id'] == $order_status_id) ? ' active-filter' : null; ?>
		<?php endforeach; ?>
		<?php $total_orders = $expired_count + $payment_pending_count + $in_process_count + $canceled_count + $shipped_count + $completed_count; ?>
		<?php $class = (empty($this->request->params['named']['status_filter_id'])) ? ' active-filter' : null; ?>
<div class="product-chart-block order-chart-block clearfix round-5">
   <div class="order-chart grid_right">
			<?php $order_color_list = 'A5A5A5|C244AB|59BFB3|FB3C3C|D96666|3B4A04';
			$order_percentage = '';
			$order_percentage .= ($order_percentage != '') ? ',' : '';
			$order_percentage .= round((empty($expired_count)) ? 0 : ( ($expired_count / $total_orders) * 100 ));
			$order_percentage .= ($order_percentage != '') ? ',' : '';
			$order_percentage .= round((empty($payment_pending_count)) ? 0 : ( ($payment_pending_count / $total_orders) * 100 ));
			$order_percentage .= ($order_percentage != '') ? ',' : '';
			$order_percentage .= round((empty($in_process_count)) ? 0 : ( ($in_process_count / $total_orders) * 100 ));
			$order_percentage .= ($order_percentage != '') ? ',' : '';
			$order_percentage .= round((empty($canceled_count)) ? 0 : ( ($canceled_count / $total_orders) * 100 ));
			$order_percentage .= ($order_percentage != '') ? ',' : '';
			$order_percentage .= round((empty($shipped_count)) ? 0 : ( ($shipped_count / $total_orders) * 100 ));
			$order_percentage .= ($order_percentage != '') ? ',' : '';
			$order_percentage .= round((empty($completed_count)) ? 0 : ( ($completed_count / $total_orders) * 100 ));

			?>
            <?php echo $this->Html->image('http://chart.googleapis.com/chart?cht=p&chd=t:'.$order_percentage.'&chs=100x100&chco='.$order_color_list); ?>
	  </div>
 <ul class="product-chart order-chart clearfix">
			 <li class="new-order"><span class="new-order"><span><?php echo __l('New order'); ?></span></span>  </li>
				<li class="payment-pending new-product">
				<div class="pending-to-completed-block">&nbsp;</div>
				  <span class="waiting-esrow"><?php echo $this->Html->link(__l('Payment Pending') . ' (' . $this->Html->cInt($payment_pending_count, false).')', array('controller' => 'orders', 'action' => 'index', 'status_filter_id' => ConstOrderStatus::PaymentPending), array('class' => $class, 'title' => __l('Payment Pending').'('.$payment_pending_count.')'));?></span>
					<div class="winner-inner-block">
						<ul class="winner-inner-block">
							<li> <span class="bid-expired"><?php echo $this->Html->link(__l('Expired') . ' (' . $this->Html->cInt($expired_count, false).')', array('controller' => 'orders', 'action' => 'index', 'status_filter_id' => ConstOrderStatus::Expired), array('class' => $class, 'title' => __l('Expired').'('.$expired_count.')'));?></span></li>
						</ul>
					</div>
				</li>
				<li class="order-inprocess">
					<span class="order-inprocess"><?php echo $this->Html->link(__l('Inprocess') . ' (' . $this->Html->cInt($in_process_count, false).')', array('controller' => 'orders', 'action' => 'index', 'status_filter_id' => ConstOrderStatus::InProcess), array('class' => $class, 'title' => __l('Inprocess').'('.$in_process_count.')'));?></span>
						<ul class="inprocess">
						  <li class="cancelled"> <span class="cancelled"><?php echo $this->Html->link(__l('Canceled and Refunded') . ' (' . $this->Html->cInt($canceled_count, false).')', array('controller' => 'orders', 'action' => 'index', 'status_filter_id' => ConstOrderStatus::CanceledAndRefunded), array('class' => $class, 'title' => __l('Canceled and Refunded').'('.$canceled_count.')'));?></span></li>
						</ul>
					  </li>

				  <li class="order-skipped"> <span class="skipped"><?php echo $this->Html->link(__l('Shipped') . ' (' . $this->Html->cInt($shipped_count, false).')', array('controller' => 'orders', 'action' => 'index', 'status_filter_id' => ConstOrderStatus::Shipped), array('class' => $class, 'title' => __l('Shipped').'('.$shipped_count.')'));?></span></li>

				<li class="order-completed"> <span class="order-completed"><?php echo $this->Html->link(__l('Completed') . ' (' . $this->Html->cInt($completed_count, false).')', array('controller' => 'orders', 'action' => 'index', 'status_filter_id' => ConstOrderStatus::Completed), array('class' => $class, 'title' => __l('Completed').'('.$completed_count.')'));?></span> </li>
		  </ul>

      <div class="total round-5 <?php echo $class; ?>"><?php echo $this->Html->link(__l('All') . ': ' . $this->Html->cInt($total_orders, false), array('controller' => 'orders', 'action' => 'index'), array('class' => $class, 'title' => __l('All')));?></div>
</div>

  </div>
	<div class="clearfix"><div class="grid_left"><?php echo $this->element('paging_counter'); ?></div>
		<div class="filter-section clearfix grid_left">
  <div class="clearfix date-time-block">
				<div class="input date-time clearfix">
					<div class="js-datetime">
						<?php echo $this->Form->input('from_date', array('label' => __l('From'), 'type' => 'date', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'), 'orderYear' => 'asc')); ?>
					</div>
				</div>
				<div class="input date-time end-date-time-block clearfix">
					<div class="js-datetime">
						<?php echo $this->Form->input('to_date', array('label' => __l('To '),  'type' => 'date', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'), 'orderYear' => 'asc')); ?>
					</div>
				</div>
			</div>
			<?php echo $this->Form->input('status_filter_id', array('type' => 'hidden', 'value' => $this->request->params['named']['status_filter_id'])); ?>
		<div class="clearfix grid_left"><?php echo $this->Form->submit(__l('Search'));?></div>
	</div>
	</div>
	<?php echo $this->Form->end(); ?>
	<?php echo $this->Form->create('Order' , array('class' => 'normal', 'action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
	<table class="list">
		<tr>
			<?php if (!empty($moreActions)): ?>
				<th  class="select"></th>
			<?php endif; ?>
			<th  class="actions"><?php echo __l('Actions'); ?></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Order'), 'id'); ?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username'); ?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Quantity'), 'order_item_count'); ?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Amount (').Configure::read('site.currency').__l(')'), 'amount'); ?></div></th>
			<th><?php echo __l('Shipped'); ?></th>
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
				<td class="select"><?php echo $this->Form->input('Order.'.$order['Order']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$order['Order']['id'], 'label' => false, 'class' =>' js-checkbox-list')); ?></td>
			<?php endif; ?>
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
				<?php
				$total_shipped_amount = $total_gift_wrap_fee = 0;
				if (!empty($order['OrderItem'])): ?>
					<li><span><?php echo $this->Html->link(__l('View Ordered items'), '#', array('class' => 'order js-order-colorbox {"id":"js-order-item-' . $order['Order']['id'] . '"}', 'title' => __l('View Ordered items'))); ?></span>
					<div class="hide">
						<div id="js-order-item-<?php echo $order['Order']['id']; ?>">
							<h2><?php echo __l('Order details - #') . $order['Order']['id']; ?></h2>
							<table class="list">
								<tr>
									<th><?php echo __l('Product'); ?></th>
									<th><?php echo __l('Quantity'); ?></th>
									<th><?php echo __l('Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
									<th><?php echo __l('Total Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
								</tr>
								<?php foreach($order['OrderItem'] as $orderItem):
									$total_shipped_amount += $orderItem['shipping_price'];
									$total_gift_wrap_fee += $orderItem['gift_wrap_fee'];
								?>
									<tr>
										<td>
                                           <div class="clearfix">
                                             <span title="<?php echo $orderItem['OrderStatus']['name']; ?>" class="grid_right <?php echo 'round-3 order-statusbg order-status-'.strtolower(str_replace(" ","",$orderItem['OrderStatus']['name']));?>"><?php echo $this->Html->cText($orderItem['OrderStatus']['name']);?></span>
                                           </div>
                                           <?php echo $orderItem['Product']['title']; ?>
											<?php if(!empty($orderItem['ProductAttribute']['AttributesProductAttribute'])): ?>
											<?php foreach ($orderItem['ProductAttribute']['AttributesProductAttribute'] as $attribute){
												 $attribute_detail = $this->Html->getAttributeGroupDetails($attribute['attribute_id']); ?>
												<dl class="attribute-list1 clearfix">
												<dt class="grid_left"><?php echo $attribute_detail['AttributeGroup']['display_name']; ?>:</dt>
												<dd class="grid_left"><?php echo $attribute_detail['Attribute']['name']; ?></dd>
												</dl>
									   <?php } endif;?>
										</td>
										<td><?php echo $orderItem['quantity']; ?></td>
										<td><?php echo $orderItem['price']; ?></td>
										<td><?php echo $orderItem['total_price']; ?></td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
					</div>
					</li>
				<?php endif; ?>
				<?php if (!empty($order['Order']['is_shipped_order'])): ?>
					<li><span><?php echo $this->Html->link(__l('Generate Address Label'), array('controller' => 'orders', 'action' => 'updatestatus', $order['Order']['id'], 'addresslabel'), array('title' => __l('Generate Address Label'), 'class' => 'address-icon')); ?></span></li>
				<?php endif; ?>
				<?php if (!empty($order['Order']['order_status_id']) && ($order['Order']['order_status_id'] == ConstOrderStatus::PaymentPending || $order['Order']['order_status_id'] == ConstOrderStatus::Expired)): ?>
					<li><span><?php echo $this->Html->link(__l('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['Order']['id']), array('class' => 'js-delete delete', 'title' => __l('Delete'))); ?></span></li>
				<?php endif; ?>
				<?php if (!empty($order['Order']['order_status_id']) && $order['Order']['order_status_id'] == ConstOrderStatus::InProcess): ?>
					<li><span><?php echo $this->Html->link(__l('Cancel'), array('controller' => 'payments', 'action' => 'order_cancel', $order['Order']['id']), array('class' => 'js-delete delete', 'title' => __l('Cancel'))); ?></span></li>
					<li><span><?php echo $this->Html->link(__l('Shipped'), array('controller' => 'orders', 'action' => 'shipped', $order['Order']['id']), array('class' => 'shipped', 'title' => __l('Shipped'))); ?></span></li>
				<?php endif; ?>
				<li><span><?php echo $this->Html->link(__l('View Invoice'), array('controller' => 'orders', 'action' => 'view', $order['Order']['id'], 'admin' => false), array('title' => __l('View Invoice'), 'class' => 'invoice')); ?></span></li>
				<?php if (!empty($order['Order']['order_status_id']) && $order['Order']['order_status_id'] == ConstOrderStatus::Shipped): ?>
					<li><span><?php echo $this->Html->link(__l('Completed'), array('controller' => 'orders', 'action' => 'updatestatus', $order['Order']['id'], 'completed'), array('title' => __l('Completed'))); ?></span></li>
				<?php endif; ?>
				</ul>
						</div>
						<div class="action-bottom-block"></div>
					</div>
				</div>
			</td>
			<td class="dc">
			      <div class="clearfix">
                  <span title="<?php echo $order['OrderStatus']['name']; ?>" class="grid_right <?php echo 'round-3 order-statusbg order-status-'.strtolower(str_replace(" ","",$order['OrderStatus']['name']));?>"><?php echo $this->Html->cText($order['OrderStatus']['name']);?></span>
                   </div>
                  <div class="clearfix"><span class="grid_left order-id"><?php echo '#'.$this->Html->cInt($order['Order']['id']);?></span>
				  <span class="order-date grid_right"><?php echo $this->Html->cDateTime($order['Order']['created']);?></span></div>
			</td>
			<td><?php echo $this->Html->link($this->Html->cText($order['User']['username']), array('controller'=> 'users', 'action' => 'view', $order['User']['username']), array('escape' => false));?></td>
			<td><?php echo $this->Html->cInt($order['Order']['order_item_count']);?></td>
			<td><span class="order-amount"><?php echo $this->Html->cCurrency($order['Order']['amount']);?></span>
				<?php if($total_shipped_amount>0 || $total_gift_wrap_fee>0): ?>
				<p class="including">
					<span><?php echo __l('Including'); ?></span>

						<?php if($total_shipped_amount>0): ?>
						<span class="charge"><?php echo '+ '.$this->Html->cCurrency($total_shipped_amount).' '.__l('Shipping Charges'); ?></span>
						<?php endif; ?>
						<?php if($total_gift_wrap_fee>0): ?>
						<span class="charge"><?php echo '+ '.$this->Html->cCurrency($total_gift_wrap_fee).' '.__l('Gift Wrapper'); ?></span>
						<?php endif; ?>

				</p>
				<?php endif; ?>
			</td>
			<td><?php
				if($order['Order']['shipped_date']!='0000-00-00 00:00:00'):
					echo __l('Yes'). ' / '; ?>
					<span class="order-shipped-date"><?php echo $this->Html->cDateTime($order['Order']['shipped_date']); ?></span>
				<?php
				else:
					echo __l('No');
				endif;
				?></td>
            </tr>
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
	<?php if (!empty($orders)): ?>
	<?php if (!empty($moreActions)): ?>
		<div class="clearfix">
			<div class="admin-select-block grid_left">
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
			</div>
			<div class="admin-checkbox-button grid_4 grid_left">
				<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
			</div>
    <?php endif; ?>
			<div class="hide"><?php echo $this->Form->submit('Submit'); ?></div>
			<div class="grid_right js-pagination">
				<?php echo $this->element('paging_links'); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>
<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="orders index js-response">
	<h2 class="invoice-detail"><?php echo __l('Order details - #') . $order['Order']['id']; ?></h2>
	<div class="invoice-block clearfix">
	<div class="grid_8 omega">
	<dl class="list invoice clearfix">
	 <dt><?php echo __l('User:'); ?></dt>
	 <dd><?php echo $this->Html->link($this->Html->cText($order['User']['username']), array('controller'=> 'users', 'action' => 'view', $order['User']['username']), array('escape' => false));?></dd>
	</dl>
		<dl class="list invoice clearfix">
	 <dt><?php echo __l('Amount:'); ?></dt>
	 <dd><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($order['Order']['amount']));?></dd>
	</dl>
		<dl class="list invoice clearfix">
	 <dt><?php echo __l('Order Status:'); ?></dt>
	 <dd><?php echo $this->Html->cText($order['OrderStatus']['name']);?></dd>
	</dl>
		<dl class="list invoice clearfix">
	 <dt><?php echo __l('Quantity:'); ?></dt>
	 <dd><?php echo $this->Html->cInt($order['Order']['order_item_count']);?></dd>
	</dl>	</div>
	<div class="grid_8 alpha omega">
		<dl class="list invoice clearfix">
	 <dt><?php echo __l('Ordered date:'); ?></dt>
	 <dd><?php echo $this->Html->cDateTime($order['Order']['created']);?></dd>
	</dl>

 	<dl class="list invoice clearfix">
	 <dt><?php echo __l('Paid date:'); ?></dt>
	 <dd><?php echo ($order['Order']['paid_date']!='0000-00-00 00:00:00')?$this->Html->cDateTime($order['Order']['paid_date']):'Nil';?></dd>
	</dl>

	</div>
	<div class="grid_8 alpha omega">
	<?php if($order['Order']['is_shipped_order']): ?>
	<dl class="list invoice clearfix">
	 <dt class="grid_3"><?php echo __l('Shipped date:'); ?></dt>
	 <dd><?php echo ($order['Order']['shipped_date']!='0000-00-00 00:00:00')?$this->Html->cDateTime($order['Order']['shipped_date']):'Nil';?></dd>
	</dl>

	<dl class="list invoice clearfix">
	 <dt class="grid_3"><?php echo __l('Shipping Remarks:'); ?></dt>
	 <dd><?php echo !empty($order['Order']['shipping_remarks'])?$this->Html->cText($order['Order']['shipping_remarks']):'Nil';?></dd>
	</dl>
	<?php endif; ?>

	</div>
	</div>
<?php if (!empty($order['OrderItem'])): ?>
					<h3><?php echo __l('Ordered tems'); ?></h3>
						<div id="js-order-item-<?php echo $order['Order']['id']; ?>">
							<table class="list">
								<tr>
									<th><?php echo __l('Product'); ?></th>
									<th><?php echo __l('Quantity'); ?></th>
									<th><?php echo __l('Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
									<th><?php echo __l('Total Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
								</tr>
								<?php foreach($order['OrderItem'] as $orderItem): ?>
									<tr>
										<td><?php echo $orderItem['Product']['title']; ?></td>
										<td><?php echo $orderItem['quantity']; ?></td>
										<td><?php echo $orderItem['price']; ?></td>
										<td><?php echo $orderItem['total_price']; ?></td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
				
				<?php endif; ?>
<?php if($order['Order']['order_status_id'] == ConstOrderStatus::Shipped || $order['Order']['order_status_id'] == ConstOrderStatus::InProcess): ?>
	<div class="clearfix"><div class="set-complete">
		<?php echo $this->Html->link(__l('Set completed'), array('controller' => 'orders', 'action' => 'update_status', $order['Order']['id'],'checkqr'), array('title' => __l('Set completed'))); ?>
	</div>
	</div>
	<?php endif; ?>
</div>
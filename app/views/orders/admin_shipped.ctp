<?php /* SVN: $Id: admin_deduct_amount.ctp 3 2010-04-07 06:03:46Z siva_063at09 $ */ ?>
<div class="orders form js-response js-responses">
	<?php echo $this->Form->create('Order', array('action' => 'shipped/'.$orders[0]['Order']['id'], 'admin' => true, 	'class' => 'normal'));?>
		<fieldset>
			<?php $shipped = 0; ?>
			<?php foreach($orders as  $order): ?>
				<h3><?php echo __l('Order') . '#'.$this->Html->cInt($order['Order']['id']); ?></h3>
				<?php if($order['Order']['is_shipped_order'] && $order['Order']['order_status_id'] != ConstOrderStatus::Shipped): ?>
					<?php $shipped = 1; ?>
					<?php echo $this->Form->input('Order.' . $order['Order']['id'] . '.shipping_remarks', array('type' => 'textarea', 'label' => __l('Shipping Remarks'))); ?>
					<?php echo $this->Form->input('Order.' . $order['Order']['id'] . '.user_id', array('value' => $order['Order']['user_id'], 'type' => 'hidden', 'label' => false)); ?>
					<?php echo $this->Form->input('Order.' . $order['Order']['id'] . '.paid_date', array('value' => $order['Order']['paid_date'], 'type' => 'hidden', 'label' => false)); ?>
				<?php elseif($order['Order']['order_status_id'] == ConstOrderStatus::Shipped): ?>
					<p class="page-information"><?php echo __l('This order was already shipped'); ?></p>
				<?php else: ?>
					<p class="page-information"><?php echo __l('This order doesn\'t have any shipping'); ?></p>
				<?php endif; ?>
			<?php endforeach; ?>
		</fieldset> 
		<div class="submit-block clearfix">
			<?php 
				if (!empty($shipped)):
					echo $this->Form->submit(__l('Update'));
				endif;
			?>
			<div class="cancel-block">
				<?php echo $this->Html->link(__l('Cancel'), array('controller' => 'orders', 'action' => 'index'), array('title' => __l('Cancel'), 'escape' => false));?>
			</div>
		</div>
	<?php echo $this->Form->end();?>
</div>
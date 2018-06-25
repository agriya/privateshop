<div class="orders invoice content" id="orders-invoice">
	   <h3 class="invoice-detail"><?php echo __l('Invoice Details'); ?></h3>
	   <div class="clearfix">
		<p class="grid_left"> <?php echo __l('Order #').$order['Order']['id'].__l(' on ').$this->Html->Cdate($order['Order']['created']); ?>
		</p>
		<?php if(empty($this->request->params['named']['type'])) : ?>
		<span class='print grid_right'><?php echo $this->Html->link(__l('Print'), array('controller'=> 'orders', 'action' => 'view', $order['Order']['id'], 'type' => 'print', 'admin' => false), array('escape' => false, 'target' => '_blank')); ?></span>
		<?php endif; ?>
		</div>
	  <div class="clearfix invoice-block">
	    <div class="grid_left grid_11 alpha">
     	<?php if(!empty($order['PaymentGateway']['name'])): ?>
			<dl class="list invoice clearfix">
			<dt><span class="grid_left"><?php echo __l('Payment Method:'); ?></span></dt>
			<dd><?php echo $this->Html->cText($order['PaymentGateway']['name'],false); ?></dd>
			</dl>
		<?php endif;?>
			<dl class="list invoice clearfix">
			<dt><span class="grid_left"><?php echo __l('Payment Status:'); ?></span></dt>
			<dd><?php echo ($order['Order']['order_status_id']==ConstOrderStatus::PaymentPending)?__l('Payment Pending'):__l('Payment Made'); ?>
							<?php if (!empty($order['Order']['order_status_id']) && $order['Order']['order_status_id'] == ConstOrderStatus::PaymentPending): ?>
					<?php echo __l('('). $this->Html->link(__l('Pay Now'), array('controller' => 'payments', 'action' => 'order', 'order_id' => $order['Order']['id']), array('title' => __l('Pay Now'))).__l(')'); ?>
				<?php endif; ?>
			</dd>
			</dl>         
			<?php if($order['Order']['is_shipped_order']): ?>
			 <dl class="list invoice clearfix">
				<dt><span class="grid_left"><?php echo __l('Shipping Status:'); ?></span></dt>
				<dd>
				<?php if($order['Order']['order_status_id']==ConstOrderStatus::Shipped): ?>
				<?php echo __l('Shipped'); ?>
				 <?php else:?>
				<?php echo __l('Unshipped'); ?>
				<?php endif; ?>
			</dd>
			</dl>
			<?php endif; ?>
			
     	<?php if($order['Order']['order_status_id']==ConstOrderStatus::Shipped): ?>
			<dl class="list invoice clearfix">
			<dt><span class="grid_left"><?php echo __l('Shipping Remarks:'); ?></span></dt>
			<dd>
				<?php echo $this->Html->cText($order['Order']['shipping_remarks']); ?>
			</dd>
			</dl>
			<?php endif; ?>
			</div>
   <div class="grid_left grid_8">
     <p><?php echo ($order['SecondUser']['user_type_id']==ConstUserTypes::Admin)? '<span  class="seller-name grid_left"><span class="grid_left">'.__l('Seller:').'</span></span> '.Configure::read('site.name'):__l('Seller: ').$this->Html->link($this->Html->cText($order['SecondUser']['username']), array('controller'=> 'users', 'action'=>'view', $order['SecondUser']['username'] , 'admin' => false), array('escape' => false)); ?></p>
 	 <p><?php echo '<span class="seller-name grid_left"><span class="grid_left">'.__l('Buyer:').'</span></span> '.$this->Html->link($this->Html->cText($order['User']['username']), array('controller'=> 'users', 'action'=>'view', $order['User']['username'] , 'admin' => false), array('escape' => false)); ?></p>
		<?php if($order['Order']['is_shipped_order']): ?>
        <dl class="list invoice order-list clearfix">
         <dt><span class="grid_left"><?php echo __l('Ship to:'); ?></span></dt>
			<dd><p><?php echo $this->Html->cText($order['Order']['receiver_name']); ?></p>
			<p><?php echo $this->Html->cText($order['Order']['address']); ?></p>
			<p><?php echo $this->Html->cText($order['Order']['zipcode']); ?></p></dd>
        </dl>
		<?php endif; ?>
		</div>
	    <div class="grid_4 title-bar">
	 	<?php if($order['Order']['order_status_id']==ConstOrderStatus::Shipped || $order['Order']['order_status_id']==ConstOrderStatus::Completed || $order['Order']['order_status_id']==ConstOrderStatus::InProcess ): ?>
			<span class='rightAlign'><?php echo __l('#').$order['Order']['top_code']; ?></span>
		<?php endif; ?>
		<?php if($order['Order']['order_status_id']==ConstOrderStatus::Shipped || $order['Order']['order_status_id']==ConstOrderStatus::Completed || $order['Order']['order_status_id']==ConstOrderStatus::InProcess ): ?>
		<?php
				if(Configure::read('barcode.is_barcode_enabled') == 1) {
					$barcode_width = Configure::read('barcode.width');
					$barcode_height = Configure::read('barcode.height');
					if(Configure::read('barcode.symbology') == 'qr') {
					  $qr_site_url = Router::url(array(
							'controller' => 'orders',
							'action' => 'check_qr',
							$order['Order']['top_code'],
							$order['Order']['bottom_code'],
							'admin' => false
						) , true);
					  ?>
					   <img src="http://chart.apis.google.com/chart?cht=qr&chs=<?php echo $barcode_width; ?>x<?php echo $barcode_height; ?>&chl=<?php echo $qr_site_url; ?>" alt = "[Image: Order qr code]"/>
			<?php 
					} 
				}				
			?>			
				<span class='rightAlign'><?php echo __l('#').$order['Order']['bottom_code']; ?></span>
		<?php endif; ?>
		</div>
	</div>
		<table class="list ">
			<tr>
				<th class="dl"><?php echo __l('Product'); ?></th>
				<th><?php echo __l('Quantity'); ?></th>
				<th><?php echo __l('Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
				<?php if(Configure::read('module.credits')) : ?>
				<th><?php echo __l('Credits'); ?></th>
				<?php endif; ?>
				<?php if($order['Order']['is_shipped_order']): ?>
					<th><?php echo __l('Shipping Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
				<?php endif; ?>
				<th><?php echo __l('Total Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
			</tr>
			<?php
			$item_price=0;
			$ship_price=0;
			$gift_wrap_fee=0;

			foreach($order['OrderItem'] as $orderItem):
				
				$item_price=$item_price+($orderItem['price']);
				$ship_price=$ship_price+$orderItem['shipping_price'];
				$gift_wrap_fee = $gift_wrap_fee+$orderItem['gift_wrap_fee'];

				
			?>
				<tr>
					<td class="dl"><?php echo $this->Html->cText($orderItem['Product']['title'],false); ?>
					<?php if(!empty($orderItem['ProductAttribute']['AttributesProductAttribute'])): ?>
						<?php foreach ($orderItem['ProductAttribute']['AttributesProductAttribute'] as $attribute){ 
							 $attribute_detail = $this->Html->getAttributeGroupDetails($attribute['attribute_id']); ?>
							<dl class="attribute-list1 clearfix">
							<dt class="grid_left"><?php echo $attribute_detail['AttributeGroup']['display_name']; ?>:</dt>
							<dd class="grid_left"><?php echo $attribute_detail['Attribute']['name']; ?></dd>
							</dl>
				   <?php } endif;?>	</td>
					<td><?php echo $this->Html->cInt($orderItem['quantity']); ?></td>
					<td><?php echo  $this->Html->cCurrency($orderItem['price']); ?></td>
				
				<?php if(Configure::read('module.credits')) : ?>
			    <td>
				<?php if($orderItem['credits']) : ?>
				<?php echo $this->Html->cInt($orderItem['credits']); ?>
				<?php else: ?>
				<?php echo __l('-'); ?>
               <?php endif; ?>
                </td>
				 <?php endif; ?>
				<?php if($order['Order']['is_shipped_order']): ?>
					<td><?php echo ($orderItem['shipping_price']>0)?$this->Html->cCurrency($orderItem['shipping_price']):'-'; ?></td>
				<?php endif; ?>	
					<td><?php echo $this->Html->cCurrency($orderItem['total_price']); ?></td>
				</tr>
			<?php endforeach; ?>
			<?php 
				$colspan=5;
				if(Configure::read('module.credits')) :
				  $colspan=$colspan+1;
				endif;
			?>
			<tr>
                    <td colspan="<?php echo $colspan; ?>" align="right" class=" dr borderright invoiceTotal">
                        <p><span><?php echo __l('Item total:'); ?> </span><strong><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($item_price)); ?></strong></p>
						<?php if($order['Order']['is_shipped_order']): ?>
						<p class="clsMarginBottom25"><span><?php echo __l('Shipping fee:'); ?> </span><strong><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($ship_price)); ?></strong></p>
						<?php endif; ?>	
						<?php if(!empty($order['OrderItem'][0]['gift_wrap_fee'])): ?>
						<p class="clsMarginBottom25"><span><?php echo __l('Gift wrap fee:'); ?> </span><strong><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($gift_wrap_fee)); ?></strong></p>
						<?php endif; ?>
                        <p><span><?php echo __l('Grand total:'); ?> </span><strong><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($order['Order']['amount'])); ?></strong></p>
                    </td>
                </tr>
		</table>
	</div>
	
<?php if(!empty($this->request->params['named']['type']) && $this->request->params['named']['type']=='print') : ?>
<script>
     window.print();
</script>
<?php endif; ?>
		

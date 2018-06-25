<?php
     $div_height = 155;
	$readonly = false;
	if (!empty($is_show_confirm_order)):
		$readonly = true;
	endif;
?>

<?php if (!empty($order)): ?>
	<h2><?php echo __l('Order#') . $order['Order']['id']; ?></h2>
<?php else: ?>
	<div class="shopping-block">
		<h2><span class="icon-left"><span class="icon-right"><?php echo __l('Cart'); ?></span></span></h2>
	</div>
<?php endif; ?>
<div class="clearfix">
<div class="round-3 shipping-countinue grid_right">
<?php echo $this->Html->link(__l('Continue Shopping'), array('controller' => 'products', 'action' => 'index'), array('class'=>'shopping','title' => __l('Continue Shopping'))); ?>
</div>
</div>
<div class="table-outer-block">
<?php if (!empty($order)): ?>
	<?php echo $this->Form->create('Payment', array('url' => array('controller' => 'payments', 'action' => 'order', 'order_id' => $order['Order']['id']), 'class' => 'normal quantity-form', 'id' => 'PaymentOrderForm')); ?>
<?php elseif (!empty($this->request->params['named']['type'])): ?>
	<?php echo $this->Form->create('Payment', array('url' => array('controller' => 'payments', 'action' => 'order', 'type' => 'multiple'), 'class' => 'normal quantity-form', 'id' => 'PaymentOrderForm')); ?>
<?php else: ?>
	<?php echo $this->Form->create('Payment', array('action' => 'order', 'class' => 'normal quantity-form', 'id' => 'PaymentOrderForm')); ?>
<?php endif; ?>
<table class="list cart-list">
	<?php
		$rowspan = '';
	?>
	<tr>
		<th <?php echo $rowspan; ?> class="descripution-block"><?php echo __l('Product'); ?></th>
		<th<?php echo $rowspan; ?>><?php echo __l('Quantity'); ?></th>
		<th<?php echo $rowspan; ?>><?php echo __l('Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
		<?php if (!empty($this->request->params['named']['type'])): ?>
			<th<?php echo $rowspan; ?>><?php echo __l('Shipping Address'); ?></th>
		<?php endif; ?>
		<?php if (!empty($is_shipping_allowed_arr) || (!empty($order['Order']['is_shipped_order']))): ?>
			<th<?php echo $rowspan; ?> ><?php echo __l('Shipping Price') . ' (' . Configure::read('site.currency') . ')'; ?></th>
		<?php endif; ?>
		<?php if (Configure::read('module.buy_as_gift')): ?>
			<th<?php echo $rowspan; ?> ><?php echo __l('Gift'); ?></th>
		<?php endif; ?>
		<th><?php echo __l('Total') . ' (' . Configure::read('site.currency') . ')'; ?></th>
		<?php if (empty($order)): ?>
			<th<?php echo $rowspan; ?>><?php echo __l('Action'); ?></th>
		<?php endif; ?>
	</tr>
	<?php
		$is_show_checkout = 1;
		$total_commission_amount = $total_price = $is_show_shipping_address = $is_change_shipping_address = $is_remove_product = 0;
	?>
<?php if (empty($order)): ?>
	<?php if (!empty($carts)): ?>
		<?php foreach($carts as $cart): ?>
			<tr>
				<td class="user-block dl">
					<?php
					   if(!empty($cart['ProductAttribute']['id'])){
							$cart['Product']['quantity']  = $cart['ProductAttribute']['quantity'];
							$cart['Product']['sold_quantity']  = $cart['ProductAttribute']['sold_quantity'];
							$cart['Product']['original_price'] = $cart['ProductAttribute']['original_price'];
							$cart['Product']['discounted_price'] = $cart['ProductAttribute']['discounted_price'];
							echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.product_attribute_id', array('value' => $cart['ProductAttribute']['id'], 'type' => 'hidden'));
					   }
					   $cart['Product']['Attachment'][0] = !empty($cart['Product']['Attachment'][0]) ? $cart['Product']['Attachment'][0] : array();
					   if(!empty($cart['ProductAttribute']['Attachment']['id'])){
							$cart['Product']['Attachment'][0] = $cart['ProductAttribute']['Attachment'];
					   }
					?>
					  <div class="clearfix">
					  <div class="grid_8">
                <div class="grid_2 alpha omega">
                	<?php echo $this->Html->link($this->Html->showImage('Product', $cart['Product']['Attachment'][0], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($cart['Product']['title'], false)), 'title' => $this->Html->cText($cart['Product']['title'], false))), array('controller' => 'products', 'action' => 'view', $cart['Product']['slug'], 'admin' => false), array('title' => $this->Html->cText($cart['Product']['title'], false), 'target' => '_blank', 'class' => 'deal-image', 'escape' => false)); ?>
               </div>
                   <div class="user-inner-block grid_5">
                   <?php echo $this->Html->cText($this->Html->truncate($cart['Product']['description'],60)); ?>
				   <?php echo $this->Html->link($this->Html->cText($cart['Product']['title'], false), array('controller' => 'products', 'action' => 'view', $cart['Product']['slug']), array('title' => $this->Html->cText($cart['Product']['title'], false), 'target' => '_blank', 'escape' => false)); ?>
					<?php echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.product_id', array('value' => $cart['Cart']['product_id'], 'type' => 'hidden', 'label' => false)); ?>
			     	<?php echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.owner_user_id', array('value' => $cart['Product']['user_id'], 'type' => 'hidden', 'label' => false)); ?>
                                <?php if(!empty($cart['ProductAttribute']['AttributesProductAttribute'])):?>
 					<?php foreach ($cart['ProductAttribute']['AttributesProductAttribute'] as $attribute){
							 $attribute_detail = $this->Html->getAttributeGroupDetails($attribute['attribute_id']); ?>
							<dl class="attribute-list1 clearfix">
							<dt class="grid_left"><?php echo $attribute_detail['AttributeGroup']['display_name']; ?>:</dt>
							<dd class="grid_left"><?php echo $attribute_detail['Attribute']['name']; ?></dd>
							</dl>
				   <?php } endif;?>
				   <dl class="attribute-list1 clearfix">
						<dt class="grid_left"><?php echo __l('Type'); ?>:</dt>
						<dd class="grid_left"><?php echo !empty($cart['Product']['is_requires_shipping'])? 'Shippable': 'Downloadable'; ?></dd>
					</dl>
					       </div>
					       </div>
                    </div>
                </td>
				<td class="quantity-block">
					<?php
						$quantity_readonly = $readonly;
						if(!empty($cart['Product']['is_having_file_to_download'])){
							$quantity_readonly = true;
						}
						$quantity = !empty($this->request->data['Cart'][$cart['Cart']['id']]['quantity']) ? $this->request->data['Cart'][$cart['Cart']['id']]['quantity'] : $cart['Cart']['quantity'];
						if (!empty($cart['Cart']['is_available'])):
							echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.quantity', array('readonly' => $quantity_readonly, 'value' => $quantity, 'label' => false));
						endif;
						echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.available_quantity', array('type' => 'hidden', 'value' => $cart['Product']['quantity'] - $cart['Product']['sold_quantity'], 'label' => false));
						echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.maximum_quantity_to_buy_as_own', array('type' => 'hidden', 'value' => $cart['Product']['maximum_quantity_to_buy_as_own'], 'label' => false));
						if(Configure::read('module.credits') && $cart['Product']['is_credit_product']):
						echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.credits', array('type' => 'hidden', 'value' => $cart['Product']['credits'], 'label' => false));
						endif;

						if (Configure::read('module.buy_as_gift')):
							echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.maximum_quantity_to_send_as_gift', array('type' => 'hidden', 'value' => $cart['Product']['maximum_quantity_to_send_as_gift'], 'label' => false));
						endif;
						$current_total_price = $cart['Product']['discounted_price'] *$cart['Cart']['quantity'];
					?>
				</td>
				<td>
					<?php echo $this->Html->cCurrency($cart['Product']['discounted_price']); ?>
					<?php echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.price', array('value' => $cart['Product']['discounted_price'], 'type' => 'hidden', 'label' => false)); ?>
					<?php echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.cart_price', array('value' => $cart['Cart']['price'], 'type' => 'hidden', 'label' => false)); ?>
					<?php echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.is_requires_shipping', array('value' => $cart['Product']['is_requires_shipping'], 'type' => 'hidden', 'label' => false)); ?>
				</td>
				<?php if (!empty($this->request->params['named']['type'])): ?>
					<td>
						<?php
							if (!empty($cart['Product']['is_requires_shipping'])):
								echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.user_address_id', array('readonly' => $readonly, 'value' => !empty($cart['Cart']['user_address_id']) ? $cart['Cart']['user_address_id'] : $primary_address_id, 'options' => $userAddresses, 'type' => 'select', 'empty' => __l('Please Select'), 'label' => false));
							else:
								echo '-';
							endif;
						?>
					</td>
				<?php endif; ?>
				<?php if (!empty($is_shipping_allowed_arr[$cart['Cart']['id']])): ?>
					<?php
						$current_total_price += $cart['Cart']['shipping_price'];
					?>
					<td>
						<?php echo $this->Html->cCurrency($cart['Cart']['shipping_price']); ?>
						<?php echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.shipping_price', array('value' => $cart['Cart']['shipping_price'], 'type' => 'hidden', 'label' => false)); ?>
					</td>				
				<?php endif; ?>
				<?php if (Configure::read('module.buy_as_gift')): ?>
					<td class="buy-block <?php if (!empty($is_shipping_allowed_arr[$cart['Cart']['id']])): ?> buy-block1 <?php endif; ?>">
						<?php
							if (!$readonly):
								echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.is_send_as_gift', array('checked' => !empty($cart['Cart']['is_send_as_gift']) ? 'checked' : '', 'type' => 'checkbox', 'label' => __l('This will be a gift'), 'class' => 'js-gift-product {"id":"' . $cart['Cart']['id'] . '"}'));
							else:
						?>							
							<span class="js-gift-product {'id':'<?php echo $cart['Cart']['id']; ?>','value':'<?php echo $cart['Cart']['is_send_as_gift']; ?>'}">
							<dl class="clearfix list">
								<dt><?php echo __l('Gift:').' ';?></dt>
								<dd><?php echo !empty($cart['Cart']['is_send_as_gift']) ? __l('Yes') : __l('No');?></dd>
							</dl>
							</span>
							<?php
								echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.is_send_as_gift', array('value' => !empty($cart['Cart']['is_send_as_gift']) ? '1' : '0', 'type' => 'hidden', 'label' => false));
							endif;
						?>
						<div class="js-gift-fields-<?php echo $cart['Cart']['id']; ?> hide">
							<?php
                               $gift_wrap_note = !empty($this->request->data['Cart'][$cart['Cart']['id']]['gift_wrap_note']) ? $this->request->data['Cart'][$cart['Cart']['id']]['gift_wrap_note'] : $cart['Cart']['gift_wrap_note'];
								if($readonly){ 
									echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.gift_wrap_note', array('value' => $gift_wrap_note, 'type' => 'hidden'));
									?>
									<dl class="clearfix list">
										<dt><?php echo __l('Gift Notes:').' ';?></dt>
										<dd><?php echo $cart['Cart']['gift_wrap_note'];?></dd>
									</dl>
								<?php } else {
									echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.gift_wrap_note', array('value' => $gift_wrap_note, 'type' => 'textarea', 'label' => __l('Gift Notes:')));
								}
								if (!empty($cart['Product']['is_having_file_to_download']) || !empty($cart['Product']['is_credit_product'])): ?>
                                  <div class="friend-email">
                                <?php echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.gift_friend_email', array('readonly' => $readonly, 'value' => $cart['Cart']['gift_friend_email'], 'type' => 'text', 'label' => __l('Friend Email'))); ?>
                                </div>
							<?php endif;
								if (!empty($cart['Product']['is_requires_shipping'])):
									if (!$readonly):
										echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.is_gift_wrap', array('checked' => !empty($cart['Cart']['is_gift_wrap']) ? 'checked' : '', 'type' => 'checkbox', 'label' => __l('Gift Wrap'), 'info' => sprintf(__l('%s for one item. %s for each additional item.'), $this->Html->siteCurrencyFormat(Configure::read('buy_as_gift.gift_wrap_fee_for_one_item')), $this->Html->siteCurrencyFormat(Configure::read('buy_as_gift.gift_wrap_fee_for_additional_item')))));
									else: ?>
										<dl class="clearfix list">
											<dt><?php echo __l('Gift Wrap:').' ';?></dt>
											<dd><?php echo !empty($cart['Cart']['is_gift_wrap']) ? __l('Yes') : __l('No');?></dd>
										</dl>
										<?php 
										echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.is_gift_wrap', array('type' => 'hidden', 'type' => 'hidden', 'label' => false));
									endif;
									if (!empty($cart['Cart']['is_gift_wrap'])):
										if ($cart['Cart']['quantity'] > 1):
											$gift_wrap_fee = Configure::read('buy_as_gift.gift_wrap_fee_for_one_item') + (Configure::read('buy_as_gift.gift_wrap_fee_for_additional_item') * ($cart['Cart']['quantity']-1));
										else:
											$gift_wrap_fee = Configure::read('buy_as_gift.gift_wrap_fee_for_one_item');
										endif;
										$current_total_price += $gift_wrap_fee;
										?>
										<dl class="clearfix list">
											<dt><?php echo __l('Gift Wrap Fee:').' ';?></dt>
											<dd><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($gift_wrap_fee));?></dd>
										</dl>
										<?php 										
										echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.gift_wrap_fee', array('value' => $gift_wrap_fee, 'type' => 'hidden', 'label' => false));
									endif;
								endif;
							?>
						</div>
					</td>
				<?php endif; ?>
				<td>
					<?php
						echo $this->Html->cCurrency($current_total_price);
						echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.total_price', array('value' => $current_total_price, 'type' => 'hidden', 'label' => false));
						if (Configure::read('module.seller')):
							$total_commission_amount += $commission_amount = (($current_total_price * $cart['Product']['commission_percentage']) / 100) + $cart['Product']['bonus_amount'];
							echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.commission_amount', array('value' => $commission_amount, 'type' => 'hidden', 'label' => false));
						endif;
					?>
				</td>
				<td>
				   <div class="clearfix warning_inline">
					<?php
						if (empty($cart['Cart']['is_available']) || (isset($is_shipping_allowed_arr[$cart['Cart']['id']]) && empty($is_shipping_allowed_arr[$cart['Cart']['id']]))):
							$is_show_checkout = $is_show_confirm_order = 0;
							if (empty($cart['Cart']['is_available'])) {
								$is_remove_product = 1;
								echo __l('No longer available');
							} elseif (isset($is_shipping_allowed_arr[$cart['Cart']['id']]) && empty($is_shipping_allowed_arr[$cart['Cart']['id']])) {
								$is_show_checkout = $is_change_shipping_address = 1;
								echo __l('This product does not ship for your shipping address');
							}
						endif;
						if (!empty($cart['Product']['is_requires_shipping'])):
							$is_show_shipping_address++;
						endif;
					?>
					</div>
					<?php echo $this->Html->link(__l('Remove'), array('controller' => 'carts', 'action' => 'delete', $cart['Cart']['id']), array('class' => 'remove js-delete', 'title' => __l('Remove'))); ?>
					<?php //echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.id', array('type' => 'checkbox', 'label' => false)); ?>
				</td>
			</tr>
			<?php
                if(!empty($cart['Cart']['is_send_as_gift']))
                {
                   $div_height = $div_height + 223;
                }
                else
                {
                   $div_height  = $div_height + 155;
                }
				$total_price += $current_total_price;
			?>
		<?php endforeach; ?>
		<tr>
			<td class="dr total-block total-value1" colspan="<?php echo 4 + $this->Html->getColspan((!empty($this->request->params['named']['type'])) ? !empty($this->request->params['named']['type']) : '', !empty($is_shipping_allowed_arr) ? $is_shipping_allowed_arr : ''); ?>"><?php echo __l('Total'); ?></td>
			<td class="total-block total-value2">
				<?php
					echo $this->Html->siteCurrencyFormat($total_price);
					echo $this->Form->input('Payment.amount', array('value' => $total_price, 'type' => 'hidden', 'label' => false));
					if (!empty($this->request->params['named']['type'])):
						echo $this->Form->input('Payment.is_multiple_address', array('value' => 1, 'type' => 'hidden', 'label' => false));
					endif;
					if (Configure::read('module.seller')):
						echo $this->Form->input('Cart.' . $cart['Cart']['id'] . '.total_commission_amount', array('value' => $total_commission_amount, 'type' => 'hidden', 'label' => false));
					endif;
				?>
			</td>
		</tr>
	<?php else: ?>
		<tr>
			<td colspan="9"><p class="notice"><?php echo __l('There are no items in your shopping cart.'); ?></p></td>
		</tr>
	<?php endif; ?>
<?php else: ?>
	<?php if (!empty($order['OrderItem'])): ?>
		<?php $total_price = 0; ?>
		<?php foreach($order['OrderItem'] as $orderItem): ?>
			<?php $current_total_price = 0; ?>
			<tr>
				<td>
					<?php $orderItem['Product']['Attachment'][0] = !empty($orderItem['Product']['Attachment'][0]) ? $orderItem['Product']['Attachment'][0] : array(); ?>
					<?php echo $this->Html->link($this->Html->showImage('Product', $orderItem['Product']['Attachment'][0], array('dimension' => 'normal_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($orderItem['Product']['title'], false)), 'title' => $this->Html->cText($orderItem['Product']['title'], false))), array('controller' => 'products', 'action' => 'view', $orderItem['Product']['slug'], 'admin' => false), array('title' => $this->Html->cText($orderItem['Product']['title'], false), 'target' => '_blank', 'escape' => false)); ?>
					<?php echo $this->Html->cText($this->Html->truncate($orderItem['Product']['description'],60)); ?>
					<?php echo $this->Html->link($this->Html->cText($orderItem['Product']['title'], false), array('controller' => 'products', 'action' => 'view', $orderItem['Product']['slug']), array('title' => $this->Html->cText($orderItem['Product']['title'], false), 'target' => '_blank', 'escape' => false)); ?>
					<?php if(!empty($orderItem['ProductAttribute']['AttributesProductAttribute'])): ?>
 					<?php foreach ($orderItem['ProductAttribute']['AttributesProductAttribute'] as $attribute){
							 $attribute_detail = $this->Html->getAttributeGroupDetails($attribute['attribute_id']); ?>
							<dl class="attribute-list1 clearfix">
							<dt class="grid_left"><?php echo $attribute_detail['AttributeGroup']['display_name']; ?>:</dt>
							<dd class="grid_left"><?php echo $attribute_detail['Attribute']['name']; ?></dd>
							</dl>
				   <?php } endif;?>
				</td>
				<td><?php echo $this->Html->cInt($orderItem['quantity']); ?></td>
				<td>
					<?php
						echo $this->Html->cCurrency($orderItem['quantity'] * $orderItem['Product']['discounted_price']);
						$current_total_price += $orderItem['quantity'] * $orderItem['Product']['discounted_price'];
					?>
				</td>
				<?php if (!empty($order['Order']['is_shipped_order'])): ?>
					<td>
						<?php
							if (!empty($orderItem['shipping_price'])) {
								echo $this->Html->cCurrency($orderItem['shipping_price']);
								$current_total_price += $orderItem['shipping_price'];
							} else {
								echo '-';
							}
						?>
					</td>
				<?php endif; ?>
				<?php if (Configure::read('module.buy_as_gift')): ?>
					<td class="dc">
						<dl class="attribute-list1 clearfix">
							<dt class="grid_left"><?php echo __l('Gift: '); ?></dt>
								<dd class="grid_left"><?php echo $this->Html->cBool($orderItem['is_send_as_gift']); ?></dd>
                            </dl>
                             <dl class="attribute-list1 clearfix">
                                <dt class="grid_left"><?php echo __l('Gift Wrap Note: '); ?></dt>
								<dd class="grid_left"><?php echo (!empty($orderItem['gift_wrap_note'])) ? nl2br($this->Html->cText($orderItem['gift_wrap_note'])) : '-'; ?></dd>
                             </dl>
                               	<?php if (empty($order['Order']['is_shipped_order'])): ?>
                               <dl class="attribute-list1 clearfix">
                            	<dt class="grid_left"><?php echo __l('Friend Email: '); ?></dt>
									<dd class="grid_left"><?php echo (!empty($orderItem['gift_friend_email'])) ? $this->Html->cText($orderItem['gift_friend_email']) : '-'; ?></dd>
                               </dl>
                               	<?php else: ?>
                                <dl class="attribute-list1 clearfix">
                            	<dt class="grid_left"><?php echo __l('Gift Wrap Fee: '); ?></dt>
									<dd class="grid_left"><?php echo $this->Html->cCurrency($orderItem['gift_wrap_fee']); ?></dd>
                                  </dl>
								  <?php if (!empty($orderItem['gift_wrap_fee'])):
										if ($orderItem['quantity'] > 1):
											$gift_wrap_fee = Configure::read('buy_as_gift.gift_wrap_fee_for_one_item') + (Configure::read('buy_as_gift.gift_wrap_fee_for_additional_item') * ($orderItem['quantity']-1));
										else:
											$gift_wrap_fee = Configure::read('buy_as_gift.gift_wrap_fee_for_one_item');
										endif;
										$current_total_price += $gift_wrap_fee;
										endif;
										?>
                        	<?php endif; ?>
										</td>
				<?php endif; ?>
				<td class="dr"><?php echo $this->Html->cCurrency($current_total_price); ?></td>
			</tr>
			<?php $total_price += $current_total_price; ?>
		<?php endforeach; ?>
		<tr>
			<td class="dr" colspan="<?php echo 4 + $this->Html->getColspan('', !empty($is_shipping_allowed_arr) ? $is_shipping_allowed_arr : ''); ?>"><?php echo __l('Total'); ?></td>
			<td class="dr">
				<?php
					echo $this->Html->cCurrency($total_price);
					echo $this->Form->input('Payment.amount', array('value' => $total_price, 'type' => 'hidden', 'label' => false));
					echo $this->Form->input('Order.id', array('value' => $order['Order']['id'], 'type' => 'hidden', 'label' => false));
					if (!empty($this->request->params['named']['type'])):
						echo $this->Form->input('Payment.is_multiple_address', array('value' => 1, 'type' => 'hidden', 'label' => false));
					endif;
				?>
			</td>
		</tr>
	<?php endif; ?>
<?php endif; ?>
</table>
<?php if (!empty($is_remove_product) && !empty($is_change_shipping_address)): ?>
	<p class="info"><?php echo __l('Some of the products in your cart aren\'t available and does not ship to your shipping address. Please remove these products from your cart so you can checkout.'); ?></p>
<?php elseif (!empty($is_remove_product)): ?>
	<p class="info"><?php echo __l('Some of the products in your cart aren\'t available. Please remove these products from your cart so you can checkout.'); ?></p>
<?php elseif (!empty($is_change_shipping_address)): ?>
	<p class="info"><?php echo __l('Please change your shipping address so you can checkout.'); ?></p>
<?php endif; ?>

 
<?php if (!empty($is_show_confirm_order)): ?>
<div class="new-shipping-address-block">
  <h3><?php echo __l('Chekout Details'); ?></h3>
	<?php if (!empty($address)): ?>
     <?php
			echo __l('Shipping Address') . ': ' . $address; ?> 
			<?php
			echo $this->Form->input('address', array('type' => 'hidden', 'legend' => false, 'value' => $address));
		?>
		<?php
			if (!empty($user_address_id)):
				echo $this->Form->input('user_address_id', array('type' => 'hidden', 'legend' => false, 'value' => $user_address_id));
			endif;
		?>
	<?php endif; ?>
	<div class="payment-block">
	<?php echo $this->Form->input('payment_gateway_id', array('legend' => __l('Payment Gateway'), 'type' => 'radio', 'class' => 'js-payment-type')); ?>
  </div>
	<?php if (!empty($paymentGateways[ConstPaymentGateways::Wallet])): ?>
		<div class="js-wallet-connection <?php echo (!empty($this->request->data['Payment']['payment_gateway_id']) && $this->request->data['Payment']['payment_gateway_id'] == ConstPaymentGateways::Wallet) ? '' : 'hide'?>">
			<p class="js-user-available-balance {'balance':'<?php echo $user['User']['available_balance_amount']; ?>'}"><span class="info info1"><?php echo __l('Your available balance:').' '.$this->Html->siteCurrencyFormat($this->Html->cCurrency($user['User']['available_balance_amount']));?></span></p>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->submit(__l('Confirm Order') . ' (' . __l('With') . ' ' . $this->Html->siteCurrencyFormat($total_price) . ')', array('name' => 'data[Payment][confirm]','class' => ' js-update-order-field')); ?>
	</div>
<?php elseif (!empty($total_price) && $is_show_checkout): ?>
	<div class="user-login-block grid_23 clearfix">
		<div class="grid_12">
			<?php
				if (!$this->Auth->user('id')):
					echo $this->Form->input('User.username',array('label' => __l('Username'),'info' => __l('Must start with an alphabet. <br/> Must be minimum of 3 characters and <br/> Maximum of 20 characters <br/> No special characters and spaces allowed')));
					echo $this->Form->input('User.email',array('label' => __l('Email')));
					echo $this->Form->input('User.passwd', array('label' => __l('Password')));
				endif;
			?>
		</div>
	</div>

    

 <div class="new-shipping-address-block">

 	<?php if (!empty($is_show_shipping_address) && empty($this->request->params['named']['type'])): ?>
	  <h3><?php echo __l('Shipping Address Details');?></h3>
    	<?php if (!empty($userAddresses)): ?>
			<?php echo $this->Form->input('user_address_id', array('type' => 'select', 'empty' => __l('Please Select'), 'label' => __l('Shipping Address'), 'value' => $primary_address_id, 'class' => 'js-shipping-address')); ?>
		<?php endif; ?>
		<div class="js-new-shipping-address hide">
			<div class="clearfix">
			<div class="grid_left"><?php echo $this->Form->input('UserAddress.full_name'); ?></div>
			<div class="mapblock-info grid_left">
				<div class="clearfix address-input-block">
					<?php echo $this->Form->input('UserAddress.address', array('label' => __l('Address'), 'class' => 'js-preview-address-change', 'id' => 'UserAddressAddressSearch')); ?>
				</div>
				<?php
					echo $this->Form->input('UserAddress.country_id', array('id' => 'js-country_id', 'type' => 'hidden'));
					echo $this->Form->input('State.name', array('type' => 'hidden'));
					echo $this->Form->input('City.name', array('type' => 'hidden'));
				?>
				<div id="address-info" class="hide"><?php echo __l('Please select correct address value'); ?></div>
				<div id="mapblock">
					<div id="mapframe">
						<div id="mapwindow"></div>
					</div>
				</div>
			</div>
			</div>
           <div class="clearfix">
			<div class="grid_left"><?php echo $this->Form->input('UserAddress.zipcode'); ?></div>
			<div class="grid_left"><?php echo $this->Form->input('UserAddress.phone');	?></div>
			</div>
		</div>
		<?php if ($is_show_shipping_address > 1): ?>
			<?php echo $this->Html->link(__l('Ship to multiple addresses'), array('controller' => 'payments', 'action' => 'order', 'type' => 'multiple'), array('class'=>'shopping-block','title' => __l('Ship to multiple addresses'))); ?>
			<?php if (!$this->Auth->user('id')): ?>
				<span class="info"><?php echo __l('This will work only after logged in.'); ?></span>
			<?php endif; ?>
		<?php endif; ?>
	<?php elseif (!empty($is_show_shipping_address)): ?>
	   <?php echo $this->Html->link(__l('Ship to one address'), array('controller' => 'payments', 'action' => 'order'), array('class'=>'shopping-block','title' => __l('Ship to one address'))); ?>
    <?php endif; ?>

    </div>
	<div class="shopping-block-bottom">
	    <?php //echo $this->Form->submit(__l('Remove from cart'), array('name' => 'data[Payment][remove]')); ?>
     <div class="submit-block clearfix">
         	<?php echo $this->Form->submit(__l('Proceed to checkout'), array('name' => 'data[Payment][checkout]')); ?>
    </div>
    <div class="submit-block clearfix">
         <?php echo (!$readonly) ? $this->Form->submit(__l('Update cart'), array('name' => 'data[Payment][update]')) : ''; ?>
    </div>
    </div>
<?php endif; ?>
<?php echo $this->Form->end(); ?>

<!-- Login Area -->
<?PHP if (!$this->Auth->sessionValid()): ?>
<?php if (!empty($total_price) && $is_show_checkout): ?>
<div class="login-right-block js-right-block" style="top:<?PHP echo $div_height;?>px;">
            <div class="login-message-lineheight js-login-message ">
                <h3><?php echo __l('Already Have An Account?');?></h3>

                <div class="clearfix">
                 <p class="login-info-block grid_right"><?php echo sprintf(__l('If you have purchased a %s before, you can sign in using your %s.'), Configure::read('site.name'),Configure::read('user.using_to_login')); ?></p>
                <div class="cancel">
                    <?php echo $this->Html->link(__l('Login'), '#', array('title' => __l('Sign In'), 'class' => "cancel js-toggle-show-login {'container':'js-login-form', 'hide_container':'js-login-message'}"));?>
                </div>
                </div>

            </div>
            <div class="js-login-form hide">
              <?php
	            	echo $this->element('users-login', array('call_page'=> 'order', 'config' => 'sec', 'f' => $this->request->url));
              ?>
            </div>
    </div>
<?PHP  endif; ?>
<?PHP  endif; ?>
</div>

<?php /* SVN: $Id: $ */ ?>
<h2><?php echo __l('Add Amount to Wallet');?></h2>
<div class="container_24 payments order add-wallet js-responses js-main-order-block js-submit-target-block space-top">
	
	<?php echo $this->Form->create('User', array('action' => 'add_to_wallet', 'id' => 'PaymentOrderForm', 'class' => 'js-submit-target normal')); ?>
		
		<div class="padd-center main-section">
		<div class="current-balance content-info">
		<span><?php echo __l('Your current available balance:').' '. Configure::read('site.currency').$user_info['User']['available_wallet_amount'];?></span>
		</div>
			<?php
				echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Auth->user('id')));
				if (!Configure::read('wallet.max_wallet_amount')):
					$max_amount = 'No limit';
				else:
					$max_amount = Configure::read('site.currency').Configure::read('wallet.max_wallet_amount');
				endif;
				echo $this->Form->input('amount', array('label' => __l('Amount (').configure::read('site.currency').__l(')')));
				echo $this->Form->input('type', array('type' => 'hidden'));

			?>
			<?php echo $this->Form->input('payment_gateway_id', array('legend' => false, 'type' => 'radio', 'options' => $gateway_options['paymentGateways'], 'class' => 'js-payment-type')); ?>
			<div class="clearfix states-block payment-states-block">
			
				<div class="js-paypal-main <?php echo (!empty($this->request->data['User']['payment_gateway_id']) && $this->request->data['User']['payment_gateway_id'] == ConstPaymentGateways::PayPal) ? "" : ''?> ">
					<!-- USING CONNECT -->
					<?php if (Configure::read('property.is_paypal_connection_enabled')): ?>
						<div class="js-connected-paypal property-stats buying-bg">
							<h3><?php echo __l('Pay With Connected PayPal'); ?></h3>
							<?php if (Configure::read('property.is_paypal_connection_enabled') && !empty($userPaypalConnections)){ ?>
								<div class="option-block clearfix">
									<?php echo $this->Form->input('user_paypal_connection_id', array('type' => 'radio', 'options' =>$userPaypalConnections, 'legend' => false)); ?>
								</div>
								<div class="clearfix"><?php echo $this->Form->submit(__l('Pay with connected PayPal'), array('name' => 'data[User][adaptive_connect]','div'=>false, 'class' => 'js-update-paymentgateway-field paypal-block'));?></div>
							<?php } else { ?>
								<p class="notice">
									<?php echo __l('No PayPal Connection Available.'); ?>
									<?php echo $this->Html->link(__l('Connect Now'), array('controller' => 'user_paypal_connections', 'action' => 'index'), array('title' => __l('Connect Now'))); ?>
								</p>
								<div class="page-information clearfix">
									<?php  echo sprintf(__l('You can connect your PayPal account with %s. To connect your account, you\'ll be taken to paypal.com and once connected, you can make orders without leaving to paypal.com again. Note: We don\'t save your PayPal password and the connection is enabled through PayPal standard alone. Anytime, you can disable the connection.'), Configure::read('site.name')); ?>
								</div>
							<?php } ?>
						</div>
					<?php endif; ?>
					<!-- USING NORMAL -->
					<div class="js-normal-paypal user-stats pay-paypal buying-bg">
						<h3><?php echo __l('Pay With PayPal'); ?></h3>
						<div class="page-information clearfix"><?php echo __l('This will take you to the paypal.com'); ?></div>
						<div class="submit-block clearfix">
							<?php echo $this->Form->submit(__l('Pay with PayPal'), array('name' => 'data[User][adaptive_normal]', 'id'=>'pay_button','class' => 'paypal-block'));?>
						</div>
					</div>
				</div>
			
			</div>
		</div>

	<?php echo $this->Form->end();?>
</div>
<?php 
	if (Configure::read('paypal.is_embedded_payment_enabled')):
		echo $this->element('js-embedded-paypal', array('config' => 'sec'));
	endif;
?>
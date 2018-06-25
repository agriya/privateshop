<?php /* SVN: $Id: $ */ ?>
<h2><?php echo __l('Add Amount to Wallet');?></h2>
<div class="common-outet-block">
	<div class="page-info">
		<?php echo __l('Your current available balance') . ': ' . $this->Html->siteCurrencyFormat($this->Html->cCurrency($user['User']['available_balance_amount']));?>
	</div>
	<?php
		echo $this->Form->create('Payment', array('action' => 'add_to_wallet', 'class' => 'normal add-form'));
		echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Auth->user('id')));
		if (!Configure::read('wallet.max_wallet_amount')):
			$max_amount = 'No limit';
		else:
			$max_amount = $this->Html->siteCurrencyFormat($this->Html->cCurrency(Configure::read('wallet.max_wallet_amount')));
		endif;
		$info = sprintf(__l('Minimum amount: %s, Maximum Amount: %s'),$this->Html->siteCurrencyFormat($this->Html->cCurrency(Configure::read('wallet.min_wallet_amount'))), $max_amount);
		echo $this->Form->input('amount', array('label' => __l('Amount') . ' (' . Configure::read('site.currency') . ')', 'info' => $info));
		echo $this->Form->input('payment_gateway_id', array('legend' => __l('Payment Gateway'), 'type' => 'radio', 'class' => 'js-payment-type'));
		?>
		<div class="submit-block clearfix">
			<?php echo $this->Form->Submit(__l('Add to wallet'));?>
		</div>
		<?php echo $this->Form->end(); ?>
</div>
<?php /* SVN: $Id: add.ctp 47846 2011-03-23 11:02:48Z josephine_065at09 $ */ ?>
<div class="userCashWithdrawals form js-ajax-form-container js-responses">
	<div class="page-info">
    	<?php 
		if(!empty($massPayEnabledCount)){
			echo __l('The requested amount will be deducted from your wallet and the amount will be blocked until it get approved or rejected by the administrator. Once its approved, the requested amount will be sent to your paypal account. In case of failure, the amount will be refunded to your wallet.');
         }else{
			echo __l('The requested amount will be deducted from your wallet and the amount will be blocked until it get approved or rejected by the administrator. Once its approved, the requested amount will be manually pay to you.');
		 }?>
    </div>
    <?php echo $this->Form->create('UserCashWithdrawal', array('action' => 'add','class' => "normal js-ajax-add-form {container:'js-ajax-form-container',responsecontainer:'js-responses'}"));?>
	<fieldset>
	<?php
		if(Configure::read('site.currency_symbol_place') == 'left'):
			$currecncy_place = 'between';
		else:
			$currecncy_place = 'after';
		endif;	
	?>	
	<?php
	
			$min = Configure::read('user.minimum_withdraw_amount');
			$max = Configure::read('user.maximum_withdraw_amount');	
	
		echo $this->Form->input('amount',array($currecncy_place => '<span class="currency">'.Configure::read('site.currency').'</span>' ));
		?>
		<span class="info"> <?php echo sprintf(__l('Minimum withdraw amount: %s <br/> Maximum withdraw amount: %s'),$this->Html->siteCurrencyFormat($this->Html->cCurrency($min)),$this->Html->siteCurrencyFormat($this->Html->cCurrency($max))); ?> </span>
		<?php
		echo $this->Form->input('user_id',array('type' => 'hidden'));
		echo $this->Form->input('user_type_id',array('type' => 'hidden','value'=>$this->Auth->user('user_type_id')));
	?>
	</fieldset>
        <div class="submit-block clearfix">
        <?php
        	echo $this->Form->submit(__l('Withdraw and Confirm'));
        ?>
        </div>
        <?php
        	echo $this->Form->end();
        ?>
</div>

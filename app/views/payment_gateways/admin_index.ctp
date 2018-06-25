<?php /* SVN: $Id: admin_index.ctp 2741 2010-08-13 15:30:58Z boopathi_026ac09 $ */ ?>
<div class="home-page-block js-response">
<?PHP
    unset($wallet_enabled);
    unset($paypal_enabled);
    foreach ($paymentGateways as $paymentGateway1):
      if($paymentGateway1['PaymentGateway']['id'] == ConstPaymentGateways::Wallet):
         if($paymentGateway1['PaymentGateway']['is_active'] == '1')
         {
            $wallet_enabled = $paymentGateway1['PaymentGateway']['is_active'];
         }
      endif;
      if($paymentGateway1['PaymentGateway']['id'] == ConstPaymentGateways::PayPal):
         if($paymentGateway1['PaymentGateway']['is_active'] == '1')
         {
            $paypal_enabled = $paymentGateway1['PaymentGateway']['is_active'];
         }
      endif;
    endforeach;?>



<?PHP
   $message = '';
   $payment_class = '';
   if(isset($wallet_enabled) && isset($paypal_enabled)) {
    $message = __l('Read the warning carefully and enable appropriate options for your website.');
    $payment_class = "content-info master-page-info1";
} else if(isset($wallet_enabled) && (!isset($paypal_enabled))) {
   $message = __l('Site cannot work with "Wallet" option alone. This is added as
a provision to integrate other payment gateway solutions.');
   $payment_class = "content-info master-page-info1";
 } else if(isset($paypal_enabled) && (!isset($wallet_enabled))) {
$message = __l("Read the warning carefully. This is recommended by PayPal, but
read the caveats and understand clearly.");
   $payment_class = "content-info master-page-info";
   } else if(!isset($paypal_enabled) && (!isset($wallet_enabled))) {
$message = __l("Site cannot work without enabling anyone of the payment gateways.");
   $payment_class = "content-info master-page-info1";
   }
?>


<div id = "payment_msg" class="<?PHP echo $payment_class; ?>"><?PHP echo $message; ?></div>

<div><?php echo $this->element('paging_counter');?></div>
<table class="list">
   <tr>
        <th rowspan="3"><?php echo __l('Action');?></th>
        <th rowspan="3"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('display_name'));?></div></th>
		<th colspan="5"><?php echo __l('Settings');?></th>
	</tr>
	<tr>
        <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Active'),'is_active');?></div></th>
        <th rowspan="2"><?php echo __l('Live Mode');?></th>
		<th colspan="3"><?php echo __l('Where to use?');?></th>
    </tr>
	<tr>
		<th><?php echo __l('Mass Pay');?></th>
		<th><?php echo __l('Enable for Purchase');?></th>
        <th><?php echo __l('Enable for Wallet');?></th>
    </tr>
<?php
if (!empty($paymentGateways)):

$i = 0;
foreach ($paymentGateways as $paymentGateway):
	$class = $active_class = null;
	$status_class = null;
	if ($i++ % 2 == 0) :
		$class = 'altrow';
	endif;
	if(!$paymentGateway['PaymentGateway']['is_active']){
		$active_class = ' inactive-record';
	}
	$paymentGateway['PaymentGateway']['is_live_mode'] = 1;
	if(!empty($paymentGateway['PaymentGateway']['is_test_mode'])){
		$paymentGateway['PaymentGateway']['is_live_mode'] = 0;
	}
?>
	<tr class="<?php echo $class.$active_class;?> ">
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
								<li><span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $paymentGateway['PaymentGateway']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span></li>
							</ul>
						</div>
						<div class="action-bottom-block"></div>
					</div>
				</div>
		</td>
		<td class="dl">
			<?php echo $this->Html->cText($paymentGateway['PaymentGateway']['name']);?>
			<span class="info"><?php echo $this->Html->cText($paymentGateway['PaymentGateway']['description']);?></span>
		</td>
		<td id='payment-id<?php echo $paymentGateway['PaymentGateway']['id']?>' class='tc <?php echo "admin-status-".$paymentGateway['PaymentGateway']['is_active']?> <?php echo ($paymentGateway['PaymentGateway']['is_active'] ==1)? 'js-active-gateways': 'js-deactive-gateways'; ?>'>
        <?php echo $this->Html->link(($paymentGateway['PaymentGateway']['is_active'] ==1)? "Yes": "No", array('action'=>'update', $paymentGateway['PaymentGateway']['id'], ConstMoreAction::Active, 'toggle' => ($paymentGateway['PaymentGateway']['is_active'] ==1)? 0: 1),array('class'=>'js-admin-update-status {is_active:"yes"}'));?>
		</td>
		<td class='tc <?php echo "admin-status-".$paymentGateway['PaymentGateway']['is_live_mode'];?> <?php echo ($paymentGateway['PaymentGateway']['is_test_mode'] ==1)? 'js-active-gateways': 'js-deactive-gateways'; ?>'>
			<?php echo ($paymentGateway['PaymentGateway']['id'] != ConstPaymentGateways::Wallet) ? $this->Html->link(($paymentGateway['PaymentGateway']['is_test_mode'] ==0)? "Yes": "No", array('action'=>'update', $paymentGateway['PaymentGateway']['id'], ConstMoreAction::TestMode, 'toggle' => ($paymentGateway['PaymentGateway']['is_test_mode'] ==1)? 0: 1),array('class'=>'js-admin-update-status {is_active:"yes"}')):'-';?>
		</td>
		<td class='tc <?php echo "admin-status-".$paymentGateway['PaymentGateway']['is_mass_pay_enabled']?>'><?php echo ($paymentGateway['PaymentGateway']['id'] != ConstPaymentGateways::Wallet) ? $this->Html->link(($paymentGateway['PaymentGateway']['is_mass_pay_enabled'] ==1)? "Yes": "No", array('action'=>'update', $paymentGateway['PaymentGateway']['id'], ConstMoreAction::MassPay, 'toggle' => ($paymentGateway['PaymentGateway']['is_mass_pay_enabled'] ==1)? 0: 1),array('class'=>'js-admin-update-status')):'-';?></td>
		<?php

		foreach($paymentGateway['PaymentGatewaySetting'] as $paymentGatewaySetting):
			if($paymentGatewaySetting['key'] == 'is_enable_for_purchase'): ?>
				<td class='tc <?php echo "admin-status-".$paymentGatewaySetting['test_mode_value']?>'><?php echo $this->Html->link(($paymentGatewaySetting['test_mode_value'] ==1)? "Yes": "No", array('action'=>'update', $paymentGateway['PaymentGateway']['id'], ConstMoreAction::Purchase, 'toggle' => ($paymentGatewaySetting['test_mode_value'] ==1)? 0: 1),array('class'=>'js-admin-update-status'));?>
			</td>
		<?php elseif($paymentGatewaySetting['key'] == 'is_enable_for_add_to_wallet'):
				 if($paymentGateway['PaymentGateway']['id'] != ConstPaymentGateways::Wallet):?>
					<td class='tc <?php echo "admin-status-".$paymentGatewaySetting['test_mode_value']?>'>
						<?php  echo $this->Html->link(($paymentGatewaySetting['test_mode_value'] ==1)? "Yes": "No", array('action'=>'update', $paymentGateway['PaymentGateway']['id'], ConstMoreAction::Wallet, 'toggle' => ($paymentGatewaySetting['test_mode_value'] ==1)? 0: 1),array('class'=>'js-admin-update-status'));?>
					</td>
				<?php
				else:?>
				<td class="tc"><?php echo '-'; ?></td>
		<?php	endif;
		endif;
		endforeach;?>


	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="9"><p class="notice"><?php echo __l('No Payment Gateways available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
<?php if (!empty($paymentGateways)): ?>
	<div class="clearfix">
		<div class="js-pagination grid_right">
			<?php echo $this->element('paging_links'); ?>
		</div>
		</div>
<?php endif; ?>
</div>
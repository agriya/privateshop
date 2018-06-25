<h2><?php echo __l('Money Transfer Accounts'); ?></h2>
<?php if(!empty($paymentGateways)): ?>
<div class="common-outet-block clearfix">
<div class="page-info master-page-info">
	<?php echo __l("In order to withdrawal cash/amount from your account balance in the site, You first need to create a 'Money transfer account'. You can also add multiple transfer accounts with different gateways and mark any one of them as 'Primary'. The approved withdrawal amount from your account balance will be credited to the 'Primary' marked transfer account.");?>
</div>

<div class="clearfix">
    <?php echo $this->element('money_transfer_accounts-add'); ?>
</div>
</div>
<div class="moneyTransferAccounts index">
<?php
?>
	<div class="space-top">
<?php echo $this->element('paging_counter');?>
</div>
<?php echo $this->Form->create('MoneyTransferAccount' , array('class' => 'normal money-transform-form table-form','action' => 'update')); ?>
<div class="table-outer-block">
<table class="list">
    <tr>
		<th class="dl"><?php echo __l('Action');?></th>
        <th><?php echo $this->Paginator->sort(__l('Payment Gateway'), 'PaymentGateway.name');?></th>
        <th><?php echo $this->Paginator->sort(__l('Primary'),'is_default');?></th>
    </tr>
<?php
if (!empty($moneyTransferAccounts)):
$i = 0;
foreach ($moneyTransferAccounts as $moneyTransferAccount):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td class="dl">
		<?php $options = array($moneyTransferAccount['MoneyTransferAccount']['id'] => ''); 
		echo $this->Form->input('MoneyTransferAccount.checked', array('type' => 'radio', 'options' => $options ,'div'=>false, 'label' => false, 'legend' => false)); ?><label for="MoneyTransferAccountChecked<?php echo $moneyTransferAccount['MoneyTransferAccount']['id']; ?>">
		<?php echo $this->Html->cText($moneyTransferAccount['MoneyTransferAccount']['account']);?></label></td>
    	<td class="dc"><?php echo $this->Html->cText($moneyTransferAccount['PaymentGateway']['name']);?></td>
		<td class="dc"><?php echo $this->Html->cBool($moneyTransferAccount['MoneyTransferAccount']['is_default']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="8" class="notice"><?php echo __l('No money transfer account available');?></td>
	</tr>
<?php
endif;
?>
</table>
</div>
<?php if (!empty($moneyTransferAccounts)):?>
<div class="primary-block clearfix">
<?php echo $this->Form->submit(__l('Mark as Primary'), array('name' => 'data[MoneyTransferAccount][default]'));?>
<?php echo $this->Form->submit(__l('Delete'), array('name' => 'data[MoneyTransferAccount][delete]'));?>
</div>
<?php endif;?>
<?php echo $this->Form->end(); ?>
<?php if (!empty($moneyTransferAccounts)):?>
		<?php
			echo $this->element('paging_links');
		?>
<?php endif;?>
</div>
<?php elseif($moneyTransferAccounts['is_mass_pay_enabled']==0):?>
<div class="common-outet-block clearfix">
<div class="page-info master-page-info">
	<?php echo __l("Mass pay are disabled. You can add withdraw request, admin will pay manually.");?>
</div>
</div>
<?php else:?>
<div class="common-outet-block clearfix">
<div class="page-info master-page-info">
	<?php echo __l("No money transfer gateways are enabled. You can add withdraw request, admin will pay manually.");?>
</div>
</div>
<?php endif;?>



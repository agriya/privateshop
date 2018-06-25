<?php /* SVN: $Id: index.ctp 47519 2011-03-21 09:29:14Z aravindan_111act10 $ */ ?>
<div class="userCashWithdrawals index js-response js-withdrawal_responses js-responses">
<h2><?php echo __l('Withdraw Fund Request');?></h2>
<div class="common-outet-block clearfix">
<?php
    if(!empty($massPayEnabledCount)) {
    if(!empty($moneyTransferAccounts)) {
    echo $this->element('../user_cash_withdrawals/add');
    } else{
?>
	<div class="page-info">
	<?php
		echo $this->Html->link(__l('Your money transfer account is empty, so click here to update money transfer account.'), array('controller' => 'money_transfer_accounts', 'action'=>'index'), array('title' => __l('money transfer accounts')));	
	?>
	</div>
<?php } ?>
<?php } else {?>
	<div class="page-info">
	<?php
		echo __l('Masspay is not enabled.');
	?>
	</div>
<?php }?>
</div>
<?php
if (!empty($massPayEnabledCount)):
?>
<div class="space-top">
<?php echo $this->element('paging_counter');?>
</div>
	<div class="table-outer-block">
<table class="list fund-list">
    <tr>
		<th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Requested On'), 'UserCashWithdrawal.created');?></div></th>
        <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Amount').' ('.Configure::read('site.currency').')', 'UserCashWithdrawal.amount');?></div></th>
        <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Status'),'WithdrawalStatus.name');?></div></th>
    </tr>
<?php
if (!empty($userCashWithdrawals)):
$i = 0;
foreach ($userCashWithdrawals as $userCashWithdrawal):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td class="dl"><?php echo $this->Html->cDateTime($userCashWithdrawal['UserCashWithdrawal']['created']);?></td>
    	<td><?php echo $this->Html->cCurrency($userCashWithdrawal['UserCashWithdrawal']['amount']);?></td>
		<td><?php echo $this->Html->cText($userCashWithdrawal['WithdrawalStatus']['name']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="8" class="notice"><?php echo __l('No withdraw fund requests available');?></td>
	</tr>
<?php
endif;
?>
</table>
</div>

<?php if (!empty($userCashWithdrawals)):?>
	<div class="js-pagination">
		<?php
			echo $this->element('paging_links');
		?>
	</div>
<?php endif;?>
<?php endif;?>
</div>
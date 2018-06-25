<?php /* SVN: $Id: admin_index.ctp 2077 2010-04-20 10:42:36Z josephine_065at09 $ */ ?>
	<?php
		if(!empty($this->request->params['isAjax'])):
			echo $this->element('flash_message');
		endif;
	?>
<?php $credit = 1;
$debit = 1;
$debit_total_amt = $credit_total_amt = $gateway_total_fee = 0;
if(!empty($this->request->params['named']['type']) && ($this->request->params['named']['type'] == ConstTransactionTypes :: AddedToWallet) && !empty($this->request->params['named']['stat'])) {
    $debit = 0;
}
if(!empty($this->request->params['named']['type']) && ($this->request->params['named']['type'] == ConstTransactionTypes::AcceptCashWithdrawRequest ) && !empty($this->request->params['named']['stat'])) {
    $credit = 0;

}?>
<div class="transactions index js-response js-responses">
	<div class="clearfix">
		<ul class="clearfix filter-list-block filter-list">
		<li <?php if (empty($this->request->params['named']['filter'])) { echo 'class="active"';} ?>><span class="yellow-block" title="<?php echo __l('Admin'); ?>"><?php echo $this->Html->link('<span>' .__l('Admin'). '</span>', array('controller'=>'transactions','action'=>'index'), array('escape' => false));?></span></li>
		<li <?php if (!empty($this->request->params['named']['filter']) && $this->request->params['named']['filter'] == 'all') { echo 'class="active"';} ?>><span class="import-block" title="<?php echo __l('All'); ?>"><?php echo $this->Html->link('<span>' .__l('All'). '</span>', array('controller'=>'transactions','action'=>'index','filter' => 'all'), array('escape' => false));?></span></li>
		</ul>
	</div>
<div class="page-count-block clearfix">
    <div class="grid_left">
    <?php echo $this->element('paging_counter');?>
    </div>
   <div class="grid_left ">
		<?php echo $this->Form->create('Transaction' , array('action' => 'admin_index', 'type' => 'post', 'class' => 'normal search-form clearfix ')); ?>
		<?php echo $this->Form->input('filter', array('type' => 'hidden')); ?>
		<div class="mapblock-info grid_left">
			<?php echo $this->Form->autocomplete('User.username', array('label' => __l('User'), 'acFieldKey' => 'Transaction.user_id', 'acFields' => array('User.username'), 'acSearchFieldNames' => array('User.username'), 'maxlength' => '255')); ?>
			<div class="autocompleteblock">
			</div>
		</div>
		<?php
		if(!empty($this->request->data['Transaction']['user_id'])) {
			echo $this->Form->input('user_hidden_id',array('type' => 'hidden', 'value' => $this->request->data['Transaction']['user_id']));
		}
		?>
         <div class="filter-section clearfix grid_left">
			<div class="clearfix date-time-block">
				<div class="input date-time clearfix">
					<div class="js-datetime">
						<?php echo $this->Form->input('from_date', array('label' => __l('From'), 'type' => 'date', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'), 'orderYear' => 'asc')); ?>
					</div>
				</div>
				<div class="input date-time end-date-time-block clearfix">
					<div class="js-datetime">
						<?php echo $this->Form->input('to_date', array('label' => __l('To '),  'type' => 'date', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'), 'orderYear' => 'asc')); ?>
					</div>
				</div>
			</div>
				<?php
			echo $this->Form->submit(__l('Filter'));
			 ?>
			 		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<div class="add-block1 grid_right">
    	<?php if(!empty($transactions)) { ?>
    	<?php echo $this->Html->link(__l('CSV'), array('controller' => 'transactions', 'action' => 'index', 'hash' => $export_hash, 'ext' => 'csv', 'admin' => true), array('class' => 'export', 'title' => __l('CSV'), 'escape' => false)); ?>
    	<?php } ?>
	</div>
	</div>
    <table class="list">
        <tr>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Date'), 'Transaction.created');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Description'),'TransactionType.name');?></div></th>
            <?php if(!empty($credit)){ ?>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Credit'), 'Transaction.amount');?></div></th>
            <?php } ?>
            <?php if(!empty($debit)){?>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Debit'), 'Transaction.amount');?></div></th>
            <?php } ?>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Gateway Fees ('.Configure::read('site.currency').')'), 'Transaction.gateway_fees');?></div></th>
        </tr>
    <?php
    if (!empty($transactions)):

    $i = 0;
    foreach ($transactions as $transaction):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
    ?>
        <tr<?php echo $class;?>>
                <td><?php echo $this->Html->cDateTimeHighlight($transaction['Transaction']['created']);?></td>
                <td class="dl">
                <?php
				//$attachment = array('id'=>$transaction['User']['attachment_id']);
				//echo $this->Html->showImage('UserAvatar', $attachment, array('dimension' => 'micro_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($transaction['User']['username'], false)), 'title' => $this->Html->cText($transaction['User']['username'], false)));?>
                <?php echo $this->Html->link($this->Html->cText($transaction['User']['username']), array('controller'=> 'users', 'action'=>'view', $transaction['User']['username'],'admin' => false), array('escape' => false, 'title' => $transaction['User']['username']));?></td>
                <td class="dl">
                    <?//php echo $this->Html->cText($transaction['TransactionType']['name']);?>
                    <?php
                        $class = $transaction['Transaction']['class'];
               			echo $this->Html->transactionDescription($transaction);
                    ?>
                </td>
                <?php if(!empty($credit)) {?>
                    <td class="dr">
                        <?php
                            if($transaction['TransactionType']['is_credit']):
                                echo $this->Html->siteCurrencyFormat($transaction['Transaction']['amount']);
								$credit_total_amt = $credit_total_amt + $transaction['Transaction']['amount'];
                            else:
                                echo '--';
                            endif;
                         ?>
                    </td>
                <?php } ?>
                <?php if(!empty($debit)) {?>
                    <td class="dr">
                        <?php
                            if($transaction['TransactionType']['is_credit']):
                                echo '--';
                            else:
							    $debit_total_amt = $debit_total_amt + $transaction['Transaction']['amount'];
                                echo $this->Html->siteCurrencyFormat($transaction['Transaction']['amount']);
                            endif;
                         ?>
                    </td>
                <?php } ?>
                <td class="dr">
					<?php
						echo $this->Html->cFloat($transaction['Transaction']['gateway_fees']);
						$gateway_total_fee = $gateway_total_fee + $transaction['Transaction']['gateway_fees'];
					?>
				</td>
            </tr>
    <?php
        endforeach;
	?>
	<tr class="total-block">
		<td colspan="3" class="dr"><?php echo __l('Total');?></td>
		 <?php if(!empty($credit)) {?>
		<td class="dr"><?php echo $this->Html->siteCurrencyFormat($credit_total_amt);?></td>
		 <?php } if(!empty($debit)) {?>
		<td class="dr"><?php echo $this->Html->siteCurrencyFormat($debit_total_amt);?></td>
		<?php } ?>
		<td class="dr"><?php echo $this->Html->siteCurrencyFormat($gateway_total_fee);?></td>
	</tr>
	<?php
    else:
    ?>
        <tr>
            <td colspan="11" class="notice"><?php echo __l('No Transactions available');?></td>
        </tr>
    <?php
    endif;
    ?>
    </table>
    <?php
    if (!empty($transactions)) {
        ?>
         <div class="clearfix">   <div class="js-pagination grid_right">
                <?php echo $this->element('paging_links'); ?>
            </div>
		</div>
        <?php
    }
    ?>
</div>
 
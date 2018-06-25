<?php /* SVN: $Id: admin_refunds.ctp 1675 2009-03-19 15:15:18Z shankar_92ag08 $ */
?>
<div class="home-page-block">
<div class="paypalTransactionLogs index">
<?php echo $this->element('paging_counter');?>
<div class="overflow-block">
<table class="list">
    <tr>
        <th rowspan = "2"><?php echo __l('Action');?></th>
		<th rowspan = "2"><?php echo $this->Paginator->sort(__l('Date'),'created');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('User'),'User.username');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Transaction ID'),'txn_id');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Item Name'),'txn_id');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('User email'),'payer_email');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Receiver email'),'receiver_email');?></th>
		<th rowspan = "2"><?php echo $this->Paginator->sort(__l('Amount').' ('.Configure::read('site.currency').')','mc_gross');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Fees').' ('.Configure::read('site.currency').')','mc_fee');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Currency Code'));?></th>
		<th rowspan = "2"><?php echo $this->Paginator->sort(__l('Status'), 'payment_status');?></th>
		<th rowspan = "2"><?php echo $this->Paginator->sort(__l('Error Number'), 'error_no');?></th>
		<th rowspan = "2"><?php echo $this->Paginator->sort(__l('Error Message'), 'error_message');?></th>
		<th rowspan = "2"><?php echo __l('Date');?></th>
        <th rowspan = "2"><?php echo __l('IP');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Payment Type'), 'payment_type');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Quantity'), 'quantity');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Payer Status'), 'payer_status');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Test ipn'), 'test_ipn');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Option Selection'), 'option_selection1');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Option Name'), 'option_name1');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Type'), 'type');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Auth Status'), 'auth_status');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Auth Exp'), 'auth_exp');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Transaction Entity'), 'transaction_entity');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Parent Transaction Id'), 'parent_txn_id');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Remaining Settle'), 'remaining_settle');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Auth Id'), 'auth_id');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Auth_amount'), 'Auth_amount');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Payment Gross'), 'payment_gross');?></th>
        <th rowspan = "2"><?php echo $this->Paginator->sort(__l('Ids'), 'ids');?></th>
	</tr>
	
    <tr>
       
    </tr>
    </tr>
<?php
if (!empty($paypalTransactionLogs)):

$i = 0;
foreach ($paypalTransactionLogs as $paypalTransactionLog):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	//if (!empty($paypalTransactionLog['PaypalTransactionLog']['error_no'])):
		//$class = ' class="error-log"';
	//endif;
	/////////////Quick fix//////////////////////
	if (empty($paypalTransactionLog['PaypalTransactionLog']['capture_ack']) && empty($paypalTransactionLog['PaypalTransactionLog']['void_ack']))
	{
		$class = ' class="error-log"';
	}
	if (!empty($paypalTransactionLog['PaypalTransactionLog']['capture_ack']))
	{
		$Pay_sts = 'Completed';
	}	
	elseif (!empty($paypalTransactionLog['PaypalTransactionLog']['void_ack']))
	{
		$Pay_sts = 'Canceled';
	}
	else
	{
		$Pay_sts = 'Pending';
	}
?>
	<tr<?php echo $class;?>>
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
                            <li><?php echo $this->Html->link(__l('View'), array('controller' => 'paypal_transaction_logs', 'action' => 'view', $paypalTransactionLog['PaypalTransactionLog']['id']), array('class' => 'view1', 'title' => __l('View')));?></li>
    					 </ul>
    					</div>
    					<div class="action-bottom-block"></div>
    				  </div>
              </div>
        </td>
		<td>			
			<?php echo $this->Html->cDateTime($paypalTransactionLog['PaypalTransactionLog']['created']) ;?>
		</td>
		<td><?php echo ($paypalTransactionLog['User']['username']) ? $this->Html->link($this->Html->cText($paypalTransactionLog['User']['username'], false), array('controller' => 'users', 'action' => 'view', $paypalTransactionLog['User']['username'], 'admin' => false), array('title' => $this->Html->cText($paypalTransactionLog['User']['username'], false))) : __l('New User');?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['txn_id']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['item_name']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['payer_email']);?></td>
		<td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['receiver_email']);?></td>
        <td><?php echo $this->Html->cFloat($paypalTransactionLog['PaypalTransactionLog']['mc_gross']);?></td>		
        <td><?php echo $this->Html->cFloat($paypalTransactionLog['PaypalTransactionLog']['mc_fee']);?></td>
        <td><?php echo __l($paypalTransactionLog['PaypalTransactionLog']['mc_currency']);?></td>
        <td><?php echo  $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['payment_status']) ;//$Pay_sts;?></td>
		<td><?php echo  $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['error_no']) ;?></td>
		<td><?php echo  $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['error_message']) ;?></td>
		<td><?php echo (!empty($paypalTransactionLog['PaypalTransactionLog']['created']) ? $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['created']) : '-');?></td>
        <td><?php echo (!empty($paypalTransactionLog['PaypalTransactionLog']['ip']) ? $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['ip']) : '-');?></td>

        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['payment_type']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['quantity']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['payer_status']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['test_ipn']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['option_selection1']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['option_name1']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['type']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['auth_status']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['auth_exp']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['transaction_entity']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['parent_txn_id']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['remaining_settle']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['auth_id']);?></td>
        <td><?php echo $this->Html->cFloat($paypalTransactionLog['PaypalTransactionLog']['auth_amount']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['payment_gross']);?></td>
        <td><?php echo $this->Html->cText($paypalTransactionLog['PaypalTransactionLog']['ids']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="26"><p class="notice"><?php echo __l('No Paypal Transaction Logs available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
</div>
<div class="clearfix">
<div class="grid_right">
<?php
if (!empty($paypalTransactionLogs)) {
    echo $this->element('paging_links');
}
?>
</div>
</div>
</div>
</div>

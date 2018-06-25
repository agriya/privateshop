<div class="js-response">
	<div class="page-info"><?php echo __l('Diagnostics are for developer purpose only.'); ?></div>
	<ul class="setting-links   clearfix">	
	        <li class="grid_12 omega alpha">
    			<div class="setting-details-info setting-details-info1 payment-transaction-log">
                    <h3><?php echo $this->Html->link(__l('Paypal Transaction Log'), array('controller' => 'paypal_transaction_logs', 'action' => 'index'),array('title' => __l('Paypal Transaction Log'))); ?></h3>
                    <div><?php echo __l('View the transaction logs  done via PayPal'); ?></div>
                </div>
            </li>
			<li class="grid_12 omega alpha">
    			<div class="setting-details-info setting-details-info1 debug-error">
                    <h3><?php echo $this->Html->link(__l('Debug & Error Log'), array('controller' => 'devs', 'action' => 'logs'),array('title' => __l('Debug & Error Log'))); ?></h3>
                    <div><?php echo __l('View debug, error log, used cache memory and used log memory'); ?></div>
                </div>
            </li>
    </ul>
</div>
<?php

?>
<h2><?php echo __l('Dashboard'); ?></h2>
<div class="balance-amount-info common-outet-block clearfix">
<div class="clearfix">
<p class="balance-list grid_left">
<?php echo __l('Balance ');?>
<?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($user_available_balance)); ?>
 </p>
 <?php if($is_wallet_enabled==1) {?>
  <p class="grid_right"><?php echo $this->Html->link(__l('Deposit'), array('controller' => 'payments', 'action' => 'add_to_wallet'), array('class' => 'add', 'title' => __l('Deposit'))); ?></p>
  <?php }?>
 </div>
 </div>
<div class="common-outet-block dashboard-outer-block clearfix">
<?php if (Configure::read('module.seller')): ?>
<div class="dashboard-filter-block dashboard-filter-block1">
	<h3><?php echo __l('Seller'); ?></h3>
	<h4><?php echo __l('Orders'); ?></h4>
      <ul class="dashboard-filter-list clearfix">
		<li><span class="all"><?php echo $this->Html->link(__l('All') . ': ' . $this->Html->cInt($user['User']['seller_order_count']), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders', 'admin' => false), array('class' => 'All', 'title' => __l('All'), 'escape' => false)); ?></span></li>
		<li><span class="paymentpending"><?php echo $this->Html->link(__l('Payment Pending') . ': ' . $this->Html->cInt($user['User']['seller_order_payment_pending_count']), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders', 'status_filter_id' => ConstOrderStatus::PaymentPending, 'admin' => false), array('class' => 'PaymentPending', 'title' => __l('Payment Pending'), 'escape' => false)); ?></span></li>
		<li><span class="inprocess"><?php echo $this->Html->link(__l('In Process') . ': ' . $this->Html->cInt($user['User']['seller_order_inprocess_count']), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders', 'status_filter_id' => ConstOrderStatus::InProcess, 'admin' => false), array('class' => 'InProcess', 'title' => __l('In Process'), 'escape' => false)); ?></span  class="all"></li>
		<li><span class="expired"><?php echo $this->Html->link(__l('Expired') . ': ' . $this->Html->cInt($user['User']['seller_order_expired_count']), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders', 'status_filter_id' => ConstOrderStatus::Expired, 'admin' => false), array('class' => 'Expired', 'title' => __l('Expired'), 'escape' => false)); ?></span></li>
		<li><span class="canceledandrefunded"><?php echo $this->Html->link(__l('Canceled and Refunded') . ': ' . $this->Html->cInt($user['User']['seller_order_canceled_count']), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders', 'status_filter_id' => ConstOrderStatus::CanceledAndRefunded, 'admin' => false), array('class' => 'CanceledAndRefunded', 'title' => __l('Canceled and Refunded'), 'escape' => false)); ?></span></li>
		<li><span class="shipped"><?php echo $this->Html->link(__l('Shipped') . ': ' . $this->Html->cInt($user['User']['seller_order_shipped_count']), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders', 'status_filter_id' => ConstOrderStatus::Shipped, 'admin' => false), array('class' => 'Shipped', 'title' => __l('Shipped'), 'escape' => false)); ?></span></li>
		<li><span class="completed"><?php echo $this->Html->link(__l('Completed') . ': ' . $this->Html->cInt($user['User']['seller_order_completed_count']), array('controller' => 'orders', 'action' => 'index', 'type' => 'manageorders', 'status_filter_id' => ConstOrderStatus::Completed, 'admin' => false), array('class' => 'Completed', 'title' => __l('Completed'), 'escape' => false)); ?></span></li>
       </ul>
</div>
<?php endif; ?>
<div class="dashboard-filter-block">
<h3><?php echo __l('Orders'); ?></h3>
<h4><?php echo __l('Purchases'); ?></h4>
</div>
<?php
     $total_orders = $user['User']['buyer_order_expired_count'] + $user['User']['buyer_order_payment_pending_count'] +  $user['User']['buyer_order_inprocess_count'] + $user['User']['buyer_order_canceled_count'] + $user['User']['buyer_order_shipped_count'] +  $user['User']['buyer_order_completed_count'];
?>
<div class="clearfix">
<div class="product-chart-block dashboard-chart-block round-5 grid_left">

  <ul class="product-chart order-chart clearfix">
   <li class="new-order"><span class="new-order"><span><?php echo __l('New order'); ?></span></span>  </li>
    <li class="payment-pending new-product">
	<div class="pending-to-completed-block">&nbsp;</div>
      <span class="waiting-esrow"><?php echo $this->Html->link(__l('Payment Pending') . ' (' .$this->Html->cInt($user['User']['buyer_order_payment_pending_count'], false).')', array('controller' => 'orders', 'action' => 'index', 'type' => 'mypurchases', 'status_filter_id' => ConstOrderStatus::PaymentPending), array('title' => __l('Payment Pending')));?></span>
	    <div class="winner-inner-block">
			<ul class="winner-inner-block">
				<li><span class="bid-expired"><?php echo $this->Html->link(__l('Expired') . ' (' .$this->Html->cInt($user['User']['buyer_order_expired_count'], false).')', array('controller' => 'orders', 'action' => 'index', 'type' => 'mypurchases', 'status_filter_id' => ConstOrderStatus::Expired), array('title' => __l('Expired')));?></span></li>
            </ul>
		</div>
    </li>
	<li class="order-inprocess"> 
		<span class="order-inprocess"><?php echo $this->Html->link(__l('Inprocess') . ' (' .$this->Html->cInt($user['User']['buyer_order_inprocess_count'], false).')', array('controller' => 'orders', 'action' => 'index', 'type' => 'mypurchases', 'status_filter_id' => ConstOrderStatus::InProcess), array('title' => __l('Inprocess')));?></span>
            <ul class="inprocess">
              <li class="cancelled"> <span class="cancelled"><?php echo $this->Html->link(__l('Canceled and Refunded') . ' (' .$this->Html->cInt($user['User']['buyer_order_canceled_count'], false).')', array('controller' => 'orders', 'action' => 'index', 'type' => 'mypurchases', 'status_filter_id' => ConstOrderStatus::CanceledAndRefunded), array('title' => __l('Canceled')));?></span></li>
            </ul>
          </li>
	  
	  <li class="order-skipped"> <span class="skipped"><?php echo $this->Html->link(__l('Shipped') . ' (' .$this->Html->cInt($user['User']['buyer_order_shipped_count'], false).')', array('controller' => 'orders', 'action' => 'index', 'type' => 'mypurchases', 'status_filter_id' => ConstOrderStatus::Shipped), array('title' => __l('Shipped')));?></span></li>
    
	<li class="order-completed"> <span class="order-completed"><?php echo $this->Html->link(__l('Completed') . ' (' .$this->Html->cInt($user['User']['buyer_order_completed_count'], false).')', array('controller' => 'orders', 'action' => 'index', 'type' => 'mypurchases', 'status_filter_id' => ConstOrderStatus::Completed), array('title' => __l('Completed')));?></span> </li>
  </ul>

  <?php
  if(!empty($total_orders)){
	$product_percentage = '';
	$product_percentage .= ($product_percentage != '') ? ',' : '';
		$product_percentage .= round((empty($user['User']['buyer_order_expired_count'])) ? 0 : ( ($user['User']['buyer_order_expired_count'] / $total_orders) * 100 ));
		$product_percentage .= ($product_percentage != '') ? ',' : '';
		$product_percentage .= round((empty($user['User']['buyer_order_payment_pending_count'])) ? 0 : ( ($user['User']['buyer_order_payment_pending_count'] / $total_orders) * 100 ));
		$product_percentage .= ($product_percentage != '') ? ',' : '';
		$product_percentage .= round((empty($user['User']['buyer_order_inprocess_count'])) ? 0 : ( ($user['User']['buyer_order_inprocess_count'] / $total_orders) * 100 ));
		$product_percentage .= ($product_percentage != '') ? ',' : '';
		$product_percentage .= round((empty($user['User']['buyer_order_canceled_count'])) ? 0 : ( ($user['User']['buyer_order_canceled_count'] / $total_orders) * 100 ));
        $product_percentage .= ($product_percentage != '') ? ',' : '';
		$product_percentage .= round((empty($user['User']['buyer_order_shipped_count'])) ? 0 : ( ($user['User']['buyer_order_shipped_count'] / $total_orders) * 100 ));
		$product_percentage .= ($product_percentage != '') ? ',' : '';
		$product_percentage .= round((empty($user['User']['buyer_order_completed_count'])) ? 0 : ( ($user['User']['buyer_order_completed_count'] / $total_orders) * 100 ));
?>
<div class="my-chart grid_right">
<?php	$host_color_list = 'A5A5A5|C244AB|59BFB3|FB3C3C|D96666|3B4A04';?>
             <?php echo $this->Html->image('http://chart.googleapis.com/chart?cht=p&chd=t:'.$product_percentage.'&chs=90x90&chco='.$host_color_list.'&chf=bg,s,FFFFFF00'); ?>
    </div>
    <?php } ?>
      <div class="total round-5"><?php echo $this->Html->link(__l('All') . ': ' . $this->Html->cInt($total_orders, false), array('controller' => 'orders', 'action' => 'index', 'type' => 'mypurchases'), array('title' => __l('All')));?></div>
</div>
  

			 </div>
</div>

<div class="order_address" id="orders-address">
<ol class="list">
<?php

if (!empty($orders)):

$i = 0;
foreach ($orders as $order):
	$class = null;
	if ($i++ % 2 == 0):
		$class = ' class="altrow"';
	endif;

?>

	<li>
	<dl class="list clearfix">
    	   <dt><?php echo __l('Name: ')?></dt>
    	   <dd><?php echo $order['Order']['receiver_name'];?></dd>
	</dl>
	<dl class="list clearfix">
    	   <dt><?php echo __l('Address: ')?></dt>
    	   <dd><?php echo $order['Order']['address'];?></dd>
	</dl>
	<dl class="list clearfix">
    	<dt><?php echo __l('Zip code: ');?></dt>
    	<dd><?php echo $order['Order']['zipcode'];?></dd>
	</dl>
	<dl class="list clearfix">
    	<dt><?php echo __l('Phone: ')?></dt>
    	<dd><?php echo $order['Order']['phone'];?></dd>
	</dl>

	</li>
<?php
    endforeach;
else:
?>
	<li>
		<td colspan="11"><p class="notice"><?php echo __l('No address available');?></p></td>
	</li>
<?php
endif;
?>
</ol>
</div>
<script>
     window.print();
</script>
<?php
echo $this->requestAction(array('controller' => 'orders', 'action' => 'index', 'type' => 'product_orders', 'product_id' => $product_id, 'admin' => false), array('return'));
?>
<?php
echo $this->requestAction(array('controller' => 'products', 'action' => 'index', 'type' => 'recommended', 'product_id' => $product_id), array('return'));
?>
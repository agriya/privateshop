<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="carts index">
<?php echo $this->element('paging_counter');?>
<ol class="list" start="<?php echo $this->Paginator->counter(array(
    'format' => '%start%'
));?>">
<?php
if (!empty($carts)):

$i = 0;
foreach ($carts as $cart):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cInt($cart['Cart']['id']);?></p>
		<p><?php echo $this->Html->cDateTime($cart['Cart']['created']);?></p>
		<p><?php echo $this->Html->cDateTime($cart['Cart']['modified']);?></p>
		<p><?php echo $this->Html->link($this->Html->cText($cart['User']['username']), array('controller'=> 'users', 'action' => 'view', $cart['User']['username']), array('escape' => false));?></p>
		<p><?php echo $this->Html->link($this->Html->cText($cart['Product']['title']), array('controller'=> 'products', 'action' => 'view', $cart['Product']['slug']), array('escape' => false));?></p>
		<p><?php echo $this->Html->cInt($cart['Cart']['quantity']);?></p>
		<p><?php echo $this->Html->cCurrency($cart['Cart']['price']);?></p>
		<p><?php echo $this->Html->cFloat($cart['Cart']['total_price']);?></p>
		<p><?php echo $this->Html->cBool($cart['Cart']['is_available']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $cart['Cart']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $cart['Cart']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No Carts available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($carts)) {
    echo $this->element('paging_links');
}
?>
</div>
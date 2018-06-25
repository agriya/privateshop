<?php if (!empty($products)):?>
<div class="slider-block">
<h3><?php echo __l('We Recommend'); ?></h3>
<div class="slider">			
	<ol class="slider-list clearfix">
	<?php foreach($products as $productList) :  ?> 
		<li>
		<?php  $productList['Attachment'][0] = !empty($productList['Attachment'][0]) ? $productList['Attachment'][0] : array(); ?>
		<?php echo $this->Html->link($this->Html->showImage('Product', $productList['Attachment'][0], array('dimension' => 'small_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($productList['Product']['title'], false)), 'title' => $this->Html->cText($productList['Product']['title'], false))), array('controller' => 'products', 'action' => 'view', $productList['Product']['slug'],  'admin' => false), array('title'=>$this->Html->cText($productList['Product']['title'],false),'escape' => false)); ?>
			<h3><?php echo $productList['Category']['name']; ?></h3>
			<h4><?php echo $this->Html->link($this->Html->cText($productList['Product']['title']), array('controller'=> 'products', 'action' => 'view', $productList['Product']['slug']), array('title'=>$productList['Product']['title'],'escape' => false));?></h4>
			<p class="price"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($productList['Product']['original_price'])); ?></p>
		</li>		
	 <?php	endforeach; ?>
	</ol>	
	<?php if (count($products)>=5):?>
	<div class="more-block grid_right">
	<?php echo $this->Html->link(__l('More'), array('controller'=> 'products', 'action' => 'index', 'category' => $productList['Category']['slug']), array('title'=>__l('More'),'escape' => false)); ?>
    </div>
	<?php endif; ?>
</div>
</div>
<?php endif; ?>
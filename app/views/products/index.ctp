<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="clearfix js-response">
<div class="products index properties-inner-page clearfix">
    <div class="grid_19 alpha omega properties-side1 grid_right">
	<?php if(!empty($this->request->params['named']['category'])) : ?>
	<h2><?php $i=1; $count=count($categoeyBreadCrumb);
	foreach($categoeyBreadCrumb as $categoryPath):
    if($count > $i ) : echo $this->Html->link($categoryPath['Category']['name']  , array('controller'=> 'categories', 'action' => 'view',  $categoryPath['Category']['slug']),array('title' => $categoryPath['Category']['name'])) .'<span> \</span>'. '<span>\ </span>' ;
	else : ?><?php echo $categoryPath['Category']['name']; endif; ?><?php $i++; endforeach;?>
	</h2>
	<?php endif; ?>
		<div class="sort-block clearfix">
            <?php if (!empty($products)){
					echo $this->element('paging_counter');
				}
			?>
            <div class="grid_left clearfix">
			<?php 
			$sorting= array('product_view_count' => __l('Views'), 'discounted_price' => __l('Price'), 'end_date' => __l('Ending Soon'), 'id' => __l('Latest'));
			if(empty($this->request->params['named']['sort'])):
              $this->request->params['named']['sort']='end_date';
              endif;
		?>
              <h5 class="sort grid_left"><?php echo __l('Sort by:'); ?></h5>
              <ul class="sort-list grid_left clearfix">
                <li class="filter-amount clearfix"><?php   echo $sorting[$this->request->params['named']['sort']];
				?>
                  <ul>
				  <?php unset($sorting[$this->request->params['named']['sort']]); 
				  foreach($sorting as $key => $val){ 
				    $options = array(
						'direction' => 'desc'
					);
					if($key == 'discounted_price'){
						$options['direction'] = 'asc';
					}
					if($key == 'end_date'){
						$options['direction'] = 'asc';
					}
				  ?>
				  <li><?php echo $this->Paginator->sort(__l($val), $key, $options);?></li>
                  <?php } ?> 
    			</ul>
                </li>
              </ul>
            </div>
          	<?php if (!empty($products)): echo $this->element('paging_links',array('page'=>'home')); endif; ?>
        </div>

<?php
if (!empty($products)):?>
 <ol class="list property-list clearfix">
<?php
$i = 0;
foreach ($products as $product):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = 'altrow';
	}
	$earily_status='';
	$discount = false;
	if($product['Product']['discount_amount'] > 0){
		$discount = true;
	}	
?>
		<li class="grid_left alpha omega">
        <?php $product['Attachment'][0] = !empty($product['Attachment'][0]) ? $product['Attachment'][0] : array(); ?>
		<?php echo $this->Html->link($this->Html->showImage('Product', $product['Attachment'][0], array('dimension' => 'medium_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $product['Product']['title']), 'title' => $product['Product']['title'])), array('controller' => 'products', 'action' => 'view', $product['Product']['slug'],  'admin' => false), array('title'=>$product['Product']['title'],'escape' => false)); ?>
			<span class="available-block <?php  if($product['Product']['quantity'] <= $product['Product']['sold_quantity']): echo __l('soldout-block'); endif; ?>"><?php  if($product['Product']['quantity'] > $product['Product']['sold_quantity']): echo __l('Available'); else: echo __l('Sold Out'); endif; ?> </span>
        	<div class="list-bottom-block property-title-block">
				<h3 class="grid_left"><?php echo $this->Html->link($this->Html->cText($product['Product']['title']), array('controller'=> 'products', 'action' => 'view', $product['Product']['slug']), array('title'=>$product['Product']['title'],'escape' => false));?></h3>
				<p class="grid_right"><span class="<?php echo ($discount)?'strike':''; ?>"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($product['Product']['original_price']));?></span><?php if($discount): ?> <?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($product['Product']['discounted_price']));?><?php endif;?></p>
			</div>
		</li>
<?php
    endforeach;

?>	
</ol>
<?php
else:
?>
<p class="notice"><?php echo __l('No Products available');?></p>
<?php
endif;
?>
<?php
if (!empty($products)) { ?>
<div class="sort-block1 clearfix">
<?php
    echo $this->element('paging_links',array('page'=>'home'));
?>
</div>
<?php
}
?>
</div>
<div class="grid_left alpha omega properties-side2">
<?php  echo $this->Form->create('Product', array('class' => 'properties-form js-ajax-search-form normal', 'action'=> 'index')); ?>
<?php
		if(!empty($this->request->params['named']['category'])):
			echo $this->Form->input('category',array('type'=>'hidden','value'=>$this->request->params['named']['category']));
		endif;
		?>
<?php if(!empty($this->request->params['named']['category'])) : ?>
  <div class="side1-outer-block clearfix">
    <h3><?php echo __l('Category'); ?></h3>
    <h4><?php echo __l($parentCategory['Category']['name']); ?></h4>
    <ol class="apparel-list">
	  <?php foreach($categoriesList as $category) :?>
      <li class="<?php echo ($this->request->params['named']['category'] == $category['Category']['slug'])? 'active':'';?>"><?php echo $this->Html->link($category['Category']['name'] , array('controller'=> 'products', 'action' => 'index', 'category' => $category['Category']['slug']),array('title' => $category['Category']['name'])); ?></li>
	  <?php endforeach; ?>
    </ol>
  </div>
  <?php endif; ?>
<?if(!empty($attributeGroups)):  ?>
  <div class="side2-outer-block clearfix">
  <?php foreach($attributeGroups as $attributeGroup):?>
  <h3><?php echo $attributeGroup['AttributeGroup']['display_name']?></h3>
    <div class="input select clearfix">
        <?php foreach($attributeGroup['Attribute'] as $attributes):?>
        <?php echo $this->Form->input('Product.'.'attribute.'.$attributeGroup['AttributeGroup']['id'].'.'.$attributes['id'].'.', array('type' => 'checkbox', 'label' => $attributes['name'], 'class' => 'js-search-ajax-submit checkbox')); ?>
        <?php
        endforeach; ?>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
   <div class="side2-outer-block clearfix">
    <h3><?php echo __l('Price')?></h3>
    <div class="input select">
       <?php $i=0; foreach($priceRanges as $priceRange):
       ?>
        <div class="checkbox">
        <?php echo $this->Form->input('Product.'.'pricerange.'.$i, array('type' => 'checkbox', 'label' => $priceRange['display'],'class' => 'js-search-ajax-submit checkbox')); ?>
        </div>
        <?php $i++;
        endforeach; ?>
    </div>
  </div>
  <div class="hide"> <?php echo $this->Form->submit('Submit');  ?> </div>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>
<?php /* SVN: $Id: $ */ ?>
<?php
	$class='';
	if(count($product['Attachment'])<=1)
	{
		$id='gallery';
	}
	else
	{
		$id='galleryView';
	}
?>
<div class="products view clearfix">
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
    <div class="breadcreamb-block clearfix">
	<?php $i=1; $count=count($categoeyBreadCrumb);
	foreach($categoeyBreadCrumb as $categoryPath):
    if($count > $i ): ?>
    <span><?php echo $this->Html->link($categoryPath['Category']['name']  , array('controller'=> 'categories', 'action' => 'view',  $categoryPath['Category']['slug']),array('title' => $categoryPath['Category']['name'])) ;?>
    </span>
	<?php else : ?>
    <span class="cate-name">
    <?php echo $this->Html->link($categoryPath['Category']['name'] , array('controller'=> 'products', 'action' => 'index', 'category' => $categoryPath['Category']['slug']),array('title' => $categoryPath['Category']['name'])) . $product['Product']['title'] ; ?>
    </span>
    <?php endif; ?><?php $i++; endforeach;?>
	</div>	
	<div class="section-block clearfix">
		<div class="section1 grid_12 alpha">
			<div class="section1-tl">
				<div class="section1-tr">
					<div class="section1-tm">
					</div>
				</div>
			</div>
			<div class="section1-cl">
				<div class="section1-cr">
					<div class="section1-inner">
					<div class="section1-inner-block">
                    	
                        	<?php  $product['Attachment'][0] = !empty($product['Attachment'][0]) ? $product['Attachment'][0] : array(); ?>
					

								<?php echo $this->Html->showImage('Product', $product['Attachment'][0], array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $product['Product']['title']), 'class' => 'js-img-container', 'title' => $product['Product']['title'])); ?>
						</div>
                    
					
	        	<div class="zoom-img-block">
					<dl class='list clearfix'>
					<dt><?php echo __l('Views'); ?></dt>
					<dd><?php echo $this->Html->cInt($product['Product']['product_view_count']); ?></dd>
					</dl>
				</div>					
						<ul class="zoom-list clearfix">
						
           				<?php foreach($product['Attachment'] as $attachment){
							$image_url=getImageUrl('Product', $attachment, array('dimension' => 'big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['title'], false)), 'title' => $this->Html->cText($product['Product']['title'], false)));
							?>
						<li class="grid_2">
                        <?php echo $this->Html->link($this->Html->showImage('Product', $attachment, array('dimension' => 'normal_thumb','class' => 'js-filmstrip', 'alt' => sprintf(__l('[Image: %s]'), $product['Product']['title']), 'title' => $product['Product']['title'])), $image_url, array('title'=>$this->Html->cText($product['Product']['title'],false),'escape' => false)); ?>
						</li>
                       <?php } ?>
						</ul>

					</div>
				</div>
			</div>
			<div class="section1-bl">
				<div class="section1-br">
					<div class="section1-bm">
					</div>
				</div>
			</div>

         
		</div>

		<div class="section2 grid_12 grid_right alpha omega">
			<div class="section2-top-block">			
				<h3><?php echo $this->Html->cText($product['Product']['title']);?></h3>
				<?php 
				  $discount = false;	
				  $base_original = 0;	
				  if(($product['Product']['discounted_price']>0 && $product['Product']['discounted_price'] < $product['Product']['original_price']) || ($product['Product']['discount_amount'] >=$product['Product']['original_price'])): 
					$discount = true;
					$base_price = $product['Product']['discounted_price'];
				?> 
					<p class="price"><?php if(Configure::read('site.currency_symbol_place') == 'left'){ 
						echo Configure::read('site.currency');
					}?>
					<span id="js-discounted_price"><?php echo $this->Html->cCurrency($product['Product']['discounted_price']);?></span>
					<?php if(Configure::read('site.currency_symbol_place') != 'left'){ 
						echo Configure::read('site.currency');
					}?>
					</p>					
				<?php else:
					$base_price = $product['Product']['original_price'];
				?>
					<p class="price"><?php if(Configure::read('site.currency_symbol_place') == 'left'){ 
						echo Configure::read('site.currency');
					}?>
					<span id="js-discounted_price"><?php echo $this->Html->cCurrency($product['Product']['original_price']);?></span>
					<?php if(Configure::read('site.currency_symbol_place') != 'left'){ 
						echo Configure::read('site.currency');
					}?>
					</p>
				<?php endif;?>
				    <p id="js-original_price_block" class="price original-price <?php echo !($discount)?'hide':''; ?>">
					<strike>
					<?php if(Configure::read('site.currency_symbol_place') == 'left'){ 
						echo Configure::read('site.currency');
					}?>
					<span id="js-original_price"><?php 
					$base_original = $product['Product']['original_price'];	
					echo $this->Html->cCurrency($product['Product']['original_price']);?></span>
					<?php if(Configure::read('site.currency_symbol_place') != 'left'){ 
						echo Configure::read('site.currency');
					}?>
					</strike>
					</p>
					<span class="hide js-base-price"><?php  echo $base_price; ?></span>
					<span class="hide js-base-original-price"><?php echo $base_original; ?></span>
			</div>
			
		<div>
            <?php
               if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
                  echo __l('Status :').$product['ProductStatus']['name'];
               endif;
            ?>
        </div>
		<div class="add-cart-block">
		  <?php if($product['Product']['product_status_id']==ConstProductStatus::Open && $product['Product']['quantity']- $product['Product']['sold_quantity'] > 0): ?>
          <?php if(!empty($colors)): ?>
			<div class="color-list-block">
				<h4><?php echo __l('Pick a color'); ?></h4>
				<ul class="color-list clearfix">
					<?php foreach($colors as $colors => $color): ?>
						<li style="background:#<?php echo $color['value'];?>"><a class="js-pick-product-color {color_id:'<?php echo $color['id']; ?>'}" title ="<?php echo $this->Html->cText($color['name'], false); ?>"><?php echo $this->Html->cText($color['name']);?></a></li>
					<?php endforeach; ?>					
				</ul>
			</div>
			<?php endif; ?>
			<?php if (Configure::read('module.credits') && $product['Product']['is_credit_product']): ?>
				<dl class= "clearfix">
				<dt><?php echo __l('Credits'); ?></dt>
				<dd><?php echo $this->Html->cInt($product['Product']['credits']);?></dd>
				</dl>
			<?php endif; ?>
				<?php echo $this->Form->create('Cart', array('class' => 'normal clearfix quantity js-product-variant-selection', 'enctype' => 'multipart/form-data'));?>
				<div id="js-attributes">
					<?php foreach($groups as $key => $group) {
						 $color_select_class = '';
						 if($group['is_color_group']){
							$color_select_class = 'js-color-selectbox';
						 }
						 echo $this->Form->input('ProductAttribute.'.$key.'.group',array('class' => $color_select_class, 'type'=>'select','value'=>$key, 'label' => $group['name'], 'empty'=> __l('Select'), 'options' => $group['attributes']));
					}?>
				</div>
				<div class=" alpha omega">
				   <div id="js-quantity_wanted_block">
						<?php 
						if(!empty($product['Product']['is_having_file_to_download'])){
							echo $this->Form->input('Cart.quantity',array('label'=>'Quantity','value'=>1, 'id' =>'js-quantity_wanted', 'readonly' => true)); 
						} else {
							echo $this->Form->input('Cart.quantity',array('label'=>'Quantity','value'=>1, 'id' =>'js-quantity_wanted')); 
						} ?>
                   </div>
				<?php if (Configure::read('module.buy_as_gift')): ?>
				<?php echo $this->Form->input('Cart.is_send_as_gift',array('label'=>'Will be a gift?','type'=>'checkbox')); ?>
				<?php endif;?>
				<?php echo $this->Form->input('Cart.product_id',array('type'=>'hidden','value'=>$product['Product']['id'])); ?>
				<?php echo $this->Form->input('Cart.type',array('type'=>'hidden','value'=>'view')); ?>
				<?php echo $this->Form->input('Cart.slug',array('type'=>'hidden','value'=>$product['Product']['slug'])); ?>
				<?php echo $this->Form->input('Cart.product_attribute_id',array('type'=>'hidden','id' => 'js-product_attribute_id')); ?>
				</div>
				<div id="js-availability_block" class="availability-block alpha omega">
					<span id="availability_label"><?php echo __l('Availability:'); ?> </span>
					<span id="js-availability_value"><?php 
						if($product['Product']['quantity']- $product['Product']['sold_quantity'] > 0){
							echo __l('In stock'); 
						}else{
							echo __l('Sold'); 
						}
					?></span>
				</div>				
				<div class="submit-block clearfix <?php ($product['Product']['quantity']- $product['Product']['sold_quantity'] <= 0)?'hide':''; ?>" id="js-add_to_cart_block">
					<?php echo $this->Form->submit(__l('Add to cart'));?>
				</div>
				<?php echo $this->Form->end();?>
		
		<?php else: ?>
			<div class="setion-inner-block">
				<?php echo __l('Not Available'); ?>
			</div>			
		<?php endif; ?>
		</div>		
		<div class="setion-inner-block">
			<dl class="list clearfix">
				<?php if(strtotime($product['Product']['end_date']) && $product['Product']['end_date']!='0000-00-00 00:00:00'): ?>
				<dt><?php echo __l('Ends on:'); ?></dt>
				<dd><?php echo $this->Html->cDateTime($product['Product']['end_date']);?></dd>
				<?php endif; ?>
				<dt><?php echo __l('Product Type:'); ?></dt>
				<dd><?php echo !empty($product['Product']['is_requires_shipping'])? 'Shippable': 'Downloadable';?></dd>
			</dl>				
		</div>				   		
		<div class="setion-inner-block clearfix">
		<?php
				// Twitter
				$tw_url = Router::url(array('controller' => 'products', 'action' => 'view', $product['Product']['slug']), true);
				$tw_url =$tw_url;
				$tw_message = $product['Product']['title'];
				// Facebook
				$fb_status = Router::url(array('controller' => 'products', 'action' => 'view', $product['Product']['slug']), true);
				$fb_status = $fb_status;
			?>
			<h5 class="grid_left"><?php echo __l('Share this');?></h5>
				<ul class="share-list grid_left clearfix">
	                 	<li class="quick"><?php echo $this->Html->link(__l('Quick! Email a friend!'), 'mailto:?subject='.__l('I think you should get great product on ').Configure::read('site.name').'&body='.__l('Check out the great product on ').Configure::read('site.name').' - '.Router::url('/', true).'product/'.$product['Product']['slug'], array('target' => 'blank', 'title' => __l('Send a mail to friend about this deal'), 'class' => 'quick'));?></li>
                		<li class="twitter"><a href="https://twitter.com/share?url=<?php echo $tw_url;?>&amp;lang=en&amp;via=<?php echo Configure::read('site.name'); ?>" class="twitter-share-button" data-lang="en" data-count="none"><?php echo __l('Tweet!');?></a></li>
						<li class="facebook"><fb:like href="<?php echo $fb_status;?>" layout="button_count" font="tahoma"></fb:like></li>
					</ul>
			</div>
			<div id="tabs" class="js-tabs">
				<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all clearfix">
					<li><a href="#tab-description"><?php echo __l('Description');?></a></li>
					<?php if(!empty($product['ProductShipmentCost']) && $product['Product']['is_requires_shipping']): ?>
					<li><a href="#tab-shipping"><?php echo __l('Shipping Details'); ?></a></li>
					<?php endif; ?>			
					<?php if (!empty($product['Product']['video_url'])): ?>
					<li><a href="#tab-video"><?php echo __l('Video'); ?></a></li>
					<?php endif; ?>	
				</ul>
				<div id="tab-description" class="ui-tabs-panel ui-widget-content ui-corner-bottom clearfix">
	
						<?php echo $this->Html->cHtml($product['Product']['description']);?>
				
				</div>
				<div id="tab-shipping">
				   <?php if(!empty($product['ProductShipmentCost']) && $product['Product']['is_requires_shipping']): ?>
					<div class="block">
						<table width="100%" class="clsShippingDetailTable list shipping-list">
							<tbody>
								<tr>
									<th class="dl">
									<strong><?php echo __l('Ship To'); ?></strong></th>
									<th class="dl">
									<strong><?php echo __l('Cost'); ?></strong></th>
									<th class="dl">
									<strong><?php echo __l('With Another Item'); ?></strong></th>
								</tr>
							<?php foreach($product['ProductShipmentCost'] as $shipment): ?>
								<tr >
									<td class="dl"><?php echo $shipment['GroupedCountry']['name']; ?></td>
									<td class="dl">
									<p><?php echo Configure::read('site.currency').$this->Html->cCurrency($shipment['shipment_cost']); ?></p>
									</td>
									<td class="dl">
									<p><?php echo Configure::read('site.currency').$this->Html->cCurrency($shipment['additional_quantity_shipment_cost']); ?></p>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>		
					<?php endif; ?>								
				</div>
					<?php if (!empty($product['Product']['video_url'])): ?>
				<div id="tab-video" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
				
						<div id="video-1" >
						<?php
							if($this->Embed->parseUrl($product['Product']['video_url'])) {
								$this->Embed->setHeight('300px');
								$this->Embed->setWidth('400px');
								echo $this->Embed->getEmbedCode();
							}
						?>
						</div>
			
				</div>
						<?php endif; ?>
			</div> 
		</div>
	</div>

  <?php if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin):?>            
	  <div class="admin-view-sales">
		   <div class="js-tabs">
    			<ul class="clearfix">
    				<li><?php echo $this->Html->link(__l('Product Orders'), '#tabs-'.$product['Product']['id']);?></li>
    			</ul>
    			<div id="tabs-<?php echo $product['Product']['id']; ?>" ><?php echo $this->element('orders-index', array('product_id' => $product['Product']['id'])); ?></div>
    		</div>
	  </div>
	<?php endif; ?>
	<?php echo $this->element('produtcs-recommended_index', array('cache' => array('key' => $product['Product']['id'], 'config' => 'sec'), 'product_id' => $product['Product']['id'])); ?>		
</div>
<div id="fb-root"></div>
	<script type="text/javascript">
	  window.fbAsyncInit = function() {
		FB.init({appId: '<?php echo Configure::read('facebook.app_id');?>', status: true, cookie: true,
				 xfbml: true});
	  };
	  (function() {
		var e = document.createElement('script'); e.async = true;
		e.src = document.location.protocol +
		  '//connect.facebook.net/en_US/all.js';
		document.getElementById('fb-root').appendChild(e);
	  }());
	</script>


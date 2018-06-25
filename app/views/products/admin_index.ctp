<?php /* SVN: $Id: $ */ ?>
<div class="products index js-response">
<div class="clearfix">
		<ul class="filter-list-block filter-list clearfix">
        <li <?php if (!empty($this->request->data['Product']['filter_id']) && $this->request->data['Product']['filter_id'] == ConstMoreAction::Active) { echo 'class="active"';} ?>><span class="green-block" title="<?php echo __l('Active'); ?>"><?php echo $this->Html->link($this->Html->cInt($active_product_count,false).'<span>' .__l('Active'). '</span>', array('controller'=>'products','action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false));?></span> </li>
        <li <?php if (!empty($this->request->data['Product']['filter_id']) && $this->request->data['Product']['filter_id'] == ConstMoreAction::Inactive) { echo 'class="active"';} ?>><span class="red-block" title="<?php echo __l('Inactive'); ?>"><?php echo $this->Html->link($this->Html->cInt($inactive_product_count,false).'<span>' .__l('Inactive'). '</span>', array('controller'=>'products','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false));?></span> </li>
        <li <?php if (!empty($this->request->data['Product']['filter_id']) && $this->request->data['Product']['filter_id'] == ConstProductTypeFilter::Shipping) { echo 'class="active"';} ?>><span class="orange-block" title="<?php echo __l('Shipping'); ?>"><?php echo $this->Html->link($this->Html->cInt($shipping_product_count,false).'<span>' .__l('Shipping'). '</span>', array('controller'=>'products','action'=>'index','filter_id' => ConstProductTypeFilter::Shipping), array('escape' => false));?></span></li>
        <li <?php if (!empty($this->request->data['Product']['filter_id']) && $this->request->data['Product']['filter_id'] == ConstProductTypeFilter::Downloadable) { echo 'class="active"';} ?>><span class="purple-block" title="<?php echo __l('Downloadable'); ?>"><?php echo $this->Html->link($this->Html->cInt($downloadable_product_count,false).'<span>' .__l('Downloadable'). '</span>', array('controller'=>'products','action'=>'index','filter_id' => ConstProductTypeFilter::Downloadable), array('escape' => false));?></span></li>
        <li <?php if (empty($this->request->data['Product']['filter_id'])) { echo 'class="active"';} ?>><span class="import-block" title="<?php echo __l('All'); ?>"><?php echo $this->Html->link($this->Html->cInt($active_product_count + $inactive_product_count,false).'<span>' .__l('All'). '</span>', array('controller'=>'products','action'=>'index'), array('escape' => false));?></span> </li>
		</ul>
		<?php foreach($productStatuses as $product_status_id => $product_status_name): ?>
			<?php $class = (!empty($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id'] == $product_status_id) ? ' active-filter' : null; ?>
		<?php endforeach; ?>
<?php $filter = !empty($this->request->params['named']['filter_id']) ? $this->request->params['named']['filter_id'] : ''; 
?>
<div class="js-pagination product-chart-block clearfix round-5">
  <ul class="product-chart clearfix">
    <li class="new-product"> <span class="new-product"><?php echo __('New product'); ?></span>

        <div class="upcoming-inner-right">
          <ul>
            <li> <span class="bid-closed"><?php echo $this->Html->link(__l('Draft') . ' (' . $this->Html->cInt($draft_count, false).')', array('controller' => 'products', 'action' => 'index', 'status_filter_id' => ConstProductStatus::Draft), array('class' => $class,'id'=> "Products-Draft",  'title' => __l('Draft').'('.$draft_count.')'));?></span></li>
          </ul>
        </div>
    </li>
    <li> <span class="product-upcoming"><?php echo $this->Html->link(__l('Upcoming') . ' (' . $this->Html->cInt($upcoming_count, false).')', array('controller' => 'products', 'action' => 'index', 'filter_id' => $filter, 'status_filter_id' => ConstProductStatus::Upcoming), array('class' => $class,'id'=> "Products-Upcoming",  'title' => __l('Upcoming').'('.$upcoming_count.')'));?></span> </li>
    <li> <span class="product-open"><?php echo $this->Html->link(__l('Open') . ' (' . $this->Html->cInt($open_count, false).')', array('controller' => 'products', 'action' => 'index', 'filter_id' => $filter, 'status_filter_id' => ConstProductStatus::Open), array('class' => $class,'id'=> "Products-Open",  'title' => __l('Open').'('.$open_count.')'));?> </span> </li>
    <li> <span class="product-closed"><?php echo $this->Html->link(__l('Closed') . ' (' . $this->Html->cInt($closed_count, false).')', array('controller' => 'products', 'action' => 'index', 'filter_id' => $filter, 'status_filter_id' => ConstProductStatus::Closed), array('class' => $class,'id'=> "Products-Closed",  'title' => __l('Closed').'('.$closed_count.')'));?></span> </li>
    <li class="cancelled"> <span class="cancelled"><?php echo $this->Html->link(__l('Canceled') . ' (' . $this->Html->cInt($canceled_count, false).')', array('controller' => 'products', 'action' => 'index', 'filter_id' => $filter, 'status_filter_id' => ConstProductStatus::Canceled), array('class' => $class, 'id'=> "Products-Canceled", 'title' => __l('Canceled').'('.$canceled_count.')'));?> </span> </li>
  </ul>
</div>

</div>
    <div class="page-count-block clearfix">
    <div class="grid_left"> <?php echo $this->element('paging_counter');?> </div>
    <div class="grid_left">
    	<?php echo $this->Form->create('Product', array('type' => 'post', 'class' => 'normal search-form clearfix', 'action'=>'index'));	?>
    	<div class="filter-section grid_left clearfix">
    	 <div class="clearfix">
    	    <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    		<?php echo $this->Form->submit(__l('Search'));?>
    		</div>
    		</div>
    	<?php echo $this->Form->end(); ?>
    	</div>
    	<div class="clearfix add-block1 grid_right"> <?php echo $this->Html->link(__l('Add'),array('controller'=>'products', 'action'=>'add'),array('class' => 'add', 'title' => __l('Add Product')));?> </div>
    </div>
	<?php echo $this->Form->create('Product' , array('class' => 'normal', 'action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
<table class="list" id="js-expand-table">
                    <tr class="js-even">
			<th class="select"><?php echo __l('Action');?></th>
			<th><?php echo $this->Paginator->sort(__l('Product'), 'title');?></th>
			<th><div class="js-pagination"><?php echo __l('Date'); ?><div><?php echo $this->Paginator->sort(__l('Start'), 'Product.start_date'); ?><?php echo '/'.$this->Paginator->sort(__l('End'), 'Product.end_date'); ?></div></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Quantity Sold'),'Product.sold_quantity'); ?></div></th>
			<th><?php echo __l('Sales').' ('.Configure::read('site.currency').')'; ?></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Added On'),'created');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Quantity'),'quantity');?></div></th>
		</tr>
		
		<?php
			if (!empty($products)):
				$i = 0;
				foreach ($products as $product):
					$class = null;
					$active_class = '';
					if ($i++ % 2 == 0):
						$class = 'altrow';
					endif;
					if($product['Product']['is_active']):
						$status_class = 'js-checkbox-active';
					else:
    					$active_class = ' inactive-record';
						$status_class = 'js-checkbox-inactive';
					endif;
					if($product['Product']['admin_suspend']):
						$status_class.= ' js-checkbox-suspended';
					else:
						$status_class.= ' js-checkbox-unsuspended';
					endif;
					if($product['Product']['is_system_flagged']):
						$status_class.= ' js-checkbox-flagged';
					else:
						$status_class.= ' js-checkbox-unflagged';
					endif;
		?>
		<tr class="<?php echo $class.' '.$active_class. " expand-row js-odd" ;?>">
			<td class="<?php echo $class;?> select">
                          		<div class="arrow"></div>
                       <?php if(!empty($moreActions) && isset($this->request->params['named']['status_filter_id'])): ?>
                              <?php echo $this->Form->input('Product.'.$product['Product']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$product['Product']['id'], 'label' => false, 'class' => 'js-checkbox-list '. $status_class. '' )); ?>
                       <?php endif; ?>
                      </td>
                      <td class="dl">
                      <div class="clearfix">
                         <span title="<?php echo $product['ProductStatus']['name']; ?>" class="<?php echo 'product-status-info product-status-'.strtolower(str_replace(" ","",$product['ProductStatus']['name']));?>">
						 <?php echo $this->Html->cText($product['ProductStatus']['name']); ?></span>
						 <?php echo $this->Html->link($this->Html->cText($this->Html->truncate($product['Product']['title'],90, array('ending' => '...')),false),array('controller'=>'products','action'=>'view',$product['Product']['slug'],'admin'=>false), array('escape' => false,'title'=> $this->Html->cText($product['Product']['title'],false)));?>

						 <?php
			if(!empty($product['Product']['is_requires_shipping'])) :
				echo '<span class="requires-shipping shipping-block" title="'.__l('Shipping').'">'.__l('Shipping').'</span>';
			endif;
			if(!empty($product['Product']['is_having_file_to_download'])) :
				echo '<span class="requires-shipping downloadable-block" title="'.__l('Downloadable').'">'.__l('Downloadable').'</span>';
			endif;
		?>
                        </div>
                      </td>

    <td class="dc">
   <?php if($product['Product']['start_date'] == '0000-00-00 00:00:00' || $product['Product']['end_date'] == '0000-00-00 00:00:00') {
   echo '-';
   } else {?>
					  <div class="clearfix">
                       <div class="product-bought-info">
                       <?php
							$product_progress_precentage = 0;
							if(strtotime($product['Product']['start_date']) < strtotime(date('Y-m-d H:i:s'))) {
								if($product['Product']['end_date'] !== null) {
									$days_till_now = (strtotime(date("Y-m-d")) - strtotime(date($product['Product']['start_date']))) / (60 * 60 * 24);
									$total_days = (strtotime(date($product['Product']['end_date'])) - strtotime(date($product['Product']['start_date']))) / (60 * 60 * 24);
									$product_progress_precentage = round((($days_till_now/$total_days) * 100));
									if($product_progress_precentage > 100)
									{
										$product_progress_precentage = 100;
									}
								} else {
									$product_progress_precentage = 100;
								}
							}
						?>

                        <p class="progress-bar">
                           <span class="<?php echo ($product['Product']['end_date'] === null)? ' any-time-product-progress': 'progress-status '; ?>" style="width:<?php echo $product_progress_precentage; ?>%" title="<?php echo ($product['Product']['end_date'] === null)? __l('Any Time Product'): $product_progress_precentage.'%'; ?>">&nbsp;</span>
                        </p>
                        <p class="progress-value clearfix"><span class="progress-from grid_left"><?php echo $this->Html->cDateTimeHighlight($product['Product']['start_date']);?></span><span class="progress-to grid_right"><?php echo (!is_null($product['Product']['end_date']))? $this->Html->cDateTimeHighlight($product['Product']['end_date']): ' - ';?></span></p>
                       </div>
                     </div>
                     <?php } ?>
					   </td>
			<td><?php echo $product['Product']['sold_quantity'];?></td>
			<td><?php echo $this->Html->cCurrency($product['Product']['sales_cleared_amount']+$product['Product']['sales_pending_amount']);?></td>
            <td><?php echo $this->Html->cDateTimeHighlight($product['Product']['created']); ?></td>
			<td><?php echo $product['Product']['quantity'];?></td>
		</tr>
		<tr class="hide">
          <td colspan="9" class="action-block">
              <div class="action-info-block clearfix">
                <div class="action-left-block">
				<h3> <?php echo __l('Action'); ?> </h3>
				 <ul>
				<li><span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $product['Product']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span></li>
				<li><span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $product['Product']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span></li>
				<?php if(!empty($product['Product']['is_product_variant_enabled']) && Configure::read('attribute.is_enabled_attribute')){ ?>
				<li><span><?php echo $this->Html->link(__l('Manage Variants'), array('action' => 'product_variants', 'product_id' => $product['Product']['id'], 'type' => 'edit'), array('class' => 'managevariants' , 'title' => __l('Manage Variants')));?></span></li>
				<?php } ?>
				<?php if(!empty($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id']==ConstProductStatus::OpenForVoting) : ?>
				<li><span><?php echo $this->Html->link(__l('Move to open'), array('action' => 'admin_updatestatus', $product['Product']['id'], 'open'), array('class' => 'js-admin-update-product voting', 'title' => __l('Move to open')));?></span></li>
				<?php endif;?>
				<?php if($product['Product']['order_item_count']) : ?>
			    <li><span><?php echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'products', 'action' => 'buyers',$product['Product']['id'], 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export'));?></span></li>
				<?php endif; ?>
				<li><span><?php echo $this->Html->link(__l('View'), array('controller' => 'products', 'action' => 'view', $product['Product']['slug'], 'admin' => false), array('class' => 'view', 'title' => __l('View')));?></span></li>
					 </ul>
				</div>
				<div class="action-right-block product-action-right-block clearfix">
                               <div class="action-right action-right1">
                                       <h3><?php echo __l('Price'); ?></h3>
                                       <dl class="clearfix">
        								   <dt><?php echo __l('Original Price').' ('.Configure::read('site.currency').')'; ?></dt>
                                           <dd><?php echo $this->Html->cCurrency($product['Product']['original_price']); ?></dd>
        								   <dt><?php echo __l('Discounted Price').' ('.Configure::read('site.currency').')'; ?></dt>
                                           <dd><?php echo $this->Html->cCurrency($product['Product']['discounted_price']); ?></dd>
        								   <dt><?php echo __l('Discount').' (%)'; ?>
                                           </dt><dd><?php echo $this->Html->cFloat($product['Product']['discount_percentage']); ?></dd>
        								   <dt><?php echo __l('Discount').' ('.Configure::read('site.currency').')'; ?></dt>
                                           <dd><?php echo $this->Html->cCurrency($product['Product']['discount_amount']); ?></dd>
                                       </dl>
                                 </div>
                                 <div class="action-right action-right2">
                                         <h3><?php echo __l('Stats'); ?></h3>
                                         <dl class="clearfix">
                                          <dt><?php echo __l('Views').': ';?></dt>
                                          <dd>
                                          <?php echo $this->Html->link($this->Html->cInt($product['Product']['product_view_count'],false), array('controller'=>'product_views','action'=>'index', 'product_id'=>$product['Product']['id']), array('title' => __l('views'))); ?>
                        				  </dd>
										  <?php if(!empty($product['Product']['is_having_file_to_download'])): ?>
                        				  <dt><?php echo __l('Downloads').': ';?></dt>
                                          <dd>
                        				  <?php echo $this->Html->link($this->Html->cInt($product['Product']['product_download_count'],false), array('controller'=>'product_downloads','action'=>'index', 'product_id'=>$product['Product']['id']), array('title' => __l('Downloads'))); ?>
                        				  </dd>
										  <?php endif; ?>                        				  
                                         </dl>
                                </div>
                    			 <div class="action-right action-right3">
                                   <div class="product-img-block">
								   <?php if(!empty($product['Attachment']['0'])):?>
                                       <?php echo $this->Html->link($this->Html->showImage('Product', $product['Attachment']['0'], array('dimension' => 'small_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['title'], false)), 'title' => $this->Html->cText($product['Product']['title'], false),'escape'=>false)), array('controller' => 'products', 'action' => 'view', $product['Product']['slug'], 'admin' => false), array('escape' => false));?>
									   <?php endif; ?>
                                   </div>
                                   <dl class="clearfix">
                                        <dt><?php echo __l('Status: '); ?> </dt>
                                          <dd>
                                           <div class="clearfix">
                                               <span title="<?php echo $product['ProductStatus']['name']; ?>" class="<?php echo 'product-status-info product-status-'.strtolower(str_replace(" ","",$product['ProductStatus']['name']));?>">&nbsp;</span>
                                                  <?php
                                    				if (!empty($product['Product']['admin_suspend'])):
                                    					echo '<span class="admin-suspended round-3">'.__l('Admin Suspended').'</span>';
                                    				endif;
                                    				if (!empty($product['Product']['is_system_flagged'])):
                                    					echo '<span class="system-flagged round-3">'.__l('System Flagged').'</span>';
                                    				endif;
                                    				if ($product['Product']['product_status_id']==ConstProductStatus::Draft):
                                    					echo '<span>'.__l('Draft').'</span>';
                                    				elseif ($product['Product']['product_status_id']==ConstProductStatus::Upcoming):
                                    					echo '<span>'.__l('Upcoming').'</span>';
                                    				elseif ($product['Product']['product_status_id']==ConstProductStatus::Open):
                                    					echo '<span>'.__l('Open').'</span>';
                                    				elseif ($product['Product']['product_status_id']==ConstProductStatus::Closed):
                                    					echo '<span>'.__l('Closed').'</span>';
                                    				elseif ($product['Product']['product_status_id']==ConstProductStatus::Canceled):
                                    					echo '<span>'.__l('Canceled').'</span>';
                                    				endif;
                                    			?>
                                            </div>
                                          </dd>
                                          <dt><?php echo __l('User').': '?></dt>
                    				          <dd><?php echo $this->Html->link($this->Html->cText($product['User']['username']), array('controller'=> 'users', 'action'=>'view', $product['User']['username'] , 'admin' => false), array('escape' => false));?></dd>
                    				           <dt><?php echo __l('Ip').': ';?></dt>
                    				            <dd>
                    				            <?php if(!empty($product['Ip']['ip'])): ?>
                                        <?php echo  $this->Html->link($product['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $product['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois ', 'escape' => false));
                    							?>
                                        <p>
                                          <?php
                                                if(!empty($product['Ip']['Country'])):
                                                    ?>
                                          <span class="flags flag-<?php echo strtolower($product['Ip']['Country']['iso2']); ?>" title ="<?php echo $product['Ip']['Country']['name']; ?>"> <?php echo $product['Ip']['Country']['name']; ?> </span>
                                          <?php
                                                endif;
                    							 if(!empty($product['Ip']['City'])):
                                                ?>
                                          <span> <?php echo $product['Ip']['City']['name']; ?> </span>
                                          <?php endif; ?>
                                        </p>
                                        <?php else: ?>
                                        <?php echo __l('N/A'); ?>
                                        <?php endif; ?>
                    				             </dd>
                                           </dl>
                                      </div>
                          </div>
     	         </div>
			</td>
		</tr>
		<?php
				endforeach;
			else:
		?>
		<tr class="js-even">
			<td colspan="20"><p class="notice"><?php echo __l('No Products available');?></p></td>
		</tr>
		<?php
			endif;
		?>
	</table>
	<?php if (!empty($moreActions)): ?>
		<div class="clearfix">
			<div class="admin-select-block grid_left">
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
			</div>
			<div class="admin-checkbox-button grid_4 grid_left">
				<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
			</div>
			<div class="grid_right">
				<?php echo $this->element('paging_links'); ?>
			</div>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>
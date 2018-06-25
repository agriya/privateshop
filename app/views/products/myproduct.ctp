<?php /* SVN: $Id: $ */ ?>
<div class="products index">
	<h2><?php echo __l('Products');?></h2>
<div class="common-outet-block clearfix">
	<div class="dashboard-filter-block">
		<h3><?php echo __l('Product Filter'); ?></h3>

		<ul class="dashboard-filter-list clearfix">
		<?php $class = (!empty($this->request->data['Product']['filter_id']) && $this->request->data['Product']['filter_id'] == ConstMoreAction::Active) ? ' active-filter' : null; ?>
		<li><span class="<?php echo $class; ?> active"><?php echo $this->Html->link(__l('Active') . ': ' . $this->Html->cInt($active_product_count, false), array('controller' => 'products', 'action' => 'index', 'type'=>'myproduct', 'filter_id' => ConstMoreAction::Active), array('class' => $class, 'title' => __l('Active Products')));?></span></li>
		<?php $class = (!empty($this->request->data['Product']['filter_id']) && $this->request->data['Product']['filter_id'] == ConstMoreAction::Inactive) ? ' active-filter' : null; ?>
		<li><span class="<?php echo $class; ?> inactive"><?php echo $this->Html->link(__l('Inactive') . ': ' . $this->Html->cInt($inactive_product_count, false), array('controller' => 'products', 'action' => 'index','type'=>'myproduct', 'filter_id' => ConstMoreAction::Inactive), array('class' => $class, 'title' => __l('Inactive Products')));?></span></li>
</ul>

		</div>
		<div class="dashboard-filter-block clearfix">
		<h3><?php echo __l('Product Status'); ?></h3>

       <ul class="dashboard-filter-list clearfix">
		<?php foreach($productStatuses as $product_status_id => $product_status_name): ?>
			<li>
			<?php $class = (!empty($this->request->params['named']['status_filter_id']) && $this->request->params['named']['status_filter_id'] == $product_status_id) ? ' active-filter' : null; ?>
			<span class="<?php echo $class; ?> <?php echo strtolower(Inflector::camelize($product_status_name)); ?>"><?php echo $this->Html->link($product_status_name . ': ' . $this->Html->cInt(${'product_status_' . $product_status_id}, false), array('controller' => 'products', 'action' => 'index', 'status_filter_id' =>$product_status_id,'type' =>'myproduct'), array('class' => $class, 'title' => $product_status_name . ' ' . __l('Products')));?></span>
			</li>
		<?php endforeach; ?>
		</ul>

	</div>
	<?php echo $this->Form->create('Product' , array('class' => 'normal', 'action' => 'update')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
		<?php echo $this->element('paging_counter');?>
	<table class="list">
		<tr>
			<th><?php echo __l('Select');?></th>
			<th class="actions"><?php echo __l('Actions');?></th>
			<th><?php echo $this->Paginator->sort(__l('Created'), 'created');?></th>
			<th><?php echo $this->Paginator->sort(__l('Title'), 'title');?></th>
			<th><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></th>
			<th><?php echo __l('Price');?></th>
			<th><?php echo $this->Paginator->sort(__l('Views'), 'product_view_count');?></th>
			<th><?php echo $this->Paginator->sort(__l('Downloads'), 'product_download_count');?></th>
			<th><?php echo $this->Paginator->sort(__l('IP'), 'Ip.ip');?></th>
			<th><?php echo $this->Paginator->sort(__l('Status'), 'product_status_id'); ?></th>
		</tr>
		<?php
			if (!empty($products)):
				$i = 0;
				foreach ($products as $product):
					$class = null;
					if ($i++ % 2 == 0):
						$class = ' class="altrow"';
					endif;
					if($product['Product']['is_active']):
						$status_class = 'js-checkbox-active';
					else:
						$status_class = 'js-checkbox-inactive';
					endif;


		?>
		<tr<?php echo $class;?>>
			<td>
			<?php if($product['Product']['product_status_id']==ConstProductStatus::Draft) : ?>
			<?php echo $this->Form->input('Product.'.$product['Product']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$product['Product']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?>
			<?php endif ; ?>
			</td>
			<td class="actions">
				<span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $product['Product']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
			<?php if($product['Product']['product_status_id']==ConstProductStatus::Draft) : ?>
				<span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $product['Product']['id']), array('class' => 'delete js-delete', 'title' => __l('Disappear product from user side')));?></span>
			<?php endif; ?>
			<?php if($product['Product']['order_item_count']) : ?>
			<span><?php echo $this->Html->link(__l('CSV'), array_merge(array('controller' => 'products', 'action' => 'buyers',$product['Product']['id'], 'ext' => 'csv', 'admin' => true), $this->request->params['named']), array('title' => __l('CSV'), 'class' => 'export'));?></span>
			<?php endif; ?>
			</td>
			<td><?php echo $this->Html->cDateTimeHighlight($product['Product']['created']);?></td>
			<td>
				<?php $product['Attachment']['0'] = !empty($product['Attachment']['0']) ? $product['Attachment']['0'] : array();?>
				<p><?php echo $this->Html->link($this->Html->showImage('Product', $product['Attachment']['0'], array('dimension' => 'small_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['title'], false)), 'title' => $this->Html->cText($product['Product']['title'], false))), array('controller' => 'products', 'action' => 'view', $product['Product']['slug'], 'admin' => false), array('escape' => false));?></p>
				<p><?php echo $this->Html->link($this->Html->cText($product['Product']['title']), array('controller'=> 'products', 'action'=>'view', $product['Product']['slug'] , 'admin' => false), array('escape' => false));?></p>
				<?php
					if (!empty($product['Product']['admin_suspend'])):
						echo '<span class="admin-suspended round-3">'.__l('Admin Suspended').'</span>';
					endif;
					if (!empty($product['Product']['is_system_flagged'])):
						echo '<span class="system-flagged round-3">'.__l('System Flagged').'</span>';
					endif;
					if ($product['Product']['is_active']==0):
						echo '<span class="inactive round-3">'.__l('Inactive').'</span>';
					endif;

					if ($product['Product']['product_status_id']==ConstProductStatus::Draft):
						echo '<span class="draft round-3">'.__l('Draft').'</span>';
					elseif ($product['Product']['product_status_id']==ConstProductStatus::Upcoming):
						echo '<span class="upcoming round-3">'.__l('Upcoming').'</span>';
					elseif ($product['Product']['product_status_id']==ConstProductStatus::Open):
						echo '<span class="open round-3">'.__l('Open').'</span>';
					elseif ($product['Product']['product_status_id']==ConstProductStatus::Closed):
						echo '<span class="closed round-3">'.__l('Closed').'</span>';
					elseif ($product['Product']['product_status_id']==ConstProductStatus::Canceled):
						echo '<span class="canceled round-3">'.__l('Canceled').'</span>';
					endif;
				?>
			</td>
			<td><?php echo $this->Html->link($this->Html->cText($product['User']['username']), array('controller'=> 'users', 'action'=>'view', $product['User']['username'] , 'admin' => false), array('escape' => false));?></td>
			<td><?php echo $this->Html->cCurrency($product['Product']['original_price']);?></td>
			<td><?php echo $this->Html->link($this->Html->cInt($product['Product']['product_view_count'], false), array('controller' => 'product_views', 'product_id' => $product['Product']['id']));?></td>
			<td><?php echo $this->Html->link($this->Html->cInt($product['Product']['product_download_count'], false), array('controller' => 'product_downloads', 'product_id' => $product['Product']['id']));?></td>
			<td>
				<?php 
					if(!empty($product['Ip']['ip'])) {
						echo $this->Html->cText($product['Ip']['ip']); 
						echo ' ['.$product['Ip']['host'].']' . '('. $this->Html->link(__l('whois'), array('controller' => 'users', 'action' => 'whois', $product['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => __l('whois'), 'escape' => false)) .')';
					} else {
						echo '--';
					}
				?>
			</td>
			<td><?php echo $this->Html->cBool($product['ProductStatus']['name']);?></td>
		</tr>
		<?php
				endforeach;
			else:
		?>
		<tr>
			<td colspan="20"><p class="notice"><?php echo __l('No Products available');?></p></td>
		</tr>
		<?php
			endif;
		?>
	</table>
	<?php if (!empty($products)): ?>
		<div class="admin-select-block">
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
		</div>
		<div class="admin-checkbox-button">
			<?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
		</div>
	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
	<?php
		if (!empty($products)):
			echo $this->element('paging_links');
		endif;
	?>
</div>
</div>
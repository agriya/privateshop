<?php /* SVN: $Id: $ */ ?>
<div class="clearfix js-scroll-to">			
     <?php if(!empty($parent['CategoryPhoto'])): ?>
	  <div id="js-showcase" class="showcase {'img_width':'<?php echo Configure::read('thumb_size.large_thumb.width'); ?>', 'img_height':'<?php echo Configure::read('thumb_size.large_thumb.height'); ?>'}">		
		<?php foreach($parent['CategoryPhoto'] as $categoryPhoto): ?>	       
		<div class="showcase-slide">
			<!-- Put the slide content in a div with the class .showcase-content. -->
			<div class="showcase-content">
				<a href="<?php echo $categoryPhoto['url']; ?>"><?php echo $this->Html->showImage('CategoryPhoto', $categoryPhoto['Attachment'], array('dimension' => 'large_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($categoryPhoto['title'], false)), 'title' => $this->Html->cText($categoryPhoto['title'], false)));?></a>
			</div>
            <?PHP if(!empty($categoryPhoto['title']))
            {
            ?>
			<div class="showcase-caption">
				<h2><?php echo $this->Html->cText($categoryPhoto['title']); ?></h2>
				
			</div>
			<?PHP } ?>
		</div>
		<?php endforeach; ?>									
	</div>   
	<?php endif; ?>		
	<ol class="category-list clearfix">
		<?php foreach($childCategories as $category): ?>
		<li class="grid_left">
         	<?php
                     if($this->Html->isParent($category['Category']['id']))
                     {
                       $category_img = array('controller'=> 'categories', 'action' => 'view', $category['Category']['slug'], 'admin' => false);
                     }
                     else
                     {
                       $category_img = array('controller' => 'products', 'action' => 'index','category' => $category['Category']['slug'], 'admin' => false);
                     }
                     if(!empty($category['CategoryPhoto'][0]['Attachment'])):
                         //echo $this->Html->showImage('CategoryPhoto', $category['CategoryPhoto'][0]['Attachment'], array('dimension' => 'normal_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($category['Category']['name'], false)), 'title' => $this->Html->cText($category['Category']['name'], false)));
                         echo $this->Html->link($this->Html->showImage('CategoryPhoto', $category['CategoryPhoto']['0']['Attachment'], array('dimension' => 'normal_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($category['Category']['name'], false)), 'title' => $this->Html->cText($category['Category']['name'], false),'escape'=>false)), $category_img , array('escape' => false));
                     endif; ?>
			<div class="list-top-block">
			<h3 class="grid_left"><?php echo $this->Html->link($sub_parent['Category']['name'] , array('controller'=> 'categories', 'action' => 'view', $sub_parent['Category']['slug']),array('title' => $sub_parent['Category']['name'])); ?></h3>
			<h4 class="grid_left"><?php echo $this->Html->link($category['Category']['name'] , ($this->Html->isParent($category['Category']['id'])) ? array('controller'=> 'categories', 'action' => 'view', $category['Category']['slug']):array('controller'=> 'products', 'action' => 'index', 'category' => $category['Category']['slug']),array('title' => $category['Category']['name'])); ?></h4>
			</div>
			<div class="list-bottom-block">
               <?php echo $this->Html->link(__l('View Now') , ($this->Html->isParent($category['Category']['id'])) ? array('controller'=> 'categories', 'action' => 'view', $category['Category']['slug']):array('controller'=> 'products', 'action' => 'index', 'category' => $category['Category']['slug']),array('title' => __l('View Now'))); ?>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
    <div class="clearfix">
		<?php echo $this->Html->link(__l('Back to top') , array('#') ,array('class' => 'back-to-top grid_right js-scroll','title' => __l('Back to top'))); ?>
	</div>
</div>

 
  
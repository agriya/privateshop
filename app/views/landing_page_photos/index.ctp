
	  <div id="js-showcase" class="showcase {'img_width':'<?php echo Configure::read('thumb_size.large_big_thumb'); ?>', 'img_height':'<?php echo Configure::read('thumb_size.large_big_thumb.height'); ?>'}">		
	  	<?php 
		foreach($landingPagePhotos as $landingPagePhoto): ?>	       
		<div class="showcase-slide">
			<!-- Put the slide content in a div with the class .showcase-content. -->
			<div class="showcase-content">
				<a href="<?php echo $landingPagePhoto['LandingPagePhoto']['url']; ?>"><?php echo $this->Html->showImage('landingPagePhoto', $landingPagePhoto['Attachment'], array('dimension' => 'large_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), !empty($landingPagePhoto['title']) ? $this->Html->cText($landingPagePhoto['title'], false) : ''), 'title' => $this->Html->cText($landingPagePhoto['LandingPagePhoto']['title'], false)));?></a>
			</div>
			<div class="showcase-caption">
				<h2><?php echo $this->Html->cText($landingPagePhoto['LandingPagePhoto']['title']); ?></h2>
				
			</div>
		</div>
		<?php endforeach; ?>									
	</div>   

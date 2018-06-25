<div class="landingPagePhotos form">
<?php if (Configure::read('site.enable_landing_page')): ?>
			<div class="page-info">
				<?php echo __l('Here you can update the landing page slideshow Image, Title, URL (Where to go when click it).');?>
			</div>
            <?php echo $this->Form->create('LandingPagePhoto',  array('class' => 'normal clearfix', 'action'=>'index', 'enctype' => 'multipart/form-data'));?>
           
        <div class="picture">
            <ol class=" upload-list clearfix">
        
               <?php
               for($i = 0; $i<Configure::read('landing_page.max_upload_photo'); $i++):
                 ?>
                 <li>
                <div class="product-img">
                <?php 
			        if(!empty($this->request->data[$i]['Attachment'])):
                        $old_attachment = (!empty($this->request->data[$i]['filename'])) ? '1' :'';
                        echo $this->Form->input('LandingPagePhoto.'.$i.'.OldAttachment.id', array('value'=>$old_attachment, 'id' =>'old_attachment'.$i, 'type' => 'hidden', 'label' => false));
                        echo $this->Form->input('LandingPagePhoto.'.$i.'.Attachment.id', array('type'=>'hidden', 'value'=>$this->request->data[$i]['Attachment']['id']));
        
                    endif;
                    echo $this->Form->uploader('LandingPagePhoto.Attachment.'.$i.'.filename', array('id' =>'LandingPagePhoto.Attachment.'.$i.'.filename', 'type'=>'file', 'uPreview' => '1', 'uFilecount'=>1, 'uController'=> 'landing_page_photos', 'uId' => 'ProductImage'.$i.'',  'uFiletype' => Configure::read('product_image.file.allowedExt')));
                    echo $this->Form->input('LandingPagePhoto.'.$i.'.id', array('type' => 'hidden', 'value' => !empty($this->request->data[$i]['LandingPagePhoto']['id'])?$this->request->data[$i]['LandingPagePhoto']['id']:''));
                  ?>
                  <span class="product-image-preview" id="preview_image<?php echo $i?>">
                    <?php
					    if(!empty($this->request->data[$i]['Attachment'])):
                           if(!empty($this->request->data[$i]['LandingPagePhoto']['filename'])):
                              $thumb_url = Router::url(array(
                                'controller' => 'landing_page_photos',
                                'action' => 'thumbnail',
                                 session_id(),
                                 $this->request->data[$i]['LandingPagePhoto']['filename'],
                                'admin' => false
                            ) , true);
                           ?>
                           <img src="<?php echo $thumb_url; ?>" /><input type="hidden" name="data[Attachment][<?php echo $i; ?>][filename]" value="<?php echo $this->request->data[$i]['LandingPagePhoto']['filename']; ?>" />
                           <?php
                           else:
                             $photo_title  = !empty($this->request->data[$i]['title'])?$this->request->data[$i]['title']:'';
                            echo $this->Html->showImage('LandingPagePhoto', $this->request->data[$i]['Attachment'], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($photo_title, false)), 'title' => $this->Html->cText($photo_title , false))); ?>
                        <?php
                            endif;
                            ?>
                               <a href="#" class="js-preview-close {id:<?php echo $i ?>}">&nbsp;</a>
                            <?php
                        endif;
                        ?>
                  </span>
                   </div>
                   <div class="js-overlabel url-block">
                    <?php 
					echo $this->Form->input('Attachment.'.$i.'.url', array('label' => __l('URL'), 'value' => !empty($this->request->data[$i]['LandingPagePhoto']['url'])?$this->request->data[$i]['LandingPagePhoto']['url']:'')); ?>
                    </div>
                   <div class="js-overlabel title-block">
                     <?php  echo $this->Form->input('Attachment.'.$i.'.title', array('label' => __l('Title'),'value' => !empty($this->request->data[$i]['LandingPagePhoto']['title'])?$this->request->data[$i]['LandingPagePhoto']['title']:'')); ?>
                    </div>
                    </li>
                  <?php
                endfor;
                    ?>
            </ol>
        </div>				
 <?php echo $this->Form->submit(__l('Update'));?>
          <?php echo $this->Form->end();?>
	<?php else: ?>
		<div class="page-info">
				<?php echo __l('New Landing Page is currently disabled. You can enable it from').' '. $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'edit', 1),array('title' => __l('Settings'))).' '.__l('page');?>
			</div>
		<?php endif; ?>
 </div>
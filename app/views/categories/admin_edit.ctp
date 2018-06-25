<div class="categories form">
        <?php echo $this->Form->create('Category',  array('class' => 'normal add-form clearfix','action'=>'edit', 'enctype' => 'multipart/form-data'));?>
            <?php
				echo $this->Form->hidden('id');
				echo $this->Form->input('name');
				echo $this->Form->input('parent_id', array('selected'=>$this->request->data['Category']['parent_id']));
				echo $this->Form->input('description',array('label'=>'Description'));
			?>
<fieldset class="fields-block">
		<h3><?php echo __l('Photos'); ?></h3>
		<div class="page-info"><?php echo __l('Photo caption allows only 255 characters.'); ?></div>

        <div class="picture">
            <ol class=" upload-list clearfix">
        
               <?php
               for($i = 0; $i<Configure::read('category.max_upload_photo'); $i++):
                 ?>
                 <li>
                <div class="product-img">
                <?php
                    if(!empty($this->request->data['CategoryPhoto'][$i]['Attachment'])):
                        $old_attachment = (!empty($this->request->data['CategoryPhoto'][$i]['filename'])) ? '1' :'';
                        echo $this->Form->input('CategoryPhoto.'.$i.'.OldAttachment.id', array('value'=>$old_attachment, 'id' =>'old_attachment'.$i, 'type' => 'hidden', 'label' => false));
                        echo $this->Form->input('CategoryPhoto.'.$i.'.Attachment.id', array('type'=>'hidden', 'value'=>$this->request->data['CategoryPhoto'][$i]['Attachment']['id']));
        
                    endif;
                    echo $this->Form->uploader('CategoryPhoto.Attachment.'.$i.'.filename', array('id' =>'CategoryPhoto.Attachment.'.$i.'.filename', 'type'=>'file', 'uPreview' => '1', 'uFilecount'=>1, 'uController'=> 'products', 'uId' => 'ProductImage'.$i.'',  'uFiletype' => Configure::read('product_image.file.allowedExt')));
                    echo $this->Form->input('CategoryPhoto.'.$i.'.id', array('type' => 'hidden'));
                  ?>
                  <span class="product-image-preview" id="preview_image<?php echo $i?>">
                    <?php
                        if(!empty($this->request->data['CategoryPhoto'][$i]['Attachment'])):
                           if(!empty($this->request->data['CategoryPhoto'][$i]['filename'])):
                              $thumb_url = Router::url(array(
                                'controller' => 'categories',
                                'action' => 'thumbnail',
                                 session_id(),
                                 $this->request->data['CategoryPhoto'][$i]['filename'],
                                'admin' => false
                            ) , true);
                           ?>
                           <img src="<?php echo $thumb_url; ?>" /><input type="hidden" name="data[Attachment][<?php echo $i; ?>][filename]" value="<?php echo $this->request->data['CategoryPhoto'][$i]['filename']; ?>" />
                           <?php
                           else:
                             $photo_title  = $this->request->data['Category']['name'];
                            echo $this->Html->showImage('CategoryPhoto', $this->request->data['CategoryPhoto'][$i]['Attachment'], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($photo_title, false)), 'title' => $this->Html->cText($photo_title , false))); ?>
                        <?php
                            endif;
                            ?>
                               <a href="#" class="js-preview-close {id:<?php echo $i ?>}">&nbsp;</a>
                            <?php
                        endif;
                        ?>
                  </span>
                   </div>
                   <div class="js-overlabel">
                     <?php  echo $this->Form->input('Attachment.'.$i.'.url', array('label' => __l('Url'),'value' => !empty($this->request->data['CategoryPhoto'][$i]['url']) ? $this->request->data['CategoryPhoto'][$i]['url'] : '')); ?>
                    </div>
                   <div class="js-overlabel">
                     <?php  echo $this->Form->input('Attachment.'.$i.'.title', array('label' => __l('Title'),'value' => !empty($this->request->data['CategoryPhoto'][$i]['url']) ? $this->request->data['CategoryPhoto'][$i]['url'] : '')); ?>
                    </div>
                    </li>
                  <?php
                endfor;
                    ?>
            </ol>
        </div>
       </fieldset>
     <div class="submit-block uploader-submit-block clearfix"><?php echo $this->Form->submit(__l('Update'));?></div>
     <?php echo $this->Form->end();?>
</div>
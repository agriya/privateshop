<div class="categories form">
            <?php echo $this->Form->create('Category',  array('class' => 'normal add-form clearfix','action'=>'add', 'enctype' => 'multipart/form-data'));?>
            <?php
				echo $this->Form->input('parent_id',array('label'=>'Parent'));
				echo $this->Form->input('name',array('label'=>'Name'));
				echo $this->Form->input('description',array('label'=>'Description'));
			?>	
<fieldset class="fields-block">
		<h3><?php echo __l('Photos'); ?></h3>
		<div class="page-info"><?php echo __l('Photo caption allows only 255 characters.'); ?></div>
                <div class="padd-center">
                    <div class="picture">
                        <ol class="upload-list clearfix">
                            <?php for($i = 0; $i<Configure::read('category.max_upload_photo'); $i++):  ?>
                                <li>
                                    <div class="product-img"> <?php echo $this->Form->uploader('Attachment.'.$i.'.filename', array('id' =>'Attachment.'.$i.'.filename', 'type'=>'file', 'uPreview' => '1', 'uFilecount'=>1, 'uController'=> 'categories', 'uId' => 'ProductImage'.$i.'',  'uFiletype' => Configure::read('product.file.allowedExt'))); ?> 
                                        <span class="product-image-preview" id="preview_image<?php echo $i?>">
                                            <?php if(!empty($this->request->data['Attachment']) && !empty($this->request->data['Attachment'][$i]['filename'])) :?>
                                                <?php
                                                    $thumb_url = Router::url(array('controller' => 'categories', 'action' => 'thumbnail', session_id(), $this->request->data['Attachment'][$i]['filename'], 'admin' => false) , true);
                                                ?>
                                                <img src="<?php echo $thumb_url; ?>" /><input type="hidden" name="data[Attachment][<?php echo $i; ?>][filename]" value="<?php echo $this->request->data['Attachment'][$i]['filename']; ?>" /><a href="#" class="js-preview-close {id:<?php echo $i ?>}">&nbsp;</a>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <div class="js-overlabel url-block"><?php echo $this->Form->input('Attachment.'.$i.'.url', array('type' => 'text', 'maxlength' => '255', 'label' => __l('URL'))); ?></div>
                                    <div class="js-overlabel title-block"><?php echo $this->Form->input('Attachment.'.$i.'.title', array('type' => 'text', 'maxlength' => '255', 'label' => __l('Title'))); ?></div>
                                </li>
                            <?php endfor; ?>
                        </ol>
                    </div>
                </div>
            </fieldset>
            <div class="submit-block uploader-submit-block clearfix"><?php echo $this->Form->submit(__l('Add'));?></div>
           <?php echo $this->Form->end();?>
  </div>

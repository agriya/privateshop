<?php /* SVN: $Id: $ */ ?>
<div class="products form">
	<?php echo $this->Form->create('Product', array('class' => 'normal add-form', 'enctype' => 'multipart/form-data'));?>
		<fieldset class="fields-block">
			<h3><?php echo __l('General'); ?></h3>
			<?php
				echo $this->Form->input('user_id',array('type'=>'hidden'));
				echo $this->Form->input('title');
				echo $this->Form->input('description', array('type' => 'textarea', 'class' => 'js-editor'));
				echo $this->Form->input('first_category_id',array('label' => 'First Level Category','class' => 'js-load-category {"child_category" : "ProductSecondCategoryId"}', 'empty' => 'Please Select'));
                echo $this->Form->input('second_category_id',array('label' => 'Second Level Category','class' => 'js-load-category {"child_category" : "ProductCategoryId"}', 'type' => 'select', 'empty' => 'Please Select'));
				echo $this->Form->input('category_id',array('label' => 'Third Level Category','type' => 'select', 'empty' => 'Please Select'));				
				if(!empty($this->request->data['Product']['start_date']) && ($this->request->data['Product']['product_status_id'] ==ConstProductStatus::Upcoming || $this->request->data['Product']['product_status_id'] ==ConstProductStatus::Draft)):
				echo $this->Form->input('start_date', array('orderYear' => 'asc', 'minYear' => date('Y')));
				endif;
				if(!empty($this->request->data['Product']['end_date']) && $this->request->data['Product']['end_date'] > date('Y-m-d')):
				echo $this->Form->input('end_date', array('orderYear' => 'asc', 'minYear' => date('Y')));
				endif;
				echo $this->Form->input('id', array('type' => 'hidden'));
				echo $this->Form->input('quantity');				
				echo $this->Form->input('maximum_quantity_to_send_as_gift', array('label' => __l('Maximum quantity can buy product as gift'), 'info' => __l('Leave blank for no limit.')));
				if (!empty($this->request->data['Product']['is_requires_shipping'])):
					$this->request->data['Product']['product_type_id'] = ConstProductTypes::Shipping;
				elseif (!empty($this->request->data['Product']['is_having_file_to_download'])):
					$this->request->data['Product']['product_type_id'] = ConstProductTypes::Download;
				endif;
				$productTypes = array(
					ConstProductTypes::Shipping => 'Shipping Product',
					ConstProductTypes::Download => 'Downloadable Product'
				);
				echo $this->Form->input('product_type_id', array('type' => 'hidden'));
				if (Configure::read('module.credits')):
					$productTypes = $productTypes + array(
						ConstProductTypes::Credit => 'Credit Product',
					);
					if (!empty($this->request->data['Product']['is_credit_product'])):
						$this->request->data['Product']['product_type_id'] = ConstProductTypes::Credit;
					endif;
				endif;				
			?>
		</fieldset>
		<fieldset class="js-saving-block fields-block">
			<h3><?php echo __l('Price'); ?></h3>
			<div class="price-form-block product-discount-form-block">
				<div class=" product-discount-form-block1 discount-form-block clearfix">
					<?php
						echo $this->Form->input('original_price', array('div' => 'input text grid_10 omega alpha', 'label' => __l('Original Price ('.Configure::read('site.currency').')'), 'class' => 'js-price'));
						echo $this->Form->input('discount_percentage', array('div' => 'input text grid_10 omega alpha', 'label' => __l('Discount (%)')));
						echo $this->Form->input('discount_amount', array('div' => 'input text grid_10 omega alpha', 'label' => __l('Discount Amount ('.Configure::read('site.currency').')')));
						echo $this->Form->input('savings', array('div' => 'input text grid_10 omega alpha', 'type' => 'text',  'label' => __l('Savings for User ('.Configure::read('site.currency').')'),  'readonly' => 'readonly'));
						echo $this->Form->input('discounted_price', array('div' => 'input text required grid_10 omega alpha', 'label' => __l('Discounted Price for User ('.Configure::read('site.currency').')'), 'type' => 'text', 'readonly' => 'readonly'));
					?>
				</div>
			</div>
		</fieldset>
		<?php // [vip_user] element include end ?>
		<?php // [credits] extra fields element ?>
			<?php echo $this->element('credit-form'); ?>
		<?php // [credits] element include end ?>
		<?php if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
			<?php // [Seller] extra fields element ?>
				<?php echo $this->element('seller-form'); ?>
			<?php // [Seller] element include end ?>
		<?php endif; ?>
		<?php if($this->request->data['Product']['product_type_id'] == ConstProductTypes::Download): ?>
		<fieldset class="js-download-block fields-block">
			<h3><?php echo __l('File Download'); ?></h3>
			<div class="page-info"><?php echo __l('Attach a file for your buyers to download'); ?></div>
				<div class="clearfix">
					<?php
						if (!empty($this->request->data['ProductFile']['filename']['name'])):
							if (!empty($this->request->data['ProductFile']['id'])):
								echo $this->Form->input('OldAttachment.id', array('type' => 'checkbox', 'label' => __l('Delete?'))); ?>
							<div class="submit-block">
                            <?php echo $this->Form->input('ProductFile.id', array('type'=>'hidden', 'value'=>$this->request->data['ProductFile']['id']));
							echo $this->Html->cText('('.$this->request->data['ProductFile']['filename'].')'); ?>
                             </div>
						<?php endif;
						endif;
					?>
				</div>
				<?php echo $this->Form->input('ProductFile.filename', array('type' => 'file', 'label' => __l('Upload Product File'))); ?>
		</fieldset>
		<?php endif; ?>
		<?php if($this->request->data['Product']['product_type_id'] == ConstProductTypes::Shipping): ?>
		<fieldset class="js-shipping-block fields-block">
			<h3><?php echo __l('Shipping'); ?></h3>
			<div class="page-info"><?php echo __l('Specify the shipment cost details for this product.'); ?></div>

			<div class="seller-center add-center clearfix">
				<div class="requirement-left">
						<div class="js-shipment-container clearfix shipment-container round-10">
        	            	<div class="clearfix new-block-add">
								<div class="js-clone add-form-block clearfix">
								<?php
									$count = (!empty($this->request->data['ProductShipmentCost'])) ? count($this->request->data['ProductShipmentCost']) : 1;
									for($i = 0; $i < $count; $i++) :
								?>
								<div class="js-field-list clearfix">
									<div class="add-shipping-block grid_left">
						<div class="clearfix">
                                    <?php echo $this->Form->input('ProductShipmentCost.'.$i.'.grouped_country_id', array('id' => 'product_ship_country'.$i, 'label' => __l('Country'), 'options' => $shipCountries, 'empty' => __l('Select a region or country'), 'class' =>'js-ship-country')); ?>
									<?php echo $this->Form->input('ProductShipmentCost.'.$i.'.id', array('type' => 'hidden')); ?>
									<span class="ship-currency-symbol"></span>
									<?php echo $this->Form->input('ProductShipmentCost.'.$i.'.shipment_cost', array('label' => __l('Shipping Cost ('.Configure::read('site.currency').')'), 'class' => 'js-ship-cost', 'id' => 'product_ship_cost'.$i)); ?>
									<span class="ship-currency-symbol"></span>
									<?php echo $this->Form->input('ProductShipmentCost.'.$i.'.additional_quantity_shipment_cost', array('label' => __l('Addition Quantity Ship Cost ('.Configure::read('site.currency').')'), 'class' => 'js-ship-cost', 'id' => 'product_ship_additional_cost'.$i)); ?>
                                    </div>
                                    </div>
                                    <div class="grid_left"><?php if($i >0): ?>
										<p class="press-link  delete"> <?php echo $this->Html->link(__l('Remove'), '#', array('class' => 'js-remove-clone delete'));?></p>
									<?php endif; ?>
									</div>
								
								</div>
								<?php
									endfor;
								?>
							</div>
							<p class="add"> <?php echo $this->Html->link(__l('Add more'), '#', array('class' => 'js-addmore add'));?></p>
						</div>
						<p class= " js-ship-info"></p>
					</div>
				</div>
			</div>
		</fieldset>
		<?php endif; ?>
		<fieldset class="fields-block">
			<h3><?php echo __l('Photos'); ?></h3>
			<div class="padd-center">
				<div class="page-info"><?php echo __l('Photo caption allows only 255 characters.'); ?></div>
				<div class="picture">
					<ol class=" upload-list clearfix">
						<?php for($i = 0; $i<Configure::read('product.max_upload_photo'); $i++): ?>
							<li>
								<div class="product-img"> 
									<?php
										if(!empty($this->request->data['Attachment'][$i])):
											$old_attachment = '';
											if (!empty($this->request->data['Attachment'][$i]['filename'])):
												$old_attachment = (!empty($_SESSION['property_file_info'][$this->request->data['Attachment'][$i]['filename']])) ? '1' :'';
											endif;
											echo $this->Form->input('Attachment.'.$i.'.checked_id', array('value'=>$old_attachment, 'id' =>'old_attachment'.$i, 'type' => 'hidden', 'label' => false));
											echo $this->Form->input('Attachment.'.$i.'.id', array('type'=>'hidden', 'value' => !empty($this->request->data['Attachment'][$i]['id']) ? $this->request->data['Attachment'][$i]['id'] : ''));
										endif;				
										echo $this->Form->uploader('Attachment.'.$i.'.filename', array('id' =>'Attachment.'.$i.'.filename', 'type'=>'file', 'uPreview' => '1', 'uFilecount'=>1, 'uController'=> 'products', 'uId' => 'ProductImage'.$i.'',  'uFiletype' => Configure::read('product.file.allowedExt')));
										echo $this->Form->input('ProductPhoto.'.$i.'.id', array('type' => 'hidden'));
									?>
									<span class="product-image-preview" id="preview_image<?php echo $i?>">
										<?php
											$enable_close = 0;				   
											if(!empty($this->request->data['Attachment'][$i]) && !empty($this->request->data['Attachment'][$i]['filename']) && !empty($_SESSION['property_file_info'][$this->request->data['Attachment'][$i]['filename']])):
												$enable_close = 1;
												$thumb_url = Router::url(array('controller' => 'products', 'action' => 'thumbnail', session_id(), $this->request->data['Attachment'][$i]['filename'], 'admin' => false) , true);
										?>
										<img src="<?php echo $thumb_url; ?>" /><input type="hidden" name="data[Attachment][<?php echo $i; ?>][filename]" value="<?php echo $this->request->data['Attachment'][$i]['filename']; ?>" />
										<?php
											elseif(!empty($this->request->data['Attachment'][$i]) && !empty($this->request->data['Attachment'][$i]['id'])):
												$enable_close = 1;
												$product_photo_title  = (!empty($this->request->data['Attachment'][$i]['description'])) ? $this->request->data['Attachment'][$i]['description'] : $this->request->data['Product']['title'];
												echo $this->Html->showImage('Product', $this->request->data['Attachment'][$i], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product_photo_title, false)), 'title' => $this->Html->cText($product_photo_title , false)));
											endif;
											if ($enable_close) {
										?>
												<a href="#" class="js-preview-close {id:<?php echo $i ?>}">&nbsp;</a>
										<?php
											}
										?>
									</span>
								</div>
								<div class="js-overlabel">
									<?php  echo $this->Form->input('Attachment.'.$i.'.description', array('type' => 'text', 'label' => __l('Caption'))); ?>
								</div>
							</li>
						<?php endfor; ?>
					</ol>
				</div>
			</div>
		</fieldset>
		<?php if(Configure::read('attribute.is_enabled_attribute')): ?>
        <?php if(!$product_order) {?>
        <fieldset class="fields-block">
        	<div class="page-info"><?php echo __l('If you change the variant group or uncheck the product variant, then existing variant combination for the product will be deleted.'); ?></div>
			<h3><?php echo __l('Product Options'); ?></h3>
            <div class="page-info"><?php echo __l('This is how your customers distinguish variations of your product. This product\'s variants have multiple options that distinguish them. Example: Size AND Color'); ?></div>
			<?php echo $this->Form->input('is_product_variant_enabled', array('label' => __l('Enable Product Distinguish With Variations?'), 'class' => 'js-enable-product-variant')); ?>
			<div class="js-product-variant-groups <?php echo (!empty($this->request->data['Product']['is_product_variant_enabled']))?'':'hide'; ?>">
			<?php echo $this->Form->input('AttributeGroupProduct.attribute_group_id', array('label' => __l('Variant Group'), 'multiple' => 'checkbox', 'options'=>$attributeGroups)); ?>
            </div>
		</fieldset>
        <?php } ?>
		<?php endif; ?>
		<fieldset class="fields-block">
			<h3><?php echo __l('Video'); ?></h3>
			<?php echo $this->Form->input('video_url',array('label' => __l('Video URL'),'info' => __l('You can post video URL from YouTube, Vimeo etc.'))); ?>
		</fieldset>
		<fieldset class="fields-block">
			<h3><?php echo __l('Meta'); ?></h3>
			<?php
				echo $this->Form->input('meta_keywords');
				echo $this->Form->input('meta_description');
			?>
		</fieldset>
		<?php if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
				<?php
					echo $this->Form->input('is_active', array('label' => __l('Active?')));
				?>
		<?php endif; ?>
		<div class="submit-block clearfix">
			<div class="submit-button-sec">
				<?php
					echo $this->Form->submit(__l('Update'), array('class' => 'js-update-order-field'));
					if(!empty($this->request->data['Product']['product_status_id']) && $this->request->data['Product']['product_status_id'] == ConstProductStatus::Draft):
						echo $this->Form->input('is_save_draft', array('type' => 'hidden', 'id' => 'js-save-draft'));
						echo $this->Form->submit(__l('Update as Draft'), array('name' => 'data[Product][save_as_draft]', 'class' => 'js-update-order-field'));
					endif;
				?>
			</div>
		</div>
	<?php echo $this->Form->end();?>
</div>
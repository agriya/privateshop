<?php /* SVN: $Id: $ */ ?>
<div class="products user-profile-form  form">
<div class="step-left">
    <div class="step-right">
        <div class="step-mid clearfix">
            <ul class="step-list">
                <li class="step-1 step-1-active"><a href="#" title="step1">Step 1</a></li>
                <li class="step-2" style="display:none;"><a href="#" title="step2">Step 2</a></li>
            </ul>
        </div>
    </div>
</div>
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
				echo $this->Form->input('is_start_end_date_required', array('type' => 'checkbox', 'label' => 'Is start and end date required?', 'class' => 'js-date-chkbox')); 
				if(empty($this->request->data['Product']['is_start_end_date_required'])){
					$class = 'hide';
				}
				else{
					$class = '';
				}
				?>
				<div class="<?php echo $class; ?> js-showdate">
                <?php echo $this->Form->input('start_date', array('orderYear' => 'asc', 'minYear' => date('Y')));
				echo $this->Form->input('end_date', array('orderYear' => 'asc', 'minYear' => date('Y'))); ?>
                </div>
				<?php echo $this->Form->input('quantity');
                echo $this->Form->input('maximum_quantity_to_buy_as_own', array('label' => __l('Maximum quantity can buy product as own'), 'info' => __l('Leave blank for no limit.')));
				echo $this->Form->input('maximum_quantity_to_send_as_gift', array('label' => __l('Maximum quantity can buy product as gift'), 'info' => __l('Leave blank for no limit.')));
				$productTypes = array(
					ConstProductTypes::Shipping => 'Shipping Product',
					ConstProductTypes::Download => 'Downloadable Product'
				);
				if (Configure::read('module.credits')):
					$productTypes = $productTypes + array(
						ConstProductTypes::Credit => 'Credit Product',
					);
				endif;
				echo $this->Form->input('product_type_id', array('class' => 'js-product-type', 'label' => __l('Product Type'), 'type' => 'select', 'options' => $productTypes));
			?>
		</fieldset>
		<fieldset class="fields-block js-saving-block">
				<h3><?php echo __l('Price'); ?></h3>
			<div class="price-form-block product-discount-form-block">
				<div class="product-discount-form-block1 discount-form-block clearfix">
					<?php 
						echo $this->Form->input('original_price', array('div' => 'input text ', 'label' => __l('Original Price ('.Configure::read('site.currency').')'), 'class' => 'js-price'));
						echo $this->Form->input('discount_percentage', array('div' => 'input text ', 'label' => __l('Discount (%)')));
						echo $this->Form->input('discount_amount', array('div' => 'input text ', 'label' => __l('Discount Amount ('.Configure::read('site.currency').')')));
						echo $this->Form->input('savings', array('div' => 'input text ', 'type' => 'text',  'label' => __l('Savings for User ('.Configure::read('site.currency').')'),  'readonly' => 'readonly'));
						echo $this->Form->input('discounted_price', array('div' => 'input text required ', 'label' => __l('Discounted Price for User ('.Configure::read('site.currency').')'), 'type' => 'text', 'readonly' => 'readonly'));
						?>
				</div>
			</div>
		</fieldset>
		<?php // [credits] extra fields element ?>
			<?php echo $this->element('credit-form'); ?>
		<?php // [credits] element include end ?>
		<?php if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
			<?php // [seller] extra fields element ?>
				<?php echo $this->element('seller-form'); ?>
			<?php // [seller] element include end ?>
		<?php endif; ?>
		<fieldset class="fields-block js-download-block">
        <h3><?php echo __l('File Download'); ?></h3>
			<div>
				<p class="requirement-left-block"><?php echo __l('Attach a file for your buyers to download'); ?></p>
				<?php echo $this->Form->input('ProductFile.filename', array('type' => 'file', 'size' => 30, 'label' => __l('Upload a file to sell'))); ?>
			</div>
		</fieldset>
		<fieldset class="js-shipping-block fields-block">
			<h3><?php echo __l('Shipping'); ?></h3>
			<div class="js-shipment-container clearfix shipment-container round-10">
				<div class="page-info"><?php echo __l('Specify the shipment cost details for this product.'); ?></div>
				<div class="clearfix new-block-add">
					<div class="js-clone add-form-block clearfix">
						<?php
							$count = (!empty($this->request->data['ProductShipmentCost'])) ? count($this->request->data['ProductShipmentCost']) : 1;
							for($i = 0; $i < $count; $i++) :
							  $shipment_cost = (!empty($this->request->data['ProductShipmentCost'][$i]['shipment_cost'])) ? $this->request->data['ProductShipmentCost'][$i]['shipment_cost'] : 0;
						?>
						<div class="js-field-list clearfix">
						<div class="add-shipping-block grid_left">
						<div class="clearfix">
                        	<?php echo $this->Form->input('ProductShipmentCost.'.$i.'.grouped_country_id', array('id' => 'product_ship_country'.$i, 'label' => __l('Country'), 'options' => $shipCountries, 'empty' => __l('Select a region or country'), 'class' =>'js-ship-country')); ?>
							<span class="ship-currency-symbol"></span>
							<?php echo $this->Form->input('ProductShipmentCost.'.$i.'.shipment_cost', array('label' => __l('Shipping Cost ('.Configure::read('site.currency').')'), 'class' => 'js-ship-cost', 'id' => 'product_ship_cost'.$i, 'value' => $shipment_cost)); ?>
							<span class="ship-currency-symbol"></span>
							<?php echo $this->Form->input('ProductShipmentCost.'.$i.'.additional_quantity_shipment_cost', array('label' => __l('Addition Quantity Ship Cost ('.Configure::read('site.currency').')'), 'class' => 'js-ship-cost', 'id' => 'product_ship_additional_cost'.$i)); ?>
                        </div>
                        </div>
                        	<?php if($i >0): ?>
								<p class="press-link delete"> <?php echo $this->Html->link(__l('Remove'), '#', array('class' => 'js-remove-clone delete'));?></p>
							<?php endif; ?>
						
						</div>
						<?php
							endfor;
						?>
					</div>
					<p> <?php echo $this->Html->link(__l('Add more'), '#', array('class' => 'js-addmore add'));?></p>
				</div>
				<p class="js-ship-info"></p>
			</div>
		</fieldset>
		<fieldset class="fields-block">
			<h3><?php echo __l('Photos'); ?></h3>
			<div class="padd-center">
				<div class="page-info"><?php echo __l('Photo caption allows only 255 characters.'); ?></div>
				<div class="picture">
					<ol class="upload-list clearfix">
						<?php for($i = 0; $i<Configure::read('product.max_upload_photo'); $i++):  ?>
							<li class="clearfix">
								<div class="product-img"> <?php echo $this->Form->uploader('Attachment.'.$i.'.filename', array('id' =>'Attachment.'.$i.'.filename', 'type'=>'file', 'uPreview' => '1', 'uFilecount'=>1, 'uController'=> 'products', 'uId' => 'ProductImage'.$i.'',  'uFiletype' => Configure::read('product.file.allowedExt'))); ?> 
									<span class="product-image-preview" id="preview_image<?php echo $i?>">
										<?php if(!empty($this->request->data['Attachment']) && !empty($this->request->data['Attachment'][$i]['filename'])) :?>
											<?php
												$thumb_url = Router::url(array('controller' => 'products', 'action' => 'thumbnail', session_id(), $this->request->data['Attachment'][$i]['filename'], 'admin' => false) , true);
											?>
											<img src="<?php echo $thumb_url; ?>" /><input type="hidden" name="data[Attachment][<?php echo $i; ?>][filename]" value="<?php echo $this->request->data['Attachment'][$i]['filename']; ?>" /><a href="#" class="js-preview-close {id:<?php echo $i ?>}">&nbsp;</a>
										<?php endif; ?>
									</span>
								</div>
								<div class="js-overlabel"><?php  echo $this->Form->input('Attachment.'.$i.'.description', array('type' => 'text', 'maxlength' => '255', 'label' => __l('Caption'))); ?></div>
							</li>
						<?php endfor; ?>
					</ol>
				</div>
			</div>
		</fieldset>
		<?php if(Configure::read('attribute.is_enabled_attribute')): ?>
        <fieldset class="fields-block">
			<h3><?php echo __l('Product Options'); ?></h3>
            <div class="page-info"><?php echo __l('This is how your customers distinguish variations of your product. This product\'s variants have multiple options that distinguish them. Example: Size AND Color'); ?></div>
			<?php echo $this->Form->input('is_product_variant_enabled', array('label' => __l('Enable Product Distinguish With Variations?'), 'class' => 'js-enable-product-variant')); ?>
			<div class="js-product-variant-groups <?php echo (!empty($this->request->data['Product']['is_product_variant_enabled']))?'':'hide'; ?>">
			<?php 
			echo $this->Form->input('AttributeGroupProduct.attribute_group_id', array('label' => 'Variant Group', 'multiple' => 'checkbox', 'options'=>$attributeGroups)); ?>
            </div>
		</fieldset>
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
		<?php if ($this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
			<?php echo $this->Form->input('is_active', array('label' => __l('Active?'))); ?>
		<?php endif; ?>
		<div class="submit-block clearfix">
			<?php echo $this->Form->input('is_save_draft', array('type' => 'hidden', 'id' => 'js-save-draft'));?>
				<div class="submit-button-sec grid_left">
					<?php echo $this->Form->submit(__l('Add'), array('class' => 'js-update-order-field', 'id' => 'add-button')); ?>
				</div>
				<div class="submit-button-sec grid_left">
				<?php echo $this->Form->submit(__l('Save as Draft'), array('name' => 'data[Product][save_as_draft]', 'class' => 'js-update-order-field')); ?>
				</div>
		</div>
		</fieldset>
	<?php echo $this->Form->end();?>
</div>